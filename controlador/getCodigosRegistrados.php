<?php
require_once 'vista/layouts/includes/db.php';
require_once '../modelo/tarja.php';

if (isset($_GET['tarja_id'])) {
    $tarja_id = $_GET['tarja_id'];

    try {
        $database = new DB();
        $db = $database->connect();
        $tarja = new Tarja($db);
        $codigosRegistrados = $tarja->obtenerCodigosRegistrados($tarja_id);
        echo $codigosRegistrados;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Error: Tarja ID no proporcionado.";
}
?>