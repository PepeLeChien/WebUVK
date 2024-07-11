<?php

class PagesController extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        if (!$this->model) {
            $this->loadModel('movie');
        }
        $movies = $this->model->getMovies();
        $this->view->render('pages/index', ['movies' => $movies]);
    }
}
?>
