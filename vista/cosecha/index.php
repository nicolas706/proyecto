<?php
require_once(__DIR__ . "/../layouts/header.php");
require_once("controlador/cosechaController.php");
?>

<h1 class="text-center">LISTA DE COSECHAS</h1>
<a href="index.php?m=cosecha&a=nuevo" class="btn">NUEVA COSECHA</a>
<table>
    <tr>
        <td>AÑO</td>
        <td>ACTIVA</td> 
        <td>DETALLE</td>
        <td>ACCIÓN</td>       
    </tr>
    <tbody>
        <?php
            if(!empty($dato)):
                foreach($dato as $key => $value)
                    foreach($value as $v):?>
                    <tr>
                        <td><?php echo $v['año'] ?> </td>
                        <td><?php echo $v['activa'] ?> </td>
                        <td><?php echo $v['detalle'] ?> </td>
                        <td>
                            <a class="btn" href="index.php?m=cosecha&a=editar&id=<?php echo $v['id']?>">EDITAR</a>
                            <a class="btn" href="index.php?m=eliminarCosecha&id=<?php echo $v['id']?>" onclick="return confirm('ESTA SEGURO'); false">ELIMINAR</a>
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
