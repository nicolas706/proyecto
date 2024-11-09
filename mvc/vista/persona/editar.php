<?php
require_once(__DIR__."/../layouts/header.php");
?>
<h1 class="text-center">EDITAR</h1>
<form action="index.php?m=actualizar" method="POST">
    <?php
    foreach($dato as $key => $value):
        foreach($value as $v):
        ?>
        <input type="text" value="<?php echo $v['nombre'] ?>" name="nombre" placeholder="INGRESE NOMBRE:" required> <br>
        <input type="text" value="<?php echo $v['apellido_paterno'] ?>" name="apellido_paterno" placeholder="INGRESE APELLIDO PATERNO:" required> <br>
        <input type="text" value="<?php echo $v['apellido_materno'] ?>" name="apellido_materno" placeholder="INGRESE APELLIDO MATERNO:" required> <br>
        <input type="text" value="<?php echo $v['rut'] ?>" name="rut" placeholder="INGRESE RUT:" maxlength="12" required> <br>
        <input type="text" value="<?php echo $v['sexo'] ?>" name="sexo" placeholder="INGRESE SEXO:" required> <br>
        <input type="date" value="<?php echo $v['fecha_de_nacimiento'] ?>" name="fecha_de_nacimiento" placeholder="INGRESE FECHA DE NACIMIENTO:" required> <br>
        <input type="text" value="<?php echo $v['telefono'] ?>" name="telefono" placeholder="INGRESE TELEFONO:" maxlength="12" required> <br>
        <input type="hidden" value="<?php echo $v['id'] ?>" name="id"> <br>
        <input type="submit" class="btn" name="btn" value="ACTUALIZAR"> <br>
        <?php
        endforeach;
    endforeach;
    ?>
</form>
<?php
require_once(__DIR__."/../layouts/footer.php");
?>
