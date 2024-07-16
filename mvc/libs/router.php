<?php

namespace MVC;

class Router {
    protected $d;
    public array $getRoutes = [];
    public array $postRoutes = [];
    public $params = [];

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
            $fn = $this->matchRoute($this->getRoutes, $currentUrl);
        } else {
            $fn = $this->matchRoute($this->postRoutes, $currentUrl);
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

    private function matchRoute($routes, $currentUrl) {
        foreach ($routes as $url => $fn) { 
            $urlPattern = preg_replace('/:\w+/', '(\w+)', $url);
            if (preg_match("#^$urlPattern$#", $currentUrl, $matches)) {
                array_shift($matches);
                $this->params = $matches;
                return $fn;
            }
        }
        return null;
    }

    public function render($view, $data = [], $template = 'layout') {
        $this->d = $data;
        foreach ($data as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once __DIR__ . "/../views/$view.php"; // Ajuste de la ruta a views
        $contenido = ob_get_clean();
        include_once __DIR__ . "/../views/template/{$template}.php"; // Ajuste de la ruta a template
    }
}
