<?php require_once(__DIR__ . "/../layouts/header.php"); ?>

<?php if (isset($_GET['msg'])): ?>
    <?php if ($_GET['msg'] == 'success'): ?>
        <p style="color: green;">Datos insertados correctamente.</p>
    <?php elseif ($_GET['msg'] == 'error'): ?>
        <p style="color: red;">Error al insertar los datos.</p>
    <?php elseif ($_GET['msg'] == 'missing'): ?>
        <p style="color: red;">Error: Datos incompletos.</p>
    <?php endif; ?>
<?php endif; ?>

<h1 class="text-center">NUEVO CÓDIGO DE BARRAS</h1>
<form action="index.php?m=cdb&a=guardar" method="POST">
    <label for="cosecha_anio">Seleccione el Año de Cosecha:</label>
    <select id="cosecha_anio" name="cosecha_anio" required>
        <?php foreach ($cosechas as $cosecha): ?>
            <?php foreach ($cosecha as $c): ?>
                <option value="<?php echo $c['anio']; ?>"><?php echo $c['anio']; ?></option>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </select>
    <br>
    <input type="number" placeholder="INGRESE CANTIDAD IMPRESOS:" id="cantidad_impresos" name="cantidad_impresos" required>
    <br>
    <input type="number" placeholder="INGRESE CANTIDAD ENTREGADOS:" id="cantidad_entregados" name="cantidad_entregados" required>
    <br>
    <input type="submit" class="btn" name="btn" value="GUARDAR"> <br>
</form>
<?php
require_once(__DIR__ . "/../layouts/footer.php");
?>