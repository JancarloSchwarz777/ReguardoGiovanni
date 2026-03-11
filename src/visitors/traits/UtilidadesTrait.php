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
            case 'rune': return ''; // Carácter nulo
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
        if ($this->esReferencia($valor)) {
            return "&" . $valor['id'] . " (" . $valor['tipo_base'] . "*)";
        }
        
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
     * Verifica si dos tipos son compatibles para una operación
     */
    // En UtilidadesTrait.php, mejorar tiposCompatibles:

    private function tiposCompatibles($tipo1, $tipo2, $operacion)
    {
        $compatibilidad = [
            // Operadores aritméticos
            '+' => [
                'int32' => ['int32' => 'int32', 'float32' => 'float32', 'rune' => 'rune'],
                'float32' => ['int32' => 'float32', 'float32' => 'float32'],
                'string' => ['string' => 'string', 'rune' => 'string'], // string + rune = string
                'rune' => ['int32' => 'rune', 'rune' => 'rune', 'string' => 'string']
            ],
            '-' => [
                'int32' => ['int32' => 'int32', 'float32' => 'float32', 'rune' => 'int32'],
                'float32' => ['int32' => 'float32', 'float32' => 'float32'],
                'rune' => ['int32' => 'int32', 'rune' => 'int32']
            ],
            '*' => [
                'int32' => ['int32' => 'int32', 'float32' => 'float32', 'rune' => 'int32'],
                'float32' => ['int32' => 'float32', 'float32' => 'float32'],
                'rune' => ['int32' => 'int32']
            ],
            '/' => [
                'int32' => ['int32' => 'int32', 'float32' => 'float32'],
                'float32' => ['int32' => 'float32', 'float32' => 'float32']
            ],
            '%' => [
                'int32' => ['int32' => 'int32']
            ],
            
            // Operadores relacionales
            '==' => [
                'int32' => ['int32' => 'bool', 'float32' => 'bool', 'rune' => 'bool'],
                'float32' => ['int32' => 'bool', 'float32' => 'bool'],
                'bool' => ['bool' => 'bool'],
                'rune' => ['rune' => 'bool', 'int32' => 'bool', 'string' => 'bool'],
                'string' => ['string' => 'bool', 'rune' => 'bool']
            ],
            '!=' => [
                'int32' => ['int32' => 'bool', 'float32' => 'bool', 'rune' => 'bool'],
                'float32' => ['int32' => 'bool', 'float32' => 'bool'],
                'bool' => ['bool' => 'bool'],
                'rune' => ['rune' => 'bool', 'int32' => 'bool', 'string' => 'bool'],
                'string' => ['string' => 'bool', 'rune' => 'bool']
            ],
            '<' => [
                'int32' => ['int32' => 'bool', 'float32' => 'bool', 'rune' => 'bool'],
                'float32' => ['int32' => 'bool', 'float32' => 'bool'],
                'string' => ['string' => 'bool', 'rune' => 'bool'],
                'rune' => ['int32' => 'bool', 'rune' => 'bool', 'string' => 'bool']
            ],
            '>' => [
                'int32' => ['int32' => 'bool', 'float32' => 'bool', 'rune' => 'bool'],
                'float32' => ['int32' => 'bool', 'float32' => 'bool'],
                'string' => ['string' => 'bool', 'rune' => 'bool'],
                'rune' => ['int32' => 'bool', 'rune' => 'bool', 'string' => 'bool']
            ],
            '<=' => [
                'int32' => ['int32' => 'bool', 'float32' => 'bool', 'rune' => 'bool'],
                'float32' => ['int32' => 'bool', 'float32' => 'bool'],
                'string' => ['string' => 'bool', 'rune' => 'bool'],
                'rune' => ['int32' => 'bool', 'rune' => 'bool', 'string' => 'bool']
            ],
            '>=' => [
                'int32' => ['int32' => 'bool', 'float32' => 'bool', 'rune' => 'bool'],
                'float32' => ['int32' => 'bool', 'float32' => 'bool'],
                'string' => ['string' => 'bool', 'rune' => 'bool'],
                'rune' => ['int32' => 'bool', 'rune' => 'bool', 'string' => 'bool']
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
        if ($this->esReferencia($valor)) {
            return 'puntero';
        }
        
        if ($valor === null) return 'nil';
        if (is_int($valor)) return 'int32';
        if (is_float($valor)) return 'float32';
        if (is_string($valor)) {
            // Si es un string de longitud 1, es rune
            if (strlen($valor) === 1) {
                return 'rune';  // ✅ Debe devolver 'rune', no 'string'
            }
            return 'string';
        }
        if (is_bool($valor)) return 'bool';
        if (is_array($valor)) return 'array';
        
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

    /**
     * Verifica si un array es un arreglo estructurado del lenguaje
     * (diferente de un múltiple retorno)
     */
    private function esArregloEstructurado($valor)
    {
        if (!is_array($valor)) {
            return false;
        }
        
        // Por ahora, asumimos que los arreglos del lenguaje tendrán una estructura específica
        // Esto lo ajustaremos cuando implementemos arreglos
        return false;
    }

    /**
     * Verifica si un valor es una referencia (puntero)
     */
    private function esReferencia($valor)
    {
        return is_array($valor) && isset($valor['__referencia']) && $valor['__referencia'] === true;
    }

    /**
     * Obtiene el valor real de una referencia
     */
    private function obtenerValorReferencia($referencia)
    {
        if (!$this->esReferencia($referencia)) {
            return $referencia;
        }
        
        $id = $referencia['id'];
        if (!isset($this->tablaSimbolos[$id])) {
            return null;
        }
        
        return $this->tablaSimbolos[$id]['valor'];
    }

}