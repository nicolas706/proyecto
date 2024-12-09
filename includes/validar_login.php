<?php
require_once 'db.php';

// Habilitar CORS
header('Access-Control-Allow-Origin: *'); // Permite cualquier origen
header('Access-Control-Allow-Methods: POST, GET, OPTIONS'); // Métodos permitidos
header('Access-Control-Allow-Headers: Content-Type, Authorization'); // Encabezados permitidos

// Manejo para solicitudes OPTIONS (Preflight)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204); // Sin contenido
    exit;
}

try {
    // Conexión a la base de datos
    $database = new DB();
    $db = $database->connect();

    // Leer datos del cliente
    $input = json_decode(file_get_contents("php://input"), true);

    if (!isset($input['username']) || !isset($input['password'])) {
        echo json_encode([
            "success" => false,
            "message" => "Faltan datos para el inicio de sesión."
        ]);
        exit;
    }

    $username = $input['username'];
    $password = md5($input['password']); // Encripta usando MD5

    // Consulta para validar el usuario
    $stmt = $db->prepare("SELECT id FROM usuarios WHERE username = :username AND password = :password LIMIT 1");
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":password", $password);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo json_encode([
            "success" => true,
            "message" => "Inicio de sesión exitoso."
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Usuario o contraseña incorrectos."
        ]);
    }
} catch (PDOException $e) {
    echo json_encode([
        "success" => false,
        "message" => "Error en el servidor: " . $e->getMessage()
    ]);
}
?>
