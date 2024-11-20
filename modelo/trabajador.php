<?php
class Trabajador {
    private $Trabajador;
    private $db;
    private $datos;


    public function mostrarConDetalles() {
        $consulta = "
            SELECT 
                t.id, 
                t.codigo,
                p.nombre AS persona_nombre, 
                p.apellido_paterno AS persona_apellido_paterno, 
                p.apellido_materno AS persona_apellido_materno, 
                tt.nombre AS tipo_trabajo_nombre, 
                c.anio AS cosecha_año 
            FROM 
                trabajador t
            JOIN 
                persona p ON t.persona_id = p.id
            JOIN 
                tipo_trabajo tt ON t.tipo_trabajo_id = tt.id
            JOIN 
                cosecha c ON t.cosecha_id = c.id
        ";
        $resu = $this->db->query($consulta);        
        while ($filas = $resu->fetchAll(PDO::FETCH_ASSOC)) {
            $this->datos[] = $filas;
        }
        return $this->datos;
    }
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
        // Obtener columnas y valores de los datos
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
    
        // Preparar la consulta SQL
        $query = "INSERT INTO $tabla ($columns) VALUES ($placeholders)";
        $stmt = $this->db->prepare($query);
    
        // Asignar valores a los marcadores de posición
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
    
        // Ejecutar la consulta
        return $stmt->execute();
    }

    public function codigoExiste($codigo) {
        // Prepara la consulta para evitar inyección SQL
        $stmt = $this->db->prepare("SELECT id FROM trabajador WHERE codigo = :codigo");
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_STR);
    
        // Ejecuta la consulta
        $stmt->execute();
    
        // Verifica si hay resultados
        return $stmt->rowCount() > 0; // Devuelve true si existe al menos un resultado
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

    public static function obtenerTodos() {
        // Código para conectar con la base de datos y obtener todas las cosechas
        $conexion = new mysqli("localhost","root","","e-cosecha");
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }
        $consulta = "SELECT * FROM trabajador";
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