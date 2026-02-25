<?php

use Antlr\Antlr4\Runtime\Tree\AbstractParseTreeVisitor;

require_once __DIR__ . '/traits/AsignacionTrait.php';
require_once __DIR__ . '/traits/DeclaracionesTrait.php';
require_once __DIR__ . '/traits/ExpresionesTrait.php';
require_once __DIR__ . '/traits/FuncionEmbTrait.php';
require_once __DIR__ . '/traits/FuncUsuarioTrait.php';
require_once __DIR__ . '/traits/UtilidadesTrait.php';


class Interpreter extends GolampiBaseVisitor
{

    use AsignacionTrait;
    use DeclaracionesTrait;
    use ExpresionesTrait;
    use FuncionEmbTrait;
    use FuncUsuarioTrait;
    use UtilidadesTrait;


    // Tabla de símbolos global
    private $tablaSimbolos = [];
    
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
    }
    
    // ============ PROGRAMA ============
    public function visitPrograma($ctx)
    {
        $this->consola = [];
        $this->errores = [];
        $this->constantes = []; // Inicializar array de constantes
        $this->pilaAmbitos = ['global'];
        $this->ambitoActual = 'global';
        
        // Visitar todas las funciones (esto registrará las funciones en la tabla)
        foreach ($ctx->funcion() as $funcion) {
            $this->visit($funcion);
        }
        
        return [
            'consola' => $this->consola,
            'errores' => $this->errores,
            'tabla_simbolos' => $this->tablaSimbolos,
            'constantes' => $this->constantes
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
                'columna' => $ctx->getStart()->getCharPositionInLine(),
                'esConstante' => false
            ];
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
}

