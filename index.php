<?php
$request = $_GET['m'] ?? ''; // Captura la ruta desde la URL
$action = $_GET['a'] ?? null; // Captura el id desde la URL, si existe

switch ($request) {
    case '':
    case 'cosecha':
        require_once 'controlador/cosechaController.php';
        $controller = new cosechaController();
        
        switch ($action) {
            case 'nuevo':
                $controller->nuevaCosecha();
                break;
                
            case 'guardar':
                $controller->guardarCosecha();
                break;
                
            case 'editar':
                $controller->editarCosecha();
                break;

            case 'eliminar':
                $controller->eliminarCosecha();
                break;

            default:
                $controller->index();
                break;
        }
        break;

    case 'persona':
        require_once 'controlador/personaController.php';
        $controller = new personaController();
        switch ($action) {
                
            case 'guardar':
                $controller->guardarPersona();
                break;

            case 'nuevo':
                $controller->nuevaPersona();
                break;
                
            case 'editar':
                $controller->editarPersona();
                break;

            case 'actualizar':
                $controller->actualizarPersona();
                break;

            case 'eliminar':
                $controller->eliminarPersona();
                break;

            default:
                $controller->index();
                break;
        }
        break;
    

    case 'trabajo':
        require_once 'controlador/trabajoController.php';
        $controller = new trabajoController();
        $controller->index();
        break;

    default:
        http_response_code(404);
        echo "404 - Página no encontrada";
        break;
}
?>