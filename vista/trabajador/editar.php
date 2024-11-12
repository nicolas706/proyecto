<?php
require_once(__DIR__."/../layouts/header.php");
?>
<h1 class="text-center">EDITAR TRABAJADOR</h1>
<form action="index.php?m=actualizar" method="POST">
    <input type="hidden" id="id" name="id" value="<?php echo $dato[0]['id']; ?>">
    <input type="text" placeholder="INGRESE COSECHA ID:" id="cosecha_id" name="cosecha_id" value="<?php echo $dato[0]['cosecha_id']; ?>" required>
    <br>
    <input