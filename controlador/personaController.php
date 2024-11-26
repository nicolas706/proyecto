<?php
require_once dirname(__DIR__) . '/modelo/persona.php';


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
    
    

    //guardar
    static function guardarPersona() {
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
            $resultado = $modelo->insertar('persona', $data); //LLamado a la función que guarda los datos
            
            if ($resultado) {
                echo "Datos insertados correctamente.<br>";
            } else {
                echo "Error al insertar los datos.<br>";
            }
            
            header("Location: http://localhost/mvc/index.php?m=persona&a=index" . time()); 
            exit;
        } else {
            echo "Error: Datos incompletos.<br>";
        }
    }

    //nueva, llamado de la vista
    static function nuevaPersona() {
        require_once("vista/persona/nuevo.php");
    }
    

    //editar
    static function editarPersona(){    
        $id = $_REQUEST['id'];
        $persona = new Persona();
        $dato = $persona->mostrar("persona","id=".$id);        
        require_once("vista/persona/editar.php");
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
    static function eliminarPersona() {
        if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            $persona = new Persona();
            $resultado = $persona->eliminar("persona", "id=" . $id);
            
            if ($resultado) {
                echo "Persona eliminada correctamente.";
            } else {
                echo "Error al eliminar la persona.";
            }
            
            // Redirigir a la lista de personas
            header("Location: index.php?m=persona&a=index");
            exit;
        } else {
            echo "Error: ID no proporcionado o vacío.";
        }
    }
    
}
