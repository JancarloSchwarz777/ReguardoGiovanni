<?php
trait DeclaracionesGenTrait
{
    public function visitDeclaracionVar($ctx)
    {
        $tipo = $ctx->tipo()->getText();
        $esPuntero = (strpos($tipo, '*') === 0);
        $tipoBase = $esPuntero ? substr($tipo, 1) : $tipo;
        
        $ids = $ctx->listaIdentificadores()->IDENTIFICADOR();
        $expresiones = $ctx->listaExpresiones() ? $ctx->listaExpresiones()->expresion() : [];
        
        foreach ($ids as $i => $idNode) {
            $id = $idNode->getText();
            $linea = $idNode->getSymbol()->getLine();
            $columna = $idNode->getSymbol()->getCharPositionInLine();
            
            if ($this->existeEnAmbitoActual($id)) {
                $this->agregarErrorSemantico("Variable '$id' ya declarada", $linea, $columna);
                continue;
            }
            
            $valorConocido = null;
            
            if (isset($expresiones[$i])) {
                $valorConocido = $this->obtenerValorLiteral($expresiones[$i]);
                $tipoExpr = $this->visit($expresiones[$i]);
                
                if ($esPuntero && $this->esReferenciaEnExpresion($expresiones[$i])) {
                    $offset = $this->reservarVariable($id, $tipo, $linea, $columna, $valorConocido);
                    $this->guardarEnStack($offset, $tipo);
                } 
                else if ($esPuntero && $tipoExpr === 'nil') {
                    $offset = $this->reservarVariable($id, $tipo, $linea, $columna, null);
                    $this->emitText("mov x0, #0");
                    $this->guardarEnStack($offset, $tipo);
                }
                else if ($esPuntero) {
                    $offset = $this->reservarVariable($id, $tipo, $linea, $columna, $valorConocido);
                    $this->guardarEnStack($offset, $tipo);
                }
                else {
                    $offset = $this->reservarVariable($id, $tipoBase, $linea, $columna, $valorConocido);
                    $this->guardarEnStack($offset, $tipoBase);
                }
            } else {
                $offset = $this->reservarVariable($id, $tipo, $linea, $columna, $esPuntero ? null : $this->valorPorDefecto($tipoBase));
                if ($esPuntero) {
                    $this->emitText("mov x0, #0");
                    $this->guardarEnStack($offset, $tipo);
                } else {
                    $this->inicializarPorDefecto($offset, $tipoBase);
                }
            }
        }
        return null;
    }

    private function esReferenciaEnExpresion($ctx)
    {
        if ($ctx instanceof \GolampiParser\ExpresionUnariaContext) {
            if ($ctx->getChild(0) && $ctx->getChild(0)->getText() === '&') {
                return true;
            }
        }
        return false;
    }
    
    public function visitDeclaracionConstante($ctx)
    {
        $id = $ctx->IDENTIFICADOR()->getText();
        $tipo = $ctx->tipo()->getText();
        $linea = $ctx->IDENTIFICADOR()->getSymbol()->getLine();
        $columna = $ctx->IDENTIFICADOR()->getSymbol()->getCharPositionInLine();
        
        if ($this->existeEnAmbitoActual($id)) {
            $this->agregarErrorSemantico("Constante '$id' ya declarada", $linea, $columna);
            return null;
        }
        
        $valorConocido = $this->obtenerValorLiteral($ctx->expresion());
        $offset = $this->reservarVariable($id, $tipo, $linea, $columna, $valorConocido);
        $this->visit($ctx->expresion());
        $this->guardarEnStack($offset, $tipo);
        $this->tablaSimbolos[$id]['esConstante'] = true;
        return null;
    }

    public function visitDeclaracionCorta($ctx)
    {
        $ids = $ctx->listaIdentificadores()->IDENTIFICADOR();
        $expresiones = $ctx->listaExpresiones()->expresion();
        
        error_log("=== DECLARACIÓN CORTA con " . count($ids) . " IDs y " . count($expresiones) . " expresiones ===");
        
        // Verificar que al menos una variable sea nueva
        $nuevasVariables = 0;
        foreach ($ids as $idNode) {
            $id = $idNode->getText();
            if (!$this->existeEnAmbitoActual($id)) $nuevasVariables++;
        }
        if ($nuevasVariables === 0) {
            $this->agregarErrorSemantico(
                "Declaración corta debe incluir al menos una variable nueva",
                $ctx->getStart()->getLine(),
                $ctx->getStart()->getCharPositionInLine()
            );
            return null;
        }
        
        // ===== CASO ESPECIAL: múltiples IDs y una sola expresión (múltiple retorno) =====
        if (count($ids) > 1 && count($expresiones) == 1) {
            $resultado = $this->visit($expresiones[0]);
            if (is_array($resultado) && isset($resultado['__multiple_return'])) {
                if (count($ids) != $resultado['num']) {
                    $this->agregarErrorSemantico(
                        "La función retorna " . $resultado['num'] . " valores pero se declararon " . count($ids) . " variables",
                        $ctx->getStart()->getLine(),
                        $ctx->getStart()->getCharPositionInLine()
                    );
                    return null;
                }
                // Asignar cada valor a su variable
                for ($i = 0; $i < count($ids); $i++) {
                    $idNode = $ids[$i];
                    $id = $idNode->getText();
                    $linea = $idNode->getSymbol()->getLine();
                    $columna = $idNode->getSymbol()->getCharPositionInLine();
                    $offsetValor = $resultado['offsets'][$i];
                    $tipo = $resultado['tipos'][$i];
                    
                    // Cargar el valor desde el offset temporal
                    $this->cargarDeStack($offsetValor, $tipo);
                    
                    if ($this->existeEnAmbitoActual($id)) {
                        $offset = $this->offsets[$id];
                        $this->guardarEnStack($offset, $tipo);
                    } else {
                        $offset = $this->reservarVariable($id, $tipo, $linea, $columna, null);
                        $this->guardarEnStack($offset, $tipo);
                    }
                }
                return null;
            } else {
                $this->agregarErrorSemantico(
                    "Se esperaba múltiple retorno de función",
                    $ctx->getStart()->getLine(),
                    $ctx->getStart()->getCharPositionInLine()
                );
                return null;
            }
        }
        
        // ===== CASO NORMAL: misma cantidad de identificadores y expresiones (uno a uno) =====
        if (count($ids) != count($expresiones)) {
            $this->agregarErrorSemantico(
                "Cantidad de identificadores (" . count($ids) . 
                ") no coincide con cantidad de expresiones (" . count($expresiones) . ")",
                $ctx->getStart()->getLine(),
                $ctx->getStart()->getCharPositionInLine()
            );
            return null;
        }
        
        for ($i = 0; $i < count($ids); $i++) {
            $idNode = $ids[$i];
            $id = $idNode->getText();
            $linea = $idNode->getSymbol()->getLine();
            $columna = $idNode->getSymbol()->getCharPositionInLine();
            $expr = $expresiones[$i];
            
            $resultado = $this->visit($expr);
            $tipo = is_string($resultado) ? $resultado : 'int32';
            
            if ($this->existeEnAmbitoActual($id)) {
                $offset = $this->offsets[$id];
                $this->guardarEnStack($offset, $tipo);
            } else {
                $offset = $this->reservarVariable($id, $tipo, $linea, $columna, null);
                $this->guardarEnStack($offset, $tipo);
            }
        }
        
        return null;
    }
}