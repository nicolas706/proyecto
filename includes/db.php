<?php
class DB {
    private $host = "localhost"; // Dirección del servidor de base de datos
    private $user = "root";      // Usuario de la base de datos
    private $password = "";      // Contraseña del usuario
    private $dbname = "e-cosecha"; // Nombre de la base de datos

    public function connect() {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=utf8";
            $pdo = new PDO($dsn, $this->user, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Error connection: " . $e->getMessage());
        }
    }
}
?>
