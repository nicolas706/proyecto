<?php
require_once("modelo/cosecha.php");

class cosechaController {
    private $model;

    public function __construct() {
        $this->model = new Cosecha();
    }

    // Método para mostrar la lista de cosechas
    static function index() {
        $cosecha = new Cosecha();
        $dato = $cosecha->mostrar("cosecha", "1");
        require_once("vista/cosecha/index.php");
    }
    
    //nuevo
    static function nuevo(){        
        require_once("vista/cosecha/nuevo.php");
    }

    //guardar
    static function guardar() {
        if (isset($_POST['año']) && isset($_POST['activa']) && isset($_POST['detalle'])) {
            $año = $_POST['año'];
            $activa = $_POST['activa'];
            $detalle = $_POST['detalle'];
            $data = [
                'año' => $año,
                'activa' => $activa,
                'detalle' => $detalle
            ];
            $modelo = new Cosecha();
            $resultado = $modelo->insertar('cosecha', $data);
            
            if ($resultado) {
                echo "Datos insertados correctamente.<br>";
            } else {
                echo "Error al insertar los datos.<br>";
            }
            
            header("Location: http://localhost/mvc/index.php?m=cosecha&updated=" . time()); 
            exit;
        } else {
            echo "Error: Datos incompletos.<br>";
        }
    }

    //editar
    static function editar(){    
        $id = $_REQUEST['id'];
        $cosecha = new Cosecha();
        $dato = $cosecha->mostrar("cosecha","id=".$id);        
        require_once("vista/cosecha/editar.php");
    }

    //actualizar
    static function actualizar() {
        if (isset($_POST['id']) && isset($_POST['año']) && isset($_POST['activa']) && isset($_POST['detalle'])) {
            $id = $_POST['id'];
            $año = $_POST['año'];
            $activa = $_POST['activa'];
            $detalle = $_POST['detalle'];
            $data = "año='$año', activa='$activa', detalle='$detalle'";
            $modelo = new Cosecha();
            $resultado = $modelo->actualizar("cosecha", $data, "id=" . $id);
            
            if ($resultado) {
                echo "Datos actualizados correctamente.<br>";
            } else {
                echo "Error al actualizar los datos.<br>";
            }
            
            header("Location: http://localhost/mvc/index.php?m=cosecha");
            exit;
        } else {
            echo "Error: Datos incompletos.<br>";
        }
    }

    //eliminar
    static function eliminar(){    
        $id = $_REQUEST['id'];
        $cosecha = new Cosecha();
        $resultado = $cosecha->eliminar("cosecha","id=".$id);
        header("location:".urlsite);
    }

    // Método para mostrar el formulario de nueva cosecha
static function nuevaCosecha() {
    require_once("vista/cosecha/nuevo.php");
}

// Método para guardar la nueva cosecha
static function guardarCosecha() {
    if (isset($_POST['año']) && isset($_POST['activa']) && isset($_POST['detalle'])) {
        $año = $_POST['año'];
        $activa = $_POST['activa'];
        $detalle = $_POST['detalle'];
        $data = [
            'año' => $año,
            'activa' => $activa,
            'detalle' => $detalle
        ];
        $modelo = new Cosecha();
        $resultado = $modelo->insertar('cosecha', $data);
        
        if ($resultado) {
            echo "Datos insertados correctamente.<br>";
        } else {
            echo "Error al insertar los datos.<br>";
        }
        
        header("Location: http://localhost/mvc/index.php?m=cosecha&updated=" . time()); 
        exit;
    } else {
        echo "Error: Datos incompletos.<br>";
    }
}

}

