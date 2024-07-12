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
 
        ob_start(); // Almacenamiento en memoria durante un momento... 

        // entonces incluimos la vista en el layout
        include_once "views/$nombre.php";
        $contenido = ob_get_clean();
        include_once 'views/template/layout.php';
    }
 
    function render($nombre, $data = []) {
        $this->d = $data;
        foreach ($data as $key => $value) {
            $$key = $value;   
        }
 
        include  "views/$nombre.php";
    }
}
