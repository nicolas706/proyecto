<?php
require_once("layouts/header.php");
?>
<h1 class="text-center">NUEVO</h1>
<form action="index.php?m=guardar" method="POST">
    <input type="text" placeholder="INGRESE NOMBRE:" id="nombre" name="nombre" required>
    <br>
    <input type="text" placeholder="INGRESE APELLIDO PATERNO:" id="apellido_paterno" name="apellido_paterno" required>
    <br>
    <input type="text" placeholder="INGRESE APELLIDO MATERNO:" id="apellido_materno" name="apellido_materno" required>
    <br>
    <input type="text" placeholder="INGRESE RUT:" id="rut" name="rut" maxlength="12" required>
    <br>
    <input type="text" placeholder="INGRESE SEXO:" id="sexo" name="sexo" required>
    <br>
    <input type="date" placeholder="INGRESE FECHA DE NACIMIENTO:" id="fecha_de_nacimiento" name="fecha_de_nacimiento" required>
    <br>
    <input type="text" placeholder="INGRESE TELEFONO:" id="telefono" name="telefono" required>
    <br>
    <input type="submit" class="btn" name="btn" value="GUARDAR"> <br>
    <input type="hidden" name="m" value="guardar">
</form>
<?php
require_once("layouts/footer.php");
?>
