<?php
// Habilitar el informe de errores
error_reporting(E_ALL);
ini_set('ignore_repeated_errors', TRUE);
ini_set('display_errors', TRUE);
ini_set('log_errors', TRUE);
ini_set("error_log", "php-error.log");
 

use MVC\Router;

require_once 'libs/Database.php';
require_once 'libs/Controller.php';
require_once 'libs/IModel.php';
require_once 'libs/Model.php';
require_once 'libs/View.php';
require_once 'libs/Router.php';
require_once 'config/config.php';
require_once 'controllers/PagesController.php';
require_once 'controllers/LoginController.php';
require_once 'controllers/AdminController.php';
require_once 'controllers/MoviesController.php'; // Incluye el controlador de películas

$router = new Router();
$pagesController = new PagesController();
$loginController = new LoginController();
$adminController = new AdminController();
$moviesController = new MoviesController(); // Instancia el controlador de películas

$router->get('/', [$pagesController, 'index']);
$router->get('/cartelera', [$pagesController, 'cartelera']);
$router->post('/load-more-movies', [$pagesController, 'loadMoreMovies']);
$router->post('/get-movie-html', [$pagesController, 'getMovieHTML']);
$router->get('/pelicula-detalle/:id', [$pagesController, 'peliculaDetalle']);

$router->get('/login', [$loginController, 'login']);
$router->post('/login', [$loginController, 'login']);
$router->get('/logout', [$loginController, 'logout']);

$router->get('/admin', [$adminController, 'index']);
$router->get('/admin/peliculas', [$moviesController, 'index']);
$router->get('/admin/peliculas/getMovies', [$moviesController, 'getMovies']);
$router->get('/admin/peliculas/create', [$moviesController, 'create']);
$router->post('/admin/peliculas/create', [$moviesController, 'create']);
$router->get('/admin/peliculas/edit/:id', [$moviesController, 'edit']);
$router->post('/admin/peliculas/edit/:id', [$moviesController, 'edit']);
$router->post('/admin/peliculas/delete/:id', [$moviesController, 'delete']);

$router->comprobarRutas();
 

?>