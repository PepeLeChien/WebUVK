<?php

class MoviesModel extends Model implements IModel {

    private $id;
    private $nombre;
    private $descripcion;
    private $fecha_inicio;
    private $fecha_fin;
    private $id_genero;
    private $id_clasificacion;
    private $duracion;
    private $url_trailer;
    private $url_imagen;
    private $estadoEstreno;
    private $estado;
    private $url_portada;
    private $genero;
    private $clasificacion;
    private $formatos;

    public function __construct() {
        parent::__construct();

        $this->nombre = '';
        $this->descripcion = '';
        $this->fecha_inicio = '';
        $this->fecha_fin = '';
        $this->id_genero = 0;
        $this->id_clasificacion = 0;
        $this->duracion = '';
        $this->url_trailer = '';
        $this->url_imagen = '';
        $this->estadoEstreno = '';
        $this->estado = '';
        $this->url_portada = '';
        $this->genero = '';
        $this->clasificacion = '';
        $this->formatos = [];
    }

    // Métodos setter
    public function setId($id) { $this->id = $id; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setDescripcion($descripcion) { $this->descripcion = $descripcion; }
    public function setFechaInicio($fecha_inicio) { $this->fecha_inicio = $fecha_inicio; }
    public function setFechaFin($fecha_fin) { $this->fecha_fin = $fecha_fin; }
    public function setIdGenero($id_genero) { $this->id_genero = $id_genero; }
    public function setIdClasificacion($id_clasificacion) { $this->id_clasificacion = $id_clasificacion; }
    public function setDuracion($duracion) { $this->duracion = $duracion; }
    public function setUrlTrailer($url_trailer) { $this->url_trailer = $url_trailer; }
    public function setUrlImagen($url_imagen) { $this->url_imagen = $url_imagen; }
    public function setEstadoEstreno($estadoEstreno) { $this->estadoEstreno = $estadoEstreno; }
    public function setEstado($estado) { $this->estado = $estado; }
    public function setUrlPortada($url_portada) { $this->url_portada = $url_portada; }
    public function setFormatos($formatos) { $this->formatos = $formatos; }

    // Métodos get para obtener los valores...
    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getDescripcion() { return $this->descripcion; }
    public function getFechaInicio() { return $this->fecha_inicio; }
    public function getFechaFin() { return $this->fecha_fin; }
    public function getGenero() { return $this->genero; }
    public function getClasificacion() { return $this->clasificacion; }
    public function getFormatos() { return $this->formatos; }

    public function save() {
        try {
            $this->db->connect()->beginTransaction();
            
            $query = $this->prepare('INSERT INTO pelicula (nombre, descripcion, fecha_inicio, fecha_fin, id_genero, id_clasificacion, duracion, url_trailer, url_imagen, estadoEstreno, estado, url_portada) VALUES (:nombre, :descripcion, :fecha_inicio, :fecha_fin, :id_genero, :id_clasificacion, :duracion, :url_trailer, :url_imagen, :estadoEstreno, :estado, :url_portada)');
            $query->execute([
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
                'fecha_inicio' => $this->fecha_inicio,
                'fecha_fin' => $this->fecha_fin,
                'id_genero' => $this->id_genero,
                'id_clasificacion' => $this->id_clasificacion,
                'duracion' => $this->duracion,
                'url_trailer' => $this->url_trailer,
                'url_imagen' => $this->url_imagen,
                'estadoEstreno' => $this->estadoEstreno,
                'estado' => $this->estado,
                'url_portada' => $this->url_portada
            ]);
            $this->id = $this->db->connect()->lastInsertId();

            $this->saveFormatos();
            
            $this->db->connect()->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->connect()->rollBack();
            echo $e;
            return false;
        }
    }

    public function update() {
        try {
            $this->db->connect()->beginTransaction();
            
            $query = $this->prepare('UPDATE pelicula SET nombre = :nombre, descripcion = :descripcion, fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin, id_genero = :id_genero, id_clasificacion = :id_clasificacion, duracion = :duracion, url_trailer = :url_trailer, url_imagen = :url_imagen, estadoEstreno = :estadoEstreno, estado = :estado, url_portada = :url_portada WHERE id = :id');
            $query->execute([
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
                'fecha_inicio' => $this->fecha_inicio,
                'fecha_fin' => $this->fecha_fin,
                'id_genero' => $this->id_genero,
                'id_clasificacion' => $this->id_clasificacion,
                'duracion' => $this->duracion,
                'url_trailer' => $this->url_trailer,
                'url_imagen' => $this->url_imagen,
                'estadoEstreno' => $this->estadoEstreno,
                'estado' => $this->estado,
                'url_portada' => $this->url_portada,
                'id' => $this->id
            ]);

            $this->deleteFormatos();
            $this->saveFormatos();
            
            $this->db->connect()->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->connect()->rollBack();
            echo $e;
            return false;
        }
    }

    private function saveFormatos() {
        try {
            foreach ($this->formatos as $formato) {
                $query = $this->prepare('INSERT INTO peliculaFormato (id_pelicula, id_formato) VALUES (:id_pelicula, :id_formato)');
                $query->execute(['id_pelicula' => $this->id, 'id_formato' => $formato]);
            }
        } catch (PDOException $e) {
            echo $e;
            throw $e;
        }
    }

    private function deleteFormatos() {
        try {
            $query = $this->prepare('DELETE FROM peliculaFormato WHERE id_pelicula = :id_pelicula');
            $query->execute(['id_pelicula' => $this->id]);
        } catch (PDOException $e) {
            echo $e;
            throw $e;
        }
    }

    // Métodos adicionales para obtener películas con filtros y límites
    public function getAll() {
        $items = [];

        try {
            $query = $this->db->connect()->query('
                SELECT pelicula.*, genero.nombre AS genero, clasificacion.nombre AS clasificacion
                FROM pelicula
                JOIN genero ON pelicula.id_genero = genero.id
                JOIN clasificacion ON pelicula.id_clasificacion = clasificacion.id
            ');

            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $p['formatos'] = $this->getPeliculaFormatos($p['id']);
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
            $movie = $query->fetch(PDO::FETCH_OBJ);
            $movie->formatos = $this->getPeliculaFormatos($id);

            return $movie;
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

    public function from($array) {
        $this->id = $array['id'];
        $this->nombre = $array['nombre'];
        $this->descripcion = $array['descripcion'];
        $this->fecha_inicio = $array['fecha_inicio'];
        $this->fecha_fin = $array['fecha_fin'];
        $this->id_genero = $array['id_genero'];
        $this->id_clasificacion = $array['id_clasificacion'];
        $this->duracion = $array['duracion'];
        $this->url_trailer = $array['url_trailer'];
        $this->url_imagen = $array['url_imagen'];
        $this->estadoEstreno = $array['estadoEstreno'];
        $this->estado = $array['estado'];
        $this->url_portada = $array['url_portada'];
        $this->genero = $array['genero'];
        $this->clasificacion = $array['clasificacion'];
        $this->formatos = $array['formatos'];
    }

    private function getPeliculaFormatos($id_pelicula) {
        try {
            $query = $this->db->connect()->prepare('
                SELECT formato.nombre
                FROM peliculaFormato
                JOIN formato ON peliculaFormato.id_formato = formato.id
                WHERE peliculaFormato.id_pelicula = :id_pelicula
            ');
            $query->execute(['id_pelicula' => $id_pelicula]);
            return $query->fetchAll(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            echo $e;
            return [];
        }
    }

    public function getAllFormatos() {
        try {
            $query = $this->db->connect()->query('SELECT * FROM formato');
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e;
            return [];
        }
    }

    public function getAllGeneros() {
        try {
            $query = $this->db->connect()->query('SELECT * FROM genero');
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e;
            return [];
        }
    }

    public function getAllClasificaciones() {
        try {
            $query = $this->db->connect()->query('SELECT * FROM clasificacion');
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e;
            return [];
        }
    }
}
?>
