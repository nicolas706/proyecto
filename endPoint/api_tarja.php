<?php
// Habilitar CORS/PERMISOS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');


header('Content-Type: application/json');

try {
    $dsn = "mysql:host=localhost;dbname=e-cosecha;charset=utf8";
    $db = new PDO($dsn, "root", ""); // Usuario root sin contraseña
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener cosechas activas
    $cosechas = $db->query("SELECT id, anio, activa FROM cosecha WHERE activa = 1")->fetchAll(PDO::FETCH_ASSOC);

    // Obtener carros
    $carros = $db->query("SELECT id, nombre FROM carro")->fetchAll(PDO::FETCH_ASSOC);

    // Obtener huertos
    $huertos = $db->query("SELECT id, nombre FROM huerto")->fetchAll(PDO::FETCH_ASSOC);

    //Obtiene las variedades de cada huerto
    $variedad = $db->query("
            SELECT h.id, h.nombre, v.nombre 
            FROM HUERTO h JOIN variedad_huerto vh ON h.id = vh.huerto_id
            JOIN variedad v ON vh.variedad_id = v.id")->fetchAll(PDO::FETCH_ASSOC);

    // Obtener trabajadores (tractoristas y digitadores)
    $trabajadores = $db->query("
        SELECT trabajador.id, tipo_trabajo_id, CONCAT(persona.nombre, ' ', persona.apellido_paterno) AS nombre
        FROM trabajador 
        INNER JOIN persona ON trabajador.persona_id = persona.id
    ")->fetchAll(PDO::FETCH_ASSOC);

    // Obtener tipos de caja
    $tipo_cajas = $db->query("SELECT id, nombre FROM tipo_caja")->fetchAll(PDO::FETCH_ASSOC);

    // Preparar la respuesta
    $response = [
        'success' => true,
        'data' => [
            'cosechas' => $cosechas,
            'carros' => $carros,
            'huertos' => $huertos,
            'variedades' => $variedad,
            'trabajadores' => $trabajadores,
            'tipo_cajas' => $tipo_cajas
        ]
    ];

    // Enviar la respuesta como JSON
    echo json_encode($response);

} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => "Error al consultar la base de datos: " . $e->getMessage()
    ]);
    exit;
}
