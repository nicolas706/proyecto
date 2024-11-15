<?php
require_once(__DIR__ . "/../layouts/header.php");
?>
<h1 class="text-center">LISTA DE TRABAJADORES</h1>
<a href="index.php?m=trabajador&a=nuevo" class="btn">NUEVO</a>
<table>
    <tr>
        <td>CODIGO</td>
        <td>NOMBRE DE PERSONA</td>
        <td>TIPO DE TRABAJO</td>
        <td>AÑO DE COSECHA</td>
        <td>ACCIÓN</td>
    </tr>
    <tbody>
        <?php
            if(!empty($dato)):
                foreach($dato as $key => $value)
                    foreach($value as $v):?>
                    <tr>
                        <td><?php echo $v['codigo'] ?> </td>
                        <td><?php echo $v['persona_nombre'] . ' ' . $v['persona_apellido_paterno'] . ' ' . $v['persona_apellido_materno'] ?> </td>
                        <td><?php echo $v['tipo_trabajo_nombre'] ?> </td>
                        <td><?php echo $v['cosecha_año'] ?> </td>
                        <td>
                            <a class="btn" href="index.php?m=trabajador&a=editar&id=<?php echo $v['id']?>">EDITAR</a>
                            <a class="btn" href="index.php?m=trabajador&a=eliminar&id=<?php echo $v['id']?>" onclick="return confirm('ESTA SEGURO'); false">ELIMINAR</a>
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
require_once(__DIR__ . "/../layouts/footer.php");
?>

