<?php
require_once(__DIR__ . "/../layouts/header.php");
?>
<h1 class="text-center">EDITAR COSECHA</h1>
<form action="index.php?m=cosecha&a=editar" method="POST">
    <?php
    foreach($dato as $key => $value):
        foreach($value as $v):
        ?>
        <input type="number" value="<?php echo $v['año'] ?>" name="año" placeholder="INGRESE AÑO:" required> <br>
        <input type="text" value="<?php echo $v['activa'] ?>" name="activa" placeholder="ACTIVA (S/N):" required> <br>
        <input type="text" value="<?php echo $v['detalle'] ?>" name="detalle" placeholder="INGRESE DETALLE:" required> <br>
        <input type="hidden" name="m" value="actualizar"> <br>
        <input type="submit" class="btn" name="btn" value="ACTUALIZAR"> <br>
        <?php
        endforeach;
    endforeach;
    ?>
</form>
<?php
require_once(__DIR__ . "/../layouts/footer.php");
?>
