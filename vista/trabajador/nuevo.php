<?php require_once(__DIR__ . "/../layouts/header.php");?>
<?php
if (isset($_GET['action']) && $_GET['action'] === 'nuevo') 
?>

<h1>Registrar Nuevo Trabajador</h1>

<form action="index.php?m=trabajador&a=guardar" method="POST">
    <!-- Selección de Cosecha -->
    <label for="cosecha">Cosecha:</label>
    <select name="cosecha_id" id="cosecha">
        <?php foreach ($cosechas as $cosecha): ?>
            <option value="<?php echo $cosecha['id']; ?>"><?php echo $cosecha['anio']; ?></option>
        <?php endforeach; ?>
    </select>

    <!-- Selección de Tipo de Trabajo -->
    <label for="tipo_trabajo">Tipo de Trabajo:</label>
    <select name="tipo_trabajo_id" id="tipo_trabajo">
        <?php foreach ($tiposTrabajo as $tipo): ?>
            <option value="<?php echo $tipo['id']; ?>"><?php echo $tipo['nombre']; ?></option>
        <?php endforeach; ?>
    </select>

    <!-- Selección de Persona -->
    <label for="persona">Persona:</label>
    <select name="persona_id" id="persona">
        <?php foreach ($personas as $persona): ?>
            <option value="<?php echo $persona['id']; ?>"><?php echo $persona['nombre'] . ' ' . $persona['apellido_paterno'] . ' ' . $persona['apellido_materno']; ?></option>
        <?php endforeach; ?>
    </select>

    <!-- Campo para Código -->
    <label for="codigo">Código del Trabajador:</label>
    <input type="text" name="codigo" id="codigo" placeholder="Ingrese el código único" required>


    <button type="submit">Registrar</button>
</form>
<?php if (isset($_GET['msg'])): ?>
    <?php if ($_GET['msg'] === 'duplicado'): ?>
        <p class="error">El código ingresado ya existe. Por favor, use uno diferente.</p>
    <?php elseif ($_GET['msg'] === 'error'): ?>
        <p class="error">Error al guardar el trabajador. Intente nuevamente.</p>
    <?php elseif ($_GET['msg'] === 'missing'): ?>
        <p class="error">Faltan datos para guardar el trabajador.</p>
    <?php endif; ?>
<?php endif; ?>


<?php require_once(__DIR__ . "/../layouts/footer.php"); ?>
