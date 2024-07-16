<?php

use MVC\Router;

class FunctionsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Funciones');
    }

    public function index(Router $router)
    {
        session_start();
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Administrador') {
            header('Location: /');
            exit;
        }

        $functions = $this->model->getAll();

        $router->render('admin/functions/index', [
            'title' => 'Listado de Funciones',
            'functions' => $functions
        ], 'layoutAdmin');
    }

    public function create(Router $router)
    {
        session_start();
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Administrador') {
            header('Location: /');
            exit;
        }

        $cineSalas = $this->model->getCineSalas();
        $peliculaFormatos = $this->model->getPeliculaFormatos();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $function = new FuncionesModel();
            $function->from($_POST);
            if ($function->save()) {
                header('Location: /admin/funciones');
                exit;
            }
        }

        $router->render('admin/functions/form', [
            'title' => 'Crear Función',
            'cineSalas' => $cineSalas,
            'peliculaFormatos' => $peliculaFormatos
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
        $functionData = $this->model->get($id);

        if (!$functionData) {
            header('Location: /admin/funciones');
            exit;
        }

        $function = new FuncionesModel();
        $function->from((array)$functionData);
        $cineSalas = $this->model->getCineSalas();
        $peliculaFormatos = $this->model->getPeliculaFormatos();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $function->from($_POST);
            $function->setId($id); // Asegúrate de establecer el ID aquí
            if ($function->update()) {
                header('Location: /admin/funciones');
                exit;
            }
        }

        $router->render('admin/functions/form', [
            'title' => 'Actualizar Función',
            'function' => $function,
            'cineSalas' => $cineSalas,
            'peliculaFormatos' => $peliculaFormatos
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
            header('Location: /admin/funciones');
            exit;
        } else {
            // Manejar el error si la eliminación falla
            echo "Error al eliminar la función";
        }
    }

    public function getFunctions()
    {
        session_start();
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Administrador') {
            header('Location: /');
            exit;
        }

        $functions = $this->model->getAll();
        echo json_encode($functions);
    }
}
