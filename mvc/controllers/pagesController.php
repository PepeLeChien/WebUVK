<?php

namespace Controllers;

use Exception;
use MVC\Router;
use Models\FuncionesModel;
use stdClass;

class PagesController
{
    public static function index(Router $router)
    {
        $preMovies = FuncionesModel::getFunctionsByFilters(['estadoEstreno' => 'Pre-Venta'], 5);
        $movies = FuncionesModel::getFunctionsByFilters(['estadoEstreno' => ['Pelicula', 'Estreno']], 5);

        $router->render('pages/index', [
            'preMovies' => $preMovies,
            'movies' => $movies
        ]);
    }

    public static function cartelera(Router $router)
    {
        $model = new FuncionesModel();
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

    public static function cines(Router $router)
    {
        $router->render('pages/cines', [
            'title' => 'Cines'
        ]);
    }

    public static function peliculaDetalle(Router $router)
    {
        $id = $router->params[0];

        $id = filter_var($id, FILTER_VALIDATE_INT);
        if (!$id) {
            header("Location: /cartelera");
            exit;
        }

        $model = new FuncionesModel();
        $movie = $model->getMovie($id);
        $funciones = $model->getFuncionesPorPelicula($id);

        if ($movie) {
            $ciudades = $model->getCiudades();
            $cines = $model->getCines();
            $formatos = $model->getFormatos();

            // Obtener fechas únicas
            $fechasUnicas = array_unique(array_column($funciones, 'fecha'));

            $router->render('pages/pelicula-detalle', [
                'movie' => $movie,
                'ciudades' => $ciudades,
                'cines' => $cines,
                'formatos' => $formatos,
                'fechasUnicas' => $fechasUnicas,
                'funciones' => $funciones
            ]);
        } else {
            $router->render('pages/404');
        }
    }

    public static function getFuncionesPorPelicula(Router $router)
    {
        $id = $_GET['id'];

        $model = new FuncionesModel();
        $funciones = $model->getFuncionesPorPelicula($id);

        echo json_encode($funciones);
    }

    public static function loadMoreMovies(Router $router)
    {
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


    public static function getMovieHTML(Router $router)
    {
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



    public static function getFuncionById(Router $router)
    {
        header('Content-Type: application/json');

        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo json_encode(['error' => 'ID is required']);
            return;
        }

        try {
            $model = new FuncionesModel();
            $funcion = $model->get($id);
            if (!$funcion) {
                throw new Exception('Function not found');
            }

            $cineSala = $model->getCineSalaById($funcion->id_cineSala);
            if (!$cineSala) {
                throw new Exception('Cine Sala not found');
            }

            $peliculaFormato = $model->getPeliculaFormatoById($funcion->id_peliculaFormato);
            if (!$peliculaFormato) {
                throw new Exception('Pelicula Formato not found');
            }

            if (!isset($cineSala->id_cine)) {
                throw new Exception('Cine ID not found in cineSala');
            }

            $ciudad = $model->getCiudadByCineId($cineSala->id_cine);
            if (!$ciudad) {
                $ciudad = new stdClass();
                $ciudad->nombre = null;
            }

            $funcion->cine = $cineSala->cine;
            $funcion->sala = $cineSala->sala;
            $funcion->formato = $peliculaFormato->formato;
            $funcion->ciudad = $ciudad->nombre;

            echo json_encode($funcion);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
