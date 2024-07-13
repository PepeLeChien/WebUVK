<?php
require_once 'config/config.php';
require_once 'libs/database.php';

class UserSeeder {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function seed() {
        $passwordCliente = password_hash('12345', PASSWORD_BCRYPT);
        $passwordAdmin = password_hash('12345', PASSWORD_BCRYPT);

        $query = "INSERT INTO usuario (email, password, rol) VALUES
                  ('cliente@correo.com', :passwordCliente, 'Cliente'),
                  ('admin@correo.com', :passwordAdmin, 'Administrador')";

        $stmt = $this->db->connect()->prepare($query);
        $stmt->bindParam(':passwordCliente', $passwordCliente);
        $stmt->bindParam(':passwordAdmin', $passwordAdmin);

        if ($stmt->execute()) {
            echo "Usuarios insertados correctamente.\n";
        } else {
            echo "Error al insertar usuarios.\n";
        }
    }
}

$seeder = new UserSeeder();
$seeder->seed();
?>
