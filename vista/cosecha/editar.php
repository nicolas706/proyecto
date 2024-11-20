<?php
require_once(__DIR__ . "/../layouts/header.php");
?>
<h1 class="text-center">EDITAR COSECHA</h1>
<form action="index.php?m=cosecha&a=actualizar" method="POST">
    <?php
    if (!empty($dato)) {
        foreach ($dato as $key => $value) {
            foreach ($value as $v) {
                ?>
                <input type="hidden" name="id" value="<?php echo $v['id']; ?>">
                <input type="number" value="<?php echo $v['anio']; ?>" name="anio" placeholder="INGRESE AÑO:" required> <br>
                <input type="text" value="<?php echo $v['activa']; ?>" name="activa" placeholder="ACTIVA (S/N):" required> <br>
                <input type="text" value="<?php echo $v['detalle']; ?>" name="detalle" placeholder="INGRESE DETALLE:" required> <br>
                <input type="submit" class="btn" name="btn" value="ACTUALIZAR"> <br>
                <?php
            }
        }
    } else {
        echo "Error: No se encontraron datos para editar.";
    }
    ?>
</form>
<?php
require_once(__DIR__ . "/../layouts/footer.php");
?>
