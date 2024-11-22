<?php
require_once(__DIR__ . "/../layouts/header.php");
?>
<h1 class="text-center">LISTA DE COSECHEROS</h1>
<a href="index.php?m=cosechero&a=nuevo" class="btn">NUEVO COSECHERO</a>
<table>
    <tr>
        <td>ID</td>
        <td>COSECHA ID</td>
        <td>PERSONA ID</td>
        <td>CUADRILLA ID</td>
        <td>CODIGO DE BARRAS ID</td>
        <td>ACCIÓN</td>       
    </tr>
    <tbody>
        <?php
            if(!empty($dato)):
                foreach($dato as $key => $value)
                    foreach($value as $v):?>
                    <tr>
                        <td><?php echo $v['id'] ?> </td>
                        <td><?php echo $v['cosecha_id'] ?> </td>
                        <td><?php echo $v['persona_id'] ?> </td>
                        <td><?php echo $v['cuadrilla_id'] ?> </td>
                        <td><?php echo $v['codigo_de_barras_id'] ?> </td>
                        <td>
                            <a class="btn" href="index.php?m=cosechero&a=editar&id=<?php echo $v['id']?>">EDITAR</a>
                            <a class="btn" href="index.php?m=cosechero&a=eliminar&id=<?php echo $v['id']?>" onclick="return confirm('ESTA SEGURO'); false">ELIMINAR</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">NO HAY REGISTROS</td>
                </tr>
            <?php endif ?>
    </tbody>
</table>
<?php
require_once(__DIR__ . "/../layouts/footer.php");
?>