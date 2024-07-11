<?php

class PrincipalController extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $movies = $this->model->getMovies();
        $this->view->renderWithLayout('principal/index', ['movies' => $movies]);
    }
}
?>
