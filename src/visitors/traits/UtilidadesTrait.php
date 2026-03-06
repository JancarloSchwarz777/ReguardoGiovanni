<?php
trait UtilidadesTrait
{
// ============================================================ MÉTODOS AUXILIARES ============================================================
    private function existeEnAmbitoActual($id)
    {
        return isset($this->tablaSimbolos[$id]) && 
            $this->tablaSimbolos[$id]['ambito'] === $this->ambitoActual;
    }
    
    private function valorPorDefecto($tipo)
    {
        switch ($tipo) {
            case 'int32': return 0;
            case 'float32': return 0.0;
            case 'string': return "";
            case 'bool': return false;
            case 'rune': return '\u0000';
            default: return null;
        }
    }
    
    private function inferirTipo($valor)
    {
        if (is_int($valor)) return 'int32';
        if (is_float($valor)) return 'float32';
        if (is_string($valor)) return 'string';
        if (is_bool($valor)) return 'bool';
        return 'nil';
    }
    
    private function formatearValor($valor)
    {
        if ($valor === null) return 'nil';
        if (is_bool($valor)) return $valor ? 'true' : 'false';
        if (is_string($valor)) return $valor;
        if (is_float($valor) && floor($valor) == $valor) {
            return (string)(int)$valor;
        }
        return (string)$valor;
    }
    
    /**
     * Verifica si dos tipos son compatibles para una operación
     */
    private function tiposCompatibles($tipo1, $tipo2, $operacion)
    {
        $compatibilidad = [
            // Operadores aritméticos (ya existentes)
            '+' => [
                'int32' => ['int32' => 'int32', 'float32' => 'float32'],
                'float32' => ['int32' => 'float32', 'float32' => 'float32'],
                'string' => ['string' => 'string']
            ],
            '-' => [
                'int32' => ['int32' => 'int32', 'float32' => 'float32'],
                'float32' => ['int32' => 'float32', 'float32' => 'float32']
            ],
            '*' => [
                'int32' => ['int32' => 'int32', 'float32' => 'float32'],
                'float32' => ['int32' => 'float32', 'float32' => 'float32']
            ],
            '/' => [
                'int32' => ['int32' => 'int32', 'float32' => 'float32'],
                'float32' => ['int32' => 'float32', 'float32' => 'float32']
            ],
            '%' => [
                'int32' => ['int32' => 'int32']
            ],
            
            // Operadores relacionales (todos devuelven bool)
            '==' => [
                'int32' => ['int32' => 'bool', 'float32' => 'bool'],
                'float32' => ['int32' => 'bool', 'float32' => 'bool'],
                'bool' => ['bool' => 'bool'],
                'rune' => ['rune' => 'bool'],
                'string' => ['string' => 'bool']
            ],
            '!=' => [
                'int32' => ['int32' => 'bool', 'float32' => 'bool'],
                'float32' => ['int32' => 'bool', 'float32' => 'bool'],
                'bool' => ['bool' => 'bool'],
                'rune' => ['rune' => 'bool'],
                'string' => ['string' => 'bool']
            ],
            '<' => [
                'int32' => ['int32' => 'bool', 'float32' => 'bool'],
                'float32' => ['int32' => 'bool', 'float32' => 'bool'],
                'string' => ['string' => 'bool'] // Comparación lexicográfica
            ],
            '>' => [
                'int32' => ['int32' => 'bool', 'float32' => 'bool'],
                'float32' => ['int32' => 'bool', 'float32' => 'bool'],
                'string' => ['string' => 'bool']
            ],
            '<=' => [
                'int32' => ['int32' => 'bool', 'float32' => 'bool'],
                'float32' => ['int32' => 'bool', 'float32' => 'bool'],
                'string' => ['string' => 'bool']
            ],
            '>=' => [
                'int32' => ['int32' => 'bool', 'float32' => 'bool'],
                'float32' => ['int32' => 'bool', 'float32' => 'bool'],
                'string' => ['string' => 'bool']
            ],
            
            // Operadores lógicos
            '&&' => [
                'bool' => ['bool' => 'bool']
            ],
            '||' => [
                'bool' => ['bool' => 'bool']
            ]
        ];
        
        if (!isset($compatibilidad[$operacion][$tipo1][$tipo2])) {
            return null;
        }
        
        return $compatibilidad[$operacion][$tipo1][$tipo2];
    }

    /**
     * Obtiene el tipo de un valor
     */
    private function obtenerTipo($valor)
    {
        if ($valor === null) return 'nil';
        if (is_int($valor)) return 'int32';
        if (is_float($valor)) return 'float32';
        if (is_string($valor)) return 'string';
        if (is_bool($valor)) return 'bool';
        if (is_array($valor)) return 'array';
        
        // Si es numérico pero no int/float (ej: "123" como string)
        if (is_numeric($valor) && !is_string($valor)) {
            if (strpos((string)$valor, '.') !== false) {
                return 'float32';
            }
            return 'int32';
        }
        
        return 'unknown';
    }

    /**
 * Verifica si un identificador es palabra reservada
 */
    private function esPalabraReservada($id)
    {
        $reservadas = [
            'var', 'const', 'func', 'main', 'if', 'else', 'for',
            'return', 'break', 'continue', 'nil', 'true', 'false',
            'int32', 'float32', 'string', 'bool', 'rune',
            'fmt', 'Println', 'len', 'now', 'substr', 'typeOf'
        ];
        return in_array($id, $reservadas);
    }

    /**
     * Verifica compatibilidad para asignación
     */
    private function tiposCompatiblesAsignacion($tipoDeclarado, $tipoValor)
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
     * Agrega un error semántico al array
     */
    private function agregarErrorSemantico($descripcion, $linea, $columna)
    {
        $this->errores[] = [
            'tipo' => 'Semántico',
            'descripcion' => $descripcion,
            'linea' => $linea,
            'columna' => $columna
        ];
    }

    // Modificar el manejo de ámbitos en visitFuncion y visitBloque
    // Cuando entramos a un nuevo ámbito
    private function entrarAmbito($tipoAmbito)
    {
        // Generar un nombre único para el ámbito
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
        error_log(">>> Pila actual: " . implode(' -> ', $this->pilaAmbitos));
        
        return $nombreAmbito;
    }

    private function salirAmbito()
    {
        // Eliminar las variables y constantes de este ámbito de la tabla en tiempo de ejecución
        $ambitoSalida = array_pop($this->pilaAmbitos);
        
        // IMPORTANTE: No eliminar del historial, solo de la tabla de ejecución
        foreach (array_keys($this->tablaSimbolos) as $key) {
            if (isset($this->tablaSimbolos[$key]) && 
                $this->tablaSimbolos[$key]['ambito'] === $ambitoSalida) {
                unset($this->tablaSimbolos[$key]);
            }
        }
        
        error_log(">>> SALIENDO del ámbito: " . $ambitoSalida);
        error_log(">>> Pila actual: " . implode(' -> ', $this->pilaAmbitos));
        
        // Limpiar constantes de este ámbito (solo para validación)
        foreach (array_keys($this->constantes) as $clave) {
            if (strpos($clave, $ambitoSalida . '.') === 0) {
                unset($this->constantes[$clave]);
            }
        }
        
        $this->ambitoActual = end($this->pilaAmbitos);
    }

    public function getErrores()
    {
        return $this->errores;
    }

    /**
     * Verifica si un tipo es numérico
     */
    private function esTipoNumerico($tipo)
    {
        return $tipo === 'int32' || $tipo === 'float32';
    }

    private function debugTablaSimbolos($mensaje = "")
    {
        error_log("=== TABLA DE SÍMBOLOS $mensaje ===");
        foreach ($this->tablaSimbolos as $id => $info) {
            if (isset($info['ambito']) && $info['ambito'] === $this->ambitoActual) {
                error_log("  $id: {tipo: " . ($info['tipo'] ?? '?') . 
                        ", valor: " . $this->formatearValor($info['valor'] ?? null) . 
                        ", ámbito: " . ($info['ambito'] ?? '?') . "}");
            }
        }
        error_log("================================");
    }

}