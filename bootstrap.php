<?php
// bootstrap.php - Cargador inicial

// 1. Composer autoload
require_once __DIR__ . '/vendor/autoload.php';

// 2. Archivos ANTLR generados
$archivos = [
    'src/gramatica/gramatica/GolampiLexer.php',
    'src/gramatica/gramatica/GolampiParser.php',
    'src/gramatica/gramatica/GolampiVisitor.php',
    'src/gramatica/gramatica/GolampiBaseVisitor.php',
];

foreach ($archivos as $archivo) {
    $ruta = __DIR__ . '/' . $archivo;
    if (file_exists($ruta)) {
        require_once $ruta;
    } else {
        die("Error: No se encontró $archivo. Ejecuta ANTLR primero.\n");
    }
}

// 3. Visitors personalizados
require_once __DIR__ . '/src/visitors/Interpreter.php';