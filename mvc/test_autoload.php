<?php

use MVC\Router;

spl_autoload_register(function ($class) {
    $base_dir = __DIR__ . '/';
    $file = $base_dir . str_replace(['\\', 'MVC/'], ['/', 'libs/'], $class) . '.php';
    
    if (file_exists($file)) {
        require $file;
    } else {
        error_log("No se encontró la clase: $class en $file");
        echo "No se encontró la clase: $class en $file";
    }
});

// Prueba cargar la clase Router
$router = new Router();
echo "Router cargado correctamente.";
