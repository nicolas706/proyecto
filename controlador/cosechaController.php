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
    // Método para guardar la nueva cosecha
static function guardarCosecha() {
    echo '<pre>';

    echo '</pre>';
    
    // Validar que los datos requeridos están presentes
    if (isset($_POST['anio']) && isset($_POST['activa']) && isset($_POST['detalle'])) {
        $anio = $_POST['anio']; // Cambiar 'anio' por 'anio' en todas partes para evitar problemas con caracteres especiales
        $activa = strtolower($_POST['activa']) === 's' ? 1 : 0; // Convertir 's' a 1, cualquier otra cosa a 0
        $detalle = trim($_POST['detalle']); // Eliminar espacios extra

        // Validar que no estén vacíos
        if (empty($anio) || empty($detalle)) {
            echo "Error: anio o Detalle no pueden estar vacíos.<br>";
            return;
        }

        // Preparar los datos
        $data = [
            'anio' => $anio,
            'activa' => $activa,
            'detalle' => $detalle
        ];

        // Instanciar el modelo y realizar la inserción
        $modelo = new Cosecha();
        try {
            $resultado = $modelo->insertar('cosecha', $data);

            if ($resultado) {
                echo "Datos insertados correctamente.<br>";
                header("Location: http://localhost/mvc/index.php?m=cosecha&a=index");
                exit;
            } else {
                echo "Error al insertar los datos.<br>";
            }
        } catch (Exception $e) {
            echo "Error al procesar la solicitud: " . $e->getMessage() . "<br>";
        }
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
    static function actualizarCosecha() {
        if (isset($_POST['id']) && isset($_POST['anio']) && isset($_POST['activa']) && isset($_POST['detalle'])) {
            $id = $_POST['id'];
            $anio = $_POST['anio'];
            $activa = $_POST['activa'];
            $detalle = $_POST['detalle'];
            $data = "anio='$anio', activa='$activa', detalle='$detalle'";
            $modelo = new Cosecha();
            $resultado = $modelo->actualizar("cosecha", $data, "id=" . $id);
            
            if ($resultado) {
                echo "Datos actualizados correctamente.<br>";
            } else {
                echo "Error al actualizar los datos.<br>";
            }
            
            header("Location: http://localhost/mvc/index.php?m=cosecha&a=index");
            exit;
        } else {
            echo "Error: Datos incompletos.<br>";
        }
    }
    

    //eliminar
    
    static function eliminarCosecha(){  
    if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {  
        $id = $_REQUEST['id'];
        $cosecha = new Cosecha();
        $resultado = $cosecha->eliminar("cosecha","id=".$id);
        if ($resultado) {
                echo "cosecha eliminada correctamente.";
            } else {
                echo "Error al eliminar la cosecha.";
            }
            
            // Redirigir a la lista de cosechas
            header("Location: index.php?m=cosecha&a=index");
            exit;
        } else {
            echo "Error: ID no proporcionado o vacío.";
        }
    }


    // Método para mostrar el formulario de nueva cosecha

    static function nuevaCosecha() {
        require_once("vista/cosecha/nuevo.php");

    }
}
?>


