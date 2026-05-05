<?php
// ControlSwitchTrait.php
trait ControlSwitchTrait
{
    public function visitSwitchStmt($ctx)
    {
        $linea = $ctx->getStart()->getLine();
        $columna = $ctx->getStart()->getCharPositionInLine();
        
        error_log("========== SWITCH DETECTADO (línea $linea) ==========");
        
        // Marcar que estamos en un switch
        $this->enSwitch = true;
        $this->breakSwitch = false;
        
        // Evaluar la expresión del switch
        $valorSwitch = $this->visit($ctx->expresion());
        $tipoSwitch = $this->obtenerTipo($valorSwitch);
        
        error_log("Expresión switch: " . $this->formatearValor($valorSwitch) . " (tipo: $tipoSwitch)");
        
        // Crear ámbito para el switch
        $this->entrarAmbito('switch');
        
        $casoEjecutado = false;
        
        // Obtener el contexto casoBloques
        $casoBloques = $ctx->casoBloques();
        
        if ($casoBloques) {
            error_log("Procesando casoBloques");
            error_log("Número de hijos: " . count($casoBloques->children));
            
            // Recorrer todos los hijos de casoBloques
            foreach ($casoBloques->children as $index => $child) {
                error_log("Procesando hijo $index");
                
                if ($this->breakSwitch) {
                    error_log("Break detectado, saliendo del switch");
                    break;
                }
                
                // Si ya ejecutamos un caso, salir del switch
                if ($casoEjecutado) {
                    error_log("Ya se ejecutó un caso, saltando resto");
                    break;
                }
                
                // Obtener el nombre de la clase sin namespace
                $childClass = get_class($child);
                $simpleClass = substr($childClass, strrpos($childClass, '\\') + 1);
                error_log("  Hijo $index: " . $childClass . " (simple: $simpleClass)");
                
                // Verificar por el nombre de la clase
                if ($simpleClass === 'CasoContext') {
                    error_log("  → Es un CASE");
                    $this->procesarCaso($child, $valorSwitch, $tipoSwitch, $casoEjecutado);
                }
                else if ($simpleClass === 'DefaultBloqueContext') {
                    error_log("  → Es un DEFAULT");
                    if (!$casoEjecutado) {
                        error_log("    Ejecutando default");
                        $this->ejecutarSentenciasDefault($child);
                        $casoEjecutado = true;
                    }
                }
            }
        }
        
        error_log("Saliendo del ámbito switch");
        $this->salirAmbito();
        $this->enSwitch = false;
        $this->breakSwitch = false;
        
        error_log("========== FIN SWITCH ==========");
        return null;
    }
    
    private function procesarCaso($child, $valorSwitch, $tipoSwitch, &$casoEjecutado)
    {
        error_log("    === DENTRO DE procesarCaso ===");
        
        // Obtener las expresiones del caso
        $listaExpresiones = $child->listaExpresiones();
        $expresionesCaso = $listaExpresiones ? $listaExpresiones->expresion() : [];
        error_log("    Número de expresiones en case: " . count($expresionesCaso));
        
        // Verificar si este caso coincide
        foreach ($expresionesCaso as $expr) {
            $valorCaso = $this->visit($expr);
            $tipoCaso = $this->obtenerTipo($valorCaso);
            
            error_log("    Comparando case: " . $this->formatearValor($valorCaso) . " (tipo: $tipoCaso)");
            
            if (!$this->tiposCompatiblesSwitch($tipoSwitch, $tipoCaso)) {
                $this->agregarErrorSemantico(
                    "Tipo incompatible en case: switch es $tipoSwitch, case es $tipoCaso",
                    $child->getStart()->getLine(),
                    $child->getStart()->getCharPositionInLine()
                );
                continue;
            }
            
            if ($this->compararValores($valorSwitch, $valorCaso)) {
                error_log("    ¡Caso coincide! EJECUTANDO SENTENCIAS");
                $this->ejecutarSentenciasCaso($child);
                $casoEjecutado = true;
                break;
            }
        }
    }
    
    private function ejecutarSentenciasCaso($casoCtx)
    {
        error_log("    === DENTRO DE ejecutarSentenciasCaso ===");
        $this->entrarAmbito('case');
        
        // Ejecutar todas las sentencias del caso
        $sentencias = $casoCtx->sentencia();
        error_log("    Número de sentencias en case: " . count($sentencias));
        
        foreach ($sentencias as $index => $sentencia) {
            error_log("    Ejecutando sentencia $index");
            $this->visit($sentencia);
            
            // Si hay break, salir del switch
            if (isset($this->breakSwitch) && $this->breakSwitch) {
                error_log("    Break detectado en case");
                $this->breakSwitch = false;
                break;
            }
        }
        
        $this->salirAmbito();
    }
    
    private function ejecutarSentenciasDefault($defaultCtx)
    {
        error_log("    === DENTRO DE ejecutarSentenciasDefault ===");
        $this->entrarAmbito('default');
        
        $sentencias = $defaultCtx->sentencia();
        foreach ($sentencias as $sentencia) {
            $this->visit($sentencia);
        }
        
        $this->salirAmbito();
    }
    
    private function tiposCompatiblesSwitch($tipo1, $tipo2)
    {
        $tiposComparables = [
            'int32' => ['int32' => true, 'float32' => true],
            'float32' => ['int32' => true, 'float32' => true],
            'bool' => ['bool' => true],
            'rune' => ['rune' => true],
            'string' => ['string' => true]
        ];
        
        return isset($tiposComparables[$tipo1][$tipo2]);
    }
    
    private function compararValores($a, $b)
    {
        if ($a === null || $b === null) return false;
        
        if (is_int($a) && is_int($b)) return $a == $b;
        if (is_float($a) && is_float($b)) return $a == $b;
        if (is_int($a) && is_float($b)) return $a == $b;
        if (is_float($a) && is_int($b)) return $a == $b;
        if (is_string($a) && is_string($b)) return $a == $b;
        if (is_bool($a) && is_bool($b)) return $a == $b;
        
        return false;
    }
}