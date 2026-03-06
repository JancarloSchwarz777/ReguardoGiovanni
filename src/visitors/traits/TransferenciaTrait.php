<?php
trait TransferenciaTrait
{
    public function visitBreakStmt($ctx)
    {
        $linea = $ctx->getStart()->getLine();
        $columna = $ctx->getStart()->getCharPositionInLine();
        
        error_log("BREAK en línea $linea");
        
        if (!isset($this->enBucle) || !$this->enBucle) {
            $this->agregarErrorSemantico(
                "break solo puede usarse dentro de un ciclo",
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
        
        error_log("CONTINUE en línea $linea");
        
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
    
    public function visitReturnStmt($ctx)
    {
        $linea = $ctx->getStart()->getLine();
        $columna = $ctx->getStart()->getCharPositionInLine();
        
        error_log("RETURN en línea $linea");
        
        if ($ctx->expresion()) {
            $valor = $this->visit($ctx->expresion());
            error_log("Valor de retorno: " . $this->formatearValor($valor));
            return $valor;
        }
        
        return null;
    }
}