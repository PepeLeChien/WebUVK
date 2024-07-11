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
            $controller = new PrincipalController();
            $controller->loadModel('principal');
            $controller->index();
            return false;
        }

        $archivoController = 'controllers/' . $url[0] . 'Controller.php';

        if (file_exists($archivoController)) {
            require_once $archivoController;

            // Inicializar controlador
            $controllerName = $url[0] . 'Controller';
            $controller = new $controllerName;
            $controller->loadModel($url[0]);

            // Si hay un método que se requiere cargar
            if (isset($url[1])) {
                if (method_exists($controller, $url[1])) {
                    if (isset($url[2])) {
                        // El método tiene parámetros
                        // Sacar el # de parámetros
                        $nparam = sizeof($url) - 2;
                        // Crear un arreglo con los parámetros
                        $params = [];
                        // Iterar
                        for ($i = 0; $i < $nparam; $i++) {
                            array_push($params, $url[$i + 2]);
                        }
                        // Pasarlos al método   
                        $controller->{$url[1]}($params);
                    } else {
                        $controller->{$url[1]}();
                    }
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
