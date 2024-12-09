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
require_once dirname(__DIR__) . '\modelo\trabajador.php'; 

// Crear una instancia en base al constructor del modelo
$trabajador = new Trabajador();
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
        case 'mostrarTrabajador':
            mostrarTrabajador($trabajador, $condicion);
            break;

        case 'guardarTrabajador':
            guardarTrabajador($trabajador);
            break;

        case 'actualizarTrabajador':
            actualizarTrabajador($trabajador);
            break;
        
        case 'eliminarTrabajador':
            eliminarTrabajador($trabajador);
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
  Función para manejar la lógica de mostrartrabajador.
 */
function mostrarTrabajador($trabajador, $condicion) {
    try {
        //Se llama al método 'mostrar' para obtener los datos, encontrado en el modelo
        $datos = $trabajador->mostrarConDetalles();

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
 * Función para manejar la lógica de eliminarPersona.
 */
/*
function eliminarPersona($persona) {
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
        $resultado = $persona->eliminar(
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
*/