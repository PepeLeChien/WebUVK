<?php

use MVC\Router;

class MoviesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Movies');
    }

    public function index(Router $router)
    {
        session_start();
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Administrador') {
            header('Location: /');
            exit;
        }

        $movies = $this->model->getAll();

        $router->render('admin/movies/index', [
            'title' => 'Listado de Películas',
            'movies' => $movies
        ], 'layoutAdmin');
    }

    public function create(Router $router)
    {
        session_start();
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Administrador') {
            header('Location: /');
            exit;
        }

        $genres = $this->model->getAllGeneros();
        $classifications = $this->model->getAllClasificaciones();
        $formats = $this->model->getAllFormatos();

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

    public function edit(Router $router)
    {
        session_start();
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Administrador') {
            header('Location: /');
            exit;
        }

        $id = $router->params[0];
        $movieData = $this->model->get($id);

        if (!$movieData) {
            header('Location: /admin/peliculas');
            exit;
        }

        $movie = new MoviesModel();
        $movie->from((array)$movieData);
        $genres = $this->model->getAllGeneros();
        $classifications = $this->model->getAllClasificaciones();
        $formats = $this->model->getAllFormatos();
        $selectedFormats = $movie->getFormatos() ?? [];  // Asegura que siempre es un array

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $movie->from($_POST);
            $movie->setId($id); // Asegúrate de establecer el ID aquí
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
            'selectedFormats' => $selectedFormats  // Pasar siempre selectedFormats
        ], 'layoutAdmin');
    }



    public function delete(Router $router)
    {
        session_start();
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Administrador') {
            header('Location: /');
            exit;
        }

        $id = $router->params[0];
        if ($this->model->delete($id)) {
            header('Location: /admin/peliculas');
            exit;
        } else {
            // Manejar el error si la eliminación falla
            echo "Error al eliminar la película";
        }
    }


    public function getMovies()
    {
        session_start();
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Administrador') {
            header('Location: /');
            exit;
        }

        $movies = $this->model->getAll();
        echo json_encode($movies);
    }
}
