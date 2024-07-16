<?php

namespace Models;

use PDO;
use PDOException;

class CompraModel extends Model {
    public static function create($data) {
        try {
            $query = "INSERT INTO compra (id_cliente, fecha, total) VALUES (:id_cliente, :fecha, :total)";
            $stmt = self::prepare($query);
            $stmt->bindParam(':id_cliente', $data['id_cliente'], PDO::PARAM_INT);
            $stmt->bindParam(':fecha', $data['fecha'], PDO::PARAM_STR);
            $stmt->bindParam(':total', $data['total'], PDO::PARAM_STR);
            $stmt->execute();
            return self::getDb()->lastInsertId();
        } catch (PDOException $e) {
            error_log('Error en CompraModel::create - ' . $e->getMessage());
            return false;
        }
    }
    
    private static function getDb() {
        return (new self)->db->connect();
    }
}
?>
