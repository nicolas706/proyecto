<?php
require_once dirname(__DIR__) . '/modelo/trabajador.php';
require_once(__DIR__ . "/../modelo/persona.php");
require_once(__DIR__ . "/../modelo/cosecha.php");
require_once(__DIR__ . "/../modelo/TipoTrabajo.php");

class trabajadorController {
    private $model;

    public function __construct() {
        $this->model = new Trabajador();
    }

    
    // Método para mostrar la lista de trabajadores
    static function index() {
        $trabajador = new Trabajador();
        $dato = $trabajador->mostrarConDetalles();
        require_once(__DIR__ . "/../vista/trabajador/index.php");
    }

    //nuevo
    static function nuevaTrabajador(){ 
        
        $cosechas = Cosecha::obtenerTodas();
        $tiposTrabajo = TipoTrabajo::obtenerTodos();
        $personas = Persona::obtenerTodas();
        require_once("vista/trabajador/nuevo.php");
    }

    //guardar
    static function guardarTrabajador() {
        if (isset($_POST['cosecha_id']) && isset($_POST['tipo_trabajo_id']) && isset($_POST['persona_id']) && isset($_POST['codigo'])) {
            $cosecha_id = $_POST['cosecha_id'];
            $tipo_trabajo_id = $_POST['tipo_trabajo_id'];
            $persona_id = $_POST['persona_id'];
            $codigo = $_POST['codigo'];
    
            $modelo = new Trabajador();
            
            // Validar si el código ya existe
            if ($modelo->codigoExiste($codigo)) {
                header("Location: index.php?m=trabajador&a=nuevo&msg=duplicado");
                exit;
            }
    
            $data = [
                'cosecha_id' => $cosecha_id,
                'tipo_trabajo_id' => $tipo_trabajo_id,
                'persona_id' => $persona_id,
                'codigo' => $codigo
            ];
    
            $resultado = $modelo->insertar('trabajador', $data);
    
            if ($resultado) {
                header("Location: index.php?m=trabajador&a=index&msg=success");
            } else {
                header("Location: index.php?m=trabajador&a=nuevo&msg=error");
            }
        } else {
            header("Location: index.php?m=trabajador&a=nuevo&msg=missing");
        }
        exit;
    }

    //editar
    static function editarTrabajador(){    
        $id = $_REQUEST['id'];
        $trabajador = new Trabajador();
        $dato = $trabajador->mostrar("trabajador","id=".$id);        
        require_once("vista/trabajador/editar.php");
    }

    //actualizar
    static function actualizarTrabajador() {
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
            
            header("Location: http://localhost/mvc/index.php?m=trabajador&a=index");
            exit;
        } else {
            echo "Error: Datos incompletos.<br>";
        }
    }

    //eliminar
    static function eliminarTrabajador(){    
        $id = $_REQUEST['id'];
        $trabajador = new Trabajador();
        $resultado = $trabajador->eliminar("trabajador","id=".$id);
        header("location: index.php?m=trabajador&a=index");
    }
    
    

    
}
