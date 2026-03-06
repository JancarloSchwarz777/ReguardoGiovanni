<?php
require_once __DIR__ . '/../bootstrap.php';

use Antlr\Antlr4\Runtime\CommonTokenStream;
use Antlr\Antlr4\Runtime\InputStream;
use Antlr\Antlr4\Runtime\Token;

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
        return '[' . implode(', ', array_map('formatearValorParaTabla', $valor)) . ']';
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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];
    
    error_log("Código recibido:\n" . $codigo);
    
    try {
        // Análisis con ANTLR
        $input = InputStream::fromString($codigo);
        $lexer = new GolampiLexer($input);
        $tokens = new CommonTokenStream($lexer);        
        $parser = new GolampiParser($tokens);
        
        // Intentar parsear
        $tree = $parser->programa();
        
        $erroresSintacticos = $parser->getNumberOfSyntaxErrors();
        error_log("Errores sintácticos: " . $erroresSintacticos);
        
        if ($erroresSintacticos > 0) {
            $errores[] = "Error sintáctico en el código. Revisa la estructura.";
            
            // Mostrar los últimos errores del parser si es posible
            if (method_exists($parser, 'getErrorListeners')) {
                // No podemos obtener detalles fácilmente
            }
        } else {
            error_log("Árbol generado correctamente");
            error_log("Tipo de árbol: " . get_class($tree));
            
            // Ejecutar con nuestro visitor
            $visitor = new Interpreter();
            $resultado = $visitor->visit($tree);
            $consola = $resultado['consola'] ?? [];
            $errores = $resultado['errores'] ?? [];
            
            error_log("Ejecución completada. " . count($consola) . " líneas de consola, " . count($errores) . " errores.");
        }
        
    } catch (Exception $e) {
        error_log("Excepción: " . $e->getMessage() . "\n" . $e->getTraceAsString());
        $errores[] = "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Golampi Interpreter - Fase 1 (MVP)</title>
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
        .error { 
            background: #ffebee; 
            color: #c62828; 
            padding: 15px; 
            border-radius: 5px;
            border-left: 5px solid #f44336;
            margin: 15px 0;
        }
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
    </style>
</head>
<body>
    <div class="container">
        <h1>🧪 Golampi Interpreter - Fase 1 (MVP)</h1>
        
        <!-- Barra de acciones con todos los botones solicitados -->
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
            
            <!-- Botón Ejecutar -->
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
        
        <?php if (!empty($errores)): ?>
            <div class="error">
                <h3>❌ Errores encontrados:</h3>
                <?php foreach ($errores as $error): ?>
                    <div>
                        <?php 
                        if (is_array($error)) {
                            echo "[{$error['tipo']}] Línea {$error['linea']}: {$error['descripcion']}";
                        } else {
                            echo htmlspecialchars($error);
                        }
                        ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
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
        
        <?php if (isset($resultado['tabla_simbolos']) && !empty($resultado['tabla_simbolos'])): ?>
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
                    <?php foreach ($resultado['tabla_simbolos'] as $id => $info): ?>
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
        
        <div class="ejemplo">
            <h3>📝 Ejemplo de código válido:</h3>
            <pre>
func main() {
    // Declaración explícita
    var x int32 = 10
    var y int32
    
    // Declaración corta
    nombre := "Golampi"
    esDivertido := true
    
    // Asignaciones
    x = x + 5
    y = 20
    
    // Impresión
    fmt.Println("Hola", nombre)
    fmt.Println("x =", x)
    fmt.Println("y =", y)
    fmt.Println("esDivertido =", esDivertido)
}
            </pre>
            <p><strong>Para probar el for, usa:</strong></p>
            <pre>
func main() {
    for i := 0; i < 5; i++ {
        fmt.Println(i)
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