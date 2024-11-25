<?php
class DB {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbname = "e-cosecha";

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