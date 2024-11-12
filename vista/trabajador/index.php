<?php
require_once(__DIR__."/../layouts/header.php");
?>
<h1 class="text-center">LISTA DE TRABAJADORES</h1>
<a href="index.php?m=nuevo" class="btn">NUEVO</a>
<table>
    <tr>
        <td>COSECHA ID</td>
        <td>TIPO TRABAJO ID</td>
        <td>PERSONA ID</td>
        <td>CODIGO</td>
        <td>ACCIÓN</td>       
    </tr>
    <tbody>
        <?php
            if(!empty($dato)):
                foreach($dato as $key => $value)
                    foreach($value as $v):?>
                    <tr>
                        <td><?php echo $v['cosecha_id'] ?> </td>
                        <td><?php echo $v['tipo_trabajo_id'] ?> </td>
                        <td><?php echo $v['persona_id'] ?> </td>
                        <td><?php echo $v['codigo'] ?> </td>
                        <td>
                            <a class="btn" href="index.php?m=editar&id=<?php echo $v['id']?>">EDITAR</a>
                            <a class="btn" href="index.php?m=eliminar&id=<?php echo $v['id']?>" onclick="return confirm('ESTA SEGURO'); false">ELIMINAR</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">NO HAY REGISTROS</td>
                </tr>
            <?php endif ?>
    </tbody>
</table>
<?php
require_once(__DIR__."/../layouts/footer.php");
