<?php
trait FuncionEmbTrait
{

// ============================================================ FUNCIONES EMBEBIDAS ============================================================

    public function visitLlamadaFuncion($ctx)
    {
        // Obtener el nombre de la función
        $nombre = '';
        
        if ($ctx->PRINTLN()) {
            $nombre = 'fmt.Println';
        } else if ($ctx->LEN()) {
            $nombre = 'len';
        } else if ($ctx->NOW()) {
            $nombre = 'now';
        } else if ($ctx->SUBSTR()) {
            $nombre = 'substr';
        } else if ($ctx->TYPEOF()) {
            $nombre = 'typeOf';
        } else if ($ctx->IDENTIFICADOR()) {
            $nombre = $ctx->IDENTIFICADOR()->getText();
        }
        
        $argumentos = $ctx->argumentos() ? $ctx->argumentos()->expresion() : [];
        $linea = $ctx->getStart()->getLine();
        $columna = $ctx->getStart()->getCharPositionInLine();
        
        error_log("=== LLAMADA A FUNCIÓN: '$nombre' con " . count($argumentos) . " argumentos ===");
        
        // Mapeo de funciones embebidas
        switch ($nombre) {
            case 'fmt.Println':
                return $this->ejecutarPrintln($argumentos, $linea, $columna);
                
            case 'len':
                return $this->ejecutarLen($argumentos, $linea, $columna);
                
            case 'now':
                return $this->ejecutarNow($argumentos, $linea, $columna);
                
            case 'substr':
                return $this->ejecutarSubstr($argumentos, $linea, $columna);
                
            case 'typeOf':
                return $this->ejecutarTypeOf($argumentos, $linea, $columna);
                
            default:
                error_log("  → Buscando función de usuario: '$nombre'");
                return $this->ejecutarFuncionUsuario($nombre, $argumentos, $linea, $columna);
        }
    }

    private function ejecutarPrintln($argumentos, $linea, $columna)
    {
        $salida = [];
        foreach ($argumentos as $arg) {
            $valor = $this->visit($arg);
            $salida[] = $this->formatearValor($valor);
        }
        
        $lineaTexto = implode(' ', $salida);
        error_log("Println agregando a consola: " . $lineaTexto);
        $this->consola[] = $lineaTexto;
        
        return null;
    }

    private function ejecutarLen($argumentos, $linea, $columna)
    {
        if (count($argumentos) != 1) {
            $this->agregarErrorSemantico(
                'len() requiere exactamente 1 argumento',
                $linea,
                $columna
            );
            return 0;
        }
        
        $valor = $this->visit($argumentos[0]);
        
        if (is_string($valor)) {
            return strlen($valor);
        } elseif (is_array($valor)) {
            return count($valor);
        } else {
            $this->agregarErrorSemantico(
                'len() solo puede aplicarse a strings o arreglos',
                $linea,
                $columna
            );
            return 0;
        }
    }

    private function ejecutarNow($argumentos, $linea, $columna)
    {
        if (count($argumentos) > 0) {
            $this->agregarErrorSemantico(
                'now() no acepta argumentos',
                $linea,
                $columna
            );
        }
        
        return date('Y-m-d H:i:s');
    }

    private function ejecutarSubstr($argumentos, $linea, $columna)
    {
        if (count($argumentos) != 3) {
            $this->agregarErrorSemantico(
                'substr() requiere 3 argumentos: (string, inicio, longitud)',
                $linea,
                $columna
            );
            return "";
        }
        
        $str = $this->visit($argumentos[0]);
        $inicio = $this->visit($argumentos[1]);
        $longitud = $this->visit($argumentos[2]);
        
        if (!is_string($str)) {
            $this->agregarErrorSemantico(
                'substr(): primer argumento debe ser string',
                $linea,
                $columna
            );
            return "";
        }
        
        if (!is_int($inicio) || !is_int($longitud)) {
            $this->agregarErrorSemantico(
                'substr(): inicio y longitud deben ser enteros',
                $linea,
                $columna
            );
            return "";
        }
        
        return substr($str, $inicio, $longitud);
    }

    private function ejecutarTypeOf($argumentos, $linea, $columna)
    {
        if (count($argumentos) != 1) {
            $this->agregarErrorSemantico(
                'typeOf() requiere exactamente 1 argumento',
                $linea,
                $columna
            );
            return "unknown";
        }
        
        $valor = $this->visit($argumentos[0]);
        
        if ($valor === null) return "nil";
        if (is_int($valor)) return "int32";
        if (is_float($valor)) return "float32";
        if (is_string($valor)) {
            if (strlen($valor) === 1) {
                return "rune";
            }
            return "string";
        }
        if (is_bool($valor)) return "bool";
        if (is_array($valor)) return "array";
        
        return "unknown";
    }
}