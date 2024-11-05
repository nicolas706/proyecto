<?php
require_once("layouts/header.php");
?>
<h1 class="text-center">NUEVO</h1>
<form action="index.php?m=guardar" method="POST">
    <input type="text" placeholder="INGRESE NOMBRE:" id="nombre" name="nombre" required>
    <br>
    <input type="text" placeholder="INGRESE APELLIDO:" id="apellido_paterno"  name="apellido_paterno" required>
    <br>
    <input type="submit" class="btn" name="btn" value="GUARDAR"> <br>
    <input type="hidden" name="m" value="guardar">
</form>
