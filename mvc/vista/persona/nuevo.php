<?php
require_once(__DIR__ . "/../layouts/header.php");
?>
<h1 class="text-center">NUEVA PERSONA</h1>
<form action="index.php?m=persona&a=guardar" method="POST">
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
    <input type="text" placeholder="INGRESE TELEFONO:" maxlength="12" id="telefono" name="telefono" required>
    <br>
    <input type="submit" class="btn" name="btn" value="GUARDAR"> <br>
</form>
<?php
require_once(__DIR__ . "/../layouts/footer.php");
?>
