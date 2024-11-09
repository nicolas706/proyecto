<?php
require_once("config.php");
require_once("controlador/personaController.php");
require_once("controlador/cosechaController.php");

if (isset($_GET['m'])) {
    if (method_exists("personaController", $_GET['m'])) {
        personaController::{$_GET['m']}();
    } elseif (method_exists("cosechaController", $_GET['m'])) {
        cosechaController::{$_GET['m']}();
    } else {
        personaController::index();
    }
} else {
    personaController::index();
}
