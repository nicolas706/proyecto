<?php
require_once("modelo/persona.php");
require_once("modelo/cosecha.php");
//HOLA
class personaController {
    private $model;

    public function __construct() {
        $this->model = new Persona();
    }

    // Método para mostrar la lista de persona
    static function index() {
        $persona = new Persona();
        $dato = $persona->mostrar("persona", "1");
        require_once("vista/persona/index.php");
    }
    
    //nuevo
    static function nuevo(){        
        $cosecha = new Cosecha();
        if ($cosecha->hayCosechas()) {
            require_once("vista/persona/nuevo.php");
        } else {
            echo "Debe registrar una cosecha antes de ingresar persona.";
            echo "<br><a href='index.php?m=nuevaCosecha'>Registrar Cosecha</a>";
        }
    }
    

    //guardar
    static function guardar() {
        if (isset($_POST['nombre']) && isset($_POST['apellido_paterno']) && isset($_POST['apellido_materno']) && isset($_POST['rut']) && isset($_POST['sexo']) && isset($_POST['fecha_de_nacimiento']) && isset($_POST['telefono'])) {
            $nombre = $_POST['nombre'];
            $apellido_paterno = $_POST['apellido_paterno'];
            $apellido_materno = $_POST['apellido_materno'];
            $rut = $_POST['rut'];
            $sexo = $_POST['sexo'];
            $fecha_de_nacimiento = $_POST['fecha_de_nacimiento'];
            $telefono = $_POST['telefono'];
            $data = [
                'nombre' => $nombre,
                'apellido_paterno' => $apellido_paterno,
                'apellido_materno' => $apellido_materno,
                'rut' => $rut,
                'sexo' => $sexo,
                'fecha_de_nacimiento' => $fecha_de_nacimiento,
                'telefono' => $telefono
            ];
            $modelo = new Persona();
            $resultado = $modelo->insertar('persona', $data);
            
            if ($resultado) {
                echo "Datos insertados correctamente.<br>";
            } else {
                echo "Error al insertar los datos.<br>";
            }
            
            header("Location: http://localhost/mvc/index.php?updated=" . time()); 
            exit;
        } else {
            echo "Error: Datos incompletos.<br>";
        }
    }

    //editar
    static function editar(){    
        $id = $_REQUEST['id'];
        $persona = new Persona();
        $dato = $persona->mostrar("persona","id=".$id);        
        require_once("vista/persona/editar.php");
    }

    //actualizar
    static function actualizar() {
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
            
            header("Location: http://localhost/mvc/index.php");
            exit;
        } else {
            echo "Error: Datos incompletos.<br>";
        }
    }

    //eliminar
    static function eliminar(){    
        $id = $_REQUEST['id'];
        $persona = new Persona();
        $resultado = $persona->eliminar("persona","id=".$id);
        header("location:".urlsite);
    }
}
