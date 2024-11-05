<?php
class Modelo {
    private $Modelo;
    private $db;    
    private $datos;    

    public function __construct() {
        $this->Modelo = array();
        $this->db = new PDO('mysql:host=localhost;dbname=e-cosecha', "root", "");
    }

    public function insertar($tabla, $data) {
        // Construir la consulta SQL usando parámetros preparados para mayor seguridad
        $consulta = "INSERT INTO " . $tabla . " (nombre, apellido_paterno) VALUES (:nombre, :apellido_paterno)";
        echo "Consulta SQL: " . $consulta . "<br>"; // Imprime la consulta para depuración
        try {
            $stmt = $this->db->prepare($consulta);
            $stmt->bindParam(':nombre', $data['nombre']);
            $stmt->bindParam(':apellido_paterno', $data['apellido_paterno']);
            $resultado = $stmt->execute();
            if ($resultado) {
                echo "Inserción exitosa.<br>";
                return true;
            } else {
                echo "Error en la inserción.<br>";
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
            return false;
        }
    }
       

    public function mostrar($tabla, $condicion) {
        $consul = "SELECT * FROM " . $tabla . " WHERE " . $condicion . ";";
        $resu = $this->db->query($consul);        
        while ($filas = $resu->fetchAll(PDO::FETCH_ASSOC)) {
            $this->datos[] = $filas;
        }
        return $this->datos;
    } 

    public function actualizar($tabla, $data, $condicion) {       
        $consulta = "UPDATE " . $tabla . " SET " . $data . " WHERE " . $condicion;
        try {
            $resultado = $this->db->query($consulta);
            return $resultado ? true : false;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function eliminar($tabla, $condicion) {
        $eli = "DELETE FROM " . $tabla . " WHERE " . $condicion;
        try {
            $res = $this->db->query($eli);
            return $res ? true : false;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
