<?php
require_once(__DIR__ . "/../layouts/header.php");
?>
<h1 class="text-center">EDITAR CÓDIGO DE BARRAS</h1>
<form action="index.php?m=cdb&a=actualizar" method="POST">
    <?php
    foreach($dato as $key => $value):
        foreach($value as $v):
    ?>
       
        <label for="cosecha_anio">Seleccione el Año de Cosecha:</label>
        <select id="cosecha_anio" name="cosecha_anio" required>
            <?php foreach ($cosechas as $cosecha): ?>
                <?php foreach ($cosecha as $c): ?>
                    <option value="<?php echo $c['anio']; ?>"><?php echo $c['anio']; ?></option>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </select>
        <br>
        <input type="hidden" value="<?php echo $v['id'] ?>" name="id"> <br>
        <input type="number" value="<?php echo $v['numero'] ?>" name="numero" placeholder="INGRESE NÚMERO:" required> <br>
        <input type="number" value="<?php echo $v['cantidad_impresos'] ?>" name="cantidad_impresos" placeholder="INGRESE CANTIDAD IMPRESOS:" required> <br>
        <input type="number" value="<?php echo $v['cantidad_entregados'] ?>" name="cantidad_entregados" placeholder="INGRESE CANTIDAD ENTREGADOS:" required> <br>
        <input type="submit" class="btn" name="btn" value="ACTUALIZAR"> <br>
    <?php
        endforeach;
    endforeach;
    ?>
</form>
<?php
require_once(__DIR__ . "/../layouts/footer.php");
?>