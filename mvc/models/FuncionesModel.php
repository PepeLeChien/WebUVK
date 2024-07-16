<?php

namespace Models;

use Libs\Database;
use Exception;
use PDO;
use PDOException;

class FuncionesModel extends Model
{
    private $id;
    private $id_cineSala;
    private $id_peliculaFormato;
    private $fecha;
    private $horario;
    private $estado;

    public function __construct()
    {
        parent::__construct();
        $this->id_cineSala = 0;
        $this->id_peliculaFormato = 0;
        $this->fecha = '';
        $this->horario = '';
        $this->estado = 1;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function setIdCineSala($id_cineSala)
    {
        $this->id_cineSala = $id_cineSala;
    }
    public function setIdPeliculaFormato($id_peliculaFormato)
    {
        $this->id_peliculaFormato = $id_peliculaFormato;
    }
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
    public function setHorario($horario)
    {
        $this->horario = $horario;
    }
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getIdCineSala()
    {
        return $this->id_cineSala;
    }
    public function getIdPeliculaFormato()
    {
        return $this->id_peliculaFormato;
    }
    public function getFecha()
    {
        return $this->fecha;
    }
    public function getHorario()
    {
        return $this->horario;
    }
    public function getEstado()
    {
        return $this->estado;
    }

    public function save()
    {
        try {
            $pdo = $this->db->connect();
            $pdo->beginTransaction();
            $query = $pdo->prepare('INSERT INTO funcion (id_cineSala, id_peliculaFormato, fecha, horario, estado) VALUES (:id_cineSala, :id_peliculaFormato, :fecha, :horario, :estado)');
            $query->execute([
                'id_cineSala' => $this->id_cineSala,
                'id_peliculaFormato' => $this->id_peliculaFormato,
                'fecha' => $this->fecha,
                'horario' => $this->horario,
                'estado' => $this->estado
            ]);
            $this->id = $pdo->lastInsertId();
            $pdo->commit();
            return true;
        } catch (PDOException $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            error_log($e->getMessage());
            return false;
        }
    }

    public function update()
    {
        try {
            $pdo = $this->db->connect();
            $pdo->beginTransaction();
            $query = $pdo->prepare('UPDATE funcion SET id_cineSala = :id_cineSala, id_peliculaFormato = :id_peliculaFormato, fecha = :fecha, horario = :horario, estado = :estado WHERE id = :id');
            $query->execute([
                'id_cineSala' => $this->id_cineSala,
                'id_peliculaFormato' => $this->id_peliculaFormato,
                'fecha' => $this->fecha,
                'horario' => $this->horario,
                'estado' => $this->estado,
                'id' => $this->id
            ]);
            $pdo->commit();
            return true;
        } catch (PDOException $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            error_log($e->getMessage());
            return false;
        }
    }

    public function getAll()
    {
        try {
            $sql = 'SELECT funcion.id, CONCAT(cine.nombre, " - ", sala.numero) AS cine_sala, CONCAT(pelicula.nombre, " - ", formato.nombre) AS pelicula_formato, funcion.fecha, funcion.horario, funcion.estado
                    FROM funcion
                    JOIN cineSala ON funcion.id_cineSala = cineSala.id
                    JOIN cine ON cineSala.id_cine = cine.id
                    JOIN sala ON cineSala.id_sala = sala.id
                    JOIN peliculaFormato ON funcion.id_peliculaFormato = peliculaFormato.id
                    JOIN pelicula ON peliculaFormato.id_pelicula = pelicula.id
                    JOIN formato ON peliculaFormato.id_formato = formato.id
                    ORDER BY funcion.id DESC';
            $query = $this->db->connect()->query($sql);
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception('Error retrieving functions: ' . $e->getMessage());
        }
    }

    public function get($id)
    {
        try {
            $query = $this->prepare('SELECT * FROM funcion WHERE id = :id');
            $query->execute(['id' => $id]);
            return $query->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception('Error retrieving function: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $query = $this->prepare('DELETE FROM funcion WHERE id = :id');
            $query->execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            throw new Exception('Error deleting function: ' . $e->getMessage());
        }
    }

    public function from($array)
    {
        $this->id = $array['id'] ?? null;
        $this->id_cineSala = $array['id_cineSala'] ?? 0;
        $this->id_peliculaFormato = $array['id_peliculaFormato'] ?? 0;
        $this->fecha = $array['fecha'] ?? '';
        $this->horario = $array['horario'] ?? '';
        $this->estado = $array['estado'] ?? 1;
    }

    public static function getFunctionsByFilters($filters = [], $limit = null)
    {
        $sql = 'SELECT DISTINCT pelicula.*
                FROM funcion
                JOIN peliculaFormato ON funcion.id_peliculaFormato = peliculaFormato.id
                JOIN pelicula ON peliculaFormato.id_pelicula = pelicula.id
                JOIN cineSala ON funcion.id_cineSala = cineSala.id
                JOIN cine ON cineSala.id_cine = cine.id
                JOIN ciudad ON cine.id_ciudad = ciudad.id
                JOIN formato ON peliculaFormato.id_formato = formato.id
                WHERE funcion.estado = 1 AND pelicula.estado=1';

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
            $db = new Database(); // Crear una nueva instancia de Database
            $query = $db->connect()->prepare($sql); // Usar la instancia para conectarse a la base de datos
            $query->execute($params);
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception('Error retrieving functions by filters: ' . $e->getMessage());
        }
    }


    public function getCiudades()
    {
        try {
            $query = $this->query('SELECT * FROM ciudad');
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception('Error retrieving cities: ' . $e->getMessage());
        }
    }

    public function getCines()
    {
        try {
            $query = $this->query('SELECT * FROM cine');
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception('Error retrieving cinemas: ' . $e->getMessage());
        }
    }

    public function getFormatos()
    {
        try {
            $query = $this->query('SELECT * FROM formato');
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception('Error retrieving formats: ' . $e->getMessage());
        }
    }

    public function getMovie($id)
    {
        try {
            $query = $this->prepare('SELECT * FROM pelicula WHERE id = :id');
            $query->execute(['id' => $id]);
            return $query->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception('Error retrieving pelicula: ' . $e->getMessage());
        }
    }

    public function getCineSalas()
    {
        try {
            $query = $this->query('
                SELECT cineSala.id, cine.nombre as cine_nombre, sala.numero as sala_numero
                FROM cineSala
                JOIN cine ON cineSala.id_cine = cine.id
                JOIN sala ON cineSala.id_sala = sala.id
            ');
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Error retrieving cine salas: ' . $e->getMessage());
        }
    }

    public function getPeliculaFormatos()
    {
        try {
            $query = $this->db->connect()->query('
            SELECT peliculaFormato.id, pelicula.nombre as pelicula_nombre, formato.nombre as formato_nombre
            FROM peliculaFormato
            JOIN pelicula ON peliculaFormato.id_pelicula = pelicula.id
            JOIN formato ON peliculaFormato.id_formato = formato.id
        ');
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Error retrieving pelicula formatos: ' . $e->getMessage());
        }
    }

    public function getFuncionesPorPelicula($id_pelicula)
    {
        try {
            $query = $this->db->connect()->prepare('
                SELECT funcion.*, cine.nombre AS cine, ciudad.nombre AS ciudad, sala.numero AS sala, formato.nombre AS formato
                FROM funcion
                JOIN cineSala ON funcion.id_cineSala = cineSala.id
                JOIN cine ON cineSala.id_cine = cine.id
                JOIN sala ON cineSala.id_sala = sala.id
                JOIN ciudad ON cine.id_ciudad = ciudad.id
                JOIN peliculaFormato ON funcion.id_peliculaFormato = peliculaFormato.id
                JOIN formato ON peliculaFormato.id_formato = formato.id
                WHERE peliculaFormato.id_pelicula = :id_pelicula AND funcion.estado = 1
            ');
            $query->execute(['id_pelicula' => $id_pelicula]);
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception('Error retrieving functions for movie: ' . $e->getMessage());
        }
    }

    public function getCineSalaById($id)
    {
        try {
            $query = $this->db->connect()->prepare('
            SELECT cineSala.id, cine.nombre AS cine, cine.id AS id_cine, sala.numero AS sala
            FROM cineSala
            JOIN cine ON cineSala.id_cine = cine.id
            JOIN sala ON cineSala.id_sala = sala.id
            WHERE cineSala.id = :id
        ');
            $query->execute(['id' => $id]);
            return $query->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception('Error retrieving cine sala: ' . $e->getMessage());
        }
    }


    public function getPeliculaFormatoById($id)
    {
        try {
            $query = $this->db->connect()->prepare('
            SELECT peliculaFormato.id, formato.nombre AS formato
            FROM peliculaFormato
            JOIN formato ON peliculaFormato.id_formato = formato.id
            WHERE peliculaFormato.id = :id
        ');
            $query->execute(['id' => $id]);
            return $query->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception('Error retrieving pelicula formato: ' . $e->getMessage());
        }
    }

    public function getCiudadByCineId($id)
    {
        try {
            $query = $this->db->connect()->prepare('
            SELECT ciudad.nombre
            FROM cine
            JOIN ciudad ON cine.id_ciudad = ciudad.id
            WHERE cine.id = :id
        ');
            $query->execute(['id' => $id]);
            return $query->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception('Error retrieving ciudad: ' . $e->getMessage());
        }
    }

    
}
