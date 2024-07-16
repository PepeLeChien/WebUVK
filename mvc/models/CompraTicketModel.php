<?php

namespace Models;

use PDO;
use PDOException;

class CompraTicketModel extends Model {
    public static function create($data) {
        try {
            $query = "INSERT INTO compraTicket (id_compra, id_funcionButaca, precio) VALUES (:id_compra, :id_funcionButaca, :precio)";
            $stmt = self::prepare($query);
            $stmt->bindParam(':id_compra', $data['id_compra'], PDO::PARAM_INT);
            $stmt->bindParam(':id_funcionButaca', $data['id_funcionButaca'], PDO::PARAM_INT);
            $stmt->bindParam(':precio', $data['precio'], PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log('Error en CompraTicketModel::create - ' . $e->getMessage());
            return false;
        }
    } 
 
}
?>
