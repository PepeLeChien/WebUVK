<?php

namespace Controllers;

use Exception;
use MVC\Router;
use Models\FuncionesModel;

class FunctionsController
{

    public static function index(Router $router)
    {
        session_start();
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Administrador') {
            header('Location: /');
            exit;
        }

        $model = new FuncionesModel();
        $functions = $model->getAll();

        $router->render('admin/functions/index', [
            'title' => 'Listado de Funciones',
            'functions' => $functions
        ], 'layoutAdmin');
    }

    public static function create(Router $router)
    {
        session_start();
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Administrador') {
            header('Location: /');
            exit;
        }

        $model = new FuncionesModel(); // Crear una instancia de FuncionesModel
        $cineSalas = $model->getCineSalas();
        $peliculaFormatos = $model->getPeliculaFormatos();

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

    public static function edit(Router $router)
    {
        session_start();
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Administrador') {
            header('Location: /');
            exit;
        }

        $id = $router->params[0];
        $model = new FuncionesModel(); // Crear una instancia de FuncionesModel
        $functionData = $model->get($id); // Llamar al método desde la instancia

        if (!$functionData) {
            header('Location: /admin/funciones');
            exit;
        }

        $function = new FuncionesModel();
        $function->from((array)$functionData);
        $cineSalas = $model->getCineSalas(); // Llamar al método desde la instancia
        $peliculaFormatos = $model->getPeliculaFormatos(); // Llamar al método desde la instancia

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

    public static function delete(Router $router)
    {
        session_start();
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Administrador') {
            header('Location: /');
            exit;
        }

        $id = $router->params[0];
        $model = new FuncionesModel(); // Crear una instancia de FuncionesModel
        if ($model->delete($id)) { // Llamar al método desde la instancia
            header('Location: /admin/funciones');
            exit;
        } else {
            // Manejar el error si la eliminación falla
            echo "Error al eliminar la función";
        }
    }

    public static function getFunctions()
    {
        session_start();
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Administrador') {
            header('Location: /');
            exit;
        }

        $model = new FuncionesModel(); // Crear una instancia de FuncionesModel
        $functions = $model->getAll(); // Llamar al método desde la instancia
        echo json_encode($functions);
    }

    public static function getFuncionById(Router $router)
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo json_encode(['error' => 'ID is required']);
            return;
        }

        try {
            $model = new FuncionesModel();
            $funcion = $model->get($id);
            $cineSala = $model->getCineSalaById($funcion->id_cineSala);
            $peliculaFormato = $model->getPeliculaFormatoById($funcion->id_peliculaFormato);
            $ciudad = $model->getCiudadByCineId($cineSala->id_cine);

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
