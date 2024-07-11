<?php

class View {
    protected $d;

    function __construct() {
    }
 
    function renderWithLayout($nombre, $data = []) {
        $this->d = $data;
        foreach ($data as $key => $value) {
            $$key = $value;   
        }

        ob_start();  

        // Incluir la vista
        include __DIR__ . '/../views/' . $nombre . '.php';
        $contenido = ob_get_clean();  
 
        include __DIR__ . '/../views/templates/layout.php';
    }
 
    function render($nombre, $data = []) {
        $this->d = $data;
        foreach ($data as $key => $value) {
            $$key = $value;   
        }
 
        include __DIR__ . '/../views/' . $nombre . '.php';
    }
}
