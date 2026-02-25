<?php
trait AsignacionTrait
{

// ============================================================ ASIGNACIONES ============================================================
    public function visitAsignacion($ctx)
    {
        $id = $ctx->IDENTIFICADOR()->getText();
        $linea = $ctx->IDENTIFICADOR()->getSymbol()->getLine();
        $columna = $ctx->IDENTIFICADOR()->getSymbol()->getCharPositionInLine();
        
        // Verificar si existe
        if (!isset($this->tablaSimbolos[$id])) {
            $this->agregarErrorSemantico(
                "Variable '$id' no declarada",
                $linea,
                $columna
            );
            return null;
        }
        
        // Verificar que no sea constante
        $claveAmbito = $this->tablaSimbolos[$id]['ambito'] . '.' . $id;
        if (isset($this->constantes[$claveAmbito]) || 
            (isset($this->tablaSimbolos[$id]['esConstante']) && $this->tablaSimbolos[$id]['esConstante'])) {
            $this->agregarErrorSemantico(
                "No se puede modificar la constante '$id'",
                $linea,
                $columna
            );
            return null;
        }
        
        $tipoVariable = $this->tablaSimbolos[$id]['tipo'];
        $valorActual = $this->tablaSimbolos[$id]['valor'] ?? $this->valorPorDefecto($tipoVariable);
        
        // Incremento/Decremento (++/--)
        if ($ctx->INCREMENTO() || $ctx->DECREMENTO()) {
            if ($tipoVariable !== 'int32') {
                $this->agregarErrorSemantico(
                    "Operador '++/--' solo válido para int32",
                    $linea,
                    $columna
                );
                return null;
            }
            
            $nuevoValor = $ctx->INCREMENTO() ? $valorActual + 1 : $valorActual - 1;
            $this->tablaSimbolos[$id]['valor'] = $nuevoValor;
            return $nuevoValor;
        }
        
        // Asignación compuesta (+=, -=) o simple (=)
        if ($ctx->expresion()) {
            // Determinar el operador de asignación
            $opAsignacion = '=';
            if ($ctx->operadorAsignacion()) {
                $opToken = $ctx->operadorAsignacion()->getChild(0)->getText();
                if ($opToken === '+=') {
                    $opAsignacion = '+=';
                } elseif ($opToken === '-=') {
                    $opAsignacion = '-=';
                }
            }
            
            $valor = $this->visit($ctx->expresion());
            $tipoValor = $this->obtenerTipo($valor);
            
            // Para += y -=, necesitamos validar que sea tipo numérico
            if ($opAsignacion === '+=' || $opAsignacion === '-=') {
                if ($tipoVariable !== 'int32' && $tipoVariable !== 'float32') {
                    $this->agregarErrorSemantico(
                        "Operador '$opAsignacion' solo válido para tipos numéricos",
                        $linea,
                        $columna
                    );
                    return null;
                }
                
                if ($tipoValor !== 'int32' && $tipoValor !== 'float32') {
                    $this->agregarErrorSemantico(
                        "Operador '$opAsignacion' requiere valor numérico",
                        $linea,
                        $columna
                    );
                    return null;
                }
                
                // Calcular nuevo valor
                if ($opAsignacion === '+=') {
                    $nuevoValor = $valorActual + $valor;
                } else {
                    $nuevoValor = $valorActual - $valor;
                }
                
                // Validar compatibilidad de tipos para el resultado
                $tipoResultado = $this->obtenerTipo($nuevoValor);
                if (!$this->tiposCompatiblesAsignacion($tipoVariable, $tipoResultado)) {
                    $this->agregarErrorSemantico(
                        "El resultado de '$opAsignacion' no es compatible con el tipo '$tipoVariable'",
                        $linea,
                        $columna
                    );
                    return null;
                }
                
                $this->tablaSimbolos[$id]['valor'] = $nuevoValor;
                return $nuevoValor;
            }
            
            // Asignación simple (=)
            if (!$this->tiposCompatiblesAsignacion($tipoVariable, $tipoValor)) {
                $this->agregarErrorSemantico(
                    "No se puede asignar valor de tipo '$tipoValor' a variable de tipo '$tipoVariable'",
                    $linea,
                    $columna
                );
                return null;
            }
            
            $this->tablaSimbolos[$id]['valor'] = $valor;
            return $valor;
        }
        
        return null;
    }

}