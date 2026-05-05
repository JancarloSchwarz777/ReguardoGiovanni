<?php
require_once __DIR__ . '/../bootstrap.php';

use Antlr\Antlr4\Runtime\CommonTokenStream;
use Antlr\Antlr4\Runtime\InputStream;

// Función auxiliar global para formatear valores
function formatearValorParaTabla($valor) {
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
    if (is_array($valor)) {
        // Si es una referencia (puntero)
        if (isset($valor['__referencia']) && $valor['__referencia']) {
            return '&' . $valor['id'];
        }
        // Si es un múltiple retorno
        $elementos = [];
        foreach ($valor as $v) {
            $elementos[] = formatearValorParaTabla($v);
        }
        return '[' . implode(', ', $elementos) . ']';
    }
    return (string)$valor;
}

// Configurar logging
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../php_errors.log');
error_log("=== NUEVA EJECUCIÓN ===");

$resultado = null;
$codigo = '';
$consola = [];
$errores = [];
$tabla_simbolos = [];
$codigoArm64 = '';
$modoEjecucion = 'ejecutar';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];
    $modoEjecucion = $_POST['modo'] ?? 'ejecutar';
    
    error_log("Modo seleccionado: $modoEjecucion");
    error_log("Código recibido:\n" . $codigo);
    
    try {
        // Análisis con ANTLR
        $input = InputStream::fromString($codigo);
        $lexer = new GolampiLexer($input);
        
        // Crear listener de errores
        $errorListener = new GolampiErrorListener();
        
        // Agregar listener al lexer
        $lexer->removeErrorListeners();
        $lexer->addErrorListener($errorListener);
        
        $tokens = new CommonTokenStream($lexer);
        $parser = new GolampiParser($tokens);
        
        // Agregar listener al parser
        $parser->removeErrorListeners();
        $parser->addErrorListener($errorListener);
        
        // Intentar parsear
        $tree = $parser->programa();
        
        // Obtener errores léxicos y sintácticos del listener
        $erroresLexicoSintactico = $errorListener->getErrores();
        
        if (!empty($erroresLexicoSintactico)) {
            // Agregar estos errores a la lista general
            $errores = array_merge($errores, $erroresLexicoSintactico);
            error_log("Se encontraron " . count($erroresLexicoSintactico) . " errores léxicos/sintácticos");
        } else {
            error_log("Árbol generado correctamente");
            error_log("Tipo de árbol: " . get_class($tree));
            
            if ($modoEjecucion === 'generar') {
                // ========== MODO GENERACIÓN ARM64 ==========
                error_log("=== GENERANDO CÓDIGO ARM64 ===");
                
                // Verificar que la clase CodeGenerator existe
                if (!class_exists('CodeGenerator')) {
                    error_log("ERROR: CodeGenerator no encontrado");
                    $errores[] = [
                        'tipo' => 'Sistema',
                        'linea' => 0,
                        'columna' => 0,
                        'descripcion' => "CodeGenerator no está disponible. Verifique que los archivos estén correctamente cargados."
                    ];
                } else {
                    try {
                        $generador = new CodeGenerator();
                        $generador->visit($tree);
                        $codigoArm64 = $generador->getFullCode();
                        $tabla_simbolos = $generador->getTablaSimbolos();
                        $erroresSemanticos = $generador->getErrores();
                        
                        if (!empty($erroresSemanticos)) {
                            $errores = array_merge($errores, $erroresSemanticos);
                        }
                        
                        if (empty($erroresSemanticos)) {
                            // Guardar archivo .s
                            $outputDir = __DIR__ . '/../output';
                            if (!file_exists($outputDir)) {
                                mkdir($outputDir, 0777, true);
                            }
                            $archivoSalida = $outputDir . '/programa.s';
                            file_put_contents($archivoSalida, $codigoArm64);
                            
                            $consola = [
                                "✅ Código ARM64 generado exitosamente",
                                "📁 Archivo guardado en: output/programa.s",
                                "",
                                "🔧 Para ensamblar y ejecutar:",
                                "   aarch64-linux-gnu-as -o programa.o output/programa.s",
                                "   aarch64-linux-gnu-ld -o programa programa.o",
                                "   qemu-aarch64 ./programa",
                                "",
                                "📝 O si tienes herramientas nativas ARM64:",
                                "   as -o programa.o output/programa.s",
                                "   ld -o programa programa.o",
                                "   ./programa"
                            ];
                        } else {
                            $consola = ["❌ Se encontraron errores semánticos. No se generó código ARM64."];
                        }
                        
                        error_log("Generación ARM64 completada. " . count($errores) . " errores.");
                        
                    } catch (Exception $e) {
                        error_log("Excepción en CodeGenerator: " . $e->getMessage());
                        $errores[] = [
                            'tipo' => 'Sistema',
                            'linea' => 0,
                            'columna' => 0,
                            'descripcion' => "Error en generación ARM64: " . $e->getMessage()
                        ];
                        $consola = ["❌ Error durante la generación de código ARM64."];
                    }
                }
                
            } else {
                // ========== MODO EJECUCIÓN (Intérprete) ==========
                error_log("=== EJECUTANDO CON INTÉRPRETE ===");
                
                $visitor = new Interpreter();
                $resultado = $visitor->visit($tree);
                $consola = $resultado['consola'] ?? [];
                $tabla_simbolos = $resultado['tabla_simbolos'] ?? [];
                
                // Agregar errores semánticos
                if (!empty($resultado['errores'])) {
                    $errores = array_merge($errores, $resultado['errores']);
                }
                
                error_log("Ejecución completada. " . count($consola) . " líneas de consola, " . count($errores) . " errores totales.");
            }
        }
        
    } catch (Exception $e) {
        error_log("Excepción: " . $e->getMessage() . "\n" . $e->getTraceAsString());
        $errores[] = [
            'tipo' => 'Sistema',
            'linea' => 0,
            'columna' => 0,
            'descripcion' => "Error interno: " . $e->getMessage()
        ];
    }
}

// Función para obtener clase CSS según tipo de error
function getErrorClass($tipo) {
    switch ($tipo) {
        case 'Léxico': return 'error-lexico';
        case 'Sintáctico': return 'error-sintactico';
        case 'Semántico': return 'error-semantico';
        default: return '';
    }
}

// Función para obtener color según tipo de error
function getErrorColor($tipo) {
    switch ($tipo) {
        case 'Léxico': return '#ff9800'; // Naranja
        case 'Sintáctico': return '#f44336'; // Rojo
        case 'Semántico': return '#9c27b0'; // Púrpura
        default: return '#6c757d'; // Gris
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Golampi Compiler - ARM64 Studio</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', -apple-system, BlinkMacSystemFont, 'Roboto', sans-serif;
            background: linear-gradient(135deg, #0f0c29 0%, #1a1a2e 50%, #16213e 100%);
            min-height: 100vh;
            padding: 24px;
        }

        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #2d2d44;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #5a5a7a;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #6c6c8c;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 28px;
            padding: 24px;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.1);
        }

        .header {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        h1 {
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
            display: inline-flex;
            align-items: center;
            gap: 12px;
        }

        h1::before {
            content: "⚙️";
            background: none;
            -webkit-text-fill-color: initial;
            font-size: 32px;
        }

        .version-badge {
            background: rgba(168, 237, 234, 0.2);
            padding: 4px 12px;
            border-radius: 40px;
            font-size: 12px;
            font-weight: 500;
            color: #a8edea;
            border: 1px solid rgba(168, 237, 234, 0.3);
        }

        .toolbar {
            display: flex;
            gap: 12px;
            margin: 0 0 24px 0;
            flex-wrap: wrap;
            padding: 8px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 20px;
            backdrop-filter: blur(5px);
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 14px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: inherit;
            letter-spacing: 0.3px;
            backdrop-filter: blur(5px);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(56, 239, 125, 0.3);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(56, 239, 125, 0.4);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: #e0e0e0;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .btn-warning {
            background: rgba(255, 193, 7, 0.15);
            color: #ffd54f;
            border: 1px solid rgba(255, 193, 7, 0.3);
        }

        .btn-warning:hover {
            background: rgba(255, 193, 7, 0.25);
            transform: translateY(-2px);
        }

        .btn-info {
            background: rgba(23, 162, 184, 0.15);
            color: #4dd0e1;
            border: 1px solid rgba(23, 162, 184, 0.3);
        }

        .btn-info:hover {
            background: rgba(23, 162, 184, 0.25);
            transform: translateY(-2px);
        }

        .btn-danger {
            background: rgba(220, 53, 69, 0.15);
            color: #ff8a80;
            border: 1px solid rgba(220, 53, 69, 0.3);
        }

        .btn-danger:hover {
            background: rgba(220, 53, 69, 0.25);
            transform: translateY(-2px);
        }

        .editor-wrapper {
            position: relative;
            margin-bottom: 24px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        }

        .editor-header {
            background: #1e1e2e;
            padding: 12px 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .editor-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #ff5f56;
            margin-right: 4px;
        }

        .editor-dot:nth-child(2) {
            background: #ffbd2e;
        }

        .editor-dot:nth-child(3) {
            background: #27c93f;
        }

        .editor-label {
            color: #888;
            font-size: 12px;
            margin-left: 12px;
            font-family: monospace;
        }

        textarea {
            width: 100%;
            height: 350px;
            font-family: 'JetBrains Mono', 'Fira Code', 'Courier New', monospace;
            font-size: 14px;
            line-height: 1.6;
            padding: 20px;
            background: #1a1a2a;
            color: #e4e4e7;
            border: none;
            resize: vertical;
            outline: none;
        }

        textarea:focus {
            background: #1f1f30;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.08), rgba(255, 255, 255, 0.02));
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 18px 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.12), rgba(255, 255, 255, 0.04));
        }

        .stat-number {
            font-size: 32px;
            font-weight: 800;
            background: linear-gradient(135deg, #fff 0%, #aaa 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-label {
            color: #9ca3af;
            font-size: 13px;
            font-weight: 500;
            margin-top: 6px;
            letter-spacing: 0.5px;
        }

        .error-container {
            background: rgba(0, 0, 0, 0.4);
            border-radius: 20px;
            margin: 24px 0;
            overflow: hidden;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(244, 67, 54, 0.3);
        }

        .error-header {
            background: linear-gradient(135deg, rgba(244, 67, 54, 0.9), rgba(229, 57, 53, 0.9));
            padding: 16px 24px;
        }

        .error-header h3 {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            font-weight: 600;
        }

        .error-table {
            width: 100%;
            border-collapse: collapse;
        }

        .error-table th {
            background: rgba(0, 0, 0, 0.3);
            color: #e0e0e0;
            font-weight: 600;
            padding: 14px 16px;
            text-align: left;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .error-table td {
            padding: 12px 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            color: #d1d5db;
        }

        .error-table tr:hover td {
            background: rgba(255, 255, 255, 0.05);
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 40px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-lexico { background: #ff9800; color: #1a1a1a; }
        .badge-sintactico { background: #f44336; color: white; }
        .badge-semantico { background: #9c27b0; color: white; }
        .badge-sistema { background: #6c757d; color: white; }
        .badge-int32 { background: #2196F3; color: white; }
        .badge-float32 { background: #FF9800; color: #1a1a1a; }
        .badge-string { background: #4CAF50; color: white; }
        .badge-bool { background: #9C27B0; color: white; }
        .badge-rune { background: #00BCD4; color: #1a1a1a; }
        .badge-puntero { background: #795548; color: white; }
        .badge-array { background: #607D8B; color: white; }
        .badge-funcion { background: #9E9E9E; color: white; }

        .console-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 24px 0 12px 0;
        }

        .console-header h3 {
            color: #e0e0e0;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .consola {
            background: #0d0d1a;
            border-radius: 16px;
            padding: 16px;
            min-height: 160px;
            max-height: 280px;
            overflow-y: auto;
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            font-size: 13px;
            border: 1px solid rgba(0, 255, 0, 0.2);
            box-shadow: inset 0 0 20px rgba(0, 0, 0, 0.5);
        }

        .consola div {
            color: #4ade80;
            padding: 4px 0;
            border-bottom: 1px solid rgba(74, 222, 128, 0.1);
            font-family: monospace;
        }

        .arm64-container {
            margin-top: 20px;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(56, 239, 125, 0.3);
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(5px);
        }

        .arm64-header {
            background: linear-gradient(135deg, rgba(56, 239, 125, 0.8), rgba(17, 153, 142, 0.8));
            padding: 14px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .arm64-header h3 {
            margin: 0;
            color: white;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
        }

        .arm64-code {
            background: #1a1a2a;
            color: #d4d4d4;
            padding: 20px;
            overflow-x: auto;
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            font-size: 13px;
            line-height: 1.5;
            max-height: 450px;
            margin: 0;
        }

        .symbols-section {
            margin-top: 32px;
        }

        .symbols-section h3 {
            color: #e0e0e0;
            font-weight: 600;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .symbols-table-wrapper {
            overflow-x: auto;
            border-radius: 20px;
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(5px);
        }

        .symbols-table {
            width: 100%;
            border-collapse: collapse;
        }

        .symbols-table th {
            background: rgba(102, 126, 234, 0.3);
            color: #e0e0e0;
            padding: 14px 16px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
        }

        .symbols-table td {
            padding: 12px 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            color: #cbd5e1;
        }

        .symbols-table tr:hover td {
            background: rgba(255, 255, 255, 0.03);
        }

        .symbols-table strong {
            color: #a8edea;
            font-family: monospace;
        }

        .modo-activo {
            background: rgba(102, 126, 234, 0.15);
            border-left: 4px solid #667eea;
            padding: 12px 20px;
            border-radius: 16px;
            margin-bottom: 20px;
            backdrop-filter: blur(5px);
            color: #cbd5e1;
            font-weight: 500;
        }

        .placeholder-text {
            color: #4b5563;
            font-style: italic;
        }

        @media (max-width: 768px) {
            body {
                padding: 12px;
            }
            .container {
                padding: 16px;
            }
            .btn {
                padding: 8px 14px;
                font-size: 12px;
            }
            h1 {
                font-size: 1.5rem;
            }
            .stat-number {
                font-size: 24px;
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .container > * {
            animation: fadeIn 0.4s ease-out forwards;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Golampi ARM64 Compiler</h1>
            <span class="version-badge">v2.0 · Native Code Generation</span>
        </div>

        <!-- Indicador de modo activo -->
        <div class="modo-activo">
            <?php if ($modoEjecucion === 'generar' && $_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                ⚙️ <strong>Modo Generación ARM64</strong> — El código se está compilando a ensamblador
            <?php elseif ($modoEjecucion === 'generar'): ?>
                ⚙️ <strong>Modo Generación ARM64</strong> — Presiona el botón verde para compilar
            <?php else: ?>
                ▶️ <strong>Modo Ejecución</strong> — El código se ejecuta directamente (intérprete)
            <?php endif; ?>
        </div>

        <!-- Barra de acciones -->
        <div class="toolbar">
            <button type="button" class="btn btn-warning" onclick="nuevoArchivo()">🆕 Nuevo</button>
            <button type="button" class="btn btn-info" onclick="cargarArchivo()">📂 Cargar</button>
            <button type="button" class="btn btn-secondary" onclick="guardarCodigo()">💾 Guardar código</button>
            <button type="submit" form="codeForm" name="modo" value="ejecutar" class="btn btn-primary" onclick="setModo('ejecutar')">▶ Ejecutar</button>
            <button type="submit" form="codeForm" name="modo" value="generar" class="btn btn-success" onclick="setModo('generar')">🔧 Generar ARM64</button>
            <button type="button" class="btn btn-danger" onclick="limpiarConsola()">🧹 Limpiar consola</button>
        </div>

        <form id="codeForm" method="POST">
            <input type="hidden" name="modo" id="modoEjecucionInput" value="ejecutar">
            <div class="editor-wrapper">
                <div class="editor-header">
                    <div class="editor-dot"></div>
                    <div class="editor-dot"></div>
                    <div class="editor-dot"></div>
                    <span class="editor-label">main.golampi</span>
                </div>
                <textarea id="codigoEditor" name="codigo" placeholder="// Escribe tu código Golampi aquí...&#10;// Ejemplo:&#10;// fmt.println('¡Hola ARM64!')"><?php echo htmlspecialchars($codigo); ?></textarea>
            </div>
        </form>

        <input type="file" id="fileInput" accept=".txt,.go,.golampi" onchange="procesarArchivo(this)">

        <!-- Estadísticas -->
        <?php 
        $totalErrores = count($errores);
        $erroresLexicos = count(array_filter($errores, function($e) { return is_array($e) && ($e['tipo'] ?? '') == 'Léxico'; }));
        $erroresSintacticos = count(array_filter($errores, function($e) { return is_array($e) && ($e['tipo'] ?? '') == 'Sintáctico'; }));
        $erroresSemanticos = count(array_filter($errores, function($e) { return is_array($e) && ($e['tipo'] ?? '') == 'Semántico'; }));
        ?>

        <?php if ($totalErrores > 0): ?>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number"><?php echo $totalErrores; ?></div>
                    <div class="stat-label">Total Errores</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" style="background: linear-gradient(135deg, #ff9800, #ffb74d); -webkit-background-clip: text;"><?php echo $erroresLexicos; ?></div>
                    <div class="stat-label">Léxicos</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" style="background: linear-gradient(135deg, #f44336, #ef5350); -webkit-background-clip: text;"><?php echo $erroresSintacticos; ?></div>
                    <div class="stat-label">Sintácticos</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" style="background: linear-gradient(135deg, #9c27b0, #ab47bc); -webkit-background-clip: text;"><?php echo $erroresSemanticos; ?></div>
                    <div class="stat-label">Semánticos</div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Reporte de Errores -->
        <?php if (!empty($errores)): ?>
            <div class="error-container">
                <div class="error-header">
                    <h3>
                        <span>⚠️ Diagnóstico de Errores</span>
                        <span style="font-size: 12px; background: rgba(255,255,255,0.2); padding: 4px 12px; border-radius: 40px;">
                            Total: <?php echo count($errores); ?>
                        </span>
                    </h3>
                </div>

                <table class="error-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tipo</th>
                            <th>Línea</th>
                            <th>Columna</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($errores as $index => $error): ?>
                            <?php if (is_array($error)): ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td>
                                        <?php 
                                        $tipo = $error['tipo'] ?? 'Sistema';
                                        $tipoLower = strtolower($tipo);
                                        $tipoClass = str_replace(['é', 'á', 'í', 'ó', 'ú'], ['e', 'a', 'i', 'o', 'u'], $tipoLower);
                                        ?>
                                        <span class="badge badge-<?php echo $tipoClass; ?>">
                                            <?php echo htmlspecialchars($tipo); ?>
                                        </span>
                                    </td>
                                    <td><?php echo $error['linea'] ?? 0; ?></td>
                                    <td><?php echo $error['columna'] ?? 0; ?></td>
                                    <td><?php echo htmlspecialchars($error['descripcion'] ?? ''); ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <!-- Consola -->
        <div class="console-header">
            <h3><span>📟</span> Terminal de Salida</h3>
            <?php if ($modoEjecucion === 'generar' && !empty($codigoArm64)): ?>
                <button onclick="descargarARM64()" class="btn btn-success" style="padding: 5px 12px; font-size: 12px;">💾 Descargar programa.s</button>
            <?php endif; ?>
        </div>
        <div id="consolaOutput" class="consola">
            <?php if (!empty($consola)): ?>
                <?php foreach ($consola as $linea): ?>
                    <div>› <?php echo htmlspecialchars($linea); ?></div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="color: #4b5563;">└─ No hay salida para mostrar ──</div>
            <?php endif; ?>
        </div>

        <!-- Código ARM64 Generado -->
        <?php if ($modoEjecucion === 'generar' && !empty($codigoArm64)): ?>
            <div class="arm64-container">
                <div class="arm64-header">
                    <h3>🔧 Código Ensamblador ARM64 Generado</h3>
                    <span style="font-size: 12px; background: rgba(255,255,255,0.2); padding: 4px 12px; border-radius: 40px;">
                        <?php echo number_format(strlen($codigoArm64)); ?> bytes
                    </span>
                </div>
                <pre class="arm64-code"><code><?php echo htmlspecialchars($codigoArm64); ?></code></pre>
            </div>
        <?php endif; ?>

        <!-- Tabla de Símbolos -->
        <?php if (!empty($tabla_simbolos)): ?>
            <div class="symbols-section">
                <h3><span>🗂️</span> Tabla de Símbolos</h3>
                <div class="symbols-table-wrapper">
                    <table class="symbols-table">
                        <thead>
                            <tr>
                                <th>Identificador</th>
                                <th>Tipo</th>
                                <th>Ámbito</th>
                                <th>Valor</th>
                                <th>Línea</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tabla_simbolos as $id => $info): ?>
                                <?php if (isset($info['tipo']) && $info['tipo'] !== 'funcion'): ?>
                                    <tr>
                                        <td><strong><?php echo htmlspecialchars($id); ?></strong></td>
                                        <td>
                                            <?php 
                                            $tipoMostrar = $info['tipo'];
                                            $claseBadge = $tipoMostrar;
                                            if (isset($info['es_puntero']) && $info['es_puntero']) {
                                                $tipoMostrar = $info['tipo_base'] . '*';
                                                $claseBadge = 'puntero';
                                            }
                                            if ($tipoMostrar === 'rune') {
                                                $claseBadge = 'rune';
                                            }
                                            ?>
                                            <span class="badge badge-<?php echo htmlspecialchars($claseBadge); ?>">
                                                <?php echo htmlspecialchars($tipoMostrar); ?>
                                            </span>
                                        </td>
                                        <td><?php echo htmlspecialchars($info['ambito'] ?? 'global'); ?></td>
                                        <td><?php echo htmlspecialchars(formatearValorParaTabla($info['valor'] ?? null)); ?></td>
                                        <td><?php echo htmlspecialchars($info['linea'] ?? '-'); ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script>
        function setModo(modo) {
            document.getElementById('modoEjecucionInput').value = modo;
        }

        function nuevoArchivo() {
            if (confirm('¿Limpiar el editor? Se perderán los cambios no guardados.')) {
                document.getElementById('codigoEditor').value = '';
                document.getElementById('consolaOutput').innerHTML = '<div style="color: #4b5563;">└─ No hay salida para mostrar ──</div>';
                const arm64Container = document.querySelector('.arm64-container');
                if (arm64Container) {
                    arm64Container.style.display = 'none';
                }
            }
        }

        function cargarArchivo() {
            document.getElementById('fileInput').click();
        }

        function procesarArchivo(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('codigoEditor').value = e.target.result;
                };
                reader.readAsText(file);
            }
            input.value = '';
        }

        function guardarCodigo() {
            const codigo = document.getElementById('codigoEditor').value;
            if (!codigo.trim()) {
                alert('⚠️ No hay código para guardar');
                return;
            }
            const blob = new Blob([codigo], { type: 'text/plain' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'codigo.golampi';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        }

        function limpiarConsola() {
            document.getElementById('consolaOutput').innerHTML = '<div style="color: #4b5563;">└─ No hay salida para mostrar ──</div>';
        }

        function descargarARM64() {
            const codigo = <?php echo json_encode($codigoArm64); ?>;
            if (!codigo) {
                alert('No hay código ARM64 para descargar');
                return;
            }
            const blob = new Blob([codigo], { type: 'text/plain' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'programa.s';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        }

        document.querySelectorAll('button[form="codeForm"]').forEach(btn => {
            btn.addEventListener('click', function(e) {
                const modo = this.value;
                if (modo === 'generar') {
                    console.log('🔧 Generando código ARM64...');
                } else if (modo === 'ejecutar') {
                    console.log('▶️ Ejecutando con intérprete...');
                }
            });
        });
    </script>
</body>
</html>