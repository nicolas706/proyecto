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
    <label for="cosecha_id">Seleccione el Año de Cosecha:</label>
    <select id="cosecha" name="cosecha_id" required>
        <?php foreach ($cosechas as $cosecha): ?>
            <?php foreach ($cosecha as $c): ?>
                <option value="<?php echo $c['id']; ?>"><?php echo $c['anio']; ?></option>
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
<h1>Generar Código de Barras</h1>
<form action="index.php?m=cdb&action=generar" method="post">
    <label for="barcodeText">Texto del Código de Barras:</label>
    <input type="text" name="barcodeText" required>
    
    <label for="barcodeType">Tipo de Código de Barras:</label>
    <select name="barcodeType">
        <option value="code128">Code 128</option>
        <option value="code39">Code 39</option>
        <!-- Agrega más tipos según sea necesario -->
    </select>
    
    <label for="barcodeDisplay">Orientación:</label>
    <select name="barcodeDisplay">
        <option value="horizontal">Horizontal</option>
        <option value="vertical">Vertical</option>
    </select>
    
    <label for="barcodeSize">Tamaño:</label>
    <input type="number" name="barcodeSize" value="20" required>
    
    <label for="printText">Imprimir Texto:</label>
    <select name="printText">
        <option value="true">Sí</option>
        <option value="false">No</option>
    </select>
    
    <button type="submit" name="generateBarcode">Generar Código de Barras</button>
</form>
<?php
require_once(__DIR__ . "/../layouts/footer.php");
?>