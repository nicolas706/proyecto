<?php
require_once("config.php");
require_once("controlador/personaController.php");
require_once("controlador/cosechaController.php");
require_once("controlador/trabajadorController.php");

if (isset($_GET['m'])) {
    if (method_exists("personaController", $_GET['m'])) {
        personaController::{$_GET['m']}();
    } elseif (method_exists("cosechaController", $_GET['m'])) {
        cosechaController::{$_GET['m']}();
    } elseif (method_exists("trabajadorController", $_GET['m'])) { // Agrega esta condición
        trabajadorController::{$_GET['m']}();
    } elseif ($_GET['m'] == 'nuevo') {
        personaController::nuevo();
    } elseif ($_GET['m'] == 'guardar') {
        personaController::guardar();
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
}
?>