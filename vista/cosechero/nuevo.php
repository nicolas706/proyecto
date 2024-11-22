<?php
require_once(__DIR__ . "/../layouts/header.php");
?>
<h1 class="text-center">NUEVO COSECHERO</h1>
<form action="index.php?m=cosechero&a=guardar" method="POST">
    <input type="number" placeholder="INGRESE COSECHA ID:" id="cosecha_id" name="cosecha_id" required>
    <br>
    <input type="number" placeholder="INGRESE PERSONA ID:" id="persona_id" name="persona_id" required>
    <br>
    <input type="number" placeholder="INGRESE CUADRILLA ID:" id="cuadrilla_id" name="cuadrilla_id" required>
    <br>
    <input type="number" placeholder="INGRESE CODIGO DE BARRAS ID:" id="codigo_de_barras_id" name="numero" required>
    <br>
    <input type="submit" class="btn" name="btn" value="GUARDAR"> <br>
</form>
<?php
require_once(__DIR__ . "/../layouts/footer.php");
?>