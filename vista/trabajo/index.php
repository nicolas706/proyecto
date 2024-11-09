<?php
require_once(__DIR__ . "/../layouts/header.php");
?>
<h1 class="text-center">LISTA DE TRABAJOS</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>DESCRIPCIÓN</th>
            <th>ACCIÓN</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(!empty($dato)):
                foreach($dato as $key => $value)
                    foreach($value as $v):?>
                    <tr>
                        <td><?php echo htmlspecialchars($v['id']); ?></td>
                        <td><?php echo htmlspecialchars($v['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($v['descripcion']); ?></td>
                        <td>
                            <a class="btn" href="index.php?m=editarTrabajo&id=<?php echo htmlspecialchars($v['id']); ?>">EDITAR</a>
                            <a class="btn" href="index.php?m=eliminarTrabajo&id=<?php echo htmlspecialchars($v['id']); ?>" onclick="return confirm('¿ESTÁS SEGURO?');">ELIMINAR</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">NO HAY REGISTROS</td>
                </tr>
            <?php endif ?>
    </tbody>
</table>
<?php
require_once(__DIR__ . "/../layouts/footer.php");
