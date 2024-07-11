<?php

class App {

    function __construct() {
        $url = isset($_GET['url']) ? $_GET['url'] : '';
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        // Cuando se ingresa sin definir controlador
        if (empty($url[0])) {
            $archivoController = 'controllers/PagesController.php';
            require_once $archivoController;
            $controller = new PagesController();
            $controller->loadModel('movie');
            $controller->index();
            return false;
        }

        $archivoController = 'controllers/' . $url[0] . 'Controller.php';

        if (file_exists($archivoController)) {
            require_once $archivoController;

            $controllerName = $url[0] . 'Controller';
            $controller = new $controllerName;
            $controller->loadModel($url[0]);

            if (isset($url[1])) {
                if (method_exists($controller, $url[1])) {
                    if (isset($url[2])) {
                        $nparam = sizeof($url) - 2;
                        $params = [];
                        for ($i = 0; $i < $nparam; $i++) {
                            array_push($params, $url[$i + 2]);
                        }
                        $controller->{$url[1]}($params);
                    } else {
                        $controller->{$url[1]}();
                    }
                } else {
                    /*$controller = new Errores();
                    $controller->render();*/
                }
            } else {
                $controller->index();
            }
        } else {
             /*$controller = new Errores();
            $controller->render();*/
        }
    }
}
?>
