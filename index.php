<?php
session_start(); // Inicia la sesión

// Incluye las clases necesarias
require_once 'includes/user.php';
require_once 'includes/user_session.php';

// Captura parámetros de la URL
$request = $_GET['m'] ?? ''; // Ruta
$action = $_GET['a'] ?? null; // Acción

// Manejo de sesión
$userSession = new UserSession();
$user = new User();

// Verifica si hay una sesión activa
if (!$userSession->getCurrentUser()) {
    // Si no hay sesión, maneja el inicio de sesión
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $userForm = $_POST['username'];
        $passForm = $_POST['password'];

        // Valida usuario y contraseña
        if ($user->userExists($userForm, $passForm)) {
            // Usuario validado
            $userSession->setCurrentUser($userForm);
            $user->setUser($userForm);
            header("Location: index.php"); // Redirige a la página principal
            exit;
        } else {
            // Credenciales incorrectas
            $errorLogin = "Nombre de usuario y/o contraseña incorrecto";
        }
    }
    // Muestra la vista de inicio de sesión
    include 'vista/login.php';
    exit;
}

// Si hay sesión activa, carga la aplicación principal
include 'vista/layouts/header.php';

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