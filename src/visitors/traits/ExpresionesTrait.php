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
            $contenido = substr($texto, 1, -1);  // Quitar comillas simples
            
            // Manejar caracteres escapados
            if ($contenido === '\\n') return "\n";
            if ($contenido === '\\t') return "\t";
            if ($contenido === '\\r') return "\r";
            if ($contenido === '\\\\') return "\\";
            if ($contenido === '\\\'') return "'";
            if ($contenido === '\\"') return '"';
            
            // Si es un solo carácter, devolverlo como string de 1 carácter
            return $contenido;
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
            error_log("Accediendo a variable: $id");
            
            if (isset($this->tablaSimbolos[$id])) {
                $info = $this->tablaSimbolos[$id];
                
                // Si es un puntero, devolvemos el valor que contiene
                if ($info['es_puntero'] ?? false) {
                    $valor = $info['valor'];
                    error_log("  Es un puntero, valor: " . $this->formatearValor($valor));
                    
                    // Si el puntero tiene un valor (referencia), lo devolvemos
                    if ($valor !== null && $this->esReferencia($valor)) {
                        return $valor;
                    }
                    
                    // Si es nil, devolvemos nil
                    return null;
                }
                
                // Variables normales devuelven su valor
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
        
        return null;
    }

    public function visitExpresionAditiva($ctx)
    {
        if (count($ctx->expresionMultiplicativa()) == 1) {
            return $this->visit($ctx->expresionMultiplicativa(0));
        }
        
        // IMPORTANTE: Evaluar todos los operandos primero, preservando el entorno
        $valores = [];
        $tipos = [];
        
        // Guardar el estado actual antes de evaluar los operandos
        $ambitoOriginal = $this->ambitoActual;
        $pilaOriginal = $this->pilaAmbitos;
        $tablaOriginal = $this->tablaSimbolos; // Guardar también la tabla de símbolos
        
        for ($i = 0; $i < count($ctx->expresionMultiplicativa()); $i++) {
            // Restaurar el entorno original para cada evaluación
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
        
        // IMPORTANTE: Evaluar todos los operandos primero, preservando el entorno
        $valores = [];
        $tipos = [];
        
        // Guardar el estado actual antes de evaluar los operandos
        $ambitoOriginal = $this->ambitoActual;
        $pilaOriginal = $this->pilaAmbitos;
        $tablaOriginal = $this->tablaSimbolos; // Guardar también la tabla de símbolos
        
        for ($i = 0; $i < count($ctx->expresionUnaria()); $i++) {
            // Restaurar el entorno original para cada evaluación
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
            
            if ($op === '&&' && $resultado === false) {
                return false;
            }
            if ($op === '||' && $resultado === true) {
                return true;
            }
            
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
            
            $tipoResultado = 'bool';
        }
        
        return $resultado;
    }

    public function visitExpresionUnaria($ctx)
    {
        $op = null;
        if ($ctx->NOT()) {
            $op = '!';
        } elseif ($ctx->MENOS()) {
            $op = '-';
        } elseif ($ctx->MULT()) {
            $op = '*';
        } elseif ($ctx->getChild(0) && $ctx->getChild(0)->getText() === '&') {
            $op = '&';
        }
        
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
                // Pasar el contexto directamente, NO evaluarlo
                return $this->referenciar($ctx->expresionPrimaria(), $linea, $columna);
        }
        
        return null;
    }

    private function referenciar($exprCtx, $linea, $columna)
    {
        error_log("=== REFERENCIANDO ===");
        
        // Si es una expresión primaria con identificador
        if ($exprCtx instanceof \GolampiParser\ExpresionPrimariaContext) {
            if ($exprCtx->IDENTIFICADOR()) {
                $id = $exprCtx->IDENTIFICADOR()->getText();
                error_log("  Referencia a variable: $id");
                
                if (!isset($this->tablaSimbolos[$id])) {
                    $this->agregarErrorSemantico(
                        "Variable '$id' no declarada",
                        $linea,
                        $columna
                    );
                    return null;
                }
                
                // Crear una referencia a la variable
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
        
        // También podría ser un identificador directamente
        if (method_exists($exprCtx, 'getText')) {
            $texto = $exprCtx->getText();
            error_log("  Texto del contexto: $texto");
            
            if (preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $texto)) {
                $id = $texto;
                error_log("  Referencia a variable (por texto): $id");
                
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
        
        error_log("  Error: No es un identificador válido");
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
        
        $id = $valor['id'];
        error_log("  Referencia a variable: $id");
        
        if (!isset($this->tablaSimbolos[$id])) {
            $this->agregarErrorSemantico(
                "La variable referenciada '$id' ya no existe",
                $linea,
                $columna
            );
            return null;
        }
        
        $valorReal = $this->tablaSimbolos[$id]['valor'];
        error_log("  Valor desreferenciado: " . $this->formatearValor($valorReal));
        
        return $valorReal;
    }
}