<?php
// FuncUsuarioTrait.php
trait FuncUsuarioTrait
{
    private $pilaLlamadas = []; // Para manejar el stack de llamadas
    private $retornoPendiente = false;
    private $valoresRetorno = [];
    
    /**
     * Procesa una sentencia return
     */
    public function visitReturnStmt($ctx)
    {
        $linea = $ctx->getStart()->getLine();
        $columna = $ctx->getStart()->getCharPositionInLine();
        
        error_log(">>> RETURN en línea $linea");
        
        $this->valoresRetorno = [];
        
        if ($ctx->expresion()) {
            // Verificar si hay múltiples expresiones (separadas por coma)
            // En la gramática, return puede tener una lista de expresiones
            $expresiones = $ctx->expresion();
            
            // Si es un array, son múltiples expresiones
            if (is_array($expresiones)) {
                foreach ($expresiones as $expr) {
                    $valor = $this->visit($expr);
                    $this->valoresRetorno[] = $valor;
                    error_log("  Valor de retorno: " . $this->formatearValor($valor));
                }
            } else {
                // Es una sola expresión
                $valor = $this->visit($expresiones);
                $this->valoresRetorno[] = $valor;
                error_log("  Valor de retorno: " . $this->formatearValor($valor));
            }
        }
        
        $this->retornoPendiente = true;
        error_log("Valores de retorno (" . count($this->valoresRetorno) . "): " . print_r($this->valoresRetorno, true));
        
        // Lanzar excepción para salir de la función actual
        throw new ReturnException($this->valoresRetorno);
    }
    
    /**
     * Ejecuta una función definida por el usuario
     */
    public function ejecutarFuncionUsuario($nombre, $argumentos, $linea, $columna)
    {
        error_log("=== LLAMADA A FUNCIÓN USUARIO: $nombre ===");
        
        // Verificar que la función existe en la tabla de símbolos
        if (!isset($this->tablaSimbolos[$nombre])) {
            $this->agregarErrorSemantico(
                "La función '$nombre' no está definida",
                $linea,
                $columna
            );
            return null;
        }
        
        // Buscar el contexto de la función en el AST
        $funcionCtx = $this->buscarFuncionEnAST($nombre);
        if (!$funcionCtx) {
            $this->agregarErrorSemantico(
                "No se encontró la definición de la función '$nombre'",
                $linea,
                $columna
            );
            return null;
        }
        
        // Obtener tipos de retorno
        $tiposRetorno = $this->tablaSimbolos[$nombre]['tipo_retorno'] ?? [];
        error_log("Tipos de retorno esperados: " . implode(', ', $tiposRetorno ?: ['void']));
        
        // Guardar estado actual antes de la llamada
        $this->pilaLlamadas[] = [
            'ambito' => $this->ambitoActual,
            'pilaAmbitos' => $this->pilaAmbitos,
            'consola' => $this->consola,
            'retornoPendiente' => $this->retornoPendiente,
            'valoresRetorno' => $this->valoresRetorno
        ];
        
        // Reiniciar flags para esta función
        $this->retornoPendiente = false;
        $this->valoresRetorno = [];
        
        // Obtener parámetros de la función
        $parametros = $funcionCtx->parametros();
        $listaParametros = $parametros ? $parametros->parametro() : [];
        
        // Validar cantidad de argumentos
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
        
        // IMPORTANTE: Evaluar todos los argumentos ANTES de entrar al ámbito de la función
        // Esto evita problemas en recursión donde una llamada puede afectar a otra
        $argumentosEvaluados = [];
        foreach ($argumentos as $idx => $arg) {
            error_log("  Evaluando argumento $idx para $nombre");
            $argumentosEvaluados[] = $this->visit($arg);
        }
        
        // Crear nuevo ámbito para la función
        $this->entrarAmbito('funcion_' . $nombre);
        
        // Procesar parámetros usando los argumentos ya evaluados
        foreach ($listaParametros as $idx => $parametro) {
            $nombreParam = $parametro->IDENTIFICADOR()->getText();
            $tipoParam = $parametro->tipo()->getText();
            $esPunteroParam = (strpos($tipoParam, '*') === 0);
            $tipoBaseParam = $esPunteroParam ? substr($tipoParam, 1) : $tipoParam;
            
            // Usar el argumento ya evaluado
            $valorArg = $argumentosEvaluados[$idx];
            
            // Si el parámetro espera un puntero, el argumento debe ser una referencia
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
            
            // Registrar parámetro en tabla de símbolos
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
        
        // Ejecutar el bloque de la función
        try {
            $this->visit($funcionCtx->bloque());
        } catch (ReturnException $e) {
            $this->valoresRetorno = $e->getValores();
            error_log("Return capturado con " . count($this->valoresRetorno) . " valores");
        }
        
        // Validar que la cantidad de valores retornados coincida con lo declarado
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
        
        // Preparar resultado
        $resultado = null;
        if (!empty($this->valoresRetorno)) {
            if (count($this->valoresRetorno) == 1) {
                $resultado = $this->valoresRetorno[0];
            } else {
                $resultado = $this->valoresRetorno;
            }
        }
        
        // Restaurar estado anterior
        $this->restaurarEstadoLlamada();
        
        error_log("=== FIN LLAMADA A $nombre, retorna: " . 
                (is_array($resultado) ? '[' . implode(', ', array_map([$this, 'formatearValor'], $resultado)) . ']' : $this->formatearValor($resultado)) . 
                " ===");
        
        return $resultado;
    }
    
    /**
     * Obtiene los tipos de retorno de una función desde su definición
     */
    private function obtenerTiposRetornoFuncion($funcionCtx)
    {
        $tipos = [];
        $texto = $funcionCtx->getText();
        
        error_log("Analizando tipos de retorno para: " . $texto);
        
        $textoCompleto = $texto;
        
        // Buscar después del primer ')' que cierra los parámetros
        $posParenCierre = strpos($textoCompleto, ')');
        if ($posParenCierre !== false) {
            $despuesParen = substr($textoCompleto, $posParenCierre + 1);
            $despuesParen = trim($despuesParen);
            
            error_log("Después del paréntesis: '$despuesParen'");
            
            // Si sigue un '(' entonces son múltiples retornos
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
                // Es un solo tipo de retorno
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
    
    /**
     * Busca una función en el AST
     */
    private function buscarFuncionEnAST($nombre)
    {
        return $this->funciones[$nombre] ?? null;
    }
    
    /**
     * Restaura el estado después de una llamada
     */
    private function restaurarEstadoLlamada()
    {
        $estadoAnterior = array_pop($this->pilaLlamadas);
        if ($estadoAnterior) {
            $this->ambitoActual = $estadoAnterior['ambito'];
            $this->pilaAmbitos = $estadoAnterior['pilaAmbitos'];
            $this->consola = $estadoAnterior['consola'];
            $this->retornoPendiente = $estadoAnterior['retornoPendiente'] ?? false;
            $this->valoresRetorno = $estadoAnterior['valoresRetorno'] ?? [];
            
            error_log(">>> Estado restaurado (sin tabla de símbolos): retornoPendiente = " . ($this->retornoPendiente ? 'true' : 'false'));
        }
    }
}

// Excepción para manejar returns
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