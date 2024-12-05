<?php
require_once dirname(__DIR__) . '/modelo/trabajador.php';
require_once(__DIR__ . "/../modelo/persona.php");
require_once(__DIR__ . "/../modelo/cosecha.php");
require_once(__DIR__ . "/../modelo/TipoTrabajo.php");
require_once(__DIR__ . "/../includes/db.php");

// Obtener listas para los selects
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

    // Nuevo trabajador
    static function nuevaTrabajador() {
        $cosechas = Cosecha::obtenerTodas();
        $tiposTrabajo = TipoTrabajo::obtenerTodos();
        $personas = Persona::obtenerTodas();
        require_once("vista/trabajador/nuevo.php");
    }

// Guardar trabajador
static function guardarTrabajador() {
    if (isset($_POST['cosecha_id']) && isset($_POST['tipo_trabajo_id']) && isset($_POST['persona_id']) && isset($_POST['codigo'])) {
        $cosecha_id = $_POST['cosecha_id'];
        $tipo_trabajo_id = $_POST['tipo_trabajo_id'];
        $persona_id = $_POST['persona_id'];
        $codigo = $_POST['codigo'];

        // Modelo del trabajador
        $modelo = new Trabajador();

        // Validar si el código ya existe
        if ($modelo->codigoExiste($codigo)) {
            header("Location: index.php?m=trabajador&a=nuevo&msg=duplicado");
            exit;
        }

        // Datos a insertar
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


    // Editar trabajador
    static function editarTrabajador() {    
        $id = $_REQUEST['id'];
        $trabajador = new Trabajador();
        $dato = $trabajador->mostrar("trabajador", "id=" . $id); 
    
        // Obtener listas para los selects
        $personas = Persona::obtenerTodas();
        $tiposTrabajo = TipoTrabajo::obtenerTodos();
        $cosechas = Cosecha::obtenerTodas();
    
        require_once(__DIR__ . "/../vista/trabajador/editar.php");
    }
    
    

    // Actualizar trabajador
    static function actualizarTrabajador() {
        if (isset($_POST['id']) && isset($_POST['cosecha_id']) && isset($_POST['tipo_trabajo_id']) && isset($_POST['persona_id'])) {
            $id = $_POST['id'];
            $cosecha_id = $_POST['cosecha_id'];
            $tipo_trabajo_id = $_POST['tipo_trabajo_id'];
            $persona_id = $_POST['persona_id'];
            $data = "cosecha_id='$cosecha_id', tipo_trabajo_id='$tipo_trabajo_id', persona_id='$persona_id'";
            $modelo = new Trabajador();
            $modelo->actualizar("trabajador", $data, "id=" . $id);
            header("Location: index.php?m=trabajador&a=index");
        }
    }
    // Eliminar trabajador
static function eliminarTrabajador() {
    if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        $trabajador = new Trabajador();

        // Intenta eliminar el trabajador
        $resultado = $trabajador->eliminar("trabajador", "id=" . $id);

        if ($resultado) {
            header("Location: index.php?m=trabajador&a=index&msg=eliminado");
        } else {
            header("Location: index.php?m=trabajador&a=index&msg=error");
        }
    } else {
        echo "Error: ID no proporcionado o inválido.";
    }
}

    
}