<?php

trait FuncUsuarioGenTrait
{
    private $funcionesText = [];
    private $currentEpilogueLabel = "";
    
    // NUEVA: almacena los tipos de retorno de cada función
    private $funcionesTipos = [];
    
    /**
     * Registra una función definida por el usuario
     */
    public function visitFuncion($ctx)
    {
        $nombre = $ctx->IDENTIFICADOR() ? $ctx->IDENTIFICADOR()->getText() : 'main';
        if ($nombre === 'main') return null;
        
        error_log("=== GENERANDO FUNCIÓN USUARIO (ARM64): $nombre ===");
        
        // Guardar los tipos de retorno de esta función (hoisting)
        $tiposRetorno = $this->obtenerTiposRetornoFuncion($ctx);
        $this->funcionesTipos[$nombre] = $tiposRetorno;
        error_log("  Tipos de retorno de '$nombre': " . implode(',', $tiposRetorno));
        
        // Guardar el estado previo de las secciones
        $oldTextSection = $this->textSection;
        $this->textSection = [];
        
        $oldStackSize = $this->stackSize;
        $this->stackSize = 0;
        
        $oldAmbito = $this->ambitoActual;
        $this->ambitoActual = $nombre;
        array_push($this->pilaAmbitos, $nombre);
        
        // Generar la etiqueta una sola vez
        $this->currentEpilogueLabel = $this->newLabel($nombre . "_epilogue");
        
        // 1. Procesar parámetros
        $parametros = $ctx->parametros();
        if ($parametros) {
            foreach ($parametros->parametro() as $idx => $param) {
                $id = $param->IDENTIFICADOR()->getText();
                $tipo = $param->tipo()->getText();
                $esPuntero = (strpos($tipo, '*') === 0);
                $tipoBase = $esPuntero ? substr($tipo, 1) : $tipo;
                
                $offset = $this->reservarVariable($id, $tipo, $param->getStart()->getLine(), $param->getStart()->getCharPositionInLine());
                
                // Guardar el parámetro según su tipo
                if ($esPuntero) {
                    $this->emitText("str x$idx, [x29, #$offset]");
                    $this->tablaSimbolos[$id]['es_puntero'] = true;
                    $this->tablaSimbolos[$id]['tipo_base'] = $tipoBase;
                } elseif ($tipo === 'float32') {
                    $this->emitText("str s$idx, [x29, #$offset]");
                } elseif ($tipo === 'string' || $tipo === 'array') {
                    $this->emitText("str x$idx, [x29, #$offset]");
                } else {
                    $this->emitText("str w$idx, [x29, #$offset]");
                }
            }
        }
        
        // 2. Visitar el cuerpo de la función
        $this->visit($ctx->bloque());
        
        // 3. Generar prólogo y epílogo
        $alignedStackSize = ($this->stackSize + 15) & ~15;
        
        $funcCode = ".globl $nombre\n";
        $funcCode .= ".type $nombre, @function\n";
        $funcCode .= "$nombre:\n";
        $funcCode .= "    stp x29, x30, [sp, #-16]!\n";
        $funcCode .= "    mov x29, sp\n";
        if ($alignedStackSize > 0) {
            $funcCode .= "    sub sp, sp, #$alignedStackSize\n";
        }
        
        $funcCode .= implode("\n", $this->textSection) . "\n";
        
        $funcCode .= "\n" . $this->currentEpilogueLabel . ":\n";
        if ($alignedStackSize > 0) {
            $funcCode .= "    add sp, sp, #$alignedStackSize\n";
        }
        $funcCode .= "    ldp x29, x30, [sp], #16\n";
        $funcCode .= "    ret\n";
        
        // Restaurar estado global
        array_pop($this->pilaAmbitos);
        $this->ambitoActual = $oldAmbito;
        $this->textSection = $oldTextSection;
        $this->stackSize = $oldStackSize;
        
        $this->funcionesText[$nombre] = $funcCode;
        
        return null;
    }
    
    // NUEVO: obtener los tipos de retorno de una función por su nombre
    private function obtenerTiposRetornoFuncionPorNombre($nombre) {
        return $this->funcionesTipos[$nombre] ?? [];
    }
    
    /**
     * Genera código para return statement (soporta múltiples retornos)
     */
    public function visitReturnStmt($ctx)
    {
        $linea = $ctx->getStart()->getLine();
        $columna = $ctx->getStart()->getCharPositionInLine();
        
        if ($this->ambitoActual === 'global') {
            $this->agregarErrorSemantico("return solo puede usarse dentro de una función", $linea, $columna);
            return null;
        }
        
        if ($ctx->expresion()) {
            $expresiones = $ctx->expresion();
            
            if (is_array($expresiones) && count($expresiones) > 1) {
                error_log("  Múltiples retornos: " . count($expresiones) . " valores");
                $tempOffsets = [];
                for ($i = 0; $i < count($expresiones); $i++) {
                    $expr = $expresiones[$i];
                    $this->visit($expr);
                    $tempOffset = $this->reservarTemporal();
                    $this->guardarEnStack($tempOffset, 'int32');
                    $tempOffsets[] = $tempOffset;
                }
                for ($i = count($tempOffsets) - 1; $i >= 0; $i--) {
                    $this->cargarDeStack($tempOffsets[$i], 'int32');
                    if ($i == 0) {
                        $this->emitText("// Primer retorno en x0");
                    } else {
                        $this->emitText("mov x$i, x0");
                    }
                    $this->liberarTemporal($tempOffsets[$i]);
                }
            } else {
                if (is_array($expresiones)) {
                    $this->visit($expresiones[0]);
                } else {
                    $this->visit($expresiones);
                }
            }
        }
        
        if (!empty($this->currentEpilogueLabel)) {
            $this->emitText("b " . $this->currentEpilogueLabel);
        }
        return null;
    }
    
    /**
     * Llama a una función de usuario (soporta parámetros por referencia y múltiples retornos)
     */
        private function ejecutarFuncionUsuario($nombre, $argumentos, $linea, $columna)
    {
        error_log("=== LLAMADA A FUNCIÓN USUARIO (ARM64): $nombre ===");
        
        if (!isset($this->funciones[$nombre])) {
            $this->agregarErrorSemantico("La función '$nombre' no está definida", $linea, $columna);
            return 'nil';
        }
        
        // Obtener tipos de retorno
        $tiposRetorno = $this->obtenerTiposRetornoFuncionPorNombre($nombre);
        $numRetornos = count($tiposRetorno);
        error_log("  La función retorna " . $numRetornos . " valor(es): " . implode(', ', $tiposRetorno));
        
        // Modo evaluación de tipos
        if ($this->evaluandoTipo) {
            if ($numRetornos > 1) {
                return [
                    '__multiple_return' => true,
                    'num' => $numRetornos,
                    'tipos' => $tiposRetorno,
                    'offsets' => []
                ];
            } else {
                return empty($tiposRetorno) ? 'nil' : $tiposRetorno[0];
            }
        }
        
        $funcionCtx = $this->funciones[$nombre];
        $parametros = $funcionCtx->parametros();
        $listaParametros = $parametros ? $parametros->parametro() : [];
        
        if (count($argumentos) != count($listaParametros)) {
            $this->agregarErrorSemantico(
                "La función '$nombre' espera " . count($listaParametros) . 
                " parámetros, se recibieron " . count($argumentos),
                $linea, $columna
            );
            return 'nil';
        }
        
        // Guardar los valores de los argumentos en temporales (en orden)
        $tempOffsets = [];
        for ($i = 0; $i < count($argumentos); $i++) {
            $arg = $argumentos[$i];
            $tipoArg = $this->visit($arg);
            if (!$tipoArg) $tipoArg = 'int32';
            $tempOffset = $this->reservarTemporal();
            $this->guardarEnStack($tempOffset, $tipoArg);
            $tempOffsets[] = ['offset' => $tempOffset, 'tipo' => $tipoArg];
        }
        
        // Cargar argumentos en los registros x0, x1, ... en el orden correcto
                // Cargar argumentos en orden inverso para que el primero quede en x0
        for ($i = count($tempOffsets) - 1; $i >= 0; $i--) {
            $tempInfo = $tempOffsets[$i];
            $this->cargarDeStack($tempInfo['offset'], $tempInfo['tipo']);
            if ($i == 0) {
                // El primer argumento ya está en x0, no mover
            } else {
                // Mover a x$i (x1, x2, ...)
                if ($tempInfo['tipo'] === 'float32') {
                    $this->emitText("fmov s$i, s0");
                } else {
                    $this->emitText("mov w$i, w0");
                }
            }
            $this->liberarTemporal($tempInfo['offset']);
        }
        
        // Llamar a la función
        $this->emitText("bl $nombre");
        
        // Manejar múltiples retornos
        if ($numRetornos > 1) {
            $returnOffsets = [];
            for ($i = 0; $i < $numRetornos; $i++) {
                $tempOffset = $this->reservarTemporal();
                if ($i == 0) {
                    $this->guardarEnStack($tempOffset, $tiposRetorno[$i]);
                } else {
                    $this->emitText("mov x0, x$i");
                    $this->guardarEnStack($tempOffset, $tiposRetorno[$i]);
                }
                $returnOffsets[] = $tempOffset;
            }
            return [
                '__multiple_return' => true,
                'offsets' => $returnOffsets,
                'tipos' => $tiposRetorno,
                'num' => $numRetornos
            ];
        }
        
        return empty($tiposRetorno) ? 'nil' : $tiposRetorno[0];
    }
    
    public function getFuncionesText() {
        return $this->funcionesText;
    }
    
    private function buscarFuncionEnAST($nombre) {
        return $this->funciones[$nombre] ?? null;
    }
    
    private function obtenerTiposRetornoFuncion($funcionCtx) {
        $tipos = [];
        
        // Método 1: propiedad 'tipos' (múltiples retornos con paréntesis)
        if (method_exists($funcionCtx, 'tipos') && $funcionCtx->tipos() !== null) {
            $listaTipos = $funcionCtx->tipos()->tipo();
            if ($listaTipos !== null) {
                foreach ($listaTipos as $t) {
                    $tipos[] = $t->getText();
                }
                error_log("  Tipos desde ->tipos(): " . implode(',', $tipos));
                return $tipos;
            }
        }
        
        // Método 2: tipo único
        if (method_exists($funcionCtx, 'tipo') && $funcionCtx->tipo() !== null) {
            $tipos[] = $funcionCtx->tipo()->getText();
            error_log("  Tipo único desde ->tipo(): " . $tipos[0]);
            return $tipos;
        }
        
        // Método 3: búsqueda recursiva en hijos
        for ($i = 0; $i < $funcionCtx->getChildCount(); $i++) {
            $child = $funcionCtx->getChild($i);
            $clase = get_class($child);
            if (strpos($clase, 'TiposContext') !== false) {
                foreach ($child->tipo() as $t) {
                    $tipos[] = $t->getText();
                }
                error_log("  Tipos desde hijo TiposContext: " . implode(',', $tipos));
                return $tipos;
            } elseif (strpos($clase, 'TipoContext') !== false) {
                $tipos[] = $child->getText();
                error_log("  Tipo desde hijo TipoContext: " . $tipos[0]);
                return $tipos;
            }
        }
        
        error_log("  No se encontraron tipos de retorno para la función");
        return $tipos;
    }
}