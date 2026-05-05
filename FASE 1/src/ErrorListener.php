<?php

use Antlr\Antlr4\Runtime\Error\Listeners\ANTLRErrorListener;
use Antlr\Antlr4\Runtime\Parser;
use Antlr\Antlr4\Runtime\Recognizer;
use Antlr\Antlr4\Runtime\Dfa\DFA;
use Antlr\Antlr4\Runtime\Utils\BitSet;
use Antlr\Antlr4\Runtime\Atn\ATNConfigSet;
use Antlr\Antlr4\Runtime\Error\Exceptions\RecognitionException;

class GolampiErrorListener implements ANTLRErrorListener
{
    private $errores = [];
    
    public function syntaxError(
        Recognizer $recognizer,
        ?object $offendingSymbol,
        int $line,
        int $charPositionInLine,
        string $msg,
        ?RecognitionException $exception = null
    ): void {
        // Determinar si es error léxico o sintáctico
        $tipo = $this->determinarTipoError($msg, $offendingSymbol);
        
        // Obtener el texto del símbolo ofensivo
        $texto = '';
        if ($offendingSymbol && method_exists($offendingSymbol, 'getText')) {
            $texto = $offendingSymbol->getText();
        } elseif ($offendingSymbol && is_string($offendingSymbol)) {
            $texto = $offendingSymbol;
        }
        
        // Limpiar y formatear el mensaje
        $descripcion = $this->limpiarMensaje($msg, $texto);
        
        $this->errores[] = [
            'tipo' => $tipo,
            'linea' => $line,
            'columna' => $charPositionInLine + 1,
            'descripcion' => $descripcion
        ];
        
        error_log("Error $tipo en línea $line, columna " . ($charPositionInLine + 1) . ": $descripcion");
    }
    
    public function reportAmbiguity(
        Parser $recognizer,
        DFA $dfa,
        int $startIndex,
        int $stopIndex,
        bool $exact,
        ?BitSet $ambigAlts,
        ATNConfigSet $configs
    ): void {
        // No necesitamos manejar ambigüedades por ahora
    }
    
    public function reportAttemptingFullContext(
        Parser $recognizer,
        DFA $dfa,
        int $startIndex,
        int $stopIndex,
        ?BitSet $conflictingAlts,
        ATNConfigSet $configs
    ): void {
        // No necesitamos manejar esto por ahora
    }
    
    public function reportContextSensitivity(
        Parser $recognizer,
        DFA $dfa,
        int $startIndex,
        int $stopIndex,
        int $prediction,
        ATNConfigSet $configs
    ): void {
        // No necesitamos manejar esto por ahora
    }
    
    private function determinarTipoError(string $msg, ?object $offendingSymbol): string
    {
        $texto = '';
        if ($offendingSymbol && method_exists($offendingSymbol, 'getText')) {
            $texto = $offendingSymbol->getText();
        }
        
        // Errores léxicos - caracteres no válidos
        if (strpos($msg, 'token recognition error') !== false) {
            return 'Léxico';
        }
        
        // Si hay un símbolo que claramente no pertenece al lenguaje
        if (strpos($msg, 'extraneous input') !== false && preg_match('/[^a-zA-Z0-9_\s]/', $texto)) {
            return 'Léxico';
        }
        
        // Por defecto es sintáctico
        return 'Sintáctico';
    }
    
    private function limpiarMensaje(string $msg, string $texto = ''): string
    {
        // Traducir mensajes comunes
        $msg = str_replace('<EOF>', 'fin de archivo', $msg);
        $msg = str_replace('mismatched input', 'entrada no esperada', $msg);
        $msg = str_replace('expecting', 'se esperaba', $msg);
        $msg = str_replace('extraneous input', 'símbolo no válido', $msg);
        $msg = str_replace('no viable alternative', 'expresión no válida', $msg);
        
        // Mensajes específicos
        if (strpos($msg, 'token recognition error') !== false) {
            return "Símbolo no reconocido: '" . $this->escapeString($texto) . "'";
        }
        
        // Limpiar mensajes que contienen listas de tokens esperados
        if (preg_match('/{(.+?)}/', $msg, $matches)) {
            $msg = str_replace($matches[0], '', $msg);
        }
        
        return trim($msg);
    }
    
    private function escapeString(string $str): string
    {
        if (empty($str)) return 'desconocido';
        
        // Escapar caracteres especiales para mostrar
        $str = addcslashes($str, "\0..\37!@\177..\377");
        return $str;
    }
    
    public function getErrores(): array
    {
        return $this->errores;
    }
    
    public function tieneErrores(): bool
    {
        return !empty($this->errores);
    }
}