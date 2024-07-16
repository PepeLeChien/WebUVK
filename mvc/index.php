<?php

// Habilitar el informe de errores
error_reporting(E_ALL);
ini_set('ignore_repeated_errors', TRUE);
ini_set('display_errors', TRUE);
ini_set('log_errors', TRUE);
ini_set("error_log", __DIR__ . '/php-error.log');

// Usar los namespaces correspondientes
use MVC\Router;
use Controllers\PagesController;
use Controllers\LoginController;
use Controllers\AdminController;
use Controllers\MoviesController;
use Controllers\FunctionsController;
use Controllers\CompraController;

// Registrar el autoload
// Registrar el autoload
spl_autoload_register(function ($class) {
    $prefix = 'MVC\\';
    $base_dir = __DIR__ . '/libs/';

    // Verifica si la clase utiliza el namespace prefix
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, pasa al siguiente autoload registrado
        return;
    }

    // Obtiene el nombre relativo de la clase
    $relative_class = substr($class, $len);

    // Reemplaza el prefijo del namespace con el directorio base,
    // reemplaza los separadores de namespace con separadores de directorio en
    // el nombre relativo de la clase, añade .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // Si el archivo existe, lo requiere
    if (file_exists($file)) {
        require $file;
    } else {
        error_log("No se encontró la clase: $class en $file");
        echo "No se encontró la clase: $class en $file";
    }
});

// Autoload para otros namespaces
// Autoload para otros namespaces
spl_autoload_register(function ($class) {
    $base_dir = __DIR__ . '/';
    $file = $base_dir . str_replace('\\', '/', $class) . '.php';

    if (file_exists($file)) {
        require $file;
    } else {
        error_log("No se encontró la clase: $class en $file");
        echo "No se encontró la clase: $class en $file";
    }
});

require_once __DIR__ . '/config/config.php';

$router = new Router();

$router->get('/', [PagesController::class, 'index']);
$router->get('/cartelera', [PagesController::class, 'cartelera']);
$router->get('/cines', [PagesController::class, 'cines']);
$router->post('/load-more-movies', [PagesController::class, 'loadMoreMovies']);
$router->post('/get-movie-html', [PagesController::class, 'getMovieHTML']);
$router->get('/pelicula-detalle/:id', [PagesController::class, 'peliculaDetalle']);

$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

$router->get('/admin', [AdminController::class, 'index']);
$router->get('/admin/peliculas', [MoviesController::class, 'index']);
$router->get('/admin/peliculas/getMovies', [MoviesController::class, 'getMovies']);
$router->get('/admin/peliculas/create', [MoviesController::class, 'create']);
$router->post('/admin/peliculas/create', [MoviesController::class, 'create']);
$router->get('/admin/peliculas/edit/:id', [MoviesController::class, 'edit']);
$router->post('/admin/peliculas/edit/:id', [MoviesController::class, 'edit']);
$router->post('/admin/peliculas/delete/:id', [MoviesController::class, 'delete']);

$router->get('/admin/funciones', [FunctionsController::class, 'index']);
$router->get('/admin/funciones/getFunctions', [FunctionsController::class, 'getFunctions']);
$router->get('/admin/funciones/create', [FunctionsController::class, 'create']);
$router->post('/admin/funciones/create', [FunctionsController::class, 'create']);
$router->get('/admin/funciones/edit/:id', [FunctionsController::class, 'edit']);
$router->post('/admin/funciones/edit/:id', [FunctionsController::class, 'edit']);
$router->post('/admin/funciones/delete/:id', [FunctionsController::class, 'delete']);

$router->get('/api/funcionesPorPelicula', [PagesController::class, 'getFuncionesPorPelicula']);
$router->get('/api/funcion', [PagesController::class, 'getFuncionById']);


$router->get('/compra', [CompraController::class, 'index']);
$router->get('/compra/tickets', [CompraController::class, 'tickets']);
$router->get('/compra/pago', [CompraController::class, 'pago']);
$router->post('/compra/agregar', [CompraController::class, 'agregar']);

// Rutas de la API para obtener butacas ocupadas
$router->get('/api/obtenerButacasOcupadas', [CompraController::class, 'obtenerButacasOcupadas']);

$router->comprobarRutas();
 
