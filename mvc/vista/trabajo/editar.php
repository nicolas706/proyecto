<?php
require_once(__DIR__ . "/../layouts/header.php");
?>
<h1 class="text-center">EDITAR TRABAJO</h1>
<form action="index.php?m=actualizarTrabajo" method="POST">
    <?php
    foreach($dato as $key => $value):
        foreach($value as $v):
        ?>
        <input type="hidden" value="<?php echo htmlspecialchars($v['id']); ?>" name="id"> <br>
        <label for="nombre">NOMBRE:</label>
        <input type="text" value="<?php echo htmlspecialchars($v['nombre']); ?>" name="nombre" required> <br>
        <label for="descripcion">DESCRIPCIÓN:</label>
        <textarea name="descripcion" required><?php echo htmlspecialchars($v['descripcion']); ?></textarea> <br>
        <input type="submit" class="btn" name="btn" value="ACTUALIZAR"> <br>
        <?php
        endforeach;
    endforeach;
    ?>
</form>
<?php
require_once(__DIR__ . "/../layouts/footer.php");
