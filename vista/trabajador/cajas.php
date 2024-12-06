<?php require_once(__DIR__ . "/../layouts/header.php"); ?>
<h1 class="text-center">Listado de Cajas por Trabajador</h1>

<!-- Filtro por fecha -->
<form method="GET" action="index.php">
    <input type="hidden" name="m" value="trabajador">
    <input type="hidden" name="a" value="cajas">
    <label for="fecha">Fecha:</label>
    <input type="date" name="fecha" id="fecha" value="<?php echo htmlspecialchars($_GET['fecha'] ?? ''); ?>">
    <button type="submit">Filtrar</button>
</form>

<!-- Enlace para descargar el archivo Excel -->
<a href="controlador/descargarCajas.php?fecha=<?php echo htmlspecialchars($_GET['fecha'] ?? ''); ?>" class="btn">Descargar en Excel</a>

<!-- Tabla de resultados -->
<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Total Cajas</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($dato)): ?>
            <?php foreach ($dato as $fila): ?>
                <tr>
                    <td><?php echo $fila['nombre_completo']; ?></td>
                    <td><?php echo $fila['total_cajas']; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="2">No hay datos disponibles.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php require_once(__DIR__ . "/../layouts/footer.php"); ?>