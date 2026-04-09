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
            return substr($texto, 1, -1);
        }
        
        if ($ctx->CARACTER()) {
            $texto = $ctx->CARACTER()->getText();
            $contenido = substr($texto, 1, -1);
            
            if ($contenido === '\\n') return "\n";
            if ($contenido === '\\t') return "\t";
            if ($contenido === '\\r') return "\r";
            if ($contenido === '\\\\') return "\\";
            if ($contenido === '\\\'') return "'";
            if ($contenido === '\\"') return '"';
            
            return $contenido;
        }
        
        if ($ctx->TRUE()) return true;
        if ($ctx->FALSE()) return false;
        if ($ctx->NIL()) return null;
        
        if ($ctx->IDENTIFICADOR()) {
            $id = $ctx->IDENTIFICADOR()->getText();
            error_log("Accediendo a variable: $id");
            
            if (isset($this->tablaSimbolos[$id])) {
                $info = $this->tablaSimbolos[$id];
                
                // Si es un puntero, devolvemos el valor que contiene
                if ($info['es_puntero'] ?? false) {
                    $valor = $info['valor'];
                    error_log("  Es un puntero, valor: " . $this->formatearValor($valor));
                    return $valor;
                }
                
                error_log("  Valor encontrado: " . $this->formatearValor($info['valor']));
                return $info['valor'];
            } else {
                $this->agregarErrorSemantico(
                    "Variable '$id' no declarada",
                    $ctx->IDENTIFICADOR()->getSymbol()->getLine(),
                    $ctx->IDENTIFICADOR()->getSymbol()->getCharPositionInLine()
                );
                return null;
            }
        }
        
        if ($ctx->llamadaFuncion()) {
            return $this->visit($ctx->llamadaFuncion());
        }
        
        if ($ctx->expresion()) {
            return $this->visit($ctx->expresion());
        }

        if ($ctx->tipo() && $ctx->expresion()) {
        $tipoDestino = $ctx->tipo()->getText();
        $valor = $this->visit($ctx->expresion());
        
        error_log("=== CONVERSIÓN DE TIPO: a $tipoDestino ===");
        error_log("  Valor original: " . $this->formatearValor($valor));
        
        $resultado = $this->convertirTipo($valor, $tipoDestino, $ctx->getStart()->getLine(), $ctx->getStart()->getCharPositionInLine());
        
        error_log("  Valor convertido: " . $this->formatearValor($resultado));
        return $resultado;
        }
        
        return null;
    }

    public function visitExpresionAditiva($ctx)
    {
        if (count($ctx->expresionMultiplicativa()) == 1) {
            return $this->visit($ctx->expresionMultiplicativa(0));
        }
        
        $valores = [];
        $tipos = [];
        
        $ambitoOriginal = $this->ambitoActual;
        $pilaOriginal = $this->pilaAmbitos;
        $tablaOriginal = $this->tablaSimbolos;
        
        for ($i = 0; $i < count($ctx->expresionMultiplicativa()); $i++) {
            $this->ambitoActual = $ambitoOriginal;
            $this->pilaAmbitos = $pilaOriginal;
            $this->tablaSimbolos = $tablaOriginal;
            
            $valores[] = $this->visit($ctx->expresionMultiplicativa($i));
            $tipos[] = $this->obtenerTipo($valores[$i]);
        }
        
        $resultado = $valores[0];
        $tipoResultado = $tipos[0];
        
        for ($i = 1; $i < count($valores); $i++) {
            $op = $ctx->getChild(2 * $i - 1)->getText();
            $valor = $valores[$i];
            $tipoValor = $tipos[$i];
            
            if ($tipoResultado === 'nil' || $tipoValor === 'nil') {
                $this->agregarErrorSemantico(
                    "Operación con nil no permitida",
                    $ctx->getStart()->getLine(),
                    $ctx->getStart()->getCharPositionInLine()
                );
                return null;
            }
            
            $tipoEsperado = $this->tiposCompatibles($tipoResultado, $tipoValor, $op);
            if ($tipoEsperado === null) {
                $this->agregarErrorSemantico(
                    "Operación '$op' no válida entre tipos '$tipoResultado' y '$tipoValor'",
                    $ctx->getStart()->getLine(),
                    $ctx->getStart()->getCharPositionInLine()
                );
                return null;
            }
            
            // MANEJO ESPECIAL PARA RUNE + INT32 / RUNE - INT32
            if ($op === '+') {
                if ($tipoResultado === 'rune' && $tipoValor === 'int32') {
                    // rune + int32: convertir rune a código ASCII, sumar, convertir de vuelta
                    $codigo = ord($resultado);
                    $codigo += $valor;
                    $resultado = chr($codigo);
                } elseif ($tipoResultado === 'int32' && $tipoValor === 'rune') {
                    // int32 + rune: convertir rune a código, sumar, convertir de vuelta
                    $codigo = ord($valor);
                    $codigo += $resultado;
                    $resultado = chr($codigo);
                } elseif ($tipoResultado === 'rune' && $tipoValor === 'rune') {
                    // rune + rune: convertir ambos a códigos, sumar, convertir de vuelta
                    $codigo1 = ord($resultado);
                    $codigo2 = ord($valor);
                    $resultado = chr($codigo1 + $codigo2);
                } elseif ($tipoResultado === 'string' && $tipoValor === 'rune') {
                    // string + rune: concatenar
                    $resultado .= $valor;
                } elseif ($tipoResultado === 'rune' && $tipoValor === 'string') {
                    // rune + string: concatenar
                    $resultado = $resultado . $valor;
                } else {
                    // Operación numérica normal
                    $resultado += $valor;
                }
            } elseif ($op === '-') {
                if ($tipoResultado === 'rune' && $tipoValor === 'int32') {
                    // rune - int32: convertir rune a código, restar, convertir de vuelta
                    $codigo = ord($resultado);
                    $codigo -= $valor;
                    $resultado = chr($codigo);
                } elseif ($tipoResultado === 'int32' && $tipoValor === 'rune') {
                    // int32 - rune: convertir rune a código, restar, convertir de vuelta
                    $codigo = ord($valor);
                    $resultado = $resultado - $codigo;
                } elseif ($tipoResultado === 'rune' && $tipoValor === 'rune') {
                    // rune - rune: diferencia de códigos (resultado int32)
                    $codigo1 = ord($resultado);
                    $codigo2 = ord($valor);
                    $resultado = $codigo1 - $codigo2;
                    $tipoEsperado = 'int32';
                } else {
                    // Resta numérica normal
                    $resultado -= $valor;
                }
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
        
        $valores = [];
        $tipos = [];
        
        $ambitoOriginal = $this->ambitoActual;
        $pilaOriginal = $this->pilaAmbitos;
        $tablaOriginal = $this->tablaSimbolos;
        
        for ($i = 0; $i < count($ctx->expresionUnaria()); $i++) {
            $this->ambitoActual = $ambitoOriginal;
            $this->pilaAmbitos = $pilaOriginal;
            $this->tablaSimbolos = $tablaOriginal;
            
            $valores[] = $this->visit($ctx->expresionUnaria($i));
            $tipos[] = $this->obtenerTipo($valores[$i]);
        }
        
        $resultado = $valores[0];
        $tipoResultado = $tipos[0];
        
        for ($i = 1; $i < count($valores); $i++) {
            $op = $ctx->getChild(2 * $i - 1)->getText();
            $valor = $valores[$i];
            $tipoValor = $tipos[$i];
            
            if ($tipoResultado === 'nil' || $tipoValor === 'nil') {
                $this->agregarErrorSemantico(
                    "Operación con nil no permitida",
                    $ctx->getStart()->getLine(),
                    $ctx->getStart()->getCharPositionInLine()
                );
                return null;
            }
            
            $tipoEsperado = $this->tiposCompatibles($tipoResultado, $tipoValor, $op);
            if ($tipoEsperado === null) {
                $this->agregarErrorSemantico(
                    "Operación '$op' no válida entre tipos '$tipoResultado' y '$tipoValor'",
                    $ctx->getStart()->getLine(),
                    $ctx->getStart()->getCharPositionInLine()
                );
                return null;
            }
            
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
            
            if ($op === '&&' && $resultado === false) return false;
            if ($op === '||' && $resultado === true) return true;
            
            $valor = $this->visit($ctx->expresionComparacion($i));
            
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

    // En visitExpresionComparacion, asegurar que las comparaciones con rune funcionen
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
            
            if ($tipoResultado === 'nil' || $tipoValor === 'nil') {
                if ($op === '==') {
                    return ($tipoResultado === 'nil' && $tipoValor === 'nil') || 
                            ($resultado === null && $valor === null);
                }
                if ($op === '!=') {
                    return !(($tipoResultado === 'nil' && $tipoValor === 'nil') || 
                            ($resultado === null && $valor === null));
                }
                
                $this->agregarErrorSemantico(
                    "Operación relacional con nil no permitida",
                    $linea,
                    $columna
                );
                return false;
            }
            
            // MANEJO ESPECIAL PARA COMPARACIONES CON RUNE
            if ($tipoResultado === 'rune' && $tipoValor === 'int32') {
                // Convertir rune a código ASCII para comparar
                $codigo = ord($resultado);
                $resultado = $codigo;
                $tipoResultado = 'int32';
            } elseif ($tipoResultado === 'int32' && $tipoValor === 'rune') {
                // Convertir rune a código ASCII para comparar
                $codigo = ord($valor);
                $valor = $codigo;
                $tipoValor = 'int32';
            } elseif ($tipoResultado === 'rune' && $tipoValor === 'rune') {
                // Comparar runes directamente (como strings de 1 carácter)
                // No necesitamos conversión especial
            }
            
            $tipoEsperado = $this->tiposCompatibles($tipoResultado, $tipoValor, $op);
            if ($tipoEsperado === null) {
                $this->agregarErrorSemantico(
                    "Operación '$op' no válida entre tipos '$tipoResultado' y '$tipoValor'",
                    $linea,
                    $columna
                );
                return false;
            }
            
            switch ($op) {
                case '==': $resultado = ($resultado == $valor); break;
                case '!=': $resultado = ($resultado != $valor); break;
                case '<': $resultado = ($resultado < $valor); break;
                case '>': $resultado = ($resultado > $valor); break;
                case '<=': $resultado = ($resultado <= $valor); break;
                case '>=': $resultado = ($resultado >= $valor); break;
            }
            
            $tipoResultado = 'bool';
        }
        
        return $resultado;
    }

    public function visitExpresionUnaria($ctx)
    {
        $op = null;
        if ($ctx->NOT()) $op = '!';
        elseif ($ctx->MENOS()) $op = '-';
        elseif ($ctx->MULT()) $op = '*';
        elseif ($ctx->getChild(0) && $ctx->getChild(0)->getText() === '&') $op = '&';
        
        $linea = $ctx->getStart()->getLine();
        $columna = $ctx->getStart()->getCharPositionInLine();
        
        if ($op === null) {
            return $this->visit($ctx->expresionPrimaria());
        }
        
        switch ($op) {
            case '!':
                $valor = $this->visit($ctx->expresionPrimaria());
                if (!is_bool($valor) && $valor !== null) {
                    $this->agregarErrorSemantico(
                        "Operador '!' solo válido para booleanos",
                        $linea,
                        $columna
                    );
                    return null;
                }
                return !$valor;
                
            case '-':
                $valor = $this->visit($ctx->expresionPrimaria());
                if (!$this->esTipoNumerico($this->obtenerTipo($valor))) {
                    $this->agregarErrorSemantico(
                        "Operador '-' solo válido para tipos numéricos",
                        $linea,
                        $columna
                    );
                    return null;
                }
                return -$valor;
                
            case '*':
                $valor = $this->visit($ctx->expresionPrimaria());
                return $this->desreferenciar($valor, $linea, $columna);
                
            case '&':
                return $this->referenciar($ctx->expresionPrimaria(), $linea, $columna);
        }
        
        return null;
    }

    private function referenciar($exprCtx, $linea, $columna)
    {
        error_log("=== REFERENCIANDO ===");
        
        if ($exprCtx instanceof \GolampiParser\ExpresionPrimariaContext) {
            if ($exprCtx->IDENTIFICADOR()) {
                $id = $exprCtx->IDENTIFICADOR()->getText();
                
                if (!isset($this->tablaSimbolos[$id])) {
                    $this->agregarErrorSemantico(
                        "Variable '$id' no declarada",
                        $linea,
                        $columna
                    );
                    return null;
                }
                
                $referencia = [
                    '__referencia' => true,
                    'id' => $id,
                    'ambito' => $this->tablaSimbolos[$id]['ambito'],
                    'tipo_base' => $this->tablaSimbolos[$id]['tipo']
                ];
                
                error_log("  Referencia creada: " . $this->formatearValor($referencia));
                return $referencia;
            }
        }
        
        if (method_exists($exprCtx, 'getText')) {
            $texto = $exprCtx->getText();
            
            if (preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $texto)) {
                $id = $texto;
                
                if (!isset($this->tablaSimbolos[$id])) {
                    $this->agregarErrorSemantico(
                        "Variable '$id' no declarada",
                        $linea,
                        $columna
                    );
                    return null;
                }
                
                $referencia = [
                    '__referencia' => true,
                    'id' => $id,
                    'ambito' => $this->tablaSimbolos[$id]['ambito'],
                    'tipo_base' => $this->tablaSimbolos[$id]['tipo']
                ];
                
                error_log("  Referencia creada: " . $this->formatearValor($referencia));
                return $referencia;
            }
        }
        
        $this->agregarErrorSemantico(
            "Operador '&' solo puede aplicarse a variables",
            $linea,
            $columna
        );
        return null;
    }

    private function desreferenciar($valor, $linea, $columna)
    {
        error_log("=== DESREFERENCIANDO ===");
        error_log("  Valor: " . $this->formatearValor($valor));
        
        if ($valor === null) {
            $this->agregarErrorSemantico(
                "No se puede desreferenciar nil",
                $linea,
                $columna
            );
            return null;
        }
        
        if (!$this->esReferencia($valor)) {
            $this->agregarErrorSemantico(
                "Operador '*' solo puede aplicarse a punteros",
                $linea,
                $columna
            );
            return null;
        }
        
        $vistos = [];
        $actual = $valor;
        $nivel = 0;
        $maxNiveles = 100;
        
        while ($nivel < $maxNiveles) {
            $nivel++;
            
            $id = $actual['id'];
            error_log("  Nivel $nivel: referencia a variable: $id");
            
            if (in_array($id, $vistos)) {
                error_log("  ⚠️ CICLO DETECTADO en variable: $id");
                $this->agregarErrorSemantico(
                    "Ciclo detectado en punteros",
                    $linea,
                    $columna
                );
                return null;
            }
            
            $vistos[] = $id;
            
            if (!isset($this->tablaSimbolos[$id])) {
                $this->agregarErrorSemantico(
                    "La variable referenciada '$id' ya no existe",
                    $linea,
                    $columna
                );
                return null;
            }
            
            $info = $this->tablaSimbolos[$id];
            
            if ($info['es_puntero'] ?? false) {
                error_log("  La variable $id es un puntero");
                $valorReal = $info['valor'];
                
                if (!$this->esReferencia($valorReal)) {
                    error_log("  → Valor directo encontrado: " . $this->formatearValor($valorReal));
                    return $valorReal;
                }
                
                $actual = $valorReal;
            } else {
                $valorReal = $info['valor'];
                error_log("  Valor final encontrado: " . $this->formatearValor($valorReal));
                return $valorReal;
            }
        }
        
        error_log("  ⚠️ LÍMITE DE DESREFERENCIACIÓN ALCANZADO ($maxNiveles niveles)");
        $this->agregarErrorSemantico(
            "Demasiados niveles de indirección en punteros",
            $linea,
            $columna
        );
        return null;
    }
    private function convertirTipo($valor, $tipoDestino, $linea, $columna)
    {
        $tipoOrigen = $this->obtenerTipo($valor);
        
        error_log("  Conversión: $tipoOrigen -> $tipoDestino");
        
        // Si ya es del tipo correcto
        if ($tipoOrigen === $tipoDestino) {
            return $valor;
        }
        
        switch ($tipoDestino) {
            case 'int32':
                if (is_numeric($valor)) {
                    return (int)$valor;
                }
                $this->agregarErrorSemantico(
                    "No se puede convertir '$tipoOrigen' a '$tipoDestino'",
                    $linea,
                    $columna
                );
                return 0;
                
            case 'float32':
                if (is_numeric($valor)) {
                    return (float)$valor;
                }
                $this->agregarErrorSemantico(
                    "No se puede convertir '$tipoOrigen' a '$tipoDestino'",
                    $linea,
                    $columna
                );
                return 0.0;
                
            case 'string':
                return (string)$valor;
                
            case 'bool':
                return (bool)$valor;
                
            case 'rune':
                if (is_string($valor) && strlen($valor) === 1) {
                    return $valor;
                }
                if (is_int($valor)) {
                    return chr($valor);
                }
                $this->agregarErrorSemantico(
                    "No se puede convertir '$tipoOrigen' a '$tipoDestino'",
                    $linea,
                    $columna
                );
                return '';
                
            default:
                $this->agregarErrorSemantico(
                    "Tipo de destino no soportado: '$tipoDestino'",
                    $linea,
                    $columna
                );
                return $valor;
        }
    }
}