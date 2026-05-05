<?php

trait ControlFlujoGenTrait
{
    /**
     * if condicion { stmts }
     * if condicion { stmts } else { stmts }
     * if condicion { stmts } else if condicion { stmts } ... else { stmts }
     */
    public function visitIfStmt($ctx)
    {
        $linea = $ctx->getStart()->getLine();
        $columna = $ctx->getStart()->getCharPositionInLine();
        
        error_log("=== IF STATEMENT (ARM64) ===");
        
        // Evaluar la condición (resultado en w0)
        $tipoCondicion = $this->visit($ctx->expresion());
        
        // Validar que la condición sea booleana
        if ($tipoCondicion !== 'bool') {
            $this->agregarErrorSemantico(
                "La condición del if debe ser de tipo bool, se encontró '$tipoCondicion'",
                $linea,
                $columna
            );
            return null;
        }
        
        // Crear etiquetas
        $labelElse = $this->newLabel("else");
        $labelEnd = $this->newLabel("endif");
        
        // Si condición es falsa, saltar al else
        $this->emitText("cmp w0, #0");
        $this->emitText("b.eq $labelElse");
        
        // === Bloque THEN ===
        $this->entrarAmbito('if_then');
        
        // Ejecutar el bloque if (primer bloque)
        if (count($ctx->bloque()) > 0) {
            $this->visit($ctx->bloque(0));
        }
        
        $this->salirAmbito();
        
        // Saltar al final después del then
        $this->emitText("b $labelEnd");
        
        // === Bloque ELSE ===
        $this->emitText("$labelElse:");
        
        // Verificar si hay parte else
        if ($ctx->ELSE()) {
            $this->entrarAmbito('if_else');
            
            // Puede ser else if o else simple
            if ($ctx->ifStmt()) {
                // Es un else if - visitar el if anidado
                $this->visit($ctx->ifStmt(0));
            } else if (count($ctx->bloque()) > 1) {
                // Es un else simple
                $this->visit($ctx->bloque(1));
            }
            
            $this->salirAmbito();
        }
        
        // === Fin del if ===
        $this->emitText("$labelEnd:");
        
        return null;
    }
}