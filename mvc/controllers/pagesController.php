<?php

use MVC\Router;

class PagesController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->loadModel('movies');
    }

    public function index(Router $router) {
        $preMovies = $this->model->getMovies(5, ['estadoEstreno' => 'Pre-Venta', 'estado' => 1]);
        $movies = $this->model->getMovies(5, ['estadoEstreno' => ['Pelicula', 'Estreno'], 'estado' => 1]);
 
        $router->render('pages/index', [
            'preMovies' => $preMovies,
            'movies' => $movies
        ]);
    }

    public function cartelera(Router $router) {
        $enCartelera = $this->model->getMovies(null, ['estadoEstreno' => ['Pelicula', 'Estreno'], 'estado' => 1]);
        $proximosEstrenos = $this->model->getMovies(null, ['estadoEstreno' => 'Pre-Venta', 'estado' => 1]);
    
        error_log("Rendering cartelera view with movies: " . count($enCartelera) . " en cartelera, " . count($proximosEstrenos) . " próximos estrenos");
    
        $router->render('pages/cartelera', [
            'enCartelera' => $enCartelera,
            'proximosEstrenos' => $proximosEstrenos,
            'title' => 'Cartelera'
        ]);
    }
    
}
?>
