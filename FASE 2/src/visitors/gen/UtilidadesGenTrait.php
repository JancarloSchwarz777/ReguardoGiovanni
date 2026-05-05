<?php

trait UtilidadesGenTrait
{
    protected function obtenerTipo($valor)
    {
        if ($valor === null) return 'nil';
        if (is_int($valor)) return 'int32';
        if (is_float($valor)) return 'float32';
        if (is_string($valor)) {
            if (strlen($valor) === 1) return 'rune';
            return 'string';
        }
        if (is_bool($valor)) return 'bool';
        if (is_array($valor)) {
            if (isset($valor['__multiple_return'])) return 'multiple';
            return 'array';
        }
        return 'unknown';
    }

    // ============================================================
    // GESTIÓN DE ÁMBITOS
    // ============================================================
    
    /**
     * Verifica si un identificador existe en el ámbito actual
     */
    protected function existeEnAmbitoActual($id)
    {
        return isset($this->offsets[$id]) && 
               isset($this->tablaSimbolos[$id]) && 
               $this->tablaSimbolos[$id]['ambito'] === $this->ambitoActual;
    }
    
    /**
     * Obtiene el offset de una variable en el stack
     */
    protected function getOffset($id)
    {
        return $this->offsets[$id] ?? null;
    }
    
    /**
     * Entra a un nuevo ámbito
     */
    protected function entrarAmbito($tipoAmbito)
    {
        $contador = 1;
        $nombreBase = $tipoAmbito;
        $nombreAmbito = $nombreBase;
        
        while (in_array($nombreAmbito, $this->pilaAmbitos)) {
            $nombreAmbito = $nombreBase . '_' . $contador;
            $contador++;
        }
        
        array_push($this->pilaAmbitos, $nombreAmbito);
        $this->ambitoActual = $nombreAmbito;
        
        error_log(">>> ENTRANDO a ámbito: " . $nombreAmbito);
        
        return $nombreAmbito;
    }
    
    /**
     * Sale del ámbito actual
     */
    protected function salirAmbito()
    {
        $ambitoSalida = array_pop($this->pilaAmbitos);
        
        // Eliminar variables de este ámbito de la tabla de símbolos
        foreach (array_keys($this->tablaSimbolos) as $key) {
            if (isset($this->tablaSimbolos[$key]) && 
                $this->tablaSimbolos[$key]['ambito'] === $ambitoSalida) {
                unset($this->tablaSimbolos[$key]);
                unset($this->offsets[$key]);
            }
        }
        
        error_log(">>> SALIENDO del ámbito: " . $ambitoSalida);
        
        $this->ambitoActual = end($this->pilaAmbitos);
    }
    
    // ============================================================
    // GESTIÓN DE TIPOS Y VALORES
    // ============================================================
    
    /**
     * Valor por defecto según tipo
     */
    protected function valorPorDefecto($tipo)
    {
        switch ($tipo) {
            case 'int32': return 0;
            case 'float32': return 0.0;
            case 'string': return "";
            case 'bool': return false;
            case 'rune': return '';
            default: return null;
        }
    }
    
    /**
     * Tamaño en bytes de cada tipo
     */
    protected function tamañoTipo($tipo)
    {
        if (strpos($tipo, '*') === 0 || $tipo === 'puntero') {
            return 8;
        }
        switch ($tipo) {
            case 'int32':
            case 'bool':
            case 'rune':
                return 4;
            case 'float32':
                return 8;   
            case 'string':
                return 8;
            default:
                return 8;
        }
    }
    
    /**
     * Infiere el tipo de un valor PHP (para constantes literales)
     */
    protected function inferirTipo($valor)
    {
        if ($valor === null) return 'nil';
        if (is_int($valor)) return 'int32';
        if (is_float($valor)) return 'float32';
        if (is_string($valor)) {
            // Si es un string de longitud 1, es rune
            if (strlen($valor) === 1) {
                return 'rune';
            }
            return 'string';
        }
        if (is_bool($valor)) return 'bool';
        if (is_array($valor)) return 'array';
        
        return 'unknown';
    }
    
    /**
     * Verifica si un tipo es numérico
     */
    protected function esTipoNumerico($tipo)
    {
        return $tipo === 'int32' || $tipo === 'float32';
    }
    
    /**
     * Verifica compatibilidad para asignación
     */
    protected function tiposCompatiblesAsignacion($tipoDeclarado, $tipoValor)
    {
        if ($tipoValor === 'nil') {
            return false;
        }
        
        // Permitir asignar int32 a float32 (promoción)
        if ($tipoDeclarado === 'float32' && $tipoValor === 'int32') {
            return true;
        }
        
        // Para los demás casos, deben ser iguales
        return $tipoDeclarado === $tipoValor;
    }
    
    /**
     * Verifica si un identificador es palabra reservada
     */
    protected function esPalabraReservada($id)
    {
        $reservadas = [
            'var', 'const', 'func', 'main', 'if', 'else', 'for',
            'return', 'break', 'continue', 'nil', 'true', 'false',
            'int32', 'float32', 'string', 'bool', 'rune',
            'fmt', 'Println', 'len', 'now', 'substr', 'typeOf',
            'switch', 'case', 'default'
        ];
        return in_array($id, $reservadas);
    }
    
    // ============================================================
    // GENERACIÓN DE CÓDIGO ARM64
    // ============================================================
    
    /**
     * Inicializa una variable con valor por defecto
     */
    protected function inicializarPorDefecto($offset, $tipo)
    {
        switch ($tipo) {
            case 'int32':
            case 'bool':
            case 'rune':
                $this->emitText("mov w0, #0");
                $this->emitText("str w0, [x29, #$offset]");
                break;
            case 'float32':
                $this->emitData(".balign 8");
                $labelZero = $this->newStringLabel();
                $this->emitData("$labelZero: .double 0.0");
                $this->emitText("adrp x0, $labelZero");
                $this->emitText("ldr d0, [x0, :lo12:$labelZero]");
                $this->emitText("str d0, [x29, #$offset]");
                break;
            case 'string':
                $emptyLabel = $this->newStringLabel();
                $this->emitData("$emptyLabel: .asciz \"\"");
                $this->emitText("adrp x0, $emptyLabel");
                $this->emitText("add x0, x0, :lo12:$emptyLabel");
                $this->emitText("str x0, [x29, #$offset]");
                break;
        }
    }
    
    /**
     * Guarda en stack manejando offsets grandes (fuera de rango -256 a 255)
     */
    protected function guardarEnStack($offset, $tipo)
    {
        if ($offset >= -255 && $offset <= 255) {
            switch ($tipo) {
                case 'int32':
                case 'bool':
                case 'rune':
                    $this->emitText("str w0, [x29, #$offset]");
                    break;
                case 'float32':
                    $this->emitText("str d0, [x29, #$offset]");
                    break;
                default:
                    $this->emitText("str x0, [x29, #$offset]");
                    break;
            }
        } else {
            // Usar registro temporal para offset grande
            $this->emitText("mov x16, #$offset");
            $this->emitText("add x16, x29, x16");
            switch ($tipo) {
                case 'int32':
                case 'bool':
                case 'rune':
                    $this->emitText("str w0, [x16]");
                    break;
                case 'float32':
                    $this->emitText("str d0, [x16]");
                    break;
                default:
                    $this->emitText("str x0, [x16]");
                    break;
            }
        }
    }

    /**
     * Carga desde stack manejando offsets grandes
     */
    protected function cargarDeStack($offset, $tipo)
    {
        if ($offset >= -255 && $offset <= 255) {
            switch ($tipo) {
                case 'int32':
                case 'bool':
                case 'rune':
                    $this->emitText("ldr w0, [x29, #$offset]");
                    break;
                case 'float32':
                    $this->emitText("ldr d0, [x29, #$offset]");
                    break;
                case 'puntero':
                case 'string':
                default:
                    $this->emitText("ldr x0, [x29, #$offset]");
                    break;
            }
        } else {
            $this->emitText("mov x16, #$offset");
            $this->emitText("add x16, x29, x16");
            switch ($tipo) {
                case 'int32':
                case 'bool':
                case 'rune':
                    $this->emitText("ldr w0, [x16]");
                    break;
                case 'float32':
                    $this->emitText("ldr d0, [x16]");
                    break;
                case 'puntero':
                case 'string':
                default:
                    $this->emitText("ldr x0, [x16]");
                    break;
            }
        }
    }
    
    /**
     * Carga un valor constante en x0/s0
     */
    protected function cargarConstante($valor, $tipo)
    {
        switch ($tipo) {
            case 'int32':
                $this->emitText("mov w0, #$valor");
                break;
            case 'bool':
                $this->emitText("mov w0, #" . ($valor ? '1' : '0'));
                break;
            case 'rune':
                $codigo = is_string($valor) ? ord($valor) : (int)$valor;
                $this->emitText("mov w0, #$codigo");
                break;
            case 'string':
                $label = $this->newStringLabel();
                $this->emitData("$label: .asciz \"" . addslashes($valor) . "\"");
                $this->emitText("adrp x0, $label");
                $this->emitText("add x0, x0, :lo12:$label");
                break;
            case 'float32':
                $this->emitData(".balign 8");
                $label = $this->newStringLabel();
                $this->emitData("$label: .double $valor");
                $this->emitText("adrp x0, $label");
                $this->emitText("ldr d0, [x0, :lo12:$label]");
                break;
        }
    }
    
    /**
     * Convierte un valor según el tipo destino
     */
    protected function convertirTipo($tipoOrigen, $tipoDestino)
    {
        if ($tipoOrigen === $tipoDestino) {
            return;
        }
        
        if ($tipoDestino === 'float32' && $tipoOrigen === 'int32') {
            $this->emitText("scvtf s0, w0");  // int a float
        } elseif ($tipoDestino === 'int32' && $tipoOrigen === 'float32') {
            $this->emitText("fcvtzs w0, s0");  // float a int
        } elseif ($tipoDestino === 'rune' && $tipoOrigen === 'int32') {
            // int32 a rune (carácter) - no necesita conversión, solo almacenar
            $this->emitText("// int32 a rune, sin conversión");
        } elseif ($tipoDestino === 'int32' && $tipoOrigen === 'rune') {
            // rune a int32 - no necesita conversión
            $this->emitText("// rune a int32, sin conversión");
        } else {
            $this->emitText("// Conversión de $tipoOrigen a $tipoDestino no implementada");
        }
    }
    
    // ============================================================
    // GESTIÓN DE ERRORES Y LOGGING
    // ============================================================
    
    /**
     * Agrega un error semántico al array
     */
    protected function agregarErrorSemantico($descripcion, $linea, $columna)
    {
        $this->errores[] = [
            'tipo' => 'Semántico',
            'descripcion' => $descripcion,
            'linea' => $linea,
            'columna' => $columna
        ];
        error_log("ERROR SEMÁNTICO [$linea,$columna]: $descripcion");
    }
    
    /**
     * Formatea un valor para logging
     */
    protected function formatearValor($valor)
    {
        if ($valor === null) return 'nil';
        if (is_bool($valor)) return $valor ? 'true' : 'false';
        if (is_string($valor)) return '"' . $valor . '"';
        if (is_int($valor)) return (string)$valor;
        if (is_float($valor)) {
            if (floor($valor) == $valor) {
                return (string)(int)$valor;
            }
            return (string)$valor;
        }
        if (is_array($valor)) {
            $elementos = [];
            foreach ($valor as $v) {
                $elementos[] = $this->formatearValor($v);
            }
            return '[' . implode(', ', $elementos) . ']';
        }
        return (string)$valor;
    }
    
    /**
     * Debug: muestra la tabla de símbolos actual
     */
    protected function debugTablaSimbolos($mensaje = "")
    {
        error_log("=== TABLA DE SÍMBOLOS $mensaje ===");
        foreach ($this->tablaSimbolos as $id => $info) {
            if (isset($info['ambito']) && $info['ambito'] === $this->ambitoActual) {
                error_log("  $id: {tipo: " . ($info['tipo'] ?? '?') . 
                        ", offset: " . ($info['offset'] ?? '?') . 
                        ", valor: " . $this->formatearValor($info['valor'] ?? null) . 
                        ", ámbito: " . ($info['ambito'] ?? '?') . "}");
            }
        }
        error_log("=================================");
    }
    
    // ============================================================
    // GESTIÓN DE TEMPORALES
    // ============================================================
    
    /**
     * Reserva espacio temporal en el stack
     */
    protected function reservarTemporal()
    {
        $this->stackSize += 8;
        $offset = -$this->stackSize;
        error_log("  Temporal reservado en offset $offset");
        return $offset;
    }
    
    /**
     * Libera espacio temporal del stack
     */
    protected function liberarTemporal($offset)
    {
        $this->stackSize -= 8;
        error_log("  Temporal liberado en offset $offset");
    }
    
    // ============================================================
    // VALORES LITERALES Y CONSTANTES
    // ============================================================
    
    /**
     * Obtiene el valor literal de una expresión para la tabla de símbolos
     */
    protected function obtenerValorLiteral($ctx)
    {
        if (!$ctx) return null;
        
        $texto = trim($ctx->getText());
        
        // Si el texto contiene signos matemáticos o llamadas a funciones, no es literal
        // Esto permite que el reporte sepa que debe poner "nil" porque depende de cálculos de AArch64
        if (preg_match('/[\+\-\*\/%&\|\!\(\)]/', $texto)) {
            return null;
        }

        if (is_numeric($texto)) {
            return strpos($texto, '.') !== false ? (float)$texto : (int)$texto;
        }
        if ($texto === 'true') return true;
        if ($texto === 'false') return false;
        
        // Cadenas
        if (strpos($texto, '"') === 0) {
            return trim($texto, '"');
        }
        // Runes
        if (strpos($texto, "'") === 0) {
            $contenido = trim($texto, "'");
            switch ($contenido) {
                case '\\n': return "\n";
                case '\\t': return "\t";
                case '\\r': return "\r";
                case '\\\\': return "\\";
                case '\\\'': return "'";
                case '\\"': return '"';
                default: return $contenido;
            }
        }
        
        return null;
    }
    
    /**
     * Evalúa si una expresión es constante (para optimización)
     */
    protected function esExpresionConstante($ctx)
    {
        if (!$ctx) return false;
        
        // Literales simples
        if ($ctx instanceof \GolampiParser\ExpresionPrimariaContext) {
            if ($ctx->NUMERO_ENTERO() || $ctx->NUMERO_DECIMAL() || 
                $ctx->CADENA() || $ctx->CARACTER() || 
                $ctx->TRUE() || $ctx->FALSE() || $ctx->NIL()) {
                return true;
            }
        }
        
        return false;
    }
    
    // ============================================================
    // MANEJO DE STRINGS (para .data)
    // ============================================================
    
    /**
     * Registra un string literal en la sección .data
     * Retorna la etiqueta generada
     */
    protected function registrarStringLiteral($str)
    {
        $label = $this->newStringLabel();
        $strEscapado = addcslashes($str, "\"\\\0..\37");
        $this->emitData("$label: .asciz \"$strEscapado\"");
        return $label;
    }
    
    /**
     * Carga la dirección de un string literal en x0
     */
    protected function cargarStringLiteral($str)
    {
        $label = $this->registrarStringLiteral($str);
        $this->emitText("adrp x0, $label");
        $this->emitText("add x0, x0, :lo12:$label");
    }

}