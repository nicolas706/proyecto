<?php
class Persona {
    private $Persona;
    private $db;    
    private $datos;    

    public function __construct() {
        $this->Persona = array();
        $this->db = new PDO('mysql:host=localhost;dbname=e-cosecha', "root", "");
    }

    public function insertar($tabla, $data) {
        $consulta = "INSERT INTO " . $tabla . " (nombre, apellido_paterno, apellido_materno, rut, sexo, fecha_de_nacimiento, telefono) VALUES (:nombre, :apellido_paterno, :apellido_materno, :rut, :sexo, :fecha_de_nacimiento, :telefono)";
        try {
            $stmt = $this->db->prepare($consulta);
            $stmt->bindParam(':nombre', $data['nombre']);
            $stmt->bindParam(':apellido_paterno', $data['apellido_paterno']);
            $stmt->bindParam(':apellido_materno', $data['apellido_materno']);
            $stmt->bindParam(':rut', $data['rut']);
            $stmt->bindParam(':sexo', $data['sexo']);
            $stmt->bindParam(':fecha_de_nacimiento', $data['fecha_de_nacimiento']);
            $stmt->bindParam(':telefono', $data['telefono']);
            return $stmt->execute();
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
        $consulta = "SELECT * FROM persona";
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
