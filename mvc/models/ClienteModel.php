<?php

namespace Models;

use PDO;
use PDOException;

class ClienteModel extends Model {
    public function find($id) {
        try {
            $query = "SELECT * FROM cliente WHERE id = :id LIMIT 1";
            $stmt = $this->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            error_log('Error en Cliente::find - ' . $e->getMessage());
            return false;
        }
    }
}
?>
