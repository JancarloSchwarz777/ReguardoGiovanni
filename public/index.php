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
        return '[' . implode(', ', array_map('formatearValorParaTabla', $valor)) . ']';
    }
    return (string)$valor;
}

$resultado = null;
$codigo = '';
$consola = [];
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];
    
    try {
        // Análisis con ANTLR
        $input = InputStream::fromString($codigo);
        $lexer = new GolampiLexer($input);
        $tokens = new CommonTokenStream($lexer);
        $parser = new GolampiParser($tokens);
        
        $tree = $parser->programa();
        
        if ($parser->getNumberOfSyntaxErrors() > 0) {
            $errores[] = "Error sintáctico en el código";
        } else {
            // Ejecutar con nuestro visitor
            $visitor = new Interpreter();
            $resultado = $visitor->visit($tree);
            $consola = $resultado['consola'] ?? [];
            $errores = $resultado['errores'] ?? [];
        }
        
    } catch (Exception $e) {
        $errores[] = $e->getMessage();
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
        }
        textarea:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(76,175,80,0.3);
        }
        button { 
            background: #4CAF50;
            color: white;
            padding: 12px 30px;
            margin: 15px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background 0.3s;
        }
        button:hover {
            background: #45a049;
        }
        .consola { 
            background: #1e1e1e; 
            color: #00ff00; 
            padding: 15px; 
            border-radius: 5px; 
            min-height: 150px;
            font-family: 'Courier New', monospace;
            border: 1px solid #333;
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
    </style>
</head>
<body>
    <div class="container">
        <h1>🧪 Golampi Interpreter - Fase 1 (MVP)</h1>
        
        <form method="POST">
            <textarea name="codigo" placeholder="Escribe tu código Golampi aquí..."><?php echo htmlspecialchars($codigo); ?></textarea>
            <br>
            <button type="submit">▶ Ejecutar</button>
        </form>
        
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
        
        <?php if (!empty($consola)): ?>
            <h3>📟 Consola:</h3>
            <div class="consola">
                <?php foreach ($consola as $linea): ?>
                    <div><?php echo htmlspecialchars($linea); ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
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
        </div>
    </div>
</body>
</html>