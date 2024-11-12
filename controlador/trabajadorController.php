<?php
require_once("modelo/trabajador.php");

class trabajadorController {
    private $model;

    public function __construct() {
        $this->model = new Trabajador();
    }

    // Método para mostrar la lista de trabajadores
    static function index() {
        $trabajador = new Trabajador();
        $dato = $trabajador->mostrar("trabajador", "1");
        require_once("vista/trabajador/index.php");
    }

    //nuevo
    static function nuevo(){        
        require_once("vista/trabajador/nuevo.php");
    }

    //guardar
    static function guardar() {
        if (isset($_POST['cosecha_id']) && isset($_POST['tipo_trabajo_id']) && isset($_POST['persona_id']) && isset($_POST['codigo'])) {
            $cosecha_id = $_POST['cosecha_id'];
            $tipo_trabajo_id = $_POST['tipo_trabajo_id'];
            $persona_id = $_POST['persona_id'];
            $codigo = $_POST['codigo'];
            $data = [
                'cosecha_id' => $cosecha_id,
                'tipo_trabajo_id' => $tipo_trabajo_id,
                'persona_id' => $persona_id,
                'codigo' => $codigo
            ];
            $modelo = new Trabajador();
            $resultado = $modelo->insertar('trabajador', $data);
            
            if ($resultado) {
                echo "Datos insertados correctamente.<br>";
            } else {
                echo "Error al insertar los datos.<br>";
            }
            
            header("Location: http://localhost/mvc/index.php?m=trabajador&updated=" . time()); 
            exit;
        } else {
            echo "Error: Datos incompletos.<br>";
        }
    }

    //editar
    static function editar(){    
        $id = $_REQUEST['id'];
        $trabajador = new Trabajador();
        $dato = $trabajador->mostrar("trabajador","id=".$id);        
        require_once("vista/trabajador/editar.php");
    }

    //actualizar
    static function actualizar() {
        if (isset($_POST['id']) && isset($_POST['cosecha_id']) && isset($_POST['tipo_trabajo_id']) && isset($_POST['persona_id']) && isset($_POST['codigo'])) {
            $id = $_POST['id'];
            $cosecha_id = $_POST['cosecha_id'];
            $tipo_trabajo_id = $_POST['tipo_trabajo_id'];
            $persona_id = $_POST['persona_id'];
            $codigo = $_POST['codigo'];
            $data = "cosecha_id='$cosecha_id', tipo_trabajo_id='$tipo_trabajo_id', persona_id='$persona_id', codigo='$codigo'";
            $modelo = new Trabajador();
            $resultado = $modelo->actualizar("trabajador", $data, "id=" . $id);
            
            if ($resultado) {
                echo "Datos actualizados correctamente.<br>";
            } else {
                echo "Error al actualizar los datos.<br>";
            }
            
            header("Location: http://localhost/mvc/index.php?m=trabajador");
            exit;
        } else {
            echo "Error: Datos incompletos.<br>";
        }
    }

    //eliminar
    static function eliminar(){    
        $id = $_REQUEST['id'];
        $trabajador = new Trabajador();
        $resultado = $trabajador->eliminar("trabajador","id=".$id);
        header("location:".urlsite);
    }
}
