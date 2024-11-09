<?php
require_once(__DIR__."/../layouts/header.php");
?>
<h1 class="text-center">NUEVO TRABAJO</h1>
<form action="index.php?m=guardar" method="POST">
    <input type="text" placeholder="INGRESE NOMBRE:" id="nombre" name="nombre" required>
    <br>
    <input type="text" placeholder="INGRESE DESCRIPCIÓN:" id="descripcion" name="descripcion" required>
    <br>
    <input type="submit" class="btn" name="btn" value="GUARDAR"> <br>
    <input type="hidden" name="m" value="guardar">
</form>
<?php
require_once(__DIR__."/../layouts/footer.php");
