<?php

namespace Controllers;

use MVC\Router;
use Models\UserModel;

class LoginController {

    public static function login(Router $router) {
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new UserModel($_POST);
            $errores = $auth->validar();

            if (empty($errores)) {
                $resultado = $auth->existeUsuario();

                if (!$resultado) {
                    $errores = UserModel::getErrores();
                } else {
                    $auth->comprobarPassword($resultado);

                    if ($auth->autenticado) {
                        $auth->autenticar();
                        error_log('Usuario autenticado con rol: ' . $auth->role); // Depuración
                        
                        if ($auth->role === 'Administrador') {
                            header('Location: /admin');
                        } else {
                            header('Location: /');
                        }
                        exit;
                    } else {
                        $errores = UserModel::getErrores();
                    }
                }
            }
        }

        $router->render('login/login', [
            'errores' => $errores,
            'title' => 'Iniciar Sesión'
        ]);
    }

    public static function logout() {
        session_start();
        $_SESSION = [];
        session_destroy();
        header('Location: /');
        exit;
    }
}
?>
