<?php
class Trabajador {
    private $Trabajador;
    private $db;
    private $datos;

    public function __construct() {
        $this->Trabajador = array();
        $this->db = new PDO('mysql:host=localhost;dbname=e-cosecha', "root", "");
    }

    public function mostrar($tabla, $condicion) {
        $consul = "SELECT * FROM " . $tabla . " WHERE " . $condicion . ";";
        $resu = $this->db->query($consul);        
        while ($filas = $resu->fetchAll(PDO::FETCH_ASSOC)) {
            $this->datos[] = $filas;
        }
        return $this->datos;
    }

    public function insertar($tabla, $data) {
        $consulta = "INSERT INTO " . $tabla . " (cosecha_id, tipo_trabajo_id, persona_id, codigo) VALUES (:cosecha_id, :tipo_trabajo_id, :persona_id, :codigo)";
        try {
            $stmt = $this->db->prepare($consulta);
            $stmt->bindParam(':cosecha_id', $data['cosecha_id']);
            $stmt->bindParam(':tipo_trabajo_id', $data['tipo_trabajo_id']);
            $stmt->bindParam(':persona_id', $data['persona_id']);
            $stmt->bindParam(':codigo', $data['codigo']);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
            return false;
        }
    }

    public function actualizar($tabla, $data, $condicion) {       
        $consulta = "UPDATE " . $tabla . " SET " . $data . " WHERE " . $condicion;
        try {
            return $this->db->query($consulta);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function eliminar($tabla, $condicion) {
        $eli = "DELETE FROM " . $tabla . " WHERE " . $condicion;
        try {
            return $this->db->query($eli);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}