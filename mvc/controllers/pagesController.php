<?php
namespace Controllers;

use Exception;
use MVC\Router;
use Models\FuncionesModel;

class PagesController {

    public static function index(Router $router) {
        $preMovies = FuncionesModel::getFunctionsByFilters(['estadoEstreno' => 'Pre-Venta'], 5);
        $movies = FuncionesModel::getFunctionsByFilters(['estadoEstreno' => ['Pelicula', 'Estreno']], 5);

        $router->render('pages/index', [
            'preMovies' => $preMovies,
            'movies' => $movies
        ]);
    }

    public static function cartelera(Router $router) {
        $model = new FuncionesModel(); // Crear una instancia de FuncionesModel
        $ciudades = $model->getCiudades();
        $cines = $model->getCines();
        $formatos = $model->getFormatos();

        $router->render('pages/cartelera', [
            'ciudades' => $ciudades,
            'cines' => $cines,
            'formatos' => $formatos,
            'title' => 'Cartelera'
        ]);
    }

    public static function cines(Router $router) { 

        $router->render('pages/cines', [ 
            'title' => 'Cines'
        ]);
    }

    public static function peliculaDetalle(Router $router) {
        $id = $router->params[0];

        $id = filter_var($id, FILTER_VALIDATE_INT);
        if (!$id) {
            header("Location: /cartelera");
            exit;
        }

        $model = new FuncionesModel(); // Crear una instancia de FuncionesModel
        $movie = $model->getMovie($id);

        if ($movie) {
            $ciudades = $model->getCiudades();
            $cines = $model->getCines();
            $formatos = $model->getFormatos();

            $router->render('pages/pelicula-detalle', [
                'movie' => $movie,
                'ciudades' => $ciudades,
                'cines' => $cines,
                'formatos' => $formatos
            ]);
        } else {
            $router->render('pages/404');
        }
    }

    public static function loadMoreMovies(Router $router) {
        header('Content-Type: application/json');

        $input = json_decode(file_get_contents('php://input'), true);

        $estadoEstreno = $input['estadoEstreno'] ?? null;
        $ciudad = $input['ciudad'] ?? null;
        $cine = $input['cine'] ?? null;
        $formato = $input['formato'] ?? null;
        $fecha = $input['fecha'] ?? null;
        $limit = $input['limit'] ?? null;

        if ($estadoEstreno === null) {
            echo json_encode(['error' => 'Missing parameters']);
            return;
        }

        $filters = ['pelicula.estadoEstreno' => $estadoEstreno, 'pelicula.estado' => 1];
        if ($ciudad) {
            $filters['ciudad.nombre'] = $ciudad;
        }
        if ($cine) {
            $filters['cine.nombre'] = $cine;
        }
        if ($formato) {
            $filters['formato.nombre'] = $formato;
        }
        if ($fecha) {
            $filters['funcion.fecha'] = $fecha;
        }

        try {
            $movies = FuncionesModel::getFunctionsByFilters($filters, $limit);
            echo json_encode($movies);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public static function getMovieHTML(Router $router) {
        header('Content-Type: text/html');
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['movie'])) {
            $movie = json_decode($input['movie']);
            ob_start();
            include 'views/pages/movie.php';
            $movieHTML = ob_get_clean();
            echo $movieHTML;
        } else {
            echo 'Error: Missing movie data';
        }
    }
}

?>
