<?php
trait DeclaracionesTrait

{

// ============================================================ DECLARACIONES ============================================================
    public function visitDeclaracionConstante($ctx)
    {
        $id = $ctx->IDENTIFICADOR()->getText();
        $tipo = $ctx->tipo()->getText();
        $linea = $ctx->IDENTIFICADOR()->getSymbol()->getLine();
        $columna = $ctx->IDENTIFICADOR()->getSymbol()->getCharPositionInLine();
        
        // Verificar si ya existe en el ámbito actual
        if ($this->existeEnAmbitoActual($id)) {
            $this->agregarErrorSemantico(
                "La constante '$id' ya fue declarada en este ámbito",
                $linea,
                $columna
            );
            return null;
        }
        
        // Verificar palabra reservada
        if ($this->esPalabraReservada($id)) {
            $this->agregarErrorSemantico(
                "'$id' es una palabra reservada y no puede usarse como identificador",
                $linea,
                $columna
            );
            return null;
        }
        
        // Evaluar la expresión de inicialización
        $valor = $this->visit($ctx->expresion());
        $tipoValor = $this->obtenerTipo($valor);
        
        // Validar que la expresión no sea nil
        if ($tipoValor === 'nil') {
            $this->agregarErrorSemantico(
                "Las constantes no pueden tener valor nil",
                $linea,
                $columna
            );
            return null;
        }
        
        // Validar compatibilidad de tipos
        if (!$this->tiposCompatiblesAsignacion($tipo, $tipoValor)) {
            $this->agregarErrorSemantico(
                "No se puede asignar valor de tipo '$tipoValor' a constante de tipo '$tipo'",
                $linea,
                $columna
            );
            return null;
        }
        
        // Validar que la expresión sea constante en tiempo de compilación
        if (!$this->esExpresionConstante($ctx->expresion())) {
            $this->agregarErrorSemantico(
                "La expresión debe ser constante en tiempo de compilación",
                $linea,
                $columna
            );
            return null;
        }
        
        // Registrar en tabla de símbolos
        $this->tablaSimbolos[$id] = [
            'tipo' => $tipo,
            'ambito' => $this->ambitoActual,
            'valor' => $valor,
            'linea' => $linea,
            'columna' => $columna,
            'esConstante' => true
        ];
        
        // Guardar en array de constantes
        $this->constantes[$this->ambitoActual . '.' . $id] = true;
        
        return null;
    }

    /**
     * Verifica si una expresión puede evaluarse en tiempo de compilación
     */
    private function esExpresionConstante($ctx)
    {
        // Si es null, no es constante
        if ($ctx === null) {
            return false;
        }
        
        // Obtener el texto de la clase para debugging
        $clase = get_class($ctx);
        error_log("Evaluando constante en contexto: " . $clase);
        
        // Caso 1: Es un literal directamente (cuando visitamos desde expresion primaria)
        if ($ctx instanceof \GolampiParser\ExpresionPrimariaContext) {
            if ($ctx->NUMERO_ENTERO() || $ctx->NUMERO_DECIMAL() || 
                $ctx->CADENA() || $ctx->CARACTER() || 
                $ctx->TRUE() || $ctx->FALSE()) {
                error_log("  → Es literal constante");
                return true;
            }
            
            if ($ctx->IDENTIFICADOR()) {
                $id = $ctx->IDENTIFICADOR()->getText();
                $esConstante = isset($this->tablaSimbolos[$id]) && 
                            isset($this->tablaSimbolos[$id]['esConstante']) &&
                            $this->tablaSimbolos[$id]['esConstante'] === true;
                error_log("  → Es identificador '$id', esConstante: " . ($esConstante ? 'sí' : 'no'));
                return $esConstante;
            }
            
            if ($ctx->expresion()) {
                // Es una expresión entre paréntesis
                return $this->esExpresionConstante($ctx->expresion());
            }
        }
        
        // Caso 2: Es una expresión con jerarquía - necesitamos ver el primer hijo
        // En realidad, cuando nos llega una expresión, debemos verificar que todos
        // los operandos sean constantes
        
        // Para simplificar, si es cualquier tipo de expresión que no sea primaria,
        // vamos a evaluarla y ver si el resultado es un literal
        // Esta es una aproximación más simple pero efectiva
        
        try {
            // Intentamos evaluar la expresión temporalmente
            $valorTemp = $this->visit($ctx);
            $tipoValor = $this->obtenerTipo($valorTemp);
            
            // Si el resultado es un literal (no nil y no array), consideramos que es constante
            $esConstante = ($tipoValor !== 'nil' && $tipoValor !== 'array' && $tipoValor !== 'unknown');
            error_log("  → Evaluación temporal: tipo=$tipoValor, esConstante=" . ($esConstante ? 'sí' : 'no'));
            
            return $esConstante;
        } catch (Exception $e) {
            error_log("  → Error al evaluar: " . $e->getMessage());
            return false;
        }
    }

    public function visitDeclaracionVar($ctx)
    {
        $tipo = $ctx->tipo()->getText();
        $ids = $ctx->listaIdentificadores()->IDENTIFICADOR();
        $expresiones = $ctx->listaExpresiones() ? $ctx->listaExpresiones()->expresion() : [];
        
        // Validar que la cantidad de IDs coincida con la de expresiones
        if (count($expresiones) > 0 && count($ids) != count($expresiones)) {
            $this->agregarErrorSemantico(
                "La cantidad de identificadores no coincide con la cantidad de expresiones",
                $ctx->getStart()->getLine(),
                $ctx->getStart()->getCharPositionInLine()
            );
            return null;
        }
        
        foreach ($ids as $i => $idNode) {
            $id = $idNode->getText();
            $linea = $idNode->getSymbol()->getLine();
            $columna = $idNode->getSymbol()->getCharPositionInLine();
            
            // Verificar si ya existe en el ámbito actual
            if ($this->existeEnAmbitoActual($id)) {
                $this->agregarErrorSemantico(
                    "El identificador '$id' ya fue declarado en este ámbito",
                    $linea,
                    $columna
                );
                continue;
            }
            
            // Verificar palabra reservada
            if ($this->esPalabraReservada($id)) {
                $this->agregarErrorSemantico(
                    "'$id' es una palabra reservada y no puede usarse como identificador",
                    $linea,
                    $columna
                );
                continue;
            }
            
            // Evaluar valor inicial si existe
            $valor = null;
            if (isset($expresiones[$i])) {
                $valor = $this->visit($expresiones[$i]);
                $tipoValor = $this->obtenerTipo($valor);
                
                // Validar compatibilidad de tipos
                if (!$this->tiposCompatiblesAsignacion($tipo, $tipoValor)) {
                    $this->agregarErrorSemantico(
                        "No se puede asignar valor de tipo '$tipoValor' a variable de tipo '$tipo'",
                        $linea,
                        $columna
                    );
                    $valor = $this->valorPorDefecto($tipo); // Asignar valor por defecto
                }
            } else {
                $valor = $this->valorPorDefecto($tipo);
            }
            
            // Registrar en tabla de símbolos
            $this->tablaSimbolos[$id] = [
                'tipo' => $tipo,
                'ambito' => $this->ambitoActual,
                'valor' => $valor,
                'linea' => $linea,
                'columna' => $columna
            ];
        }
        
        return null;
    }
    
    public function visitDeclaracionCorta($ctx)
    {
        $ids = $ctx->listaIdentificadores()->IDENTIFICADOR();
        $expresiones = $ctx->listaExpresiones()->expresion();
        
        // Validar cantidad
        if (count($ids) != count($expresiones)) {
            $this->agregarErrorSemantico(
                "La cantidad de identificadores no coincide con la cantidad de expresiones",
                $ctx->getStart()->getLine(),
                $ctx->getStart()->getCharPositionInLine()
            );
            return null;
        }
        
        // Al menos una variable debe ser nueva
        $nuevasVariables = 0;
        foreach ($ids as $idNode) {
            $id = $idNode->getText();
            if (!$this->existeEnAmbitoActual($id)) {
                $nuevasVariables++;
            } else {
                // Verificar que no sea constante si ya existe
                $claveAmbito = $this->tablaSimbolos[$id]['ambito'] . '.' . $id;
                if (isset($this->constantes[$claveAmbito])) {
                    $this->agregarErrorSemantico(
                        "No se puede redeclarar la constante '$id'",
                        $idNode->getSymbol()->getLine(),
                        $idNode->getSymbol()->getCharPositionInLine()
                    );
                    return null;
                }
            }
        }
        
        if ($nuevasVariables === 0) {
            $this->agregarErrorSemantico(
                "Declaración corta debe incluir al menos una variable nueva",
                $ctx->getStart()->getLine(),
                $ctx->getStart()->getCharPositionInLine()
            );
            return null;
        }
        
        foreach ($ids as $i => $idNode) {
            $id = $idNode->getText();
            $linea = $idNode->getSymbol()->getLine();
            $columna = $idNode->getSymbol()->getCharPositionInLine();
            
            // Si ya existe, es una reasignación (pero ya validamos que no sea constante arriba)
            if ($this->existeEnAmbitoActual($id)) {
                // Es reasignación, no declaración
                $valor = $this->visit($expresiones[$i]);
                $tipoValor = $this->obtenerTipo($valor);
                $tipoVariable = $this->tablaSimbolos[$id]['tipo'];
                
                if (!$this->tiposCompatiblesAsignacion($tipoVariable, $tipoValor)) {
                    $this->agregarErrorSemantico(
                        "No se puede asignar valor de tipo '$tipoValor' a variable de tipo '$tipoVariable'",
                        $linea,
                        $columna
                    );
                    continue;
                }
                
                $this->tablaSimbolos[$id]['valor'] = $valor;
            } else {
                // Es declaración nueva
                // Verificar palabra reservada
                if ($this->esPalabraReservada($id)) {
                    $this->agregarErrorSemantico(
                        "'$id' es una palabra reservada y no puede usarse como identificador",
                        $linea,
                        $columna
                    );
                    continue;
                }
                
                // Evaluar expresión
                $valor = $this->visit($expresiones[$i]);
                $tipo = $this->obtenerTipo($valor);
                
                // Validar nil
                if ($tipo === 'nil') {
                    $this->agregarErrorSemantico(
                        "No se puede inferir tipo de nil en declaración corta",
                        $linea,
                        $columna
                    );
                    continue;
                }
                
                // Registrar en tabla de símbolos
                $this->tablaSimbolos[$id] = [
                    'tipo' => $tipo,
                    'ambito' => $this->ambitoActual,
                    'valor' => $valor,
                    'linea' => $linea,
                    'columna' => $columna,
                    'esConstante' => false
                ];
            }
        }
        
        return null;
    }

}