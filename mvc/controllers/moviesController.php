<?php

use MVC\Router;

class MoviesController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->loadModel('Movies');
    }

    public function index(Router $router) {
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

    public function create(Router $router) {
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
    

    public function edit(Router $router) {
        session_start();
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Administrador') {
            header('Location: /');
            exit;
        }
    
        $id = $router->params[0];
        $movie = $this->model->get($id);
        $genres = $this->model->getAllGeneros();
        $classifications = $this->model->getAllClasificaciones();
        $formats = $this->model->getAllFormatos();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $movie->from($_POST);
            $movie->setFormatos($_POST['formatos']);
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
            'formats' => $formats
        ], 'layoutAdmin');
    }

    
    public function save() {
        try {
            $this->db->connect()->beginTransaction();
            
            $query = $this->prepare('INSERT INTO pelicula (nombre, descripcion, fecha_inicio, fecha_fin, id_genero, id_clasificacion, duracion, url_trailer, url_imagen, estadoEstreno, estado, url_portada) VALUES (:nombre, :descripcion, :fecha_inicio, :fecha_fin, :id_genero, :id_clasificacion, :duracion, :url_trailer, :url_imagen, :estadoEstreno, :estado, :url_portada)');
            $query->execute([
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
                'fecha_inicio' => $this->fecha_inicio,
                'fecha_fin' => $this->fecha_fin,
                'id_genero' => $this->id_genero,
                'id_clasificacion' => $this->id_clasificacion,
                'duracion' => $this->duracion,
                'url_trailer' => $this->url_trailer,
                'url_imagen' => $this->url_imagen,
                'estadoEstreno' => $this->estadoEstreno,
                'estado' => $this->estado,
                'url_portada' => $this->url_portada
            ]);
            $this->id = $this->db->connect()->lastInsertId();
    
            $this->saveFormatos();
            
            $this->db->connect()->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->connect()->rollBack();
            echo $e;
            return false;
        }
    }
    

    public function delete(Router $router) {
        session_start();
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Administrador') {
            header('Location: /');
            exit;
        }

        $id = $router->params[0];
        $this->model->delete($id);

        header('Location: /admin/peliculas');
        exit;
    }

    public function getMovies() {
        session_start();
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Administrador') {
            header('Location: /');
            exit;
        }
    
        $movies = $this->model->getAll();
        echo json_encode($movies);
    }
    
    
}
?>
