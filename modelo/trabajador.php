<?php
class Trabajador {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=e-cosecha', 'root', '');
    }

    public function insertar($tabla, $data) {
        $consulta = "INSERT INTO " . $tabla . " (cosecha_id, tipo_trabajo_id, persona_id, codigo) VALUES (:cosecha_id, :tipo_trabajo_id, :persona_id, :codigo)";
        $stmt = $this->db->prepare($consulta);
        return $stmt->execute($data);
    }

    public function mostrarConDetalles() {
        $consulta = "
            SELECT 
                t.id, 
                CONCAT(p.nombre, ' ', p.apellido_paterno, ' ', p.apellido_materno) AS persona_nombre,
                tt.nombre AS tipo_trabajo,
                c.anio AS cosecha_anio,
                t.codigo
            FROM trabajador t
            JOIN persona p ON t.persona_id = p.id
            JOIN tipo_trabajo tt ON t.tipo_trabajo_id = tt.id
            JOIN cosecha c ON t.cosecha_id = c.id
        ";
        $stmt = $this->db->query($consulta);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function mostrar($tabla, $condicion) {
        $consulta = "SELECT * FROM $tabla WHERE $condicion";
        $resultado = $this->db->query($consulta);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function actualizar($tabla, $data, $condicion) {
        $consulta = "UPDATE " . $tabla . " SET " . $data . " WHERE " . $condicion;
        return $this->db->query($consulta);
    }

    public function eliminar($tabla, $condicion) {
        $eli = "DELETE FROM " . $tabla . " WHERE ". $condicion;
        try {
            return $this->db->query($eli);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
    public function codigoExiste($codigo) {
        $consulta = "SELECT COUNT(*) as total FROM trabajador WHERE codigo = :codigo";
        $stmt = $this->db->prepare($consulta);
        $stmt->bindParam(':codigo', $codigo);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['total'] > 0;
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

    public function obtenerIdPorCodigo($codigo) {
        // Prepara la consulta para evitar inyección SQL
        $stmt = $this->db->prepare("SELECT id FROM trabajador WHERE codigo = :codigo");
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_STR);
    
        // Ejecuta la consulta
        $stmt->execute();
    
        // Obtiene el resultado
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Devuelve el ID del trabajador si se encuentra, de lo contrario, devuelve null
        return $result ? $result['id'] : null;
    }

    public function obtenerCajasTotales() {
        $consulta = "
        SELECT 
            trabajador.id AS trabajador_id,
            CONCAT(persona.nombre, ' ', persona.apellido_paterno, ' ', persona.apellido_materno) AS nombre_completo,
            COUNT(caja_cosechero.id) AS total_cajas
            FROM 
            caja_cosechero
            JOIN 
            trabajador ON caja_cosechero.trabajador_id = trabajador.id
            JOIN 
            persona ON trabajador.persona_id = persona.id
            GROUP BY 
            trabajador.id";
    
        $stmt = $this->db->prepare($consulta);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function obtenerCajasPorTrabajador($fecha = null) {
        $consulta = "
        SELECT 
                        CONCAT(p.nombre, ' ', p.apellido_paterno, ' ', p.apellido_materno) AS nombre_completo, 
                        COUNT(c.id) AS total_cajas 
                     FROM trabajador t
                     JOIN persona p ON t.persona_id = p.id
                     JOIN caja_cosechero c ON t.id = c.trabajador_id";
    
        if ($fecha) {
            $consulta .= " WHERE DATE(c.created_at) = :fecha";
        }
    
        $consulta .= " GROUP BY t.id";
    
        $stmt = $this->db->prepare($consulta);
    
        if ($fecha) {
            $stmt->bindParam(':fecha', $fecha);
        }
    
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    

}