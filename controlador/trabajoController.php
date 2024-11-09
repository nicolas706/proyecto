<?php
require_once("modelo/trabajo.php");

class TrabajoController {
    private $model;

    public function __construct() {
        $this->model = new Trabajo();
    }

    // Método para mostrar la lista de trabajos
    static function index() {
        $trabajo = new Trabajo();
        $dato = $trabajo->mostrar("tipo_trabajo", "1");
        require_once("vista/trabajo/index.php");
    }
    
    //nuevo
    static function nuevo(){        
        require_once("vista/trabajo/nuevo.php");
    }

    //guardar
    static function guardar() {
        if (isset($_POST['nombre']) && isset($_POST['descripcion'])) {
            $nombre = htmlspecialchars($_POST['nombre']);
            $descripcion = htmlspecialchars($_POST['descripcion']);
            $data = [
                'nombre' => $nombre,
                'descripcion' => $descripcion
            ];
            $modelo = new Trabajo();
            $resultado = $modelo->insertar('tipo_trabajo', $data);
            
            if ($resultado) {
                echo "Datos insertados correctamente.<br>";
            } else {
                echo "Error al insertar los datos.<br>";
            }
            
            header("Location: index.php?m=mostrarTrabajos&updated=" . time()); 
            exit;
        } else {
            echo "Error: Datos incompletos.<br>";
        }
    }

    //editar
    static function editar(){    
        $id = $_REQUEST['id'];
        $trabajo = new Trabajo();
        $dato = $trabajo->mostrar("tipo_trabajo","id=".$id);        
        require_once("vista/trabajo/editar.php");
    }

    //actualizar
    static function actualizar() {
        if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['descripcion'])) {
            $id = htmlspecialchars($_POST['id']);
            $nombre = htmlspecialchars($_POST['nombre']);
            $descripcion = htmlspecialchars($_POST['descripcion']);
            $data = "nombre='$nombre', descripcion='$descripcion'";
            $modelo = new Trabajo();
            $resultado = $modelo->actualizar("tipo_trabajo", $data, "id=" . $id);
            
            if ($resultado) {
                echo "Datos actualizados correctamente.<br>";
            } else {
                echo "Error al actualizar los datos.<br>";
            }
            
            header("Location: index.php?m=mostrarTrabajos");
            exit;
        } else {
            echo "Error: Datos incompletos.<br>";
        }
    }

    //eliminar
    static function eliminar(){    
        $id = $_REQUEST['id'];
        $trabajo = new Trabajo();
        $resultado = $trabajo->eliminar("tipo_trabajo","id=".$id);
        header("location:index.php?m=mostrarTrabajos");
    }
}
