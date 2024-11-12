<?php
require_once dirname(__DIR__) . '/modelo/cosecha.php';



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

    //editar

    static function editarCosecha() {    
        if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            $cosecha = new Cosecha();
            $dato = $cosecha->mostrar("cosecha", "id=" . $id);        
            require_once("vista/cosecha/editar.php");
        } else {
            echo "Error: ID no proporcionado o vacío.";
        }

    }
    

    //actualizar
    static function actualizarPersona() {
        if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['apellido_paterno']) && isset($_POST['apellido_materno']) && isset($_POST['rut']) && isset($_POST['sexo']) && isset($_POST['fecha_de_nacimiento']) && isset($_POST['telefono'])) {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $apellido_paterno = $_POST['apellido_paterno'];
            $apellido_materno = $_POST['apellido_materno'];
            $rut = $_POST['rut'];
            $sexo = $_POST['sexo'];
            $fecha_de_nacimiento = $_POST['fecha_de_nacimiento'];
            $telefono = $_POST['telefono'];
            $data = "nombre='$nombre', apellido_paterno='$apellido_paterno', apellido_materno='$apellido_materno', rut='$rut', sexo='$sexo', fecha_de_nacimiento='$fecha_de_nacimiento', telefono='$telefono'";
            $modelo = new Persona();
            $resultado = $modelo->actualizar("persona", $data, "id=" . $id);
            
            if ($resultado) {
                echo "Datos actualizados correctamente.<br>";
            } else {
                echo "Error al actualizar los datos.<br>";
            }
            
            header("Location: http://localhost/mvc/index.php?m=persona&a=index");
            exit;
        } else {
            echo "Error: Datos incompletos.<br>";
        }
    }
    

    //eliminar
    
    static function eliminarCosecha(){    
        $id = $_REQUEST['id'];
        $cosecha = new Cosecha();
        $resultado = $cosecha->eliminar("cosecha","id=".$id);
        header("location:".urlsite);
    }


    // Método para mostrar el formulario de nueva cosecha

    static function nuevaCosecha() {
        require_once("vista/cosecha/nuevo.php");

    }
}
?>


