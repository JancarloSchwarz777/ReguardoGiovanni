<?php
use Antlr\Antlr4\Runtime\Tree\AbstractParseTreeVisitor;

class CodeGenerator extends GolampiBaseVisitor
{
    use AsignacionGenTrait;
    use ControlFlujoGenTrait;
    use ControlForGenTrait;
    use ControlSwitchGenTrait;
    use DeclaracionesGenTrait;
    use ExpresionesGenTrait; 
    use FuncionEmbGenTrait;
    use FuncUsuarioGenTrait;
    use UtilidadesGenTrait;
    
    private $dataSection = [];
    private $textSection = [];
    private $labelCounter = 0;
    private $stringCounter = 0;
    private $stackSize = 0;
    private $offsets = [];  
    private $tablaSimbolos = [];           
    private $tablaSimbolosHistorial = [];  
    private $ambitoActual = 'global';      
    private $pilaAmbitos = ['global'];     
    private $errores = [];                 
    private $nextRegister = 0;  
    private $funcionesEmbebidas = ['fmt.Println', 'len', 'now', 'substr', 'typeOf'];  
    private $funciones = []; 
    private $dataWritableSection = [];
    private $funcionesTipos = []; 
    private $evaluandoTipo = false;
    
    public function __construct() {
        error_log("=== CodeGenerator ARM64 Inicializado ===");
    }
    
    public function visitPrograma($ctx) {
        // PRIMERO: Registrar todas las funciones en $this->funciones (para búsqueda)
        foreach ($ctx->funcion() as $funcion) {
            $nombre = $funcion->IDENTIFICADOR() ? $funcion->IDENTIFICADOR()->getText() : 'main';
            if ($nombre !== 'main') {
                $this->funciones[$nombre] = $funcion;
                error_log("Registrada función: $nombre");
            }
        }
        
        // SEGUNDO: Generar código para cada función (usando el trait FuncUsuarioGenTrait)
        foreach ($ctx->funcion() as $funcion) {
            $nombre = $funcion->IDENTIFICADOR() ? $funcion->IDENTIFICADOR()->getText() : 'main';
            if ($nombre !== 'main') {
                $this->visitFuncion($funcion);  // Esto genera el código y lo guarda en funcionesText
            }
        }
        
        // TERCERO: Generar código para main (directamente)
        foreach ($ctx->funcion() as $funcion) {
            $nombre = $funcion->IDENTIFICADOR() ? $funcion->IDENTIFICADOR()->getText() : 'main';
            if ($nombre === 'main') {
                foreach ($funcion->bloque()->sentencia() as $sentencia) {
                    $this->visit($sentencia);
                }
            }
        }
        
        return null;
    }

    protected function emitDataWritable($line) {
        if (strpos($line, ':') !== false) {
            $this->dataWritableSection[] = $line;
        } else {
            $this->dataWritableSection[] = "    " . $line;
        }
    }
    
    public function getFullCode() {
        $alignedStackSize = ($this->stackSize + 15) & ~15;
        $output = ".arch armv8-a\n";
        $output .= ".section .rodata\n";
        $output .= ".balign 8\n";  
        $output .= implode("\n", $this->dataSection) . "\n\n";
        
        if (!empty($this->dataWritableSection)) {
            $output .= ".section .data\n";
            $output .= ".balign 8\n";
            $output .= implode("\n", $this->dataWritableSection) . "\n\n";
        }
        
        $output .= ".section .text\n";
        
        foreach ($this->funcionesText as $nombre => $funcCode) {
            $output .= $funcCode . "\n";
        }
        
        $output .= ".globl main\n";
        $output .= ".type main, @function\n";
        $output .= ".align 2\n\n";
        $output .= "main:\n";
        $output .= "    stp x29, x30, [sp, #-16]!\n";
        $output .= "    mov x29, sp\n";
        
        if ($alignedStackSize > 0) {
            $output .= "    sub sp, sp, #" . $alignedStackSize . "\n\n";
        }
        
        $output .= implode("\n", $this->textSection) . "\n\n";
        
        if ($alignedStackSize > 0) {
            $output .= "    add sp, sp, #" . $alignedStackSize . "\n";
        }
        
        $output .= "    ldp x29, x30, [sp], #16\n";
        $output .= "    mov w0, #0\n";
        $output .= "    ret\n";
        
        return $output;
    }
    
    protected function emitData($line) { 
        if (strpos($line, ':') !== false) {
            $this->dataSection[] = $line;
        } else {
            $this->dataSection[] = "    " . $line;
        }
    }   
    protected function emitText($line) { $this->textSection[] = "    " . $line; }
    protected function newLabel($prefix = "L") { return $prefix . "_" . ($this->labelCounter++); }
    protected function newStringLabel() { return "str_" . ($this->stringCounter++); }
    
    /**
     * Reserva espacio en stack para una variable
     */
    protected function reservarVariable($id, $tipo, $linea, $columna, $valorConocido = null)
    {
        $tamaño = $this->tamañoTipo($tipo);
        $this->stackSize = ($this->stackSize + 7) & ~7; 
        $offset = -($this->stackSize + $tamaño);
        $this->stackSize += $tamaño;
        
        $this->offsets[$id] = $offset;
        $this->tablaSimbolos[$id] = [
            'tipo' => $tipo,
            'offset' => $offset,
            'tamaño' => $tamaño,
            'ambito' => $this->ambitoActual,
            'linea' => $linea,
            'columna' => $columna,
            'esConstante' => false,
            'valor' => $valorConocido 
        ];
        
        $this->tablaSimbolosHistorial[$id] = $this->tablaSimbolos[$id];
        return $offset;
    }

    
    private function agregarErrorSemantico($descripcion, $linea, $columna) {
        $this->errores[] = ['tipo' => 'Semántico', 'descripcion' => $descripcion, 'linea' => $linea, 'columna' => $columna];
    }
    
    public function getTablaSimbolos() { return $this->tablaSimbolosHistorial; }
    public function getErrores() { return $this->errores; }


    /**
     * Formatea un valor para logging
     */
    protected function formatearValor($valor)
    {
        if ($valor === null) return 'nil';
        if (is_bool($valor)) return $valor ? 'true' : 'false';
        if (is_string($valor)) return '"' . $valor . '"';
        if (is_int($valor)) return (string)$valor;
        if (is_float($valor)) {
            if (floor($valor) == $valor) {
                return (string)(int)$valor;
            }
            return (string)$valor;
        }
        return (string)$valor;
    }
}