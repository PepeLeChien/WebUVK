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


    public function peliculaDetalle(Router $router) {
        $id = $router->params[0];  

        $id = filter_var($id, FILTER_VALIDATE_INT);
        if (!$id) {
            header("Location: /cartelera");
            exit;
        }
 
        $movie = $this->model->get($id);
        // var_dump($movie);
        if ($movie) { 
            $router->render('pages/pelicula-detalle', [
                'movie' => $movie
            ]);
        } else { 
            $router->render('pages/404');
        }
    }
    

    public function loadMoreMovies(Router $router) {
        header('Content-Type: application/json');  
     
        $input = json_decode(file_get_contents('php://input'), true);
     
        $estadoEstreno = $input['estadoEstreno'] ?? null;
    
        if ($estadoEstreno === null) {
            echo json_encode(['error' => 'Missing parameters']);
            return;
        }
    
        $movies = $this->model->getMovies(null, ['estadoEstreno' => $estadoEstreno, 'estado' => 1]);
    
        echo json_encode($movies);
    }
     

    public function getMovieHTML(Router $router) {
        header('Content-Type: text/html'); // Asegurar que la respuesta sea HTML
    
        // Leer la entrada JSON y decodificarla
        $input = json_decode(file_get_contents('php://input'), true);
    
        // Verificar si los datos existen en la entrada JSON
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
