<?php
class TipoTrabajo {
    private $db;
    private $datos;

    public function __construct() {
        $this->datos = array();
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

    public static function obtenerTodos() {
        // Código para conectar con la base de datos y obtener todas las cosechas
        $conexion = new mysqli("localhost","root","","e-cosecha");
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }
        $consulta = "SELECT * FROM tipo_trabajo";
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
