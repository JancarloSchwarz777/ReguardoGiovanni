<?php
trait ExpresionesTrait

{

// ============================================================ EXPRESIONES ============================================================
    public function visitExpresionPrimaria($ctx)
    {
        if ($ctx->NUMERO_ENTERO()) {
            return (int)$ctx->NUMERO_ENTERO()->getText();
        }
        
        if ($ctx->NUMERO_DECIMAL()) {
            return (float)$ctx->NUMERO_DECIMAL()->getText();
        }
        
        if ($ctx->CADENA()) {
            $texto = $ctx->CADENA()->getText();
            return substr($texto, 1, -1);  // Quitar comillas
        }
        
        if ($ctx->CARACTER()) {
            $texto = $ctx->CARACTER()->getText();
            return substr($texto, 1, -1);  // Quitar comillas simples
        }
        
        if ($ctx->TRUE()) {
            return true;
        }
        
        if ($ctx->FALSE()) {
            return false;
        }
        
        if ($ctx->NIL()) {
            return null;
        }
        
        if ($ctx->IDENTIFICADOR()) {
            $id = $ctx->IDENTIFICADOR()->getText();
            if (isset($this->tablaSimbolos[$id])) {
                return $this->tablaSimbolos[$id]['valor'];
            } else {
                $this->agregarErrorSemantico(
                    "Variable '$id' no declarada",
                    $ctx->IDENTIFICADOR()->getSymbol()->getLine(),
                    $ctx->IDENTIFICADOR()->getSymbol()->getCharPositionInLine()
                );
                return null;
            }
        }
        
        if ($ctx->expresion()) {
            return $this->visit($ctx->expresion());
        }
        
        return null;
    }

    public function visitExpresionAditiva($ctx)
    {
        if (count($ctx->expresionMultiplicativa()) == 1) {
            return $this->visit($ctx->expresionMultiplicativa(0));
        }
        
        $resultado = $this->visit($ctx->expresionMultiplicativa(0));
        $tipoResultado = $this->obtenerTipo($resultado);
        
        for ($i = 1; $i < count($ctx->expresionMultiplicativa()); $i++) {
            $op = $ctx->getChild(2 * $i - 1)->getText();
            $valor = $this->visit($ctx->expresionMultiplicativa($i));
            $tipoValor = $this->obtenerTipo($valor);
            
            // Validar nil
            if ($tipoResultado === 'nil' || $tipoValor === 'nil') {
                $this->agregarErrorSemantico(
                    "Operación con nil no permitida",
                    $ctx->getStart()->getLine(),
                    $ctx->getStart()->getCharPositionInLine()
                );
                return null;
            }
            
            // Validar compatibilidad de tipos
            $tipoEsperado = $this->tiposCompatibles($tipoResultado, $tipoValor, $op);
            if ($tipoEsperado === null) {
                $this->agregarErrorSemantico(
                    "Operación '$op' no válida entre tipos '$tipoResultado' y '$tipoValor'",
                    $ctx->getStart()->getLine(),
                    $ctx->getStart()->getCharPositionInLine()
                );
                return null;
            }
            
            // Realizar operación con validación de división por cero
            if ($op === '+') {
                $resultado += $valor;
            } elseif ($op === '-') {
                $resultado -= $valor;
            }
            
            $tipoResultado = $tipoEsperado;
        }
        
        return $resultado;
    }
    
    

    public function visitExpresionMultiplicativa($ctx)
    {
        if (count($ctx->expresionUnaria()) == 1) {
            return $this->visit($ctx->expresionUnaria(0));
        }
        
        $resultado = $this->visit($ctx->expresionUnaria(0));
        $tipoResultado = $this->obtenerTipo($resultado);
        
        for ($i = 1; $i < count($ctx->expresionUnaria()); $i++) {
            $op = $ctx->getChild(2 * $i - 1)->getText();
            $valor = $this->visit($ctx->expresionUnaria($i));
            $tipoValor = $this->obtenerTipo($valor);
            
            // Validar nil
            if ($tipoResultado === 'nil' || $tipoValor === 'nil') {
                $this->agregarErrorSemantico(
                    "Operación con nil no permitida",
                    $ctx->getStart()->getLine(),
                    $ctx->getStart()->getCharPositionInLine()
                );
                return null;
            }
            
            // Validar compatibilidad de tipos
            $tipoEsperado = $this->tiposCompatibles($tipoResultado, $tipoValor, $op);
            if ($tipoEsperado === null) {
                $this->agregarErrorSemantico(
                    "Operación '$op' no válida entre tipos '$tipoResultado' y '$tipoValor'",
                    $ctx->getStart()->getLine(),
                    $ctx->getStart()->getCharPositionInLine()
                );
                return null;
            }
            
            // Realizar operación
            if ($op === '*') {
                $resultado *= $valor;
            } elseif ($op === '/') {
                if ($valor == 0) {
                    $this->agregarErrorSemantico(
                        "División por cero",
                        $ctx->getStart()->getLine(),
                        $ctx->getStart()->getCharPositionInLine()
                    );
                    return null;
                }
                $resultado /= $valor;
            } elseif ($op === '%') {
                if ($tipoResultado !== 'int32' || $tipoValor !== 'int32') {
                    $this->agregarErrorSemantico(
                        "Módulo solo válido para int32",
                        $ctx->getStart()->getLine(),
                        $ctx->getStart()->getCharPositionInLine()
                    );
                    return null;
                }
                if ($valor == 0) {
                    $this->agregarErrorSemantico(
                        "Módulo por cero",
                        $ctx->getStart()->getLine(),
                        $ctx->getStart()->getCharPositionInLine()
                    );
                    return null;
                }
                $resultado %= $valor;
            }
            
            $tipoResultado = $tipoEsperado;
        }
        
        return $resultado;
    }

    public function visitExpresionLogica($ctx)
    {
        if (count($ctx->expresionComparacion()) == 1) {
            return $this->visit($ctx->expresionComparacion(0));
        }
        
        $resultado = $this->visit($ctx->expresionComparacion(0));
        $linea = $ctx->getStart()->getLine();
        $columna = $ctx->getStart()->getCharPositionInLine();
        
        // Validar que la primera expresión sea bool
        if (!is_bool($resultado) && $resultado !== null) {
            $this->agregarErrorSemantico(
                "Operador lógico requiere expresiones booleanas",
                $linea,
                $columna
            );
            return null;
        }
        
        for ($i = 1; $i < count($ctx->expresionComparacion()); $i++) {
            $op = $ctx->getChild(2 * $i - 1)->getText();
            
            // Cortocircuito
            if ($op === '&&' && $resultado === false) {
                return false;
            }
            if ($op === '||' && $resultado === true) {
                return true;
            }
            
            $valor = $this->visit($ctx->expresionComparacion($i));
            
            // Validar que sea bool
            if (!is_bool($valor) && $valor !== null) {
                $this->agregarErrorSemantico(
                    "Operador lógico requiere expresiones booleanas",
                    $linea,
                    $columna
                );
                return null;
            }
            
            if ($op === '&&') {
                $resultado = $resultado && $valor;
            } else {
                $resultado = $resultado || $valor;
            }
        }
        
        return $resultado;
    }

    /**
     * Operadores relacionales: ==, !=, <, >, <=, >=
     */
    public function visitExpresionComparacion($ctx)
    {
        if (count($ctx->expresionAditiva()) == 1) {
            return $this->visit($ctx->expresionAditiva(0));
        }
        
        $resultado = $this->visit($ctx->expresionAditiva(0));
        $tipoResultado = $this->obtenerTipo($resultado);
        $linea = $ctx->getStart()->getLine();
        $columna = $ctx->getStart()->getCharPositionInLine();
        
        for ($i = 1; $i < count($ctx->expresionAditiva()); $i++) {
            $op = $ctx->getChild(2 * $i - 1)->getText();
            $valor = $this->visit($ctx->expresionAditiva($i));
            $tipoValor = $this->obtenerTipo($valor);
            
            // Validar nil
            if ($tipoResultado === 'nil' || $tipoValor === 'nil') {
                $this->agregarErrorSemantico(
                    "Operación relacional con nil no permitida",
                    $linea,
                    $columna
                );
                return false;
            }
            
            // Validar compatibilidad de tipos para la operación
            $tipoEsperado = $this->tiposCompatibles($tipoResultado, $tipoValor, $op);
            if ($tipoEsperado === null) {
                $this->agregarErrorSemantico(
                    "Operación '$op' no válida entre tipos '$tipoResultado' y '$tipoValor'",
                    $linea,
                    $columna
                );
                return false;
            }
            
            // Realizar la comparación según el operador
            switch ($op) {
                case '==':
                    $resultado = ($resultado == $valor);
                    break;
                case '!=':
                    $resultado = ($resultado != $valor);
                    break;
                case '<':
                    $resultado = ($resultado < $valor);
                    break;
                case '>':
                    $resultado = ($resultado > $valor);
                    break;
                case '<=':
                    $resultado = ($resultado <= $valor);
                    break;
                case '>=':
                    $resultado = ($resultado >= $valor);
                    break;
            }
            
            $tipoResultado = 'bool'; // Todas las comparaciones devuelven bool
        }
        
        return $resultado;
    }

}