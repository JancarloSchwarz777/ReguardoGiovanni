<?php
// src/visitors/gen/FuncionEmbGenTrait.php

trait FuncionEmbGenTrait
{
    public function visitLlamadaFuncion($ctx)
    {
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
        
        switch ($nombre) {
            case 'fmt.Println':
                return $this->generarPrintln($argumentos, $linea, $columna);
            case 'len':
                return $this->generarLen($argumentos, $linea, $columna);
            case 'now':
                return $this->generarNow($argumentos, $linea, $columna);
            case 'substr':
                return $this->generarSubstr($argumentos, $linea, $columna);
            case 'typeOf':
                return $this->generarTypeOf($argumentos, $linea, $columna);
            default:
                error_log("  → Buscando función de usuario: '$nombre'");
                return $this->ejecutarFuncionUsuario($nombre, $argumentos, $linea, $columna);
        }
    }

    private function generarPrintln($argumentos, $linea, $columna)
    {
        error_log("Generando fmt.Println con " . count($argumentos) . " argumentos");
        
        if (empty($argumentos)) {
            $labelNewLine = $this->newStringLabel();
            $this->emitData("$labelNewLine: .asciz \"\\n\"");
            $this->emitText("adrp x0, $labelNewLine");
            $this->emitText("add x0, x0, :lo12:$labelNewLine");
            $this->emitText("bl printf");
            return 'nil';
        }
        
        for ($i = 0; $i < count($argumentos); $i++) {
            $arg = $argumentos[$i];
            
            if ($i > 0) {
                $spaceLabel = $this->newStringLabel();
                $this->emitData("$spaceLabel: .asciz \" \"");
                $this->emitText("adrp x0, $spaceLabel");
                $this->emitText("add x0, x0, :lo12:$spaceLabel");
                $this->emitText("bl printf");
            }
            
            $tipo = $this->visit($arg);
            
            if ($tipo === 'nil') {
                $nilLabel = $this->newStringLabel();
                $this->emitData("$nilLabel: .asciz \"<nil>\"");
                $this->emitText("adrp x0, $nilLabel");
                $this->emitText("add x0, x0, :lo12:$nilLabel");
                $this->emitText("bl printf");
                continue;
            }
            
            $format = "";
            switch ($tipo) {
                case 'int32':
                    $format = "%d";
                    $this->emitText("mov w1, w0");
                    break;
                case 'float32':
                    $format = "%f";
                    $this->emitText("fmov d1, d0");
                    break;
                case 'string':
                    $format = "%s";
                    $this->emitText("mov x1, x0");
                    break;
                case 'bool':
                    $format = "%d";
                    $this->emitText("mov w1, w0");
                    break;
                case 'rune':
                    $format = "%c";
                    $this->emitText("mov w1, w0");
                    break;
                default:
                    $format = "%s";
                    $this->emitText("mov x1, x0");
            }
            
            $formatLabel = $this->newStringLabel();
            $this->emitData("$formatLabel: .asciz \"$format\"");
            $this->emitText("adrp x0, $formatLabel");
            $this->emitText("add x0, x0, :lo12:$formatLabel");
            $this->emitText("bl printf");
        }
        
        $newlineLabel = $this->newStringLabel();
        $this->emitData("$newlineLabel: .asciz \"\\n\"");
        $this->emitText("adrp x0, $newlineLabel");
        $this->emitText("add x0, x0, :lo12:$newlineLabel");
        $this->emitText("bl printf");
        
        return 'nil';
    }

    private function generarLen($argumentos, $linea, $columna)
    {
        if (count($argumentos) != 1) {
            $this->agregarErrorSemantico('len() requiere exactamente 1 argumento', $linea, $columna);
            return 'nil';
        }
        
        $tipoArg = $this->visit($argumentos[0]);
        
        if ($tipoArg === 'string') {
            $labelStart = $this->newLabel("strlen_start");
            $labelEnd = $this->newLabel("strlen_end");
            
            $this->emitText("mov x1, x0");
            $this->emitText("mov x2, #0");
            $this->emitText("$labelStart:");
            $this->emitText("ldrb w3, [x1], #1");
            $this->emitText("cbz w3, $labelEnd");
            $this->emitText("add x2, x2, #1");
            $this->emitText("b $labelStart");
            $this->emitText("$labelEnd:");
            $this->emitText("mov x0, x2");
        } else {
            $this->agregarErrorSemantico('len() solo para strings', $linea, $columna);
            $this->emitText("mov x0, #0");
        }
        
        return 'int32';
    }

    private function generarNow($argumentos, $linea, $columna)
    {
        if (count($argumentos) > 0) {
            $this->agregarErrorSemantico('now() no acepta argumentos', $linea, $columna);
        }
        
        $fechaActual = date('Y-m-d H:i:s');
        $labelFecha = $this->newStringLabel();
        $this->emitData("$labelFecha: .asciz \"$fechaActual\"");
        $this->emitText("adrp x0, $labelFecha");
        $this->emitText("add x0, x0, :lo12:$labelFecha");
        
        return 'string';
    }

    private function generarSubstr($argumentos, $linea, $columna)
    {
        if (count($argumentos) != 3) {
            $this->agregarErrorSemantico('substr() requiere 3 argumentos: string, inicio, longitud', $linea, $columna);
            return 'nil';
        }
        
        // Crear un buffer estático global para la subcadena resultado
        static $substrBufferCounter = 0;
        $bufferLabel = "substr_buffer_" . ($substrBufferCounter++);
        $this->emitDataWritable(".balign 8");
        $this->emitDataWritable("$bufferLabel: .space 256 ");
        
        // Evaluar los argumentos
        $this->visit($argumentos[0]);  
        $this->emitText("mov x19, x0  // Guardar string original");
        
        $this->visit($argumentos[1]);  
        $this->emitText("mov w20, w0  // Guardar inicio");
        
        $this->visit($argumentos[2]); 
        $this->emitText("mov w21, w0  // Guardar longitud");
        
        $labelError = $this->newLabel("substr_error");
        $labelCopy = $this->newLabel("substr_copy");
        $labelDone = $this->newLabel("substr_done");
        
        // Validaciones básicas
        $this->emitText("cmp w20, #0");
        $this->emitText("b.lt $labelError");
        $this->emitText("cmp w21, #0");
        $this->emitText("b.le $labelError");
        
        // Calcular longitud de la cadena original
        $this->emitText("mov x1, x19");
        $this->emitText("mov x2, #0");
        $labelStrlen = $this->newLabel("substr_strlen");
        $labelStrlenEnd = $this->newLabel("substr_strlen_end");
        $this->emitText("$labelStrlen:");
        $this->emitText("ldrb w3, [x1], #1");
        $this->emitText("cbz w3, $labelStrlenEnd");
        $this->emitText("add x2, x2, #1");
        $this->emitText("b $labelStrlen");
        $this->emitText("$labelStrlenEnd:");
        $this->emitText("mov x22, x2  // Longitud total");
        
        // Verificar inicio dentro del rango
        $this->emitText("cmp w20, w22");
        $this->emitText("b.ge $labelError");
        
        // Ajustar longitud si excede
        $this->emitText("add w23, w20, w21");
        $this->emitText("cmp w23, w22");
        $this->emitText("b.le $labelCopy");
        $this->emitText("sub w21, w22, w20");
        
        // Copiar subcadena
        $this->emitText("$labelCopy:");
        $this->emitText("adrp x4, $bufferLabel");
        $this->emitText("add x4, x4, :lo12:$bufferLabel  // destino");
        $this->emitText("add x5, x19, w20, SXTW  // origen = string + inicio");
        $this->emitText("mov w6, w21  // cantidad a copiar");
        $this->emitText("mov x7, #0  // índice");
        
        $labelCopyLoop = $this->newLabel("substr_copy_loop");
        $labelCopyEnd = $this->newLabel("substr_copy_end");
        $this->emitText("$labelCopyLoop:");
        $this->emitText("cmp w7, w6");
        $this->emitText("b.ge $labelCopyEnd");
        $this->emitText("ldrb w8, [x5], #1");
        $this->emitText("strb w8, [x4], #1");
        $this->emitText("add w7, w7, #1");
        $this->emitText("b $labelCopyLoop");
        $this->emitText("$labelCopyEnd:");
        $this->emitText("strb wzr, [x4]  // null terminator");
        
        // Retornar la dirección del buffer
        $this->emitText("adrp x0, $bufferLabel");
        $this->emitText("add x0, x0, :lo12:$bufferLabel");
        $this->emitText("b $labelDone");
        
        // Caso error: retornar cadena vacía
        $this->emitText("$labelError:");
        $emptyLabel = $this->newStringLabel();
        $this->emitData("$emptyLabel: .asciz \"\"");
        $this->emitText("adrp x0, $emptyLabel");
        $this->emitText("add x0, x0, :lo12:$emptyLabel");
        
        $this->emitText("$labelDone:");
        
        return 'string';
    }

    private function generarTypeOf($argumentos, $linea, $columna)
    {
        if (count($argumentos) != 1) {
            $this->agregarErrorSemantico('typeOf() requiere 1 argumento', $linea, $columna);
            return 'nil';
        }
        
        $tipoArg = $this->visit($argumentos[0]);
        $labelTipo = $this->newStringLabel();
        $this->emitData("$labelTipo: .asciz \"$tipoArg\"");
        $this->emitText("adrp x0, $labelTipo");
        $this->emitText("add x0, x0, :lo12:$labelTipo");
        
        return 'string';
    }
}