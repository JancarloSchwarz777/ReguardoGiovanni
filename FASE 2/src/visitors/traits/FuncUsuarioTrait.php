<?php
// FuncUsuarioTrait.php
trait FuncUsuarioTrait
{
    private $pilaLlamadas = [];
    private $retornoPendiente = false;
    private $valoresRetorno = [];
    
    public function visitReturnStmt($ctx)
    {
        $linea = $ctx->getStart()->getLine();
        $columna = $ctx->getStart()->getCharPositionInLine();
        
        error_log(">>> RETURN en línea $linea");
        
        $this->valoresRetorno = [];
        
        if ($ctx->expresion()) {
            $expresiones = $ctx->expresion();
            
            if (is_array($expresiones)) {
                foreach ($expresiones as $expr) {
                    $valor = $this->visit($expr);
                    $this->valoresRetorno[] = $valor;
                    error_log("  Valor de retorno: " . $this->formatearValor($valor));
                }
            } else {
                $valor = $this->visit($expresiones);
                $this->valoresRetorno[] = $valor;
                error_log("  Valor de retorno: " . $this->formatearValor($valor));
            }
        }
        
        $this->retornoPendiente = true;
        error_log("Valores de retorno (" . count($this->valoresRetorno) . "): " . print_r($this->valoresRetorno, true));
        
        throw new ReturnException($this->valoresRetorno);
    }
    
    public function ejecutarFuncionUsuario($nombre, $argumentos, $linea, $columna)
    {
        error_log("=== LLAMADA A FUNCIÓN USUARIO: $nombre ===");
        
        if (!isset($this->tablaSimbolos[$nombre])) {
            $this->agregarErrorSemantico(
                "La función '$nombre' no está definida",
                $linea,
                $columna
            );
            return null;
        }
        
        $funcionCtx = $this->buscarFuncionEnAST($nombre);
        if (!$funcionCtx) {
            $this->agregarErrorSemantico(
                "No se encontró la definición de la función '$nombre'",
                $linea,
                $columna
            );
            return null;
        }
        
        $tiposRetorno = $this->tablaSimbolos[$nombre]['tipo_retorno'] ?? [];
        error_log("Tipos de retorno esperados: " . implode(', ', $tiposRetorno ?: ['void']));
        
        // Guardar estado (SIN CONSOLA para que las salidas se acumulen)
        $this->pilaLlamadas[] = [
            'ambito' => $this->ambitoActual,
            'pilaAmbitos' => $this->pilaAmbitos,
            'retornoPendiente' => $this->retornoPendiente,
            'valoresRetorno' => $this->valoresRetorno
        ];
        
        $this->retornoPendiente = false;
        $this->valoresRetorno = [];
        
        $parametros = $funcionCtx->parametros();
        $listaParametros = $parametros ? $parametros->parametro() : [];
        
        if (count($argumentos) != count($listaParametros)) {
            $this->agregarErrorSemantico(
                "La función '$nombre' espera " . count($listaParametros) . 
                " parámetros, pero se recibieron " . count($argumentos),
                $linea,
                $columna
            );
            $this->restaurarEstadoLlamada();
            return null;
        }
        
        $argumentosEvaluados = [];
        foreach ($argumentos as $idx => $arg) {
            error_log("  Evaluando argumento $idx para $nombre");
            $argumentosEvaluados[] = $this->visit($arg);
        }
        
        $this->entrarAmbito('funcion_' . $nombre);
        
        foreach ($listaParametros as $idx => $parametro) {
            $nombreParam = $parametro->IDENTIFICADOR()->getText();
            $tipoParam = $parametro->tipo()->getText();
            $esPunteroParam = (strpos($tipoParam, '*') === 0);
            $tipoBaseParam = $esPunteroParam ? substr($tipoParam, 1) : $tipoParam;
            
            $valorArg = $argumentosEvaluados[$idx];
            
            if ($esPunteroParam) {
                if (!$this->esReferencia($valorArg)) {
                    $tipoArg = $this->obtenerTipo($valorArg);
                    $this->agregarErrorSemantico(
                        "Se esperaba un puntero a '$tipoBaseParam', se recibió '$tipoArg'",
                        $linea,
                        $columna
                    );
                    $this->restaurarEstadoLlamada();
                    return null;
                }
                $valorParam = $valorArg;
            } else {
                $tipoArg = $this->obtenerTipo($valorArg);
                
                if (!$this->tiposCompatiblesAsignacion($tipoBaseParam, $tipoArg)) {
                    $this->agregarErrorSemantico(
                        "Tipo de argumento inválido en llamada a $nombre: " .
                        "se esperaba $tipoBaseParam, se recibió $tipoArg",
                        $linea,
                        $columna
                    );
                    $this->restaurarEstadoLlamada();
                    return null;
                }
                $valorParam = $valorArg;
            }
            
            $this->tablaSimbolos[$nombreParam] = [
                'tipo' => $tipoParam,
                'tipo_base' => $tipoBaseParam,
                'es_puntero' => $esPunteroParam,
                'ambito' => $this->ambitoActual,
                'valor' => $valorParam,
                'es_referencia' => $esPunteroParam,
                'linea' => $funcionCtx->getStart()->getLine(),
                'columna' => $funcionCtx->getStart()->getCharPositionInLine(),
                'esParametro' => true
            ];
            
            $this->tablaSimbolosHistorial[$nombreParam] = $this->tablaSimbolos[$nombreParam];
        }
        
        try {
            $this->visit($funcionCtx->bloque());
        } catch (ReturnException $e) {
            $this->valoresRetorno = $e->getValores();
            error_log("Return capturado con " . count($this->valoresRetorno) . " valores");
        }
        
        if (!empty($tiposRetorno)) {
            if (count($this->valoresRetorno) != count($tiposRetorno)) {
                $this->agregarErrorSemantico(
                    "La función '$nombre' debe retornar " . count($tiposRetorno) . 
                    " valor(es), pero retornó " . count($this->valoresRetorno),
                    $funcionCtx->getStart()->getLine(),
                    $funcionCtx->getStart()->getCharPositionInLine()
                );
            }
        }
        
        $resultado = null;
        if (!empty($this->valoresRetorno)) {
            if (count($this->valoresRetorno) == 1) {
                $resultado = $this->valoresRetorno[0];
            } else {
                $resultado = $this->valoresRetorno;
            }
        }
        
        $this->restaurarEstadoLlamada();
        
        error_log("=== FIN LLAMADA A $nombre, retorna: " . 
                (is_array($resultado) ? '[' . implode(', ', array_map([$this, 'formatearValor'], $resultado)) . ']' : $this->formatearValor($resultado)) . 
                " ===");
        
        return $resultado;
    }
    
    private function obtenerTiposRetornoFuncion($funcionCtx)
    {
        $tipos = [];
        $texto = $funcionCtx->getText();
        
        error_log("Analizando tipos de retorno para: " . $texto);
        
        $textoCompleto = $texto;
        
        $posParenCierre = strpos($textoCompleto, ')');
        if ($posParenCierre !== false) {
            $despuesParen = substr($textoCompleto, $posParenCierre + 1);
            $despuesParen = trim($despuesParen);
            
            error_log("Después del paréntesis: '$despuesParen'");
            
            if (strpos($despuesParen, '(') === 0) {
                $posParenApertura = strpos($despuesParen, '(');
                $posParenCierreRet = strpos($despuesParen, ')');
                if ($posParenApertura !== false && $posParenCierreRet !== false) {
                    $tiposStr = substr($despuesParen, $posParenApertura + 1, $posParenCierreRet - $posParenApertura - 1);
                    $tiposArray = explode(',', $tiposStr);
                    foreach ($tiposArray as $t) {
                        $tipos[] = trim($t);
                    }
                    error_log("  Múltiples retornos: " . implode(', ', $tipos));
                }
            } else {
                $posLlave = strpos($despuesParen, '{');
                if ($posLlave !== false) {
                    $tipoStr = substr($despuesParen, 0, $posLlave);
                    $tipoStr = trim($tipoStr);
                    if (!empty($tipoStr)) {
                        $tipos[] = $tipoStr;
                        error_log("  Retorno simple: $tipoStr");
                    }
                }
            }
        }
        
        return $tipos;
    }
    
    private function buscarFuncionEnAST($nombre)
    {
        return $this->funciones[$nombre] ?? null;
    }
    
    private function restaurarEstadoLlamada()
    {
        $estadoAnterior = array_pop($this->pilaLlamadas);
        if ($estadoAnterior) {
            $this->ambitoActual = $estadoAnterior['ambito'];
            $this->pilaAmbitos = $estadoAnterior['pilaAmbitos'];
            $this->retornoPendiente = $estadoAnterior['retornoPendiente'] ?? false;
            $this->valoresRetorno = $estadoAnterior['valoresRetorno'] ?? [];
            // NO restauramos $this->consola para mantener las salidas
            
            error_log(">>> Estado restaurado (sin tabla de símbolos y sin consola): retornoPendiente = " . ($this->retornoPendiente ? 'true' : 'false'));
        }
    }
}

class ReturnException extends Exception
{
    private $valores;
    
    public function __construct($valores)
    {
        $this->valores = $valores;
        parent::__construct("Return detectado");
    }
    
    public function getValores()
    {
        return $this->valores;
    }
}