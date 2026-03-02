<?php

use Antlr\Antlr4\Runtime\Tree\AbstractParseTreeVisitor;

require_once __DIR__ . '/traits/AsignacionTrait.php';
require_once __DIR__ . '/traits/ControlFlujoTrait.php';
require_once __DIR__ . '/traits/DeclaracionesTrait.php';
require_once __DIR__ . '/traits/ExpresionesTrait.php';
require_once __DIR__ . '/traits/FuncionEmbTrait.php';
require_once __DIR__ . '/traits/FuncUsuarioTrait.php';
require_once __DIR__ . '/traits/UtilidadesTrait.php';


class Interpreter extends GolampiBaseVisitor
{

    use AsignacionTrait;
    use ControlFlujoTrait;
    use DeclaracionesTrait;
    use ExpresionesTrait;
    use FuncionEmbTrait;
    use FuncUsuarioTrait;
    use UtilidadesTrait;


    // Tabla de símbolos global
    private $tablaSimbolos = [];

    // Tabla de símbolos histórica (para el reporte final)
    private $tablaSimbolosHistorial = [];
    
    // Salida de la consola
    private $consola = [];
    
    // Ámbito actual
    private $ambitoActual = 'global';
    
    // Pila de ámbitos para bloques anidados
    private $pilaAmbitos = ['global'];

    // Array para errores semánticos
    private $errores = [];
    
    // Array para constantes
    private $constantes = [];
    
    public function __construct()
    {
        // Inicializar funciones embebidas
        $this->tablaSimbolos['fmt.Println'] = [
            'tipo' => 'funcion',
            'ambito' => 'global',
            'linea' => 0,
            'columna' => 0
        ];

        // También guardar en historial
        $this->tablaSimbolosHistorial['fmt.Println'] = [
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
        $this->errores = [];
        $this->constantes = [];
        $this->pilaAmbitos = ['global'];
        $this->ambitoActual = 'global';
        $this->tablaSimbolosHistorial = []; // Reiniciar historial
        
        // Registrar funciones embebidas en historial
        $this->tablaSimbolosHistorial['fmt.Println'] = [
            'tipo' => 'funcion',
            'ambito' => 'global',
            'linea' => 0,
            'columna' => 0
        ];
        
        // Visitar todas las funciones (esto registrará las funciones en la tabla)
        foreach ($ctx->funcion() as $funcion) {
            $this->visit($funcion);
        }
        
        return [
            'consola' => $this->consola,
            'errores' => $this->errores,
            'tabla_simbolos' => $this->tablaSimbolosHistorial, // <-- Usar historial
            'constantes' => $this->constantes
        ];
    }
    
    // ============ FUNCIONES ============
    public function visitFuncion($ctx)
    {
        $nombre = $ctx->IDENTIFICADOR() ? $ctx->IDENTIFICADOR()->getText() : 'main';
        
        // Registrar función en tabla de símbolos
        if (!isset($this->tablaSimbolos[$nombre])) {
            $datosFuncion = [
                'tipo' => 'funcion',
                'ambito' => 'global',
                'linea' => $ctx->getStart()->getLine(),
                'columna' => $ctx->getStart()->getCharPositionInLine(),
                'esConstante' => false
            ];
            
            $this->tablaSimbolos[$nombre] = $datosFuncion;
            $this->tablaSimbolosHistorial[$nombre] = $datosFuncion; // <-- Guardar en historial
        }
        
        // Si es main, ejecutarla
        if ($nombre === 'main') {
            $this->entrarAmbito('main');
            $this->visit($ctx->bloque());
            $this->salirAmbito();
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

    private function debugTablaSimbolos($mensaje = "")
{
    error_log("=== TABLA DE SÍMBOLOS " . $mensaje . " ===");
    foreach ($this->tablaSimbolos as $id => $info) {
        error_log("  $id: {tipo: " . ($info['tipo'] ?? '?') . 
                 ", ámbito: " . ($info['ambito'] ?? '?') . 
                 ", valor: " . ($this->formatearValor($info['valor'] ?? null)) . "}");
    }
    error_log("================================");
}
}

