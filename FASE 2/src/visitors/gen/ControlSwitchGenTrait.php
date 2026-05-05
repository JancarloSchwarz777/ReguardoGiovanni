<?php
// src/visitors/gen/ControlSwitchGenTrait.php - Versión corregida (sin duplicados)

trait ControlSwitchGenTrait
{
    private $switchEndLabel = null;
    private $inSwitch = false;
    
    public function visitSwitchStmt($ctx)
    {
        $linea = $ctx->getStart()->getLine();
        $columna = $ctx->getStart()->getCharPositionInLine();
        
        error_log("=== SWITCH STATEMENT (ARM64) ===");
        
        $this->inSwitch = true;
        $oldSwitchEndLabel = $this->switchEndLabel;
        $this->switchEndLabel = $this->newLabel("switch_end");
        
        // Evaluar la expresión del switch (resultado en w0)
        $tipoSwitch = $this->visit($ctx->expresion());
        
        // Guardar valor del switch en x19 (registro callee-saved)
        if ($tipoSwitch === 'float32') {
            $this->emitText("fmov s19, s0");
        } else {
            $this->emitText("mov w19, w0");
        }
        
        // Procesar casos
        $casoBloques = $ctx->casoBloques();
        $hasDefault = false;
        
        // Array para almacenar etiquetas de casos (para la limpieza final)
        $caseLabels = [];
        
        if ($casoBloques) {
            foreach ($casoBloques->children as $child) {
                $childClass = get_class($child);
                $simpleClass = substr($childClass, strrpos($childClass, '\\') + 1);
                
                if ($simpleClass === 'CasoContext') {
                    $label = $this->generarCaso($child, $tipoSwitch);
                    $caseLabels[] = $label;
                } else if ($simpleClass === 'DefaultBloqueContext') {
                    $hasDefault = true;
                    $this->generarDefault($child);
                }
            }
        }
        
        // Si no hay default, saltar al final
        if (!$hasDefault) {
            $this->emitText("b " . $this->switchEndLabel);
        }
        
        // NO generar las etiquetas de caso aquí - ya se generaron en generarCaso
        
        $this->emitText($this->switchEndLabel . ":");
        
        // Restaurar
        $this->switchEndLabel = $oldSwitchEndLabel;
        $this->inSwitch = false;
        
        return null;
    }
    
    private function generarCaso($casoCtx, $tipoSwitch)
    {
        $labelCaso = $this->newLabel("case");
        $labelNext = $this->newLabel("case_next");
        
        // Obtener expresiones del caso
        $listaExpresiones = $casoCtx->listaExpresiones();
        $expresionesCaso = $listaExpresiones ? $listaExpresiones->expresion() : [];
        
        // Para cada expresión, comparar
        foreach ($expresionesCaso as $expr) {
            // Recuperar valor switch guardado
            if ($tipoSwitch === 'float32') {
                $this->emitText("fmov s1, s19");
            } else {
                $this->emitText("mov w1, w19");
            }
            
            // Evaluar expresión del caso
            $tipoCaso = $this->visit($expr);
            
            // Comparar
            if ($tipoSwitch === 'float32' || $tipoCaso === 'float32') {
                $this->emitText("fcmp s1, s0");
            } else {
                $this->emitText("cmp w1, w0");
            }
            $this->emitText("b.eq $labelCaso");
        }
        
        // Si no coincide, saltar al siguiente caso
        $this->emitText("b $labelNext");
        
        // Código del caso (solo se genera una vez)
        $this->emitText("$labelCaso:");
        
        // Ejecutar sentencias del caso
        $sentencias = $casoCtx->sentencia();
        $oldBreakLabel = $this->breakLabel;
        $this->breakLabel = $this->switchEndLabel;
        
        foreach ($sentencias as $sentencia) {
            $this->visit($sentencia);
        }
        
        $this->breakLabel = $oldBreakLabel;
        
        // Saltar al final del switch
        $this->emitText("b " . $this->switchEndLabel);
        
        $this->emitText("$labelNext:");
        
        return $labelCaso;
    }
    
    private function generarDefault($defaultCtx)
    {
        $labelDefault = $this->newLabel("default_case");
        
        $this->emitText("b $labelDefault");
        $this->emitText("$labelDefault:");
        
        // Ejecutar sentencias del default
        $sentencias = $defaultCtx->sentencia();
        foreach ($sentencias as $sentencia) {
            $this->visit($sentencia);
        }
    }
}