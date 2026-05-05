<?php

trait ExpresionesGenTrait
{
    public function visitExpresion($ctx)
    {
        $tipo = $this->visit($ctx->expresionLogica());
        if (is_object($tipo) || empty($tipo)) {
            return 'int32';
        }
        return $tipo;
    }

    public function visitExpresionPrimaria($ctx)
    {
        if ($this->evaluandoTipo) {
            if ($ctx->NUMERO_ENTERO()) return 'int32';
            if ($ctx->NUMERO_DECIMAL()) return 'float32';
            if ($ctx->TRUE() || $ctx->FALSE()) return 'bool';
            if ($ctx->CADENA()) return 'string';
            if ($ctx->CARACTER()) return 'rune';
            if ($ctx->IDENTIFICADOR()) {
                $id = $ctx->IDENTIFICADOR()->getText();
                return $this->tablaSimbolos[$id]['tipo'] ?? 'nil';
            }
            return 'nil';
        }

        if ($ctx->NUMERO_ENTERO()) {
            $valor = $ctx->NUMERO_ENTERO()->getText();
            $this->emitText("mov w0, #$valor");
            return 'int32';
        }
        if ($ctx->NUMERO_DECIMAL()) {
            $valor = $ctx->NUMERO_DECIMAL()->getText();
            $this->emitData(".balign 8");
            $label = $this->newStringLabel();
            $this->emitData("$label: .double $valor");
            $this->emitText("adrp x0, $label");
            $this->emitText("ldr d0, [x0, :lo12:$label]");
            return 'float32';
        }
        if ($ctx->TRUE()) {
            $this->emitText("mov w0, #1");
            return 'bool';
        }
        if ($ctx->FALSE()) {
            $this->emitText("mov w0, #0");
            return 'bool';
        }
        if ($ctx->NIL()) {
            // nil se representa como string "<nil>" para printf
            $labelNil = $this->newStringLabel();
            $this->emitData("$labelNil: .asciz \"<nil>\"");
            $this->emitText("adrp x0, $labelNil");
            $this->emitText("add x0, x0, :lo12:$labelNil");
            return 'nil';  // importante: tipo nil
        }
        if ($ctx->CADENA()) {
            $texto = $ctx->CADENA()->getText();
            $valor = substr($texto, 1, -1);
            $label = $this->newStringLabel();
            $this->emitData("$label: .asciz \"" . addslashes($valor) . "\"");
            $this->emitText("adrp x0, $label");
            $this->emitText("add x0, x0, :lo12:$label");
            return 'string';
        }
        if ($ctx->CARACTER()) {
            $texto = $ctx->CARACTER()->getText();
            $contenido = substr($texto, 1, -1);
            switch ($contenido) {
                case '\\n': $codigo = 10; break;
                case '\\t': $codigo = 9; break;
                case '\\r': $codigo = 13; break;
                case '\\\\': $codigo = 92; break;
                case '\\\'': $codigo = 39; break;
                case '\\"': $codigo = 34; break;
                default: $codigo = ord($contenido);
            }
            $this->emitText("mov w0, #$codigo");
            return 'rune';
        }
        if ($ctx->IDENTIFICADOR()) {
            $id = $ctx->IDENTIFICADOR()->getText();
            if (isset($this->tablaSimbolos[$id])) {
                $tipo = $this->tablaSimbolos[$id]['tipo'];
                $offset = $this->tablaSimbolos[$id]['offset'];
                if ($tipo === 'puntero' || strpos($tipo, '*') === 0) {
                    $this->cargarDeStack($offset, 'puntero');
                    return 'puntero';
                }
                $this->cargarDeStack($offset, $tipo);
                return $tipo;
            } else {
                $linea = $ctx->IDENTIFICADOR()->getSymbol()->getLine();
                $columna = $ctx->IDENTIFICADOR()->getSymbol()->getCharPositionInLine();
                $this->agregarErrorSemantico("Variable '$id' no declarada", $linea, $columna);
                $this->emitText("mov x0, #0");
                return 'nil';
            }
        }
        if ($ctx->llamadaFuncion()) { return $this->visit($ctx->llamadaFuncion()); }
        if ($ctx->expresion()) { return $this->visit($ctx->expresion()); }
        if ($ctx->tipo() && $ctx->expresion()) {
            $tipoDestino = $ctx->tipo()->getText();
            $tipoOrigen = $this->visit($ctx->expresion());
            $this->convertirTipo($tipoOrigen, $tipoDestino);
            return $tipoDestino;
        }
        return 'nil';
    }
    
    public function visitExpresionUnaria($ctx)
    {
        $op = null;
        if ($ctx->NOT()) $op = '!';
        elseif ($ctx->MENOS()) $op = '-';
        elseif ($ctx->MULT()) $op = '*';
        elseif ($ctx->getChild(0) && $ctx->getChild(0)->getText() === '&') $op = '&';
        
        if ($op === null) return $this->visit($ctx->expresionPrimaria());
        
        $linea = $ctx->getStart()->getLine();
        $columna = $ctx->getStart()->getCharPositionInLine();
        
        switch ($op) {
            case '!':
                $tipo = $this->visit($ctx->expresionPrimaria());
                if ($tipo !== 'bool') {
                    $this->agregarErrorSemantico("Operador '!' solo para booleanos", $linea, $columna);
                }
                $this->emitText("cmp w0, #0");
                $this->emitText("cset w0, eq");
                return 'bool';
                
            case '-':
                $tipo = $this->visit($ctx->expresionPrimaria());
                if (!$this->esTipoNumerico($tipo)) {
                    $this->agregarErrorSemantico("Operador '-' solo numéricos", $linea, $columna);
                }
                if ($tipo === 'float32') {
                    $this->emitText("fneg d0, d0");
                } else {
                    $this->emitText("neg w0, w0");
                }
                return $tipo;
                
            case '&':
                // Operador de referencia: obtener dirección de una variable
                return $this->generarReferencia($ctx->expresionPrimaria(), $linea, $columna);
                
            case '*':
                // Operador de desreferenciación: acceder al valor apuntado
                return $this->generarDesreferencia($ctx->expresionPrimaria(), $linea, $columna);
        }
        return 'nil';
    }

    /**
     * Genera código para obtener la dirección de una variable (&x)
     */
    private function generarReferencia($exprCtx, $linea, $columna)
    {
        error_log("=== REFERENCIA (&) ===");
        error_log("  Tipo de contexto: " . get_class($exprCtx));
        
        // Intentar obtener el identificador de diferentes maneras
        $id = null;
        
        // Caso 1: Es ExpresionPrimariaContext con IDENTIFICADOR
        if ($exprCtx instanceof \GolampiParser\ExpresionPrimariaContext) {
            if ($exprCtx->IDENTIFICADOR()) {
                $id = $exprCtx->IDENTIFICADOR()->getText();
            }
        }
        // Caso 2: Es directamente un nodo IDENTIFICADOR
        else if (method_exists($exprCtx, 'IDENTIFICADOR')) {
            $idNode = $exprCtx->IDENTIFICADOR();
            if ($idNode) {
                $id = $idNode->getText();
            }
        }
        // Caso 3: El contexto tiene getText y es un identificador simple
        else if (method_exists($exprCtx, 'getText')) {
            $texto = $exprCtx->getText();
            // Verificar si es un identificador válido
            if (preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $texto)) {
                $id = $texto;
            }
        }
        
        if ($id === null) {
            $this->agregarErrorSemantico(
                "Operador '&' solo puede aplicarse a variables, no a expresiones",
                $linea,
                $columna
            );
            $this->emitText("mov x0, #0");
            return 'nil';
        }
        
        error_log("  Variable: $id");
        
        if (!isset($this->offsets[$id])) {
            $this->agregarErrorSemantico("Variable '$id' no declarada", $linea, $columna);
            $this->emitText("mov x0, #0");
            return 'nil';
        }
        
        $offset = $this->offsets[$id];
        // Calcular dirección: x29 + offset
        $this->emitText("add x0, x29, #$offset");
        error_log("  Dirección de $id: x29 + $offset");
        return 'puntero';
    }

    /**
     * Genera código para desreferenciar un puntero (*p)
     */
    private function generarDesreferencia($exprCtx, $linea, $columna)
    {
        error_log("=== DESREFERENCIA (*) ===");
        
        $tipo = $this->visit($exprCtx);
        
        if ($tipo !== 'puntero') {
            $this->agregarErrorSemantico("Operador '*' solo puede aplicarse a punteros", $linea, $columna);
            $this->emitText("mov x0, #0");
            return 'nil';
        }
        
        // Ahora x0 contiene la dirección. Cargar el valor apuntado (32 bits)
        $this->emitText("ldr w0, [x0]");  // Usar w0 para 32 bits
        error_log("  Desreferenciando: cargando valor desde la dirección en x0");
        return 'int32';
    }
    
    public function visitExpresionMultiplicativa($ctx)
    {
        $numOperandos = count($ctx->expresionUnaria());
        if ($numOperandos == 1) return $this->visit($ctx->expresionUnaria(0));
        
        // 1. Evaluar Izquierda
        $tipoResultado = $this->visit($ctx->expresionUnaria(0));
        $tempOffset = $this->reservarTemporal();
        $this->guardarEnStack($tempOffset, $tipoResultado);
        
        for ($i = 1; $i < $numOperandos; $i++) {
            $op = $ctx->getChild(2 * $i - 1)->getText();
            
            // 2. Evaluar Derecha (esto NO sobreescribirá izquierda porque está a salvo en la pila)
            $tipoOperando = $this->visit($ctx->expresionUnaria($i));
            
            // 3. Mover Derecha al registro secundario (w1 / s1)
            if ($tipoOperando === 'float32') $this->emitText("fmov s1, s0");
            else $this->emitText("mov w1, w0");
            
            // 4. Recuperar Izquierda al registro principal (w0 / s0)
            $this->cargarDeStack($tempOffset, $tipoResultado);
            
            $tipoEsperado = $this->tiposCompatiblesMultiplicativa($tipoResultado, $tipoOperando, $op);
            
            // 5. Operar w0 = w0 op w1
            if ($op === '*') {
                if ($tipoEsperado === 'float32') $this->emitText("fmul d0, d0, d1");
                else $this->emitText("mul w0, w0, w1");
            } elseif ($op === '/') {
                if ($tipoEsperado === 'float32') $this->emitText("fdiv d0, d0, d1");
                else $this->emitText("sdiv w0, w0, w1");
            } elseif ($op === '%') {
                $this->emitText("sdiv w2, w0, w1");
                $this->emitText("mul w2, w2, w1");
                $this->emitText("sub w0, w0, w2");
            }
            
            $tipoResultado = $tipoEsperado;
            $this->guardarEnStack($tempOffset, $tipoResultado); // Guardar para la sig. iteración
        }
        
        $this->cargarDeStack($tempOffset, $tipoResultado);
        $this->liberarTemporal($tempOffset);
        return $tipoResultado;
    }
    
    public function visitExpresionAditiva($ctx)
    {
        $numOperandos = count($ctx->expresionMultiplicativa());
        if ($numOperandos == 1) return $this->visit($ctx->expresionMultiplicativa(0));
        
        $tipoResultado = $this->visit($ctx->expresionMultiplicativa(0));
        $tempOffset = $this->reservarTemporal();
        $this->guardarEnStack($tempOffset, $tipoResultado);
        
        for ($i = 1; $i < $numOperandos; $i++) {
            $op = $ctx->getChild(2 * $i - 1)->getText();
            
            // Evaluar Derecha primero
            $tipoOperando = $this->visit($ctx->expresionMultiplicativa($i));
            
            // Mover Derecha a secundarios
            if ($tipoOperando === 'float32') $this->emitText("fmov s1, s0");
            else $this->emitText("mov w1, w0");
            
            // Recuperar Izquierda
            $this->cargarDeStack($tempOffset, $tipoResultado);
            
            $tipoEsperado = $this->tiposCompatiblesAditiva($tipoResultado, $tipoOperando, $op);
            
            if ($op === '+') {
                if ($tipoEsperado === 'float32') $this->emitText("fadd d0, d0, d1");
                else $this->emitText("add w0, w0, w1");
            } elseif ($op === '-') {
                if ($tipoEsperado === 'float32') $this->emitText("fsub d0, d0, d1");
                else $this->emitText("sub w0, w0, w1");
            }
            
            $tipoResultado = $tipoEsperado;
            $this->guardarEnStack($tempOffset, $tipoResultado);
        }
        
        $this->cargarDeStack($tempOffset, $tipoResultado);
        $this->liberarTemporal($tempOffset);
        return $tipoResultado;
    }
    
    public function visitExpresionComparacion($ctx)
    {
        $numOperandos = count($ctx->expresionAditiva());
        if ($numOperandos == 1) return $this->visit($ctx->expresionAditiva(0));
        
        // Detectar nil == nil mediante evaluación de tipos
        $oldEval = $this->evaluandoTipo;
        $this->evaluandoTipo = true;
        $tipoIzq = $this->visit($ctx->expresionAditiva(0));
        $tipoDer = $this->visit($ctx->expresionAditiva(1));
        $this->evaluandoTipo = $oldEval;
        
        if ($tipoIzq === 'nil' && $tipoDer === 'nil') {
            $op = $ctx->getChild(1)->getText();
            $this->emitText($op == '==' ? "mov w0, #1" : "mov w0, #0");
            return 'bool';
        }
        
        // Evaluar Izquierda
        $tipoResultado = $this->visit($ctx->expresionAditiva(0));
        $tempOffset = $this->reservarTemporal();
        $this->guardarEnStack($tempOffset, $tipoResultado);
        
        for ($i = 1; $i < $numOperandos; $i++) {
            $op = $ctx->getChild(2 * $i - 1)->getText();
            $tipoOperando = $this->visit($ctx->expresionAditiva($i));
            if ($tipoOperando === 'float32') $this->emitText("fmov d1, d0");
            else $this->emitText("mov w1, w0");
            $this->cargarDeStack($tempOffset, $tipoResultado);
            
            if ($tipoResultado === 'float32') $this->emitText("fcmp d0, d1");
            else $this->emitText("cmp w0, w1");
            
            $labelTrue = $this->newLabel("cmp_true");
            $labelEnd = $this->newLabel("cmp_end");
            switch ($op) {
                case '==': $cond = "eq"; break;
                case '!=': $cond = "ne"; break;
                case '<': $cond = "lt"; break;
                case '>': $cond = "gt"; break;
                case '<=': $cond = "le"; break;
                case '>=': $cond = "ge"; break;
                default: $cond = "eq";
            }
            $this->emitText("b.$cond $labelTrue");
            $this->emitText("mov w0, #0");
            $this->emitText("b $labelEnd");
            $this->emitText("$labelTrue:");
            $this->emitText("mov w0, #1");
            $this->emitText("$labelEnd:");
            
            $tipoResultado = 'bool';
            $this->guardarEnStack($tempOffset, $tipoResultado);
        }
        
        $this->cargarDeStack($tempOffset, $tipoResultado);
        $this->liberarTemporal($tempOffset);
        return 'bool';
    }
    
    public function visitExpresionLogica($ctx)
    {
        $numOperandos = count($ctx->expresionComparacion());
        if ($numOperandos == 1) return $this->visit($ctx->expresionComparacion(0));
        
        // Evaluar lado izquierdo (queda en w0)
        $this->visit($ctx->expresionComparacion(0));
        
        for ($i = 1; $i < $numOperandos; $i++) {
            $op = $ctx->getChild(2 * $i - 1)->getText();
            $labelEnd = $this->newLabel("logic_end");
            
            // Cortocircuito MÁGICO:
            if ($op === '&&') {
                $this->emitText("cmp w0, #0");
                $this->emitText("b.eq $labelEnd"); // Si es falso, salta (y w0 ya vale 0, que es correcto)
            } else { // ||
                $this->emitText("cmp w0, #0");
                $this->emitText("b.ne $labelEnd"); // Si es verdadero, salta (y w0 ya vale 1, que es correcto)
            }
            
            // Evaluar lado derecho (sobreescribe w0)
            $this->visit($ctx->expresionComparacion($i));
            
            $this->emitText("$labelEnd:");
        }
        return 'bool';
    }

    // ============ MÉTODOS AUXILIARES ============
    
    /**
     * Guarda un valor en un registro temporal (para operaciones)
     */
    private function guardarTemporal($registro, $tipo)
    {
        // Los temporales se manejan con stack
    }
    
    /**
     * Verifica compatibilidad de tipos para operaciones multiplicativas
     */
    private function tiposCompatiblesMultiplicativa($tipo1, $tipo2, $op)
    {
        if ($op === '%') {
            return ($tipo1 === 'int32' && $tipo2 === 'int32') ? 'int32' : null;
        }
        
        if ($tipo1 === 'float32' || $tipo2 === 'float32') {
            return 'float32';
        }
        
        if ($tipo1 === 'int32' && $tipo2 === 'int32') {
            return 'int32';
        }
        
        return null;
    }
    
    /**
     * Verifica compatibilidad de tipos para operaciones aditivas
     */
    private function tiposCompatiblesAditiva($tipo1, $tipo2, $op)
    {
        // Concatenación de strings
        if ($op === '+' && ($tipo1 === 'string' || $tipo2 === 'string')) {
            return 'string';
        }
        
        // Operaciones numéricas
        if ($tipo1 === 'float32' || $tipo2 === 'float32') {
            return 'float32';
        }
        
        if ($tipo1 === 'int32' && $tipo2 === 'int32') {
            return 'int32';
        }
        
        return null;
    }
    
    /**
     * Verifica si dos tipos son comparables
     */
    private function tiposComparables($tipo1, $tipo2)
    {
        if ($tipo1 === $tipo2) return true;
        if ($tipo1 === 'int32' && $tipo2 === 'float32') return true;
        if ($tipo1 === 'float32' && $tipo2 === 'int32') return true;
        return false;
    }
}