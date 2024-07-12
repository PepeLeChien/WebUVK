<?php

namespace MVC;

class Router {
    protected $d;
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn) {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn) {
        $this->postRoutes[$url] = $fn;
    }

    public function comprobarRutas() {
        $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        error_log("Current URL: " . $currentUrl);
        error_log("Request Method: " . $method);

        if ($method === 'GET') {
            $fn = $this->getRoutes[$currentUrl] ?? null;
        } else {
            $fn = $this->postRoutes[$currentUrl] ?? null;
        }

        if ($fn) {
            error_log("Function found for URL: " . $currentUrl);
            if (is_array($fn)) {
                call_user_func($fn, $this);
            } else {
                $fn($this);
            }
        } else {
            error_log("Invalid route: " . $currentUrl);
            echo "Página No Encontrada o Ruta no válida";
        }
    }

    public function render($view, $data = []) {
        $this->d = $data;
        foreach ($data as $key => $value) {
            $$key = $value;   
        }

        ob_start();
        include_once __DIR__ . "/../views/$view.php";
        $contenido = ob_get_clean();
        include_once __DIR__ . '/../views/template/layout.php';
    }
}
?>
