<?php
// ControlForTrait.php
trait ControlForTrait
{
    private $enBucle = false;
    private $breakFor = false;
    private $continueFor = false;
    private $maxIteraciones = 10000;
    
    public function visitForStmt($ctx)
    {
        $linea = $ctx->getStart()->getLine();
        $columna = $ctx->getStart()->getCharPositionInLine();
        
        error_log("========== FOR DETECTADO (línea $linea) ==========");
        error_log("Texto completo: " . $ctx->getText());
        
        // Verificar la estructura del for
        if (method_exists($ctx, 'forHeader')) {
            $forHeader = $ctx->forHeader();
            error_log("Tiene forHeader: SI");
            
            // Verificar qué tipo de forHeader es
            if ($forHeader->forClause()) {
                error_log("Tipo: For completo con init;cond;post");
                return $this->ejecutarForCompleto($ctx, $linea, $columna);
            } else if ($forHeader->expresion()) {
                error_log("Tipo: For como while");
                return $this->ejecutarForComoWhile($ctx, $linea, $columna);
            } else {
                error_log("Tipo: For infinito");
                return $this->ejecutarForInfinito($ctx, $linea, $columna);
            }
        } else {
            error_log("No tiene forHeader - usando método legacy");
            // Compatibilidad con gramática anterior
            return $this->ejecutarForLegacy($ctx, $linea, $columna);
        }
    }
    
    private function ejecutarForCompleto($ctx, $linea, $columna)
    {
        error_log("--- Ejecutando for completo ---");
        
        $forHeader = $ctx->forHeader();
        $forClause = $forHeader->forClause();
        
        // Obtener las partes del for
        $initStmt = $forClause->initStmt();
        $condExpr = $forClause->expresion(0);
        $postStmt = $forClause->postStmt();
        
        error_log("Init: " . ($initStmt ? $initStmt->getText() : 'vacío'));
        error_log("Cond: " . ($condExpr ? $condExpr->getText() : 'vacío'));
        error_log("Post: " . ($postStmt ? $postStmt->getText() : 'vacío'));
        
        // IMPORTANTE: Crear un ámbito para todo el for (init, cond, post, bloque)
        // Esto permite que la variable i sea visible en todo el ciclo
        $this->entrarAmbito('for_loop');
        
        // Ejecutar inicialización - esto debe registrar la variable
        if ($initStmt) {
            error_log("Ejecutando init en ámbito: " . $this->ambitoActual);
            $this->visit($initStmt);
            
            // DEBUG: Verificar que la variable se registró
            $this->debugTablaSimbolos("Después de init");
        }
        
        $iteracion = 0;
        
        while ($iteracion < $this->maxIteraciones) {
            $iteracion++;
            error_log("--- Iteración $iteracion ---");
            
            // Evaluar condición
            $condicion = true;
            if ($condExpr) {
                // Verificar que la variable existe antes de evaluar
                if ($condExpr->getText() === 'i<3') {
                    error_log("Buscando variable 'i' en tabla:");
                    if (isset($this->tablaSimbolos['i'])) {
                        error_log("  i encontrada: " . print_r($this->tablaSimbolos['i'], true));
                    } else {
                        error_log("  i NO encontrada en tabla de símbolos");
                        $this->agregarErrorSemantico(
                            "Variable 'i' no declarada en el ámbito del for",
                            $linea,
                            $columna
                        );
                        break;
                    }
                }
                
                $condicion = $this->visit($condExpr);
                $tipoCond = $this->obtenerTipo($condicion);
                error_log("Condición evaluada: " . ($condicion ? 'true' : 'false') . " (tipo: $tipoCond)");
                
                if ($tipoCond !== 'bool') {
                    $this->agregarErrorSemantico(
                        "La condición del for debe ser de tipo bool, se encontró '$tipoCond'",
                        $linea,
                        $columna
                    );
                    break;
                }
            }
            
            if (!$condicion) {
                error_log("Condición falsa, terminando ciclo");
                break;
            }
            
            // Ejecutar bloque
            $this->enBucle = true;
            $this->breakFor = false;
            $this->continueFor = false;
            
            // Crear un sub-ámbito para el bloque
            $this->entrarAmbito('for_bloque');
            $this->visit($ctx->bloque());
            $this->salirAmbito();
            
            if ($this->breakFor) {
                error_log("Break detectado");
                $this->breakFor = false;
                break;
            }
            
            // Ejecutar post si existe y no hubo continue
            if ($postStmt && !$this->continueFor) {
                error_log("Ejecutando post: " . $postStmt->getText());
                $this->entrarAmbito('for_post');
                $this->visit($postStmt);
                $this->salirAmbito();
            }
            
            $this->continueFor = false;
            $this->enBucle = false;
        }
        
        // Salir del ámbito del for
        $this->salirAmbito();
        
        if ($iteracion >= $this->maxIteraciones) {
            $this->agregarErrorSemantico(
                "Posible bucle infinito - se alcanzó el límite de {$this->maxIteraciones} iteraciones",
                $linea,
                $columna
            );
        }
        
        error_log("--- Fin for completo ($iteracion iteraciones) ---");
        return null;
    }
    
    private function ejecutarForComoWhile($ctx, $linea, $columna)
    {
        error_log("--- Ejecutando for como while ---");
        
        $forHeader = $ctx->forHeader();
        $condExpr = $forHeader->expresion();
        
        error_log("Condición: " . $condExpr->getText());
        
        $iteracion = 0;
        
        while ($iteracion < $this->maxIteraciones) {
            $iteracion++;
            error_log("--- Iteración $iteracion ---");
            
            $condicion = $this->visit($condExpr);
            $tipoCond = $this->obtenerTipo($condicion);
            error_log("Condición: " . ($condicion ? 'true' : 'false') . " (tipo: $tipoCond)");
            
            if ($tipoCond !== 'bool') {
                $this->agregarErrorSemantico(
                    "La condición del for debe ser de tipo bool, se encontró '$tipoCond'",
                    $linea,
                    $columna
                );
                break;
            }
            
            if (!$condicion) {
                error_log("Condición falsa, terminando ciclo");
                break;
            }
            
            $this->enBucle = true;
            $this->breakFor = false;
            $this->continueFor = false;
            
            $this->entrarAmbito('for_bloque');
            $this->visit($ctx->bloque());
            $this->salirAmbito();
            
            if ($this->breakFor) {
                error_log("Break detectado");
                $this->breakFor = false;
                break;
            }
            
            $this->enBucle = false;
        }
        
        error_log("--- Fin for como while ($iteracion iteraciones) ---");
        return null;
    }
    
    private function ejecutarForInfinito($ctx, $linea, $columna)
    {
        error_log("--- Ejecutando for infinito ---");
        
        $iteracion = 0;
        $this->enBucle = true;
        
        while ($iteracion < $this->maxIteraciones && !$this->breakFor) {
            $iteracion++;
            error_log("--- Iteración $iteracion ---");
            
            $this->breakFor = false;
            $this->continueFor = false;
            
            $this->entrarAmbito('for_bloque');
            $this->visit($ctx->bloque());
            $this->salirAmbito();
        }
        
        $this->enBucle = false;
        
        if ($iteracion >= $this->maxIteraciones) {
            $this->agregarErrorSemantico(
                "Posible bucle infinito - se alcanzó el límite de {$this->maxIteraciones} iteraciones",
                $linea,
                $columna
            );
        }
        
        error_log("--- Fin for infinito ($iteracion iteraciones) ---");
        return null;
    }
    
    // Método legacy para compatibilidad con gramática anterior
    private function ejecutarForLegacy($ctx, $linea, $columna)
    {
        error_log("--- Usando método legacy ---");
        
        $expresiones = $ctx->expresion();
        $numExpresiones = count($expresiones);
        
        if ($numExpresiones == 3) {
            // for init; cond; post
            return $this->ejecutarForLegacyCompleto($ctx, $expresiones, $linea, $columna);
        } else if ($numExpresiones == 1) {
            // for cond
            return $this->ejecutarForLegacyWhile($ctx, $expresiones[0], $linea, $columna);
        } else {
            // for infinito
            return $this->ejecutarForLegacyInfinito($ctx, $linea, $columna);
        }
    }
}