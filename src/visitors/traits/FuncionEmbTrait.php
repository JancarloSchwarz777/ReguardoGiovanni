<?php
trait FuncionEmbTrait

{

// ============================================================ FUNCIONES EMBEBIDAS ============================================================
    // En Interpreter.php, dentro de la clase

    public function visitLlamadaFuncion($ctx)
    {
        // Obtener el nombre de la función
        $nombre = '';
        if ($ctx->PRINTLN()) {
            $nombre = 'fmt.Println';
        } else if ($ctx->IDENTIFICADOR()) {
            $nombre = $ctx->IDENTIFICADOR()->getText();
        }
        
        $argumentos = $ctx->argumentos() ? $ctx->argumentos()->expresion() : [];
        $linea = $ctx->getStart()->getLine();
        $columna = $ctx->getStart()->getCharPositionInLine();
        
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
                // Es una función definida por el usuario
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
        $this->consola[] = $lineaTexto;
        
        return null;
    }

    private function ejecutarLen($argumentos, $linea, $columna)
    {
        if (count($argumentos) != 1) {
            $this->errores[] = [
                'tipo' => 'Semántico',
                'descripcion' => 'len() requiere exactamente 1 argumento',
                'linea' => $linea,
                'columna' => $columna
            ];
            return 0;
        }
        
        $valor = $this->visit($argumentos[0], $linea, $columna);
        
        if (is_string($valor)) {
            return strlen($valor);
        } elseif (is_array($valor)) {
            return count($valor);
        } else {
            $this->errores[] = [
                'tipo' => 'Semántico',
                'descripcion' => 'len() solo puede aplicarse a strings o arreglos',
                'linea' => $linea,
                'columna' => $columna
            ];
            return 0;
        }
    }

    private function ejecutarNow($argumentos, $linea, $columna)
    {
        if (count($argumentos) > 0) {
            $this->errores[] = [
                'tipo' => 'Semántico',
                'descripcion' => 'now() no acepta argumentos',
                'linea' => $linea,
                'columna' => $columna
            ];
        }
        
        return date('Y-m-d H:i:s');
    }

    private function ejecutarSubstr($argumentos, $linea, $columna)
    {
        if (count($argumentos) != 3) {
            $this->errores[] = [
                'tipo' => 'Semántico',
                'descripcion' => 'substr() requiere 3 argumentos: (string, inicio, longitud)',
                'linea' => $linea,
                'columna' => $columna
            ];
            return "";
        }
        
        $str = $this->visit($argumentos[0], $linea, $columna);
        $inicio = $this->visit($argumentos[1], $linea, $columna);
        $longitud = $this->visit($argumentos[2], $linea, $columna);
        
        if (!is_string($str)) {
            $this->errores[] = [
                'tipo' => 'Semántico',
                'descripcion' => 'substr(): primer argumento debe ser string',
                'linea' => $linea,
                'columna' => $columna
            ];
            return "";
        }
        
        if (!is_int($inicio) || !is_int($longitud)) {
            $this->errores[] = [
                'tipo' => 'Semántico',
                'descripcion' => 'substr(): inicio y longitud deben ser enteros',
                'linea' => $linea,
                'columna' => $columna
            ];
            return "";
        }
        
        return substr($str, $inicio, $longitud);
    }

    private function ejecutarTypeOf($argumentos, $linea, $columna)
    {
        if (count($argumentos) != 1) {
            $this->errores[] = [
                'tipo' => 'Semántico',
                'descripcion' => 'typeOf() requiere exactamente 1 argumento',
                'linea' => $linea,
                'columna' => $columna
            ];
            return "unknown";
        }
        
        $valor = $this->visit($argumentos[0], $linea, $columna);
        
        if ($valor === null) return "nil";
        if (is_int($valor)) return "int32";
        if (is_float($valor)) return "float32";
        if (is_string($valor)) return "string";
        if (is_bool($valor)) return "bool";
        if (is_array($valor)) return "array";
        
        return "unknown";
    }


}