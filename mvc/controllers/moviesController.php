<?php

 
namespace Controllers;

use MVC\Router;
use Models\MoviesModel;

class MoviesController {

    public static function index(Router $router) {
        session_start();
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Administrador') {
            header('Location: /');
            exit;
        }

        $movies = MoviesModel::getAll();  

        $router->render('admin/movies/index', [
            'title' => 'Listado de Películas',
            'movies' => $movies
        ], 'layoutAdmin');
    }

    public static function create(Router $router) {
        session_start();
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Administrador') {
            header('Location: /');
            exit;
        }

        $genres = MoviesModel::getAllGeneros();  
        $classifications = MoviesModel::getAllClasificaciones(); 
        $formats = MoviesModel::getAllFormatos();  

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $movie = new MoviesModel();
            $movie->from($_POST);
            $movie->setFormatos($_POST['formatos']);
            if ($movie->save()) {
                header('Location: /admin/peliculas');
                exit;
            }
        }

        $router->render('admin/movies/form', [
            'title' => 'Crear Película',
            'genres' => $genres,
            'classifications' => $classifications,
            'formats' => $formats
        ], 'layoutAdmin');
    }

    public static function edit(Router $router) {
        session_start();
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Administrador') {
            header('Location: /');
            exit;
        }

        $id = $router->params[0];
        $model = new MoviesModel();  
        $movieData = $model->get($id);  

        if (!$movieData) {
            header('Location: /admin/peliculas');
            exit;
        }

        $movie = new MoviesModel();
        $movie->from((array)$movieData);
        $genres = MoviesModel::getAllGeneros(); 
        $classifications = MoviesModel::getAllClasificaciones(); 
        $formats = MoviesModel::getAllFormatos(); 
        $selectedFormats = $movie->getFormatos() ?? [];  

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $movie->from($_POST);
            $movie->setId($id);  
            $movie->setFormatos($_POST['formatos'] ?? []);
            if ($movie->update()) {
                header('Location: /admin/peliculas');
                exit;
            }
        }

        $router->render('admin/movies/form', [
            'title' => 'Actualizar Película',
            'movie' => $movie,
            'genres' => $genres,
            'classifications' => $classifications,
            'formats' => $formats,
            'selectedFormats' => $selectedFormats   
        ], 'layoutAdmin');
    }

    public static function delete(Router $router) {
        session_start();
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Administrador') {
            header('Location: /');
            exit;
        }

        $id = $router->params[0];
        $model = new MoviesModel(); 
        if ($model->delete($id)) {  
            header('Location: /admin/peliculas');
            exit;
        } else {
             
            echo "Error al eliminar la película";
        }
    }

    public static function getMovies() {
        session_start();
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Administrador') {
            header('Location: /');
            exit;
        }

        $movies = MoviesModel::getAll();  
        echo json_encode($movies);
    }
}

?>
