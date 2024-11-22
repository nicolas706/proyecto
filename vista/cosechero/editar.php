<?php
require_once(__DIR__ . "/../layouts/header.php");
?>
<h1 class="text-center">EDITAR COSECHERO</h1>
<form action="index.php?m=cosechero&a=editar" method="POST">
    <?php
    foreach($dato as $key => $value):
        foreach($value as $v):
        ?>
        <input type="hidden" value="<?php echo $v['id'] ?>" name="id"> <br>
        <input type="number" value="<?php echo $v['cosecha_id'] ?>" name="cosecha_id" placeholder="INGRESE COSECHA ID:" required> <br>
        <input type="number" value="<?php echo $v['persona_id'] ?>" name="persona_id" placeholder="INGRESE PERSONA ID:" required> <br>
        <input type="number" value="<?php echo $v['cuadrilla_id'] ?>" name="cuadrilla_id" placeholder="INGRESE CUADRILLA ID:" required> <br>
        <input type="number" value="<?php echo $v['codigo_de_barras_id'] ?>" name="codigo_de_barras_id" placeholder="INGRESE CODIGO DE BARRAS ID:" required> <br>
        <input type="submit" class="btn" name="btn" value="ACTUALIZAR"> <br>
        <?php
        endforeach;
    endforeach;
    ?>
</form>
<?php
require_once(__DIR__ . "/../layouts/footer.php");
?>