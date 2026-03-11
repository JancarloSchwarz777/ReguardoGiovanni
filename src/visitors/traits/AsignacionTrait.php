<?php
trait AsignacionTrait
{

// ============================================================ ASIGNACIONES ============================================================
    public function visitAsignacion($ctx)
    {
        // Verificar si hay un operador de desreferenciación (*)
        $esDesreferenciacion = false;
        $id = '';
        
        // La estructura puede ser: IDENTIFICADOR o MULT IDENTIFICADOR
        if ($ctx->MULT()) {
            $esDesreferenciacion = true;
            $id = $ctx->IDENTIFICADOR()->getText();
        } else {
            $id = $ctx->IDENTIFICADOR()->getText();
        }
        
        $linea = $ctx->IDENTIFICADOR()->getSymbol()->getLine();
        $columna = $ctx->IDENTIFICADOR()->getSymbol()->getCharPositionInLine();
        
        error_log("=== ASIGNACIÓN " . ($esDesreferenciacion ? "CON DESREFERENCIA" : "") . " ===");
        error_log("  Variable: $id" . ($esDesreferenciacion ? " (desreferenciando)" : ""));
        
        // Verificar si existe
        if (!isset($this->tablaSimbolos[$id])) {
            $this->agregarErrorSemantico(
                "Variable '$id' no declarada",
                $linea,
                $columna
            );
            return null;
        }
        
        // Variable destino (puede cambiar si es desreferenciación)
        $variableReal = $id;
        
        // Si es desreferenciación, la variable debe ser un puntero
        if ($esDesreferenciacion) {
            if (!($this->tablaSimbolos[$id]['es_puntero'] ?? false)) {
                $this->agregarErrorSemantico(
                    "No se puede desreferenciar una variable que no es puntero",
                    $linea,
                    $columna
                );
                return null;
            }
            
            // El valor actual debe ser una referencia
            $referencia = $this->tablaSimbolos[$id]['valor'];
            if (!$this->esReferencia($referencia)) {
                $this->agregarErrorSemantico(
                    "No se puede desreferenciar un puntero nil",
                    $linea,
                    $columna
                );
                return null;
            }
            
            // La asignación es a la variable referenciada
            $variableReal = $referencia['id'];
            error_log("  Asignando a través de puntero: $id -> $variableReal");
        }
        
        // Verificar que la variable destino no sea constante
        $claveAmbito = $this->tablaSimbolos[$variableReal]['ambito'] . '.' . $variableReal;
        if (isset($this->constantes[$claveAmbito]) || 
            (isset($this->tablaSimbolos[$variableReal]['esConstante']) && $this->tablaSimbolos[$variableReal]['esConstante'])) {
            $this->agregarErrorSemantico(
                "No se puede modificar la constante '$variableReal'",
                $linea,
                $columna
            );
            return null;
        }
        
        $tipoVariable = $this->tablaSimbolos[$variableReal]['tipo'];
        $esPuntero = $this->tablaSimbolos[$variableReal]['es_puntero'] ?? false;
        $valorActual = $this->tablaSimbolos[$variableReal]['valor'] ?? $this->valorPorDefecto($tipoVariable);
        
        // Incremento/Decremento (++/--)
        if ($ctx->INCREMENTO() || $ctx->DECREMENTO()) {
            if ($tipoVariable !== 'int32' && !$esPuntero) {
                $this->agregarErrorSemantico(
                    "Operador '++/--' solo válido para int32",
                    $linea,
                    $columna
                );
                return null;
            }
            
            $nuevoValor = $ctx->INCREMENTO() ? $valorActual + 1 : $valorActual - 1;
            $this->tablaSimbolos[$variableReal]['valor'] = $nuevoValor;
            return $nuevoValor;
        }
        
        // Asignación compuesta (+=, -=) o simple (=)
        if ($ctx->expresion()) {
            $opAsignacion = '=';
            if ($ctx->operadorAsignacion()) {
                $opToken = $ctx->operadorAsignacion()->getChild(0)->getText();
                if ($opToken === '+=') {
                    $opAsignacion = '+=';
                } elseif ($opToken === '-=') {
                    $opAsignacion = '-=';
                }
            }
            
            // Evaluar la expresión
            $valor = $this->visit($ctx->expresion());
            $tipoValor = $this->obtenerTipo($valor);
            
            // CASO ESPECIAL: Operador compuesto (+=, -=) con desreferenciación
            if ($esDesreferenciacion && ($opAsignacion === '+=' || $opAsignacion === '-=')) {
                // Ya tenemos $variableReal (la variable apuntada)
                if (!isset($this->tablaSimbolos[$variableReal])) {
                    $this->agregarErrorSemantico(
                        "Variable '$variableReal' no declarada",
                        $linea,
                        $columna
                    );
                    return null;
                }
                
                $tipoVariable = $this->tablaSimbolos[$variableReal]['tipo'];
                $valorActual = $this->tablaSimbolos[$variableReal]['valor'];
                
                error_log("  Operador compuesto con desreferenciación: $variableReal $opAsignacion " . $this->formatearValor($valor));
                error_log("  Valor actual de $variableReal: " . $this->formatearValor($valorActual));
                
                // Validar que la variable sea numérica
                if (!$this->esTipoNumerico($tipoVariable)) {
                    $this->agregarErrorSemantico(
                        "Operador '$opAsignacion' solo válido para tipos numéricos",
                        $linea,
                        $columna
                    );
                    return null;
                }
                
                // Validar que el valor sea numérico
                if (!$this->esTipoNumerico($tipoValor)) {
                    $this->agregarErrorSemantico(
                        "Operador '$opAsignacion' requiere valor numérico",
                        $linea,
                        $columna
                    );
                    return null;
                }
                
                // Calcular nuevo valor
                $nuevoValor = $opAsignacion === '+=' ? $valorActual + $valor : $valorActual - $valor;
                $tipoResultado = $this->obtenerTipo($nuevoValor);
                
                // Validar compatibilidad
                if (!$this->tiposCompatiblesAsignacion($tipoVariable, $tipoResultado)) {
                    $this->agregarErrorSemantico(
                        "El resultado de '$opAsignacion' no es compatible con el tipo '$tipoVariable'",
                        $linea,
                        $columna
                    );
                    return null;
                }
                
                // Asignar el nuevo valor
                $this->tablaSimbolos[$variableReal]['valor'] = $nuevoValor;
                error_log("  Nuevo valor de $variableReal: " . $this->formatearValor($nuevoValor));
                
                return $nuevoValor;
            }
            
            // Si la variable destino es un puntero (sin desreferenciación)
            if ($esPuntero) {
                $tipoBase = $this->tablaSimbolos[$variableReal]['tipo_base'];
                
                error_log("  Asignación a puntero: $variableReal (tipo base: $tipoBase)");
                error_log("  Valor a asignar: " . $this->formatearValor($valor));
                
                // Si es nil, asignar nil
                if ($valor === null) {
                    error_log("  Asignando nil al puntero");
                    $this->tablaSimbolos[$variableReal]['valor'] = null;
                    return null;
                }
                
                // Verificar que el valor sea una referencia
                if (!$this->esReferencia($valor)) {
                    $tipoValor = $this->obtenerTipo($valor);
                    error_log("  Error: No es una referencia, es tipo $tipoValor");
                    $this->agregarErrorSemantico(
                        "No se puede asignar valor de tipo '$tipoValor' a puntero de tipo '$tipoBase'",
                        $linea,
                        $columna
                    );
                    return null;
                }
                
                // Verificar que el tipo base coincida
                $tipoReferencia = $valor['tipo_base'];
                if (!$this->tiposCompatiblesAsignacion($tipoBase, $tipoReferencia)) {
                    $this->agregarErrorSemantico(
                        "No se puede asignar puntero a '$tipoReferencia' a puntero de tipo '$tipoBase'",
                        $linea,
                        $columna
                    );
                    return null;
                }
                
                error_log("  Asignando referencia correctamente");
                $this->tablaSimbolos[$variableReal]['valor'] = $valor;
                return $valor;
            }
            
            // Para += y -= con tipos normales
            if ($opAsignacion === '+=' || $opAsignacion === '-=') {
                if (!$this->esTipoNumerico($tipoVariable)) {
                    $this->agregarErrorSemantico(
                        "Operador '$opAsignacion' solo válido para tipos numéricos",
                        $linea,
                        $columna
                    );
                    return null;
                }
                
                if (!$this->esTipoNumerico($tipoValor)) {
                    $this->agregarErrorSemantico(
                        "Operador '$opAsignacion' requiere valor numérico",
                        $linea,
                        $columna
                    );
                    return null;
                }
                
                $nuevoValor = $opAsignacion === '+=' ? $valorActual + $valor : $valorActual - $valor;
                $tipoResultado = $this->obtenerTipo($nuevoValor);
                
                if (!$this->tiposCompatiblesAsignacion($tipoVariable, $tipoResultado)) {
                    $this->agregarErrorSemantico(
                        "El resultado de '$opAsignacion' no es compatible con el tipo '$tipoVariable'",
                        $linea,
                        $columna
                    );
                    return null;
                }
                
                $this->tablaSimbolos[$variableReal]['valor'] = $nuevoValor;
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
            
            $this->tablaSimbolos[$variableReal]['valor'] = $valor;
            return $valor;
        }
        
        return null;
    }
    
}