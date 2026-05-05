<?php
// bootstrap.php - Cargador inicial

require_once __DIR__ . '/vendor/autoload.php';

// Archivos ANTLR generados
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

// Ahora cargamos automáticamente todos los traits
$traits = glob(__DIR__ . '/src/visitors/traits/*.php');
foreach ($traits as $trait) {
    require_once $trait;
}

// Cargar traits de generación ARM64 (NUEVOS)
$traitsGenerador = glob(__DIR__ . '/src/visitors/gen/*.php');
foreach ($traitsGenerador as $trait) {
    require_once $trait;
}

// Visitor principal
require_once __DIR__ . '/src/visitors/Interpreter.php';
require_once __DIR__ . '/src/visitors/CodeGenerator.php'; 


// ErrorListener (AGREGAR ESTA LÍNEA)
require_once __DIR__ . '/src/ErrorListener.php';