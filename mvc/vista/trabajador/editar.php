<?php
require_once(__DIR__."/../layouts/header.php");
?>
<h1 class="text-center">EDITAR TRABAJADOR</h1>
<form action="index.php?m=trabajador&a=actualizar" method="POST">
<?php
    if (!empty($dato)) {
        foreach ($dato as $key => $value) {
            foreach ($value as $v) {
                ?>    
                <input type="hidden" name="id" value="<?php echo $v['id']; ?>">
                <input type="text" value="<?php echo $v['cosecha_id']; ?>" name="cosecha_id" placeholder="INGRESE COSECHA:" required> <br>
                <input type="text" value="<?php echo $v['tipo_trabajo_id']; ?>" name="tipo_trabajo_id" placeholder="INGRESE TIPO DE TRABAJO:" required> <br>
                <input type="text" value="<?php echo $v['persona_id']; ?>" name="persona_id" placeholder="INGRESE PERSONA:" required> <br>
                <input type="text" value="<?php echo $v['codigo']; ?>" name="codigo" placeholder="INGRESE CODIGO:" required> <br>                
                <br>
                <?php
            }
        }
    } else {
        echo "Error: No se encontraron datos para editar.";
    }
    ?>
</form>
<?php
require_once(__DIR__ . "/../layouts/footer.php");
?>
