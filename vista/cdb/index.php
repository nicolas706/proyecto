<?php
require_once(__DIR__ . "/../layouts/header.php");
?>
<h1 class="text-center">LISTA DE CÓDIGOS DE BARRAS</h1>
<a href="index.php?m=cdb&a=nuevo" class="btn">NUEVO CÓDIGO DE BARRAS</a>
<table>
    <tr>
        <td>AÑO COSECHA</td>
        <td>NÚMERO</td>
        <td>CANTIDAD IMPRESOS</td>
        <td>CANTIDAD ENTREGADOS</td>
        <td>ACCIÓN</td>       
    </tr>
    <tbody>
        <?php
           
            if(!empty($dato)):
                foreach($dato as $key => $value)
                    foreach($value as $v):?>
                    <tr>
                        <td><?php echo $v['anio'] ?> </td>
                        <td><?php echo substr($v['numero'], -3) ?> </td> <!-- Mostrar solo los últimos 3 dígitos -->
                        <td><?php echo $v['cantidad_impresos'] ?> </td>
                        <td><?php echo $v['cantidad_entregados'] ?> </td>
                        <td>
                            <a class="btn" href="index.php?m=cdb&a=editar&id=<?php echo $v['id']?>">EDITAR</a>
                            <a class="btn" href="index.php?m=cdb&a=eliminar&id=<?php echo $v['id']?>" onclick="return confirm('ESTA SEGURO'); false">ELIMINAR</a>
                        </td>
                    </tr>
                    <?php echo $v['id']; // Depuración: imprime el ID ?>
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