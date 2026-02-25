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
    private function entrarAmbito($nombreAmbito)
    {
        array_push($this->pilaAmbitos, $nombreAmbito);
        $this->ambitoActual = $nombreAmbito;
    }

    // Cuando salimos de un ámbito
    private function salirAmbito()
    {
        // Eliminar las constantes de este ámbito de nuestro registro
        $ambitoSalida = array_pop($this->pilaAmbitos);
        
        // Limpiar constantes de este ámbito
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

}