<?php
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = new DB();
    $db = $database->connect();

    $cosecha_id = $_POST['cosecha_id'];
    $carro_id = $_POST['carro_id'];
    $huerto_id = $_POST['huerto_id'];
    $variedad_id = $_POST['variedad_id'];
    $tractorista_id = $_POST['tractorista_id'];
    $digitador_id = $_POST['digitador_id'];
    $tipo_caja_id = $_POST['tipo_caja_id'];
    $codigo = $_POST['codigo'];
    $total_fisico = $_POST['total_fisico'];

    try {
        $stmt = $db->prepare("
            INSERT INTO tarja (
                cosecha_id, carro_id, variedad_huerto_id, trabajador_id, 
                tipo_caja_id, codigo, total_fisico, fecha
            ) 
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
        ");
        $stmt->execute([
            $cosecha_id, $carro_id, $variedad_id, $tractorista_id,
            $tipo_caja_id, $codigo, $total_fisico
        ]);

        echo "Tarja guardada exitosamente.";
    } catch (Exception $e) {
        echo "Error al guardar la tarja: " . $e->getMessage();
    }
}
?>
