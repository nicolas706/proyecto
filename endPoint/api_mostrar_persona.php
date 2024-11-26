<?php

// Habilitar CORS/PERMISOS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');

// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configuración de encabezado para devolver JSON
header('Content-Type: application/json');

// Se incluye el archivo del modelo
require_once dirname(__DIR__) . '\modelo\persona.php'; 

try {
    // Crear una instancia en base al constructor del modelo
    $persona = new Persona();
    // Establecer una condición vacía para obtener todos los registros
    $condicion = '1=1'; // Siempre verdadera, lo que equivale a no aplicar filtro

    //Se llama al método 'mostrar' para obtener los datos, encontrado en el modelo
    $datos = $persona->mostrar("persona", $condicion);

    // Devolver los datos como JSON
    echo json_encode([
        'success' => true,
        'data' => $datos
    ]); 

} catch (Exception $e) {
    // Manejar errores y devolverlos en formato JSON
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);

    // Registrar el error en el log del servidor
    error_log("Error en el endpoint: " . $e->getMessage());
}
