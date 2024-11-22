<?php
require_once("modelo/cosechero.php");

class cosecheroController {
    private $model;

    public function __construct() {
        $this->model = new Cosechero();
    }

    // Método para mostrar la lista de cosecheros
    static function index() {
        $cosechero = new Cosechero();
        $dato = $cosechero->mostrar("cosechero", "1");
        require_once("vista/cosechero/index.php");
    }

    // Método para mostrar el formulario de nuevo cosechero
    static function nuevoCosechero() {
        require_once("vista/cosechero/nuevo.php");
    }

    // Método para guardar un nuevo cosechero
    static function guardarCosechero() {
        if (isset($_POST['cosecha_id']) && isset($_POST['persona_id']) && isset($_POST['cuadrilla_id']) && isset($_POST['codigo_de_barras_id'])) {
            $cosecha_id = $_POST['cosecha_id'];
            $persona_id = $_POST['persona_id'];
            $cuadrilla_id = $_POST['cuadrilla_id'];
            $codigo_de_barras_id = $_POST['codigo_de_barras_id'];
            $data = [
                'cosecha_id' => $cosecha_id,
                'persona_id' => $persona_id,
                'cuadrilla_id' => $cuadrilla_id,
                'codigo_de_barras_id' => $codigo_de_barras_id
            ];
            $modelo = new Cosechero();
            $resultado = $modelo->insertar('cosechero', $data);
            
            if ($resultado) {
                echo "Datos insertados correctamente.<br>";
            } else {
                echo "Error al insertar los datos.<br>";
            }
            
            header("Location: http://localhost/mvc/index.php?m=cosechero&updated=" . time()); 
            exit;
        } else {
            echo "Error: Datos incompletos.<br>";
        }
    }

    // Método para mostrar el formulario de edición
    static function editarCosechero() {    
        if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            $cosechero = new Cosechero();
            $dato = $cosechero->mostrar("cosechero", "id=" . $id);        
            require_once("vista/cosechero/editar.php");
        } else {
            echo "Error: ID no proporcionado o vacío.";
        }
    }

    // Método para actualizar un cosechero existente
    static function actualizarCosechero() {
        if (isset($_POST['id']) && isset($_POST['cosecha_id']) && isset($_POST['persona_id']) && isset($_POST['cuadrilla_id']) && isset($_POST['codigo_de_barras_id'])) {
            $id = $_POST['id'];
            $cosecha_id = $_POST['cosecha_id'];
            $persona_id = $_POST['persona_id'];
            $cuadrilla_id = $_POST['cuadrilla_id'];
            $codigo_de_barras_id = $_POST['codigo_de_barras_id'];
            $data = "cosecha_id='$cosecha_id', persona_id='$persona_id', cuadrilla_id='$cuadrilla_id', codigo_de_barras_id='$codigo_de_barras_id'";
            $modelo = new Cosechero();
            $resultado = $modelo->actualizar("cosechero", $data, "id=" . $id);
            
            if ($resultado) {
                echo "Datos actualizados correctamente.<br>";
            } else {
                echo "Error al actualizar los datos.<br>";
            }
            
            header("Location: http://localhost/mvc/index.php?m=cosechero");
            exit;
        } else {
            echo "Error: Datos incompletos.<br>";
        }
    }

    // Método para eliminar un cosechero
    static function eliminarCosechero() {    
        if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            $cosechero = new Cosechero();
            $resultado = $cosechero->eliminar("cosechero", "id=" . $id);
            if ($resultado) {
                echo "Datos eliminados correctamente.<br>";
            } else {
                echo "Error al eliminar los datos.<br>";
            }
            header("Location: http://localhost/mvc/index.php?m=cosechero");
            exit;
        } else {
            echo "Error: ID no proporcionado o vacío.";
        }
    }
}