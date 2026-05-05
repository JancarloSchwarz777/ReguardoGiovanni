<?php
// ControlForTrait.php
trait ControlForTrait
{
    private $enBucle = false;
    private $breakFor = false;
    private $continueFor = false;
    private $maxIteraciones = 10000; // Límite para detectar posibles bucles infinitos
    
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
        
        // IMPORTANTE: Crear un ámbito para todo el for
        $this->entrarAmbito('for_loop');
        
        // Ejecutar inicialización
        if ($initStmt) {
            error_log("Ejecutando init en ámbito: " . $this->ambitoActual);
            $this->visit($initStmt);
            $this->debugTablaSimbolos("Después de init");
        }
        
        $iteracion = 0;
        
        while ($iteracion < $this->maxIteraciones) {
            $iteracion++;
            error_log("--- Iteración $iteracion ---");
            
            // Evaluar condición
            $condicion = true;
            if ($condExpr) {
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
            try {
                $this->entrarAmbito('for_bloque');
                $this->visit($ctx->bloque());
                $this->salirAmbito();
            } catch (ContinueException $e) {
                $this->salirAmbito();  // Asegurar que salimos del ámbito
                $this->continueFor = true;
                error_log("ContinueException capturada en el for");
            } catch (ReturnException $e) {
                $this->salirAmbito();
                throw $e;  // Re-lanzar para que lo maneje la función
            }
            
            if ($this->breakFor) {
                error_log("Break detectado");
                $this->breakFor = false;
                break;
            }
            
            // IMPORTANTE: Si hubo continue, ejecutar post antes de continuar
            if ($this->continueFor) {
                error_log("Continue detectado - ejecutando post y continuando");
                $this->continueFor = false;
                $this->enBucle = false;
                
                // Ejecutar post antes de continuar con la siguiente iteración
                if ($postStmt) {
                    error_log("Ejecutando post después de continue: " . $postStmt->getText());
                    $this->entrarAmbito('for_post');
                    $this->visit($postStmt);
                    $this->salirAmbito();
                }
                
                continue;  // Ir directamente a la siguiente iteración
            }
            
            // Ejecutar post si existe (caso normal)
            if ($postStmt) {
                error_log("Ejecutando post: " . $postStmt->getText());
                $this->entrarAmbito('for_post');
                $this->visit($postStmt);
                $this->salirAmbito();
            }
            
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
            
            try {
                $this->entrarAmbito('for_bloque');
                $this->visit($ctx->bloque());
                $this->salirAmbito();
            } catch (ContinueException $e) {
                $this->salirAmbito();
                $this->continueFor = true;
                error_log("ContinueException capturada en el for");
            } catch (ReturnException $e) {
                $this->salirAmbito();
                throw $e;
            }
            
            if ($this->breakFor) {
                error_log("Break detectado");
                $this->breakFor = false;
                break;
            }
            
            // Si hubo continue, simplemente continuamos con la siguiente iteración
            if ($this->continueFor) {
                error_log("Continue detectado");
                $this->continueFor = false;
                continue;
            }
            
            $this->enBucle = false;
        }
        
        if ($iteracion >= $this->maxIteraciones) {
            $this->agregarErrorSemantico(
                "Posible bucle infinito - se alcanzó el límite de {$this->maxIteraciones} iteraciones",
                $linea,
                $columna
            );
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
            
            try {
                $this->entrarAmbito('for_bloque');
                $this->visit($ctx->bloque());
                $this->salirAmbito();
            } catch (ContinueException $e) {
                $this->salirAmbito();
                $this->continueFor = true;
                error_log("ContinueException capturada en el for");
            } catch (ReturnException $e) {
                $this->salirAmbito();
                throw $e;
            }
            
            if ($this->breakFor) {
                error_log("Break detectado");
                $this->breakFor = false;
                break;
            }
            
            // Si hubo continue, simplemente continuamos
            if ($this->continueFor) {
                error_log("Continue detectado");
                $this->continueFor = false;
            }
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