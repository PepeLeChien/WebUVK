<?php

class App {

    function __construct() {
        $url = isset($_GET['url']) ? $_GET['url'] : '';
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        // Cuando se ingresa sin definir controlador
        if (empty($url[0])) {
            $archivoController = 'controllers/PrincipalController.php';
            require_once $archivoController;
            $controller = new PagesController();
            $controller->loadModel('principal');
            $controller->index();
            return false;
        }

        $archivoController = 'controllers/' . ucfirst($url[0]) . 'Controller.php';

        if (file_exists($archivoController)) {
            require_once $archivoController;

            // Inicializar controlador
            $controllerName = ucfirst($url[0]) . 'Controller';
            $controller = new $controllerName;
            $controller->loadModel($url[0]);

            // Si hay un método que se requiere cargar
            if (isset($url[1])) {
                if (method_exists($controller, $url[1])) {
                    $params = array_slice($url, 2);
                    call_user_func_array([$controller, $url[1]], $params);
                } else { 
                    $controller->render();
                }
            } else {
                $controller->index();
            }
        } else { 
            $controller->render();
        }
    }
}
?>
