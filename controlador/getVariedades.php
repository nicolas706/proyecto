<?php
require_once '../includes/db.php';

// Conexión a la base de datos
$database = new DB();
$db = $database->connect();

if (isset($_GET['huerto_id'])) {
    $huerto_id = $_GET['huerto_id'];

    // Consulta para obtener las variedades según el huerto
    $stmt = $db->prepare("
        SELECT v.id, v.nombre 
        FROM variedad v
        JOIN variedad_huerto vh ON v.id = vh.variedad_id
        JOIN huerto h ON vh.huerto_id = h.id
        WHERE h.id = ?
    ");
    $stmt->execute([$huerto_id]);

    // Devuelve los resultados como JSON
    $variedades = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($variedades);
}
?>
