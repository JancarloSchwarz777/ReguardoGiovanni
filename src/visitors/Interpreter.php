<?php

use Antlr\Antlr4\Runtime\Tree\AbstractParseTreeVisitor;

/**
 * Visitor para Golampi - Versión MVP
 * Soporta: 
 * - Declaración de variables (var x int = 10)
 * - Declaración corta (x := 10)
 * - Asignaciones (x = 20)
 * - fmt.Println()
 */
class Interpreter extends GolampiBaseVisitor
{
    // Tabla de símbolos global
    private $tablaSimbolos = [];
    
    // Salida de la consola
    private $consola = [];
    
    // Ámbito actual
    private $ambitoActual = 'global';
    
    // Pila de ámbitos para bloques anidados
    private $pilaAmbitos = ['global'];
    
    public function __construct()
    {
        // Inicializar funciones embebidas
        $this->tablaSimbolos['fmt.Println'] = [
            'tipo' => 'funcion',
            'ambito' => 'global',
            'linea' => 0,
            'columna' => 0
        ];
    }
    
    // ============ PROGRAMA ============
    public function visitPrograma($ctx)
    {
        $this->consola = [];
        $this->pilaAmbitos = ['global'];
        $this->ambitoActual = 'global';
        
        // Visitar todas las funciones
        foreach ($ctx->funcion() as $funcion) {
            $this->visit($funcion);
        }
        
        return [
            'consola' => $this->consola,
            'tabla_simbolos' => $this->tablaSimbolos
        ];
    }
    
    // ============ FUNCIONES ============
    public function visitFuncion($ctx)
    {
        $nombre = $ctx->IDENTIFICADOR() ? $ctx->IDENTIFICADOR()->getText() : 'main';
        
        // Registrar función en tabla de símbolos
        if (!isset($this->tablaSimbolos[$nombre])) {
            $this->tablaSimbolos[$nombre] = [
                'tipo' => 'funcion',
                'ambito' => 'global',
                'linea' => $ctx->getStart()->getLine(),
                'columna' => $ctx->getStart()->getCharPositionInLine()
            ];
        }
        
        // Si es main, ejecutarla
        if ($nombre === 'main') {
            $this->ambitoActual = 'main';
            array_push($this->pilaAmbitos, 'main');
            $this->visit($ctx->bloque());
            array_pop($this->pilaAmbitos);
            $this->ambitoActual = end($this->pilaAmbitos);
        }
        
        return null;
    }
    
    // ============ BLOQUES ============
    public function visitBloque($ctx)
    {
        foreach ($ctx->sentencia() as $sentencia) {
            $this->visit($sentencia);
        }
        return null;
    }
    
    // ============ DECLARACIONES ============
    public function visitDeclaracionVar($ctx)
    {
        $tipo = $ctx->tipo()->getText();
        $ids = $ctx->listaIdentificadores()->IDENTIFICADOR();
        $expresiones = $ctx->listaExpresiones() ? $ctx->listaExpresiones()->expresion() : [];
        
        foreach ($ids as $i => $idNode) {
            $id = $idNode->getText();
            
            // Verificar si ya existe en el ámbito actual
            if ($this->existeEnAmbitoActual($id)) {
                $this->agregarErrorSemantico(
                    "El identificador '$id' ya fue declarado en este ámbito",
                    $idNode->getSymbol()->getLine(),
                    $idNode->getSymbol()->getCharPositionInLine()
                );
                continue;
            }
            
            // Evaluar valor inicial si existe
            $valor = null;
            if (isset($expresiones[$i])) {
                $valor = $this->visit($expresiones[$i]);
            } else {
                $valor = $this->valorPorDefecto($tipo);
            }
            
            // Registrar en tabla de símbolos
            $this->tablaSimbolos[$id] = [
                'tipo' => $tipo,
                'ambito' => $this->ambitoActual,
                'valor' => $valor,
                'linea' => $idNode->getSymbol()->getLine(),
                'columna' => $idNode->getSymbol()->getCharPositionInLine()
            ];
        }
        
        return null;
    }
    
    public function visitDeclaracionCorta($ctx)
    {
        $ids = $ctx->listaIdentificadores()->IDENTIFICADOR();
        $expresiones = $ctx->listaExpresiones()->expresion();
        
        foreach ($ids as $i => $idNode) {
            $id = $idNode->getText();
            
            // Verificar si ya existe en el ámbito actual
            if ($this->existeEnAmbitoActual($id)) {
                $this->agregarErrorSemantico(
                    "El identificador '$id' ya fue declarado en este ámbito",
                    $idNode->getSymbol()->getLine(),
                    $idNode->getSymbol()->getCharPositionInLine()
                );
                continue;
            }
            
            // Evaluar expresión
            $valor = $this->visit($expresiones[$i]);
            $tipo = $this->inferirTipo($valor);
            
            // Registrar en tabla de símbolos
            $this->tablaSimbolos[$id] = [
                'tipo' => $tipo,
                'ambito' => $this->ambitoActual,
                'valor' => $valor,
                'linea' => $idNode->getSymbol()->getLine(),
                'columna' => $idNode->getSymbol()->getCharPositionInLine()
            ];
        }
        
        return null;
    }
    
    // ============ ASIGNACIONES ============
    public function visitAsignacion($ctx)
    {
        $id = $ctx->IDENTIFICADOR()->getText();
        
        // Verificar si existe
        if (!isset($this->tablaSimbolos[$id])) {
            $this->agregarErrorSemantico(
                "Variable '$id' no declarada",
                $ctx->IDENTIFICADOR()->getSymbol()->getLine(),
                $ctx->IDENTIFICADOR()->getSymbol()->getCharPositionInLine()
            );
            return null;
        }
        
        // Si es incremento/decremento
        if ($ctx->INCREMENTO() || $ctx->DECREMENTO()) {
            $valorActual = $this->tablaSimbolos[$id]['valor'] ?? 0;
            $nuevoValor = $ctx->INCREMENTO() ? $valorActual + 1 : $valorActual - 1;
            $this->tablaSimbolos[$id]['valor'] = $nuevoValor;
            return $nuevoValor;
        }
        
        // Asignación normal
        if ($ctx->expresion()) {
            $valor = $this->visit($ctx->expresion());
            $this->tablaSimbolos[$id]['valor'] = $valor;
            return $valor;
        }
        
        return null;
    }
    
    // ============ EXPRESIONES ============
    public function visitExpresionAditiva($ctx)
    {
        if (count($ctx->expresionMultiplicativa()) == 1) {
            return $this->visit($ctx->expresionMultiplicativa(0));
        }
        
        $resultado = $this->visit($ctx->expresionMultiplicativa(0));
        
        for ($i = 1; $i < count($ctx->expresionMultiplicativa()); $i++) {
            $op = $ctx->getChild(2 * $i - 1)->getText();
            $valor = $this->visit($ctx->expresionMultiplicativa($i));
            
            if ($op === '+') {
                $resultado += $valor;
            } else {
                $resultado -= $valor;
            }
        }
        
        return $resultado;
    }
    
    public function visitExpresionMultiplicativa($ctx)
    {
        if (count($ctx->expresionUnaria()) == 1) {
            return $this->visit($ctx->expresionUnaria(0));
        }
        
        $resultado = $this->visit($ctx->expresionUnaria(0));
        
        for ($i = 1; $i < count($ctx->expresionUnaria()); $i++) {
            $op = $ctx->getChild(2 * $i - 1)->getText();
            $valor = $this->visit($ctx->expresionUnaria($i));
            
            if ($op === '*') {
                $resultado *= $valor;
            } elseif ($op === '/') {
                if ($valor == 0) {
                    $this->agregarErrorSemantico("División por cero", $ctx->getStart()->getLine(), $ctx->getStart()->getCharPositionInLine());
                    $resultado = null;
                } else {
                    $resultado /= $valor;
                }
            } else {
                $resultado %= $valor;
            }
        }
        
        return $resultado;
    }
    
    public function visitExpresionPrimaria($ctx)
    {
        if ($ctx->NUMERO_ENTERO()) {
            return (int)$ctx->NUMERO_ENTERO()->getText();
        }
        
        if ($ctx->NUMERO_DECIMAL()) {
            return (float)$ctx->NUMERO_DECIMAL()->getText();
        }
        
        if ($ctx->CADENA()) {
            $texto = $ctx->CADENA()->getText();
            return substr($texto, 1, -1);  // Quitar comillas
        }
        
        if ($ctx->CARACTER()) {
            $texto = $ctx->CARACTER()->getText();
            return substr($texto, 1, -1);  // Quitar comillas simples
        }
        
        if ($ctx->TRUE()) {
            return true;
        }
        
        if ($ctx->FALSE()) {
            return false;
        }
        
        if ($ctx->NIL()) {
            return null;
        }
        
        if ($ctx->IDENTIFICADOR()) {
            $id = $ctx->IDENTIFICADOR()->getText();
            if (isset($this->tablaSimbolos[$id])) {
                return $this->tablaSimbolos[$id]['valor'];
            } else {
                $this->agregarErrorSemantico(
                    "Variable '$id' no declarada",
                    $ctx->IDENTIFICADOR()->getSymbol()->getLine(),
                    $ctx->IDENTIFICADOR()->getSymbol()->getCharPositionInLine()
                );
                return null;
            }
        }
        
        if ($ctx->expresion()) {
            return $this->visit($ctx->expresion());
        }
        
        return null;
    }
    
    // ============ FUNCIONES EMBEBIDAS ============
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
    
    // ============ MÉTODOS AUXILIARES ============
    private function existeEnAmbitoActual($id)
    {
        return isset($this->tablaSimbolos[$id]) && 
               $this->tablaSimbolos[$id]['ambito'] === $this->ambitoActual;
    }
    
    private function valorPorDefecto($tipo)
    {
        switch ($tipo) {
            case 'int32': return 0;
            case 'float32': return 0.0;
            case 'string': return "";
            case 'bool': return false;
            case 'rune': return '\u0000';
            default: return null;
        }
    }
    
    private function inferirTipo($valor)
    {
        if (is_int($valor)) return 'int32';
        if (is_float($valor)) return 'float32';
        if (is_string($valor)) return 'string';
        if (is_bool($valor)) return 'bool';
        return 'nil';
    }
    
    private function formatearValor($valor)
    {
        if ($valor === null) return 'nil';
        if (is_bool($valor)) return $valor ? 'true' : 'false';
        if (is_string($valor)) return $valor;
        if (is_float($valor) && floor($valor) == $valor) {
            return (string)(int)$valor;
        }
        return (string)$valor;
    }
    
    private function agregarErrorSemantico($mensaje, $linea, $columna)
    {
        // Por ahora solo imprimimos
        error_log("Error semántico [$linea,$columna]: $mensaje");
    }
}