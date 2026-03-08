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
        // Verificar si es un múltiple retorno
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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];
    
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
            
            // Ejecutar con nuestro visitor
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
    <title>Golampi Interpreter - Reporte de Errores</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            max-width: 1200px; 
            margin: 0 auto; 
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 { 
            color: #333;
            border-bottom: 3px solid #4CAF50;
            padding-bottom: 10px;
            margin-top: 0;
        }
        .toolbar {
            display: flex;
            gap: 10px;
            margin: 15px 0;
            flex-wrap: wrap;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .btn-primary {
            background: #4CAF50;
            color: white;
        }
        .btn-primary:hover {
            background: #45a049;
        }
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        .btn-secondary:hover {
            background: #5a6268;
        }
        .btn-warning {
            background: #ffc107;
            color: #212529;
        }
        .btn-warning:hover {
            background: #e0a800;
        }
        .btn-info {
            background: #17a2b8;
            color: white;
        }
        .btn-info:hover {
            background: #138496;
        }
        .btn-danger {
            background: #dc3545;
            color: white;
        }
        .btn-danger:hover {
            background: #c82333;
        }
        textarea { 
            width: 100%; 
            height: 300px; 
            font-family: 'Courier New', monospace;
            font-size: 14px;
            padding: 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            resize: vertical;
            background: #fafafa;
            box-sizing: border-box;
        }
        textarea:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(76,175,80,0.3);
        }
        .consola { 
            background: #1e1e1e; 
            color: #00ff00; 
            padding: 15px; 
            border-radius: 5px; 
            min-height: 150px;
            max-height: 300px;
            overflow-y: auto;
            font-family: 'Courier New', monospace;
            border: 1px solid #333;
            margin-top: 15px;
        }
        .consola-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }
        .error-container { 
            background: #fff3f3; 
            border-radius: 8px;
            border-left: 5px solid #f44336;
            margin: 20px 0;
            overflow: hidden;
        }
        .error-header {
            background: #f44336;
            color: white;
            padding: 15px;
            margin: 0;
        }
        .error-header h3 {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .error-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }
        .error-table th {
            background: #f8f9fa;
            color: #333;
            font-weight: bold;
            padding: 12px;
            text-align: left;
            border-bottom: 2px solid #dee2e6;
        }
        .error-table td {
            padding: 10px 12px;
            border-bottom: 1px solid #dee2e6;
        }
        .error-table tr:hover {
            background: #f5f5f5;
        }
        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            color: white;
        }
        .badge-lexico { background: #ff9800; }
        .badge-sintactico { background: #f44336; }
        .badge-semantico { background: #9c27b0; }
        .badge-sistema { background: #6c757d; }
        
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px;
            background: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 12px; 
            text-align: left; 
        }
        th { 
            background: #4CAF50; 
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        tr:hover {
            background: #f5f5f5;
        }
        .ejemplo {
            background: #e3f2fd;
            padding: 15px;
            border-radius: 5px;
            border-left: 5px solid #2196F3;
            margin-top: 20px;
        }
        .ejemplo pre {
            background: #1e1e1e;
            color: #d4d4d4;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto;
            font-family: 'Courier New', monospace;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 12px;
            font-weight: bold;
        }
        .badge-int32 { background: #2196F3; color: white; }
        .badge-float32 { background: #FF9800; color: white; }
        .badge-string { background: #4CAF50; color: white; }
        .badge-bool { background: #9C27B0; color: white; }
        .hidden {
            display: none;
        }
        #fileInput {
            display: none;
        }
        .stats {
            display: flex;
            gap: 20px;
            margin: 15px 0;
        }
        .stat-card {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            flex: 1;
            text-align: center;
            border: 1px solid #dee2e6;
        }
        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: #4CAF50;
        }
        .stat-label {
            color: #6c757d;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🧪 Golampi Interpreter - Reporte de Errores</h1>
        
        <!-- Barra de acciones -->
        <div class="toolbar">
            <button type="button" class="btn btn-warning" onclick="nuevoArchivo()" title="Limpiar editor y consola">
                🆕 Nuevo / Limpiar
            </button>
            
            <button type="button" class="btn btn-info" onclick="cargarArchivo()" title="Cargar código desde archivo">
                📂 Cargar archivo
            </button>
            
            <button type="button" class="btn btn-secondary" onclick="guardarCodigo()" title="Guardar código como archivo">
                💾 Guardar código
            </button>
            
            <button type="submit" form="codeForm" class="btn btn-primary" title="Ejecutar / Analizar código">
                ▶ Ejecutar / Analizar
            </button>
            
            <button type="button" class="btn btn-danger" onclick="limpiarConsola()" title="Limpiar consola de salida">
                🧹 Limpiar consola
            </button>
        </div>
        
        <form id="codeForm" method="POST">
            <textarea id="codigoEditor" name="codigo" placeholder="Escribe tu código Golampi aquí..."><?php echo htmlspecialchars($codigo); ?></textarea>
        </form>
        
        <!-- Input oculto para cargar archivos -->
        <input type="file" id="fileInput" accept=".txt,.go,.golampi" onchange="procesarArchivo(this)">
        
        <!-- Estadísticas -->
        <?php 
        $totalErrores = count($errores);
        $erroresLexicos = count(array_filter($errores, function($e) { return is_array($e) && ($e['tipo'] ?? '') == 'Léxico'; }));
        $erroresSintacticos = count(array_filter($errores, function($e) { return is_array($e) && ($e['tipo'] ?? '') == 'Sintáctico'; }));
        $erroresSemanticos = count(array_filter($errores, function($e) { return is_array($e) && ($e['tipo'] ?? '') == 'Semántico'; }));
        ?>
        
        <?php if ($totalErrores > 0): ?>
            <div class="stats">
                <div class="stat-card">
                    <div class="stat-number"><?php echo $totalErrores; ?></div>
                    <div class="stat-label">Total Errores</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" style="color: #ff9800;"><?php echo $erroresLexicos; ?></div>
                    <div class="stat-label">Léxicos</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" style="color: #f44336;"><?php echo $erroresSintacticos; ?></div>
                    <div class="stat-label">Sintácticos</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" style="color: #9c27b0;"><?php echo $erroresSemanticos; ?></div>
                    <div class="stat-label">Semánticos</div>
                </div>
            </div>
        <?php endif; ?>
        
        <!-- Reporte de Errores -->
        <?php if (!empty($errores)): ?>
            <div class="error-container">
                <div class="error-header">
                    <h3>
                        <span>❌ Reporte de Errores</span>
                        <span style="font-size: 14px; background: rgba(255,255,255,0.2); padding: 3px 10px; border-radius: 20px;">
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
                                        // Eliminar acentos para las clases CSS
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
        <div class="consola-header">
            <h3>📟 Consola:</h3>
        </div>
        <div id="consolaOutput" class="consola">
            <?php if (!empty($consola)): ?>
                <?php foreach ($consola as $linea): ?>
                    <div><?php echo htmlspecialchars($linea); ?></div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="color: #666;">--- No hay salida para mostrar ---</div>
            <?php endif; ?>
        </div>
        
        <!-- Tabla de Símbolos -->
        <?php if (!empty($tabla_simbolos)): ?>
            <h3>📊 Tabla de Símbolos:</h3>
            <table>
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
                                <span class="badge badge-<?php echo htmlspecialchars($info['tipo']); ?>">
                                    <?php echo htmlspecialchars($info['tipo']); ?>
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
        <?php endif; ?>
        
        <!-- Ejemplos para probar errores -->
        <div class="ejemplo">
            <h3>📝 Ejemplos para probar errores:</h3>
            
            <p><strong>🔴 Error Léxico (caracter no válido):</strong></p>
            <pre>
func main() {
    var x int32 = 10 @ 20  // Error: @ no es válido
    fmt.Println(x)
}
            </pre>
            
            <p><strong>🔴 Error Sintáctico (falta paréntesis):</strong></p>
            <pre>
func main() {
    if x > 5 {  // Error: falta paréntesis de cierre
        fmt.Println("Hola"
}
            </pre>
            
            <p><strong>🔴 Error Semántico (variable no declarada):</strong></p>
            <pre>
func main() {
    y = x + 10  // Error: x no declarada
    fmt.Println(y)
}
            </pre>
            
            <p><strong>✅ Código correcto:</strong></p>
            <pre>
func main() {
    x := 10
    if x > 5 {
        fmt.Println("x es mayor que 5")
    }
}
            </pre>
        </div>
    </div>

    <script>
        function nuevoArchivo() {
            document.getElementById('codigoEditor').value = '';
            document.getElementById('consolaOutput').innerHTML = '<div style="color: #666;">--- No hay salida para mostrar ---</div>';
            window.location.href = window.location.pathname;
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
                alert('No hay código para guardar');
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
            document.getElementById('consolaOutput').innerHTML = '<div style="color: #666;">--- No hay salida para mostrar ---</div>';
        }
    </script>
</body>
</html>