<?php
trait ControlFlujoTrait
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
        
        // Evaluar la condición
        $condicion = $this->visit($ctx->expresion());
        
        // VALIDACIÓN: La condición debe ser booleana
        $tipoCondicion = $this->obtenerTipo($condicion);
        if ($tipoCondicion !== 'bool') {
            $this->agregarErrorSemantico(
                "La condición del if debe ser de tipo bool, se encontró '$tipoCondicion'",
                $linea,
                $columna
            );
            // No ejecutamos ningún bloque, pero continuamos el análisis
            return null;
        }
        
        // Guardar el tamaño actual de la tabla de símbolos para saber qué variables se añaden
        $simbolosAntes = array_keys($this->tablaSimbolos);
        
        if ($condicion) {
            // Crear nuevo ámbito para el bloque if
            $this->entrarAmbito('if');
            
            // Ejecutar el bloque
            $this->visit($ctx->bloque(0));
            
            // Salir del ámbito (esto eliminará las variables locales)
            $this->salirAmbito();
        }
        // Verificar si hay parte else
        else if ($ctx->ELSE()) {
            // Verificar si es else if o else simple
            if ($ctx->ifStmt()) {
                // Es un else if
                $this->entrarAmbito('else_if');
                $this->visit($ctx->ifStmt(0));
                $this->salirAmbito();
            } else if (count($ctx->bloque()) > 1) {
                // Es un else simple (hay un segundo bloque)
                $this->entrarAmbito('else');
                $this->visit($ctx->bloque(1));
                $this->salirAmbito();
            }
        }
        
        return null;
    }
}