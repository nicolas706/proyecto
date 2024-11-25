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
            
            case 'actualizar':
                $controller->actualizarCosecha();
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
        //testing
        switch ($action) {

            case 'nuevo':
                $controller->nuevaPersona();
                break;

            case 'guardar':
                $controller->guardarPersona();
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
    
        case 'trabajador':
            require_once 'controlador/trabajadorController.php';
            $controller = new trabajadorController();
            switch ($action) {
    
                case 'nuevo':
                    $controller->nuevaTrabajador();
                    break;
    
                case 'guardar':
                    $controller->guardarTrabajador();
                    break;
                    
                case 'editar':
                    $controller->editarTrabajador();
                    break;
    
                case 'actualizar':
                    $controller->actualizarTrabajador();
                    break;
    
                case 'eliminar':
                    $controller->eliminarTrabajador();
                    break;
    
                default:
                    $controller->index();
                    break;
            }
            break;


    default:
        http_response_code(404);
        echo "404 - Página no encontrada";
        break;
}
?>