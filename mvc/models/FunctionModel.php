<?php

class FunctionModel extends Model implements IModel {

    public function __construct() {
        parent::__construct();
    }

    public function save() {
        // Implementación de la función save si es necesario
    }

    public function getAll() {
        try {
            $query = $this->query('SELECT * FROM funcion');
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception('Error retrieving functions: ' . $e->getMessage());
        }
    }

    public function get($id) {
        try {
            $query = $this->prepare('SELECT * FROM pelicula WHERE id = :id');
            $query->execute(['id' => $id]);
            return $query->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception('Error retrieving function: ' . $e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $query = $this->prepare('DELETE FROM funcion WHERE id = :id');
            $query->execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            throw new Exception('Error deleting function: ' . $e->getMessage());
        }
    }

    public function update() {
        // Implementación de la función update si es necesario
    }

    public function from($array) {
        // Implementación de la función from si es necesario
    }

    public function getFunctionsByFilters($filters = [], $limit = null) {
        $sql = 'SELECT DISTINCT pelicula.*
                FROM funcion
                JOIN peliculaFormato ON funcion.id_peliculaFormato = peliculaFormato.id
                JOIN pelicula ON peliculaFormato.id_pelicula = pelicula.id
                JOIN cineSala ON funcion.id_cineSala = cineSala.id
                JOIN cine ON cineSala.id_cine = cine.id
                JOIN ciudad ON cine.id_ciudad = ciudad.id
                JOIN formato ON peliculaFormato.id_formato = formato.id
                WHERE funcion.estado = 1';
        
        $params = [];

        if (!empty($filters)) {
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
            $sql .= ' AND ' . implode(' AND ', $conditions);
        }

        if ($limit !== null) {
            $sql .= ' LIMIT ?';
            $params[] = (int)$limit;
        }

        try {
            $query = $this->db->connect()->prepare($sql);
            $query->execute($params);
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception('Error retrieving functions by filters: ' . $e->getMessage());
        }
    }

    public function getCiudades() {
        try {
            $query = $this->query('SELECT * FROM ciudad');
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception('Error retrieving cities: ' . $e->getMessage());
        }
    }

    public function getCines() {
        try {
            $query = $this->query('SELECT * FROM cine');
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception('Error retrieving cinemas: ' . $e->getMessage());
        }
    }

    public function getFormatos() {
        try {
            $query = $this->query('SELECT * FROM formato');
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception('Error retrieving formats: ' . $e->getMessage());
        }
    }
}
?>
