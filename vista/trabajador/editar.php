<?php require_once(__DIR__ . "/../layouts/header.php"); ?>
<h1 class="text-center">Editar Trabajador</h1>

<form action="index.php?m=trabajador&a=actualizar" method="POST">
    <?php if (!empty($dato)): ?>
        <?php foreach ($dato as $key => $value): ?>
            <input type="hidden" name="id" value="<?php echo $value['id']; ?>">

            <!-- Selección de Persona -->
            <label for="persona_id">Persona:</label>
            <select name="persona_id" id="persona_id" required>
                <?php foreach ($personas as $persona): ?>
                    <option value="<?php echo $persona['id']; ?>" <?php echo ($persona['id'] == $value['persona_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($persona['nombre'] . ' ' . $persona['apellido_paterno'] . ' ' . $persona['apellido_materno']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>

            <!-- Selección de Tipo de Trabajo -->
            <label for="tipo_trabajo_id">Tipo de Trabajo:</label>
            <select name="tipo_trabajo_id" id="tipo_trabajo_id" required>
                <?php foreach ($tiposTrabajo as $tipo): ?>
                    <option value="<?php echo $tipo['id']; ?>" <?php echo ($tipo['id'] == $value['tipo_trabajo_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($tipo['nombre']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>

            <!-- Selección de Año de Cosecha -->
            <label for="cosecha_id">Año de Cosecha:</label>
            <select name="cosecha_id" id="cosecha_id" required>
                <?php foreach ($cosechas as $cosecha): ?>
                    <option value="<?php echo $cosecha['id']; ?>" <?php echo ($cosecha['id'] == $value['cosecha_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($cosecha['anio']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>

            <input type="submit" class="btn" value="Actualizar">
            <br>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Error: No se encontraron datos para editar.</p>
    <?php endif; ?>
</form>
<?php require_once(__DIR__ . "/../layouts/footer.php"); ?>
