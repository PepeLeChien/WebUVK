<?php

class UserModel extends Model {
    public $email;
    public $password;
    public $role;
    public $autenticado;

    public function __construct($data = []) {
        parent::__construct();
        $this->email = $data['email'] ?? '';
        $this->password = $data['password'] ?? '';
        $this->role = $data['rol'] ?? 'Cliente';
        $this->autenticado = false;
    }

    public function validar() {
        $errores = [];
        if (!$this->email) {
            $errores[] = 'El email es obligatorio';
        }
        if (!$this->password) {
            $errores[] = 'La contraseña es obligatoria';
        }
        return $errores;
    }

    public function existeUsuario() {
        $query = "SELECT * FROM usuario WHERE email = :email LIMIT 1";
        $stmt = $this->prepare($query);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function comprobarPassword($usuario) {
        if (password_verify($this->password, $usuario->password)) {
            $this->autenticado = true;
            $this->role = $usuario->rol;
        } else {
            $this->autenticado = false;
        }
    }

    public function autenticar() {
        session_start();
        $_SESSION['email'] = $this->email;
        $_SESSION['rol'] = $this->role;
        $_SESSION['login'] = true;
        error_log('Sesión iniciada para: ' . $this->email . ' con rol: ' . $this->role); // Depuración
    }

    public static function getErrores() {
        return ['Usuario o contraseña incorrectos'];
    }
}
?>
