<?php
class Cosecha {
    private $Cosecha;
    private $db;    
    private $datos;    

    public function __construct() {
        $this->Cosecha = array();
        $this->db = new PDO('mysql:host=localhost;dbname=e-cosecha', "root", "");
    }

    public function insertar($tabla, $data) {
        $consulta = "INSERT INTO " . $tabla . " (anio, activa, detalle) VALUES (:anio, :activa, :detalle)";
        try {
            $stmt = $this->db->prepare($consulta);
            $stmt->bindParam(':anio', $data['anio'], PDO::PARAM_INT);
            $stmt->bindParam(':activa', $data['activa'], PDO::PARAM_INT);
            $stmt->bindParam(':detalle', $data['detalle'], PDO::PARAM_STR);
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

    public static function obtenerTodas() {
        // Código para conectar con la base de datos y obtener todas las cosechas
        $conexion = new mysqli("localhost","root","","e-cosecha");
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }
        $consulta = "SELECT * FROM cosecha";
        $resultado = $conexion->query($consulta);
        if ($resultado->num_rows > 0) {
            $datos = $resultado->fetch_all(MYSQLI_ASSOC);
            return $datos;
        } else {
            echo "No se encontraron datos en la tabla cosecha";
            return [];
        }

        $conexion->close();
        }
}
