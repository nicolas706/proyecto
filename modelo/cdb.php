<?php
class CodigoDeBarras {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=e-cosecha', "root", "");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Conexión exitosa.\n"; // Depuración
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage() . "\n";
        }
    }

    public function insertar($tabla, $data) {
        $consulta = "INSERT INTO " . $tabla . " (cosecha_anio, numero, cantidad_impresos, cantidad_entregados) VALUES (:cosecha_anio, :numero, :cantidad_impresos, :cantidad_entregados)";
        try {
            $stmt = $this->db->prepare($consulta);
            $stmt->bindParam(':cosecha_anio', $data['cosecha_anio']);
            $stmt->bindParam(':numero', $data['numero']);
            $stmt->bindParam(':cantidad_impresos', $data['cantidad_impresos']);
            $stmt->bindParam(':cantidad_entregados', $data['cantidad_entregados']);
            if ($stmt->execute()) {
                echo "Datos insertados correctamente.\n"; // Depuración
                return true;
            } else {
                echo "Error al insertar los datos: " . implode(", ", $stmt->errorInfo()) . "\n";
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage() . "\n";
            return false;
        }
    }
    public function mostrarSome($seleccion,$tabla,$condicion){
        $consul = "SELECT ".$seleccion." FROM " . $tabla . " WHERE " . $condicion . ";";
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

    public function generarNumeroAleatorio() {
        $randomPart = mt_rand(1000000000, 9999999999); // Parte aleatoria de 10 dígitos
        $ultimoCodigo = $this->obtenerUltimoCodigo();
        $incrementalPart = str_pad(pow(2, $ultimoCodigo), 3, '0', STR_PAD_LEFT); // Incrementar exponencialmente los últimos 3 dígitos
        return $randomPart . $incrementalPart;
    }
    
    private function obtenerUltimoCodigo() {
        $consulta = "SELECT MAX(CAST(SUBSTRING(numero, -3) AS UNSIGNED)) as ultimo_codigo FROM codigo_de_barras";
        try {
            $resu = $this->db->query($consulta);
            $fila = $resu->fetch(PDO::FETCH_ASSOC);
            return $fila['ultimo_codigo'] ?? 0;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return 0;
        }
    }
}