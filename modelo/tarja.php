 <?php

class Tarja {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function actualizarCodigosRegistrados($tarja_id) {
        $consulta = "
            UPDATE tarja 
            SET codigos_registrados = codigos_registrados + 1 
            WHERE id = ?
        ";
        try {
            $stmt = $this->db->prepare($consulta);
            return $stmt->execute([$tarja_id]);
        } catch (PDOException $e) {
            error_log("Error al actualizar los códigos registrados: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerCodigosRegistrados($tarja_id) {
        $consulta = "
            SELECT codigos_registrados 
            FROM tarja 
            WHERE id = ?
        ";
        try {
            $stmt = $this->db->prepare($consulta);
            $stmt->execute([$tarja_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC)['codigos_registrados'];
        } catch (PDOException $e) {
            error_log("Error al obtener los códigos registrados: " . $e->getMessage());
            return false;
        }
    }
}
?>