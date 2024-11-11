<?php

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
}
?> 