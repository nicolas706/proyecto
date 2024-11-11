<?php

<<<<<<< HEAD
if (isset($_GET['m'])) {
    if (method_exists("personaController", $_GET['m'])) {
        cosechaController::{$_GET['m']}();
    } elseif (method_exists("personaController", $_GET['m'])) {
        cosechaController::{$_GET['m']}();
    } elseif ($_GET['m'] == 'nuevaCosecha') {
        cosechaController::nuevaCosecha();
    } elseif ($_GET['m'] == 'guardarCosecha') {
        cosechaController::guardarCosecha();
    } elseif ($_GET['m'] == 'actualizarCosecha') {
        cosechaController::actualizar();
    } else {
        personaController::index();
    }
} else {
    cosechaController::index(); // Cambia esto para que la vista inicial sea la de cosechas
=======
$request = $_GET['route'] ?? ''; // Captura la ruta desde la URL

switch ($request) {
    case '':
    case 'cosecha':
        require_once 'controlador/cosechaController.php';
        $controller = new cosechaController();
        $controller->index();
        break;

    case 'persona':
        require_once 'controlador/personaController.php';
        $controller = new personaController();
        $controller->index();
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
>>>>>>> bfd1a8c90295479e588e7bc5126b4b6adaaa02d5
}
?> 