<?php
error_reporting(E_ALL); // Error/Exception engine, always use E_ALL

ini_set('ignore_repeated_errors', TRUE); // always use TRUE
ini_set('display_errors', TRUE); // Use TRUE in development environment
ini_set('log_errors', TRUE); // Error/Exception file logging engine.
ini_set("error_log", "php-error.log");
error_log("Hello, errors!");

require_once 'libs/App.php';
require_once 'libs/Controller.php';
require_once 'libs/Model.php';
require_once 'libs/View.php';
require_once 'libs/Database.php';
require_once 'config/config.php';

$app = new App();
?>
