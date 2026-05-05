<?php
trait AsignacionGenTrait
{
    public function visitAsignacion($ctx)
    {
        $esDesreferenciacion = $ctx->MULT() !== null;
        $id = $ctx->IDENTIFICADOR()->getText();
        $linea = $ctx->IDENTIFICADOR()->getSymbol()->getLine();
        $columna = $ctx->IDENTIFICADOR()->getSymbol()->getCharPositionInLine();
        
        if (!isset($this->offsets[$id])) {
            $this->agregarErrorSemantico("Variable '$id' no declarada", $linea, $columna);
            return null;
        }
        
        $offset = $this->offsets[$id];
        $tipoVariable = $this->tablaSimbolos[$id]['tipo'];
        $esPuntero = (strpos($tipoVariable, '*') === 0) || ($tipoVariable === 'puntero');
        
        // Extraer el tipo base si es un puntero
        if ($esPuntero && isset($this->tablaSimbolos[$id]['tipo_base'])) {
            $tipoBase = $this->tablaSimbolos[$id]['tipo_base'];
        } else {
            $tipoBase = $esPuntero ? substr($tipoVariable, 1) : $tipoVariable;
            if ($tipoBase === 'untero') $tipoBase = 'int32';
        }
        
        // Verificación de constante
        if (isset($this->tablaSimbolos[$id]['esConstante']) && $this->tablaSimbolos[$id]['esConstante']) {
            $this->agregarErrorSemantico("No se puede modificar la constante '$id'", $linea, $columna);
            return null;
        }
        
        // Incremento/Decremento (a++ / a--)
        if ($ctx->INCREMENTO() || $ctx->DECREMENTO()) {
            if ($tipoVariable !== 'int32') {
                $this->agregarErrorSemantico("Operador '++/--' solo válido para int32", $linea, $columna);
                return null;
            }
            $this->cargarDeStack($offset, $tipoVariable);
            if ($ctx->INCREMENTO()) {
                $this->emitText("add w0, w0, #1");
            } else {
                $this->emitText("sub w0, w0, #1");
            }
            $this->guardarEnStack($offset, $tipoVariable);
            return null;
        }
        
        $opAsignacion = '=';
        if ($ctx->operadorAsignacion()) {
            $opAsignacion = $ctx->operadorAsignacion()->getText();
        }
        
        // 1. Evaluar la expresión de la derecha (deja el resultado en x0/w0/s0/d0)
        $tipoValor = $this->visit($ctx->expresion());
        
        // 2. CASO ESPECIAL: Desreferenciación (*p = valor)
        if ($esDesreferenciacion) {
            if (!$esPuntero) {
                $this->agregarErrorSemantico("No se puede desreferenciar una variable que no es puntero", $linea, $columna);
                return null;
            }
            $this->emitText("ldr x1, [x29, #$offset] // Cargar dirección en x1");
            // Guardar el valor (w0/d0) en la dirección apuntada
            if ($tipoBase === 'float32') {
                $this->emitText("str d0, [x1] // Guardar valor flotante en puntero");
            } else {
                $this->emitText("str w0, [x1] // Guardar valor en puntero");
            }
            return null;
        }
        
        // 3. Asignación normal a variable puntero (p = &x)
        if ($esPuntero) {
            if ($tipoValor === 'nil') {
                $this->emitText("mov x0, #0");
                $this->guardarEnStack($offset, $tipoVariable); 
            } else if ($tipoValor === 'puntero' || is_object($tipoValor)) {
                $this->guardarEnStack($offset, $tipoVariable); 
            } else {
                $this->agregarErrorSemantico("No se puede asignar valor de tipo '$tipoValor' a puntero", $linea, $columna);
            }
            return null;
        }
        
        // 4. Asignación normal o compuesta a variable no puntero
        // Si es operador compuesto (+=, -=, *=, /=)
        if ($opAsignacion !== '=') {
            // Guardar el resultado de la expresión derecha en un temporal
            $tempOffset = $this->reservarTemporal();
            if ($tipoBase === 'float32') {
                $this->emitText("fmov d1, d0");   // mover resultado a d1
                $this->guardarEnStack($tempOffset, $tipoBase);
                // Cargar valor actual de la variable
                $this->cargarDeStack($offset, $tipoBase);
                // El valor actual está en d0, el resultado expr en d1 (desde el temporal)
                $this->cargarDeStack($tempOffset, $tipoBase);
                $this->emitText("fmov d1, d0");   // resultado expr a d1
                $this->cargarDeStack($offset, $tipoBase); // valor actual a d0
            } else {
                $this->emitText("mov w1, w0");
                $this->guardarEnStack($tempOffset, $tipoBase);
                $this->cargarDeStack($offset, $tipoBase);
                $this->cargarDeStack($tempOffset, $tipoBase);
                $this->emitText("mov w1, w0");
                $this->cargarDeStack($offset, $tipoBase);
            }
            
            $op = substr($opAsignacion, 0, -1);  // quitar el '='
            switch ($op) {
                case '+':
                    if ($tipoBase === 'float32') $this->emitText("fadd d0, d0, d1");
                    else $this->emitText("add w0, w0, w1");
                    break;
                case '-':
                    if ($tipoBase === 'float32') $this->emitText("fsub d0, d0, d1");
                    else $this->emitText("sub w0, w0, w1");
                    break;
                case '*':
                    if ($tipoBase === 'float32') $this->emitText("fmul d0, d0, d1");
                    else $this->emitText("mul w0, w0, w1");
                    break;
                case '/':
                    if ($tipoBase === 'float32') $this->emitText("fdiv d0, d0, d1");
                    else $this->emitText("sdiv w0, w0, w1");
                    break;
                default:
                    $this->agregarErrorSemantico("Operador compuesto '$opAsignacion' no soportado", $linea, $columna);
                    $this->liberarTemporal($tempOffset);
                    return null;
            }
            $this->liberarTemporal($tempOffset);
        }
        
        // Guardar el resultado (ya sea de expr simple o compuesta)
        $this->guardarEnStack($offset, $tipoBase);
        return null;
    }
}