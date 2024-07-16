<?php

namespace Models;

use PDO;
use PDOException;

class FuncionButacaModel extends Model {
    public static function create($data) {
        try {
            $query = "INSERT INTO funcionButaca (id_funcion, id_butaca, estado) VALUES (:id_funcion, :id_butaca, :estado)";
            $stmt = self::prepare($query);
            $stmt->bindParam(':id_funcion', $data['id_funcion'], PDO::PARAM_INT);
            $stmt->bindParam(':id_butaca', $data['id_butaca'], PDO::PARAM_INT);
            $stmt->bindParam(':estado', $data['estado'], PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log('Error en FuncionButacaModel::create - ' . $e->getMessage());
            return false;
        }
    }

    public static function update($id, $estado) {
        try {
            $query = "UPDATE funcionButaca SET estado = :estado WHERE id = :id";
            $stmt = self::prepare($query);
            $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log('Error en FuncionButacaModel::update - ' . $e->getMessage());
            return false;
        }
    }

    public static function obtenerButacasOcupadas($id_funcion) {
        try {
            $query = "SELECT id_butaca FROM funcionButaca WHERE id_funcion = :id_funcion AND estado = 'Ocupado'";
            $stmt = self::prepare($query);
            $stmt->bindParam(':id_funcion', $id_funcion, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            error_log('Error en FuncionButacaModel::obtenerButacasOcupadas - ' . $e->getMessage());
            return [];
        }
    }
}
?>
