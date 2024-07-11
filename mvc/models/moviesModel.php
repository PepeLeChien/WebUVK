<?php

class MoviesModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getMovies() {
        $query = $this->db->connect()->query('SELECT * FROM pelicula');
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}
?>
