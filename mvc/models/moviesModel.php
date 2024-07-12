<?php

class MoviesModel extends Model implements IModel {

    private $id;
    private $title;
    private $description;
    private $genre;
    private $release_date;
    private $url_image;
    private $estadoEstreno;

    public function __construct() {
        parent::__construct();

        $this->title = '';
        $this->description = '';
        $this->genre = '';
        $this->release_date = '';
        $this->url_image = '';
        $this->estadoEstreno = '';
    }

    public function save() {
        /*
        try {
            $query = $this->prepare('INSERT INTO pelicula (title, description, genre, release_date, url_image, estadoEstreno) VALUES (:title, :description, :genre, :release_date, :url_image, :estadoEstreno)');
            $query->execute([
                'title' => $this->title,
                'description' => $this->description,
                'genre' => $this->genre,
                'release_date' => $this->release_date,
                'url_image' => $this->url_image,
                'estadoEstreno' => $this->estadoEstreno
            ]);
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }*/
    }

    public function getAll() {
        $items = [];

        try {
            $query = $this->query('SELECT * FROM pelicula');
            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new MoviesModel();
                $item->from($p);
                array_push($items, $item);
            }
            return $items;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function get($id) {
        try {
            $query = $this->prepare('SELECT * FROM pelicula WHERE id = :id');
            $query->execute(['id' => $id]);
            $movie = $query->fetch(PDO::FETCH_ASSOC);

            $this->from($movie);

            return $this;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete($id) {
        try {
            $query = $this->prepare('DELETE FROM pelicula WHERE id = :id');
            $query->execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }

    public function update() {
        /*
        try {
            $query = $this->prepare('UPDATE pelicula SET title = :title, description = :description, genre = :genre, release_date = :release_date, url_image = :url_image, estadoEstreno = :estadoEstreno WHERE id = :id');
            $query->execute([
                'title' => $this->title,
                'description' => $this->description,
                'genre' => $this->genre,
                'release_date' => $this->release_date,
                'url_image' => $this->url_image,
                'estadoEstreno' => $this->estadoEstreno,
                'id' => $this->id
            ]);
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }*/
    }

    public function from($array) {
        /*
        $this->id = $array['id'];
        $this->title = $array['title'];
        $this->description = $array['description'];
        $this->genre = $array['genre'];
        $this->release_date = $array['release_date'];
        $this->url_image = $array['url_image'];
        $this->estadoEstreno = $array['estadoEstreno'];*/
    }

    // Métodos adicionales para obtener películas con filtros y límites
    public function getMovies($limit = null, $filters = []) {
        $sql = 'SELECT * FROM pelicula';
        $params = [];

        // Agregar condiciones WHERE si existen filtros
        if (!empty($filters)) {
            $sql .= ' WHERE ';
            $conditions = [];
            foreach ($filters as $key => $value) {
                if (is_array($value)) {
                    $conditions[] = "$key IN (" . implode(', ', array_fill(0, count($value), '?')) . ")";
                    foreach ($value as $v) {
                        $params[] = $v;
                    }
                } else {
                    $conditions[] = "$key = ?";
                    $params[] = $value;
                }
            }
            $sql .= implode(' AND ', $conditions);
        }

        // Agregar límite si se proporciona
        if ($limit !== null) {
            $sql .= ' LIMIT ?';
            $params[] = (int)$limit;
        }

        $query = $this->db->connect()->prepare($sql);

        // Ejecutar consulta con parámetros
        $query->execute($params);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}
?>
