<?php

namespace Controllers;

use MVC\Router;

class AdminController {

    public static function index(Router $router) {
        session_start();
        error_log('Rol en AdminController: ' . ($_SESSION['rol'] ?? 'No definido')); // Depuración
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Administrador') {
            header('Location: /');
            exit;
        }

        $router->render('admin/index', [
            'title' => 'Dashboard de Administrador'
        ], 'layoutAdmin');
    }
}
?>
