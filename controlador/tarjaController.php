<?php
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = new DB();
    $db = $database->connect();

    $action = $_POST['action'] ?? '';

    if ($action === 'agregar_codigo') {
        $codigo_completo = $_POST['codigo_completo'];
        $tarja_id = $_POST['tarja_id'];

        try {
            $stmt = $db->prepare("
                INSERT INTO caja_cosechero (tarja_id, codigo_completo) 
                VALUES (?, ?)
            ");
            $stmt->execute([$tarja_id, $codigo_completo]);

            echo "Código completo guardado exitosamente.";
        } catch (Exception $e) {
            echo "Error al agregar el código completo: " . $e->getMessage();
        }
    } else {
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

            // Obtener el ID de la tarja recién insertada
            $tarja_id = $db->lastInsertId();

            echo "Tarja guardada exitosamente. Tarja ID: " . $tarja_id;
        } catch (Exception $e) {
            echo "Error al guardar la tarja: " . $e->getMessage();
        }
    }
}
?>
