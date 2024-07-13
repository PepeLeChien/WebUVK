<?php 
use MVC\Router;

class PagesController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->loadModel('Function'); 
    }

    public function index(Router $router) {
        $preMovies = $this->model->getFunctionsByFilters(['estadoEstreno' => 'Pre-Venta'], 5);
        $movies = $this->model->getFunctionsByFilters(['estadoEstreno' => ['Pelicula', 'Estreno']], 5);

        $router->render('pages/index', [
            'preMovies' => $preMovies,
            'movies' => $movies
        ]);
    }

    public function cartelera(Router $router) {
        $ciudades = $this->model->getCiudades();
        $cines = $this->model->getCines();
        $formatos = $this->model->getFormatos();

        $router->render('pages/cartelera', [
            'ciudades' => $ciudades,
            'cines' => $cines,
            'formatos' => $formatos,
            'title' => 'Cartelera'
        ]);
    }

    public function peliculaDetalle(Router $router) {
        $id = $router->params[0];  

        $id = filter_var($id, FILTER_VALIDATE_INT);
        if (!$id) {
            header("Location: /cartelera");
            exit;
        }

        $movie = $this->model->get($id);

        if ($movie) {
            $ciudades = $this->model->getCiudades();
            $cines = $this->model->getCines();
            $formatos = $this->model->getFormatos();
            
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

    public function loadMoreMovies(Router $router) {
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
            $movies = $this->model->getFunctionsByFilters($filters, $limit);
            echo json_encode($movies);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
    

    public function getMovieHTML(Router $router) {
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
