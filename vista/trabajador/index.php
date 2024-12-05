<?php require_once(__DIR__ . "/../layouts/header.php"); ?>

<h1 class="text-center">Lista de Trabajadores</h1>
<a href="index.php?m=trabajador&a=nuevo" class="btn">Nuevo Trabajador</a>

<table>
    <tr>
        <th>Persona</th>
        <th>Tipo de Trabajo</th>
        <th>Año de Cosecha</th>
        <th>Código</th>
        <th>Acciones</th>
    </tr>
    <tbody>
        <?php if (!empty($dato)): ?>
            <?php foreach ($dato as $trabajador): ?>
                <tr>
                    <td><?php echo $trabajador['persona_nombre']; ?></td>
                    <td><?php echo $trabajador['tipo_trabajo']; ?></td>
                    <td><?php echo $trabajador['cosecha_anio']; ?></td>
                    <td><?php echo $trabajador['codigo']; ?></td>
                    <td>
                        <a href="index.php?m=trabajador&a=editar&id=<?php echo $trabajador['id']; ?>" class="btn">Editar</a>
                        <a href="index.php?m=trabajador&a=eliminar&id=<?php echo $trabajador['id']; ?>" class="btn" onclick="return confirm('¿Estás seguro de eliminar este trabajador?');">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No hay registros</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php require_once(__DIR__ . "/../layouts/footer.php"); ?>
