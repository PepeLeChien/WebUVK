<?php

class PrincipalController extends Controller {
    function __construct() {
        parent::__construct();
        $this->loadModel('movies');
    }

    function index() { 
        $preMovies = $this->model->getMovies(5, ['estadoEstreno' => 'Pre-Venta', 'estado' => 1]);
 
        $movies = $this->model->getMovies(5, ['estadoEstreno' => ['Pelicula', 'Estreno'], 'estado' => 1]);

        $this->view->renderWithLayout('principal/index', [
            'preMovies' => $preMovies,
            'movies' => $movies
        ]);
    }
}

?>
