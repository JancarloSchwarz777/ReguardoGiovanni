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
        $this->tablaSimbolosHistorial[$id] = $this->tablaSimbolos[$id];
        
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
        
        error_log("Declaración var en ámbito: " . $this->ambitoActual);
        
        // Validar cantidad de IDs vs expresiones
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
            
            error_log("  Declarando variable: $id en ámbito: " . $this->ambitoActual);
            
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
            
            // Evaluar valor inicial
            $valor = null;
            if (isset($expresiones[$i])) {
                $valor = $this->visit($expresiones[$i]);
                $tipoValor = $this->obtenerTipo($valor);
                
                if (!$this->tiposCompatiblesAsignacion($tipo, $tipoValor)) {
                    $this->agregarErrorSemantico(
                        "No se puede asignar valor de tipo '$tipoValor' a variable de tipo '$tipo'",
                        $linea,
                        $columna
                    );
                    $valor = $this->valorPorDefecto($tipo);
                }
            } else {
                $valor = $this->valorPorDefecto($tipo);
            }
            
            // Registrar en tabla de símbolos
            $this->tablaSimbolos[$id] = [
                'tipo' => $tipo,
                'ambito' => $this->ambitoActual,  // Asegurar que se guarda el ámbito actual
                'valor' => $valor,
                'linea' => $linea,
                'columna' => $columna,
                'esConstante' => false
            ];
            $this->tablaSimbolosHistorial[$id] = $this->tablaSimbolos[$id];
            
            error_log("    → Registrada en tabla: " . $id . " (ámbito: " . $this->ambitoActual . ")");
        }
        
        return null;
    }
    
    // En DeclaracionesTrait.php, modificar visitDeclaracionCorta:
    public function visitDeclaracionCorta($ctx)
    {
        $ids = $ctx->listaIdentificadores()->IDENTIFICADOR();
        $expresiones = $ctx->listaExpresiones()->expresion();
        
        error_log("=== DECLARACIÓN CORTA con " . count($ids) . " IDs y " . count($expresiones) . " expresiones ===");
        
        // Evaluar todas las expresiones primero
        $valoresExpresiones = [];
        $valoresAplanados = [];
        
        foreach ($expresiones as $expr) {
            $valor = $this->visit($expr);
            $valoresExpresiones[] = $valor;
            error_log("  Expresión evaluada: " . $this->formatearValor($valor) . " (tipo: " . $this->obtenerTipo($valor) . ")");
            
            // Si es un array y parece ser de múltiples retornos (no un arreglo del lenguaje)
            if (is_array($valor) && isset($valor[0]) && !$this->esArregloEstructurado($valor)) {
                // Es un múltiple retorno - aplanarlo
                error_log("  → Múltiples retornos detectados: " . count($valor) . " valores");
                foreach ($valor as $v) {
                    $valoresAplanados[] = $v;
                }
            } else {
                // Es un valor simple
                $valoresAplanados[] = $valor;
            }
        }
        
        error_log("  Total valores después de aplanar: " . count($valoresAplanados));
        
        // Validar cantidad después de aplanar
        if (count($ids) != count($valoresAplanados)) {
            $this->agregarErrorSemantico(
                "La cantidad de identificadores (" . count($ids) . 
                ") no coincide con la cantidad de valores retornados (" . count($valoresAplanados) . ")",
                $ctx->getStart()->getLine(),
                $ctx->getStart()->getCharPositionInLine()
            );
            
            // Mostrar detalles para debugging
            error_log("  IDs: " . implode(', ', array_map(function($id) { return $id->getText(); }, $ids)));
            error_log("  Valores aplanados: " . print_r($valoresAplanados, true));
            
            return null;
        }
        
        // Al menos una variable debe ser nueva
        $nuevasVariables = 0;
        foreach ($ids as $idNode) {
            $id = $idNode->getText();
            if (!$this->existeEnAmbitoActual($id)) {
                $nuevasVariables++;
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
        
        // Ahora asignar cada valor aplanado a su identificador correspondiente
        foreach ($ids as $i => $idNode) {
            $id = $idNode->getText();
            $linea = $idNode->getSymbol()->getLine();
            $columna = $idNode->getSymbol()->getCharPositionInLine();
            
            $valor = $valoresAplanados[$i];
            $tipoValor = $this->obtenerTipo($valor);
            
            error_log("  Asignando valor $i a $id: " . $this->formatearValor($valor) . " (tipo: $tipoValor)");
            
            // Si ya existe, es una reasignación
            if ($this->existeEnAmbitoActual($id)) {
                error_log("  Reasignando variable existente: $id");
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
                error_log("  Declarando nueva variable: $id con tipo $tipoValor");
                
                // Verificar palabra reservada
                if ($this->esPalabraReservada($id)) {
                    $this->agregarErrorSemantico(
                        "'$id' es una palabra reservada y no puede usarse como identificador",
                        $linea,
                        $columna
                    );
                    continue;
                }
                
                // Validar nil
                if ($tipoValor === 'nil') {
                    $this->agregarErrorSemantico(
                        "No se puede inferir tipo de nil en declaración corta",
                        $linea,
                        $columna
                    );
                    continue;
                }
                
                // Registrar en tabla de símbolos
                $this->tablaSimbolos[$id] = [
                    'tipo' => $tipoValor,
                    'ambito' => $this->ambitoActual,
                    'valor' => $valor,
                    'linea' => $linea,
                    'columna' => $columna,
                    'esConstante' => false
                ];
                $this->tablaSimbolosHistorial[$id] = $this->tablaSimbolos[$id];
            }
        }
        
        // Debug: mostrar todas las variables después de la declaración
        error_log("  Variables después de declaración:");
        foreach ($ids as $idNode) {
            $id = $idNode->getText();
            if (isset($this->tablaSimbolos[$id])) {
                error_log("    $id = " . $this->formatearValor($this->tablaSimbolos[$id]['valor']) . 
                        " (tipo: " . $this->tablaSimbolos[$id]['tipo'] . ")");
            }
        }
        
        return null;
    }

    // Método auxiliar para distinguir entre arreglos y múltiples retornos
    private function esArreglo($valor)
    {
        // Por ahora, asumimos que un array es un arreglo si sus keys son numéricas consecutivas
        // y fue creado como arreglo (esto necesitará refinarse)
        return is_array($valor) && !isset($valor['__multiple_return']);
    }

}