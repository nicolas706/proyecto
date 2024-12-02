<?php

class Tarja
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=nombre_base_datos', 'usuario', 'contraseña');
    }

    public function obtenerPorCodigo($numeroCaja)
    {
        $stmt = $this->db->prepare("SELECT * FROM tarjas WHERE numero = ?");
        $stmt->execute([$numeroCaja]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>