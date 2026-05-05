<?php

trait ControlForGenTrait
{
    private $breakLabel = null;
    private $continueLabel = null;
    private $loopDepth = 0;
    
    public function visitForStmt($ctx)
    {
        $linea = $ctx->getStart()->getLine();
        $columna = $ctx->getStart()->getCharPositionInLine();
        
        error_log("=== FOR STATEMENT (ARM64) ===");
        
        $this->loopDepth++;
        
        $oldBreakLabel = $this->breakLabel;
        $oldContinueLabel = $this->continueLabel;
        
        $labelCond = $this->newLabel("for_cond");
        $labelBody = $this->newLabel("for_body");
        $labelStep = $this->newLabel("for_step");
        $labelEnd = $this->newLabel("for_end");
        
        $this->breakLabel = $labelEnd;
        $this->continueLabel = $labelStep;
        
        // Verificar qué tipo de for es
        if (method_exists($ctx, 'forHeader')) {
            $forHeader = $ctx->forHeader();
            
            if ($forHeader->forClause()) {
                $this->generarForCompleto($ctx, $forHeader->forClause(), $labelCond, $labelBody, $labelStep, $labelEnd);
            } else if ($forHeader->expresion()) {
                $this->generarForWhile($ctx, $forHeader->expresion(), $labelCond, $labelBody, $labelEnd);
            } else {
                $this->generarForInfinito($ctx, $labelBody, $labelEnd);
            }
        } else {
            $this->generarForLegacy($ctx, $labelCond, $labelBody, $labelStep, $labelEnd);
        }
        
        $this->breakLabel = $oldBreakLabel;
        $this->continueLabel = $oldContinueLabel;
        $this->loopDepth--;
        
        return null;
    }
    
    private function generarForCompleto($ctx, $forClause, $labelCond, $labelBody, $labelStep, $labelEnd)
    {
        // Inicialización
        $initStmt = $forClause->initStmt();
        if ($initStmt) {
            $this->visit($initStmt);
        }
        
        // Saltar a la condición
        $this->emitText("b $labelCond");
        
        // Cuerpo del bucle
        $this->emitText("$labelBody:");
        $this->entrarAmbito('for_body');
        $this->visit($ctx->bloque());
        $this->salirAmbito();
        
        // Paso (post)
        $this->emitText("$labelStep:");
        $postStmt = $forClause->postStmt();
        if ($postStmt) {
            $this->visit($postStmt);
        }
        
        // Condición
        $this->emitText("$labelCond:");
        $condExpr = $forClause->expresion(0);
        if ($condExpr) {
            $tipoCond = $this->visit($condExpr);
            if ($tipoCond !== 'bool') {
                $this->agregarErrorSemantico(
                    "La condición del for debe ser bool",
                    $ctx->getStart()->getLine(),
                    $ctx->getStart()->getCharPositionInLine()
                );
            }
            $this->emitText("cmp w0, #0");
            $this->emitText("b.ne $labelBody");
        } else {
            $this->emitText("b $labelBody");
        }
        
        $this->emitText("$labelEnd:");
    }
    
    private function generarForWhile($ctx, $condExpr, $labelCond, $labelBody, $labelEnd)
    {
        $this->emitText("b $labelCond");
        
        $this->emitText("$labelBody:");
        $this->entrarAmbito('for_body');
        $this->visit($ctx->bloque());
        $this->salirAmbito();
        
        $this->emitText("$labelCond:");
        $tipoCond = $this->visit($condExpr);
        if ($tipoCond !== 'bool') {
            $this->agregarErrorSemantico(
                "La condición del for debe ser bool",
                $ctx->getStart()->getLine(),
                $ctx->getStart()->getCharPositionInLine()
            );
        }
        $this->emitText("cmp w0, #0");
        $this->emitText("b.ne $labelBody");
        
        $this->emitText("$labelEnd:");
    }
    
    private function generarForInfinito($ctx, $labelBody, $labelEnd)
    {
        $this->emitText("$labelBody:");
        $this->entrarAmbito('for_body');
        $this->visit($ctx->bloque());
        $this->salirAmbito();
        $this->emitText("b $labelBody");
        $this->emitText("$labelEnd:");
    }
    
    private function generarForLegacy($ctx, $labelCond, $labelBody, $labelStep, $labelEnd)
    {
        $expresiones = $ctx->expresion();
        $numExpresiones = count($expresiones);
        
        if ($numExpresiones == 3) {
            $this->visit($expresiones[0]);
            $this->emitText("b $labelCond");
            $this->emitText("$labelBody:");
            $this->visit($ctx->bloque());
            $this->emitText("$labelStep:");
            $this->visit($expresiones[2]);
            $this->emitText("$labelCond:");
            $this->visit($expresiones[1]);
            $this->emitText("cmp w0, #0");
            $this->emitText("b.ne $labelBody");
            $this->emitText("$labelEnd:");
        } else if ($numExpresiones == 1) {
            $this->emitText("b $labelCond");
            $this->emitText("$labelBody:");
            $this->visit($ctx->bloque());
            $this->emitText("$labelCond:");
            $this->visit($expresiones[0]);
            $this->emitText("cmp w0, #0");
            $this->emitText("b.ne $labelBody");
            $this->emitText("$labelEnd:");
        } else {
            $this->emitText("$labelBody:");
            $this->visit($ctx->bloque());
            $this->emitText("b $labelBody");
            $this->emitText("$labelEnd:");
        }
    }
    
    public function visitBreakStmt($ctx)
    {
        $linea = $ctx->getStart()->getLine();
        $columna = $ctx->getStart()->getCharPositionInLine();
        
        if ($this->loopDepth == 0) {
            $this->agregarErrorSemantico("break solo puede usarse dentro de un ciclo", $linea, $columna);
            return null;
        }
        
        if ($this->breakLabel === null) {
            $this->agregarErrorSemantico("break sin etiqueta de destino", $linea, $columna);
            return null;
        }
        
        $this->emitText("b " . $this->breakLabel);
        return null;
    }
    
    public function visitContinueStmt($ctx)
    {
        $linea = $ctx->getStart()->getLine();
        $columna = $ctx->getStart()->getCharPositionInLine();
        
        if ($this->loopDepth == 0) {
            $this->agregarErrorSemantico("continue solo puede usarse dentro de un ciclo", $linea, $columna);
            return null;
        }
        
        if ($this->continueLabel === null) {
            $this->agregarErrorSemantico("continue sin etiqueta de destino", $linea, $columna);
            return null;
        }
        
        $this->emitText("b " . $this->continueLabel);
        return null;
    }
}