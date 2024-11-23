<?php
class Cosechero {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=e-cosecha', "root", "");
    }

    public function insertar($tabla, $data) {
        $consulta = "INSERT INTO " . $tabla . " (cosecha_id, persona_id, cuadrilla_id, codigo_de_barras_id) VALUES (:cosecha_id, :persona_id, :cuadrilla_id, :codigo_de_barras_id)";
        try {
            $stmt = $this->db->prepare($consulta);
            $stmt->bindParam(':cosecha_id', $data['cosecha_id']);
            $stmt->bindParam(':persona_id', $data['persona_id']);
            $stmt->bindParam(':cuadrilla_id', $data['cuadrilla_id']);
            $stmt->bindParam(':codigo_de_barras_id', $data['codigo_de_barras_id']);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
            return false;
        }
    }

    public function mostrar($tabla, $condicion) {
        $consul = "SELECT * FROM " . $tabla . " WHERE " . $condicion . ";";
        try {
            $resu = $this->db->query($consul);
            $this->datos = [];
            while ($filas = $resu->fetchAll(PDO::FETCH_ASSOC)) {
                $this->datos[] = $filas;
            }
            return $this->datos;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
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