<?php
// Habilitar el informe de errores
error_reporting(E_ALL);
ini_set('ignore_repeated_errors', TRUE);
ini_set('display_errors', TRUE);
ini_set('log_errors', TRUE);
ini_set("error_log", "php-error.log");

require_once 'libs/Database.php';
require_once 'libs/Controller.php';
require_once 'libs/IModel.php';
require_once 'libs/Model.php';
require_once 'libs/View.php';
require_once 'libs/Router.php';
require_once 'config/config.php';
require_once 'controllers/PagesController.php';

use MVC\Router;

$router = new Router();
$pagesController = new PagesController();

$router->get('/', [$pagesController, 'index']);
$router->get('/cartelera', [$pagesController, 'cartelera']);

$router->comprobarRutas();
?>
