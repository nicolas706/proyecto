<?php
// Habilitar CORS/PERMISOS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');

// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configuración de encabezado para devolver JSON
header('Content-Type: application/json');

// Se incluye el archivo del modelo
require_once dirname(__DIR__) . '\modelo\cosecha.php'; 

// Crear una instancia en base al constructor del modelo
$cosecha = new Cosecha();
// Establecer una condición vacía para obtener todos los registros
$condicion = '1=1'; 

// Verificar si se especifica la función
if (!isset($_GET['funcion'])) {
    echo json_encode([
        'success' => false,
        'message' => 'No se especificó ninguna función a ejecutar.'
    ]);
    exit;
}

// Obtener el nombre de la función
$funcion = $_GET['funcion'];

try {
    // Lógica para manejar diferentes funciones
    switch ($funcion) {
        case 'mostrarCosecha':
            mostrarCosecha($cosecha, $condicion);
            break;

        case 'guardarCosecha':
            guardarCosecha($cosecha);
            break;

        case 'actualizarCosecha':
            actualizarcosecha($cosecha);
            break;
        
        case 'eliminarCosecha':
            eliminarCosecha($cosecha);
            break;

        default:
            echo json_encode([
                'success' => false,
                'message' => "La función '$funcion' no está definida."
            ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error en la ejecución: ' . $e->getMessage()
    ]);
}

/*
  Función para manejar la lógica de mostrarCosecha.
 */
function mostrarCosecha($cosecha, $condicion) {
    try {
        //Se llama al método 'mostrar' para obtener los datos, encontrado en el modelo
        $datos = $cosecha->mostrar("cosecha", $condicion);

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
}

/**
 * Función para manejar la lógica de guardarCosecha.
 */
function guardarCosecha($cosecha) {
    try {
        // Leer los datos JSON enviados al endpoint
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        // Verificar si los datos son válidos
        if (!isset($data['anio']) || !isset($data['detalle']) || !isset($data['activa'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Datos incompletos para insertar.'
            ]);
            return;
        }

        // Insertar los datos en la base de datos
        $resultado = $cosecha->insertar("cosecha", $data);

        // Verificar si la operación fue exitosa
        if ($resultado) {
            echo json_encode([
                'success' => true,
                'message' => 'cosecha guardada exitosamente.'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'No se pudo guardar la cosecha.'
            ]);
        }

    } catch (Exception $e) {
        // Manejar errores y devolverlos en formato JSON
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);

        // Registrar el error en el log del servidor
        error_log("Error en el endpoint: " . $e->getMessage());
    }
}

/**
 * Función para manejar la lógica de actualizarcosecha$cosecha.
 */
function actualizarCosecha($cosecha) {
    try {
        $json = file_get_contents('php://input');
        $requestData = json_decode($json, true);

        if (!isset($requestData['tabla']) || !isset($requestData['data']) || !isset($requestData['condicion'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Parámetros insuficientes para actualizar.'
            ]);
            return;
        }

        $tabla = $requestData['tabla'];
        $data = $requestData['data'];
        $condicion = $requestData['condicion'];

        $resultado = $cosecha->actualizar($tabla, $data, $condicion);

        echo json_encode([
            'success' => $resultado,
            'message' => $resultado ? 'Registro actualizado exitosamente.' : 'No se pudo actualizar el registro.'
        ]);
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
        error_log("Error en el endpoint: " . $e->getMessage());
    }
}

function eliminarCosecha($cosecha) {
    try {
        // Leer los datos JSON enviados al endpoint
        $json = file_get_contents('php://input');
        $inputData = json_decode($json, true);

        // Validar los datos recibidos
        if (!isset($inputData['tabla']) || !isset($inputData['condicion'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Datos incompletos para eliminar.'
            ]);
            return;
        }

        // Llamar al modelo para realizar la eliminación
        $resultado = $cosecha->eliminar(
            $inputData['tabla'], 
            $inputData['condicion']
        );

        // Validar el resultado
        if ($resultado) {
            echo json_encode([
                'success' => true,
                'message' => 'Registro eliminado exitosamente.'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'No se eliminó ningún registro.'
            ]);
        }
    } catch (Exception $error) {
        // Manejar errores y devolverlos en formato JSON
        echo json_encode([
            'success' => false,
            'message' => 'Error en el servidor: ' . $error->getMessage()
        ]);

        // Registrar el error en el log del servidor
        error_log("Error en el endpoint: " . $error->getMessage());
    }
}