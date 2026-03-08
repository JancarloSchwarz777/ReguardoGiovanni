<?php
// TransferenciaTrait.php
trait TransferenciaTrait
{
    public function visitBreakStmt($ctx)
    {
        $linea = $ctx->getStart()->getLine();
        $columna = $ctx->getStart()->getCharPositionInLine();
        
        error_log(">>> BREAK en línea $linea");
        
        // Verificar si estamos en un switch
        if (isset($this->enSwitch) && $this->enSwitch) {
            error_log("Break en switch detectado");
            $this->breakSwitch = true;
            return null;
        }
        
        // Verificar si estamos en un ciclo
        if (!isset($this->enBucle) || !$this->enBucle) {
            $this->agregarErrorSemantico(
                "break solo puede usarse dentro de un ciclo o switch",
                $linea,
                $columna
            );
            return null;
        }
        
        $this->breakFor = true;
        return null;
    }
    
    public function visitContinueStmt($ctx)
    {
        $linea = $ctx->getStart()->getLine();
        $columna = $ctx->getStart()->getCharPositionInLine();
        
        error_log(">>> CONTINUE en línea $linea");
        
        if (!isset($this->enBucle) || !$this->enBucle) {
            $this->agregarErrorSemantico(
                "continue solo puede usarse dentro de un ciclo",
                $linea,
                $columna
            );
            return null;
        }
        
        $this->continueFor = true;
        return null;
    }
    
}