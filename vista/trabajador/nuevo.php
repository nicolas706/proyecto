<?php
require_once(__DIR__."/../layouts/header.php");
?>
<h1 class="text-center">NUEVO TRABAJADOR</h1>
<form action="index.php?m=guardarTrabajador" method="POST">
    <input type="text" placeholder="INGRESE COSECHA ID:" id="cosecha_id" name="cosecha_id" required>
    <br>
    <input type="text" placeholder="INGRESE TIPO TRABAJO ID:" id="tipo_trabajo_id" name="tipo_trabajo_id" required>
    <br>
    <input type="text" placeholder="INGRESE PERSONA ID:" id="persona_id" name="persona_id" required>
    <br>
    <input type="text" placeholder="INGRESE CODIGO:" id="codigo" name="codigo" required>
    <br>
    <input type="submit" class="btn" name="btn" value="GUARDAR"> <br>
    <input type="hidden" name="m" value="guardarTrabajador">
</form>
<?php
require_once(__DIR__."/../layouts/footer.php");
