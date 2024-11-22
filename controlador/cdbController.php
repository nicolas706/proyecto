
<?php
require_once("modelo/cdb.php");
require_once("modelo/cosecha.php");

class cdbController {
    private $model;

    public function __construct() {
        $this->model = new CodigoDeBarras();
    }

    // Método para mostrar la lista de códigos de barras
    static function index() {
        $cdb = new CodigoDeBarras();
        $dato = $cdb->mostrarSome("cosecha.anio,codigo_de_barras.id,codigo_de_barras.numero,codigo_de_barras.cantidad_impresos,codigo_de_barras.cantidad_entregados", "cosecha,codigo_de_barras", "codigo_de_barras.cosecha_id = cosecha.id");
        require_once("vista/cdb/index.php");
    }

    // Método para mostrar el formulario de nuevo código de barras
    static function nuevoCdb() {
        $cosecha = new Cosecha();
        $cosechas = $cosecha->mostrar("cosecha", "1");
        require_once("vista/cdb/nuevo.php");
    }

    // Método para guardar un nuevo código de barras
    static function guardarCdb() {
        if (isset($_POST['cosecha_anio']) && isset($_POST['cantidad_impresos']) && isset($_POST['cantidad_entregados'])) {
            $cosecha_anio = $_POST['cosecha_anio'];
            $cantidad_impresos = $_POST['cantidad_impresos'];
            $cantidad_entregados = $_POST['cantidad_entregados'];
            echo "Datos recibidos: Año=$cosecha_anio, Impresos=$cantidad_impresos, Entregados=$cantidad_entregados\n"; // Depuración
            $modelo = new CodigoDeBarras();
            $numero = $modelo->generarNumeroAleatorio();
            $data = [
                'cosecha_anio' => $cosecha_anio,
                'numero' => $numero,
                'cantidad_impresos' => $cantidad_impresos,
                'cantidad_entregados' => $cantidad_entregados
            ];
            echo "Datos a insertar: " . print_r($data, true) . "\n"; // Depuración
            $resultado = $modelo->insertar('codigo_de_barras', $data);
            if ($resultado) {
                echo "Datos insertados correctamente.\n";
                header("Location: index.php?m=cdb&msg=success");
            } else {
                echo "Error al insertar los datos.\n";
                header("Location: index.php?m=cdb&action=nuevo&msg=error");
            }
            exit;
        } else {
            echo "Error: Datos incompletos.\n";
            header("Location: index.php?m=cdb&action=nuevo&msg=missing");
        }
    }
    

    // Método para mostrar el formulario de edición
    static function editarCdb() {    
        if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            $cdb = new CodigoDeBarras();
            $dato = $cdb->mostrar("codigo_de_barras", "id=" . $id);
            $cosecha = new Cosecha();
            $cosechas = $cosecha->mostrar("cosecha", "1");
            require_once("vista/cdb/editar.php");
        } else {
            echo "Error: ID no proporcionado o vacío.";
        }
    }

    // Método para actualizar un código de barras existente
    static function actualizarCdb() {
        if (isset($_POST['id']) && isset($_POST['cosecha_anio']) && isset($_POST['numero']) && isset($_POST['cantidad_impresos']) && isset($_POST['cantidad_entregados'])) {
            $id = $_POST['id'];
            $cosecha_anio = $_POST['cosecha_anio'];
            $numero = $_POST['numero'];
            $cantidad_impresos = $_POST['cantidad_impresos'];
            $cantidad_entregados = $_POST['cantidad_entregados'];
            $data = "cosecha_anio='$cosecha_anio', numero='$numero', cantidad_impresos='$cantidad_impresos', cantidad_entregados='$cantidad_entregados'";
            $modelo = new CodigoDeBarras();
            $resultado = $modelo->actualizar("codigo_de_barras", $data, "id=" . $id);
            
            if ($resultado) {
                echo "Datos actualizados correctamente.<br>";
            } else {
                echo "Error al actualizar los datos.<br>";
            }
            
            header("Location: http://localhost/mvc/index.php?m=cdb");
            exit;
        } else {
            echo "Error: Datos incompletos.<br>";
        }
    }

    // Método para eliminar un código de barras
    static function eliminarCdb() {    
        if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            $cdb = new CodigoDeBarras();
            $resultado = $cdb->eliminar("codigo_de_barras", "id=" . $id);
            if ($resultado) {
                echo "Datos eliminados correctamente.<br>";
            } else {
                echo "Error al eliminar los datos.<br>";
            }
            header("Location: http://localhost/mvc/index.php?m=cdb");
            exit;
        } else {
            echo "Error: ID no proporcionado o vacío.";
        }
    }
}