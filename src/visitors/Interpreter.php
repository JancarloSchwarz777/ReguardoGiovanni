<?php

use Antlr\Antlr4\Runtime\Tree\AbstractParseTreeVisitor;

require_once __DIR__ . '/traits/AsignacionTrait.php';
require_once __DIR__ . '/traits/ControlFlujoTrait.php';
require_once __DIR__ . '/traits/ControlForTrait.php';
require_once __DIR__ . '/traits/ControlSwitchTrait.php';
require_once __DIR__ . '/traits/DeclaracionesTrait.php';
require_once __DIR__ . '/traits/ExpresionesTrait.php';
require_once __DIR__ . '/traits/FuncionEmbTrait.php';
require_once __DIR__ . '/traits/FuncUsuarioTrait.php';
require_once __DIR__ . '/traits/TransferenciaTrait.php';
require_once __DIR__ . '/traits/UtilidadesTrait.php';


class Interpreter extends GolampiBaseVisitor
{

    use AsignacionTrait;
    use ControlFlujoTrait;
    use ControlForTrait;
    use ControlSwitchTrait;
    use DeclaracionesTrait;
    use ExpresionesTrait;
    use FuncionEmbTrait;
    use FuncUsuarioTrait;
    use TransferenciaTrait;
    use UtilidadesTrait;

    // Propiedades para switch
    private $enSwitch = false;
    private $breakSwitch = false;

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

    // Mapa de funciones definidas por el usuario
    private $funciones = []; 
    
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
        $this->tablaSimbolos = []; // Reiniciar tabla
        $this->tablaSimbolosHistorial = [];
        $this->funciones = []; // Reiniciar funciones
        
        error_log("=== VISITANDO PROGRAMA ===");
        error_log("Número de funciones: " . count($ctx->funcion()));
        
        // Registrar funciones embebidas
        $this->tablaSimbolosHistorial['fmt.Println'] = [
            'tipo' => 'funcion',
            'ambito' => 'global',
            'linea' => 0,
            'columna' => 0
        ];
        
        // PRIMERO: Registrar y VISITAR todas las funciones (para que queden en tablaSimbolos)
        foreach ($ctx->funcion() as $funcion) {
            $nombre = $funcion->IDENTIFICADOR() ? $funcion->IDENTIFICADOR()->getText() : 'main';
            error_log("Procesando función: $nombre");
            
            // IMPORTANTE: Visitar la función para que se registre en tablaSimbolos
            $this->visit($funcion);
        }
        
        // SEGUNDO: Ejecutar main (si existe)
        foreach ($ctx->funcion() as $funcion) {
            $nombre = $funcion->IDENTIFICADOR() ? $funcion->IDENTIFICADOR()->getText() : 'main';
            if ($nombre === 'main') {
                error_log("Ejecutando main");
                $this->entrarAmbito('main');
                
                // Ejecutar todo el bloque de main
                $this->visit($funcion->bloque());
                
                // Salir del ámbito main DESPUÉS de ejecutar todo
                $this->salirAmbito();
                break;
            }
        }
        
        error_log("CONSOLA FINAL: " . print_r($this->consola, true));
        
        return [
            'consola' => $this->consola,
            'errores' => $this->errores,
            'tabla_simbolos' => $this->tablaSimbolosHistorial,
            'constantes' => $this->constantes
        ];
    }
    
    // ============ FUNCIONES ============
    public function visitFuncion($ctx)
    {
        $nombre = $ctx->IDENTIFICADOR() ? $ctx->IDENTIFICADOR()->getText() : 'main';
        
        error_log(">>> VISITANDO FUNCIÓN: $nombre");
        
        // Almacenar el contexto de la función para búsqueda posterior
        if ($nombre !== 'main') {
            $this->funciones[$nombre] = $ctx;
            
            // Obtener tipos de retorno
            $tiposRetorno = $this->obtenerTiposRetornoFuncion($ctx);
            
            // Registrar función en tabla de símbolos
            if (!isset($this->tablaSimbolos[$nombre])) {
                $datosFuncion = [
                    'tipo' => 'funcion',
                    'tipo_retorno' => $tiposRetorno,
                    'ambito' => 'global',
                    'valor' => null,
                    'linea' => $ctx->getStart()->getLine(),
                    'columna' => $ctx->getStart()->getCharPositionInLine(),
                    'esConstante' => false
                ];
                
                $this->tablaSimbolos[$nombre] = $datosFuncion;
                $this->tablaSimbolosHistorial[$nombre] = $datosFuncion;
                
                error_log("Función '$nombre' registrada en tabla de símbolos con retornos: " . implode(', ', $tiposRetorno ?: ['void']));
            }
        }
        
        // Si es main, NO la ejecutamos aquí (ya se ejecuta en visitPrograma)
        return null;
    }

    // Modificar buscarFuncionEnAST en FuncUsuarioTrait:
    private function buscarFuncionEnAST($nombre)
    {
        return $this->funciones[$nombre] ?? null;
    }
    
    // ============ BLOQUES ============
    public function visitBloque($ctx)
    {
        error_log(">>> ENTRANDO A BLOQUE con " . count($ctx->sentencia()) . " sentencias");
        
        // Guardar el estado de retornoPendiente antes de procesar el bloque
        $retornoPendienteOriginal = $this->retornoPendiente;
        
        foreach ($ctx->sentencia() as $index => $sentencia) {
            error_log("Procesando sentencia $index en bloque");
            
            // Si ya hay un return pendiente, no procesar más sentencias
            if ($this->retornoPendiente && $retornoPendienteOriginal) {
                error_log("Return pendiente original detectado, saltando sentencia $index");
                break;
            }
            
            try {
                $this->visit($sentencia);
                
                // Si encontramos un return en este bloque, detener el procesamiento
                if ($this->retornoPendiente && !$retornoPendienteOriginal) {
                    error_log("Return detectado en este bloque, deteniendo procesamiento");
                    break;
                }
            } catch (ReturnException $e) {
                $this->valoresRetorno = $e->getValores();
                $this->retornoPendiente = true;
                error_log("ReturnException capturada, saliendo del bloque");
                break;
            }
        }
        
        error_log(">>> SALIENDO DE BLOQUE");
        return null;
    }
}

