
<?php
require_once("modelo/cdb.php");
require_once("modelo/cosecha.php");

class cdbController {
    private $model;

    public function __construct() {
        $this->model = new CodigoDeBarras();
    }

    static function generar() {
        if (isset($_POST['generateBarcode'])) {
            $barcodeText = trim($_POST['barcodeText']);
            $barcodeType = $_POST['barcodeType'];
            $barcodeDisplay = $_POST['barcodeDisplay'];
            $barcodeSize = $_POST['barcodeSize'];
            $printText = $_POST['printText'];

            if ($barcodeText != '') {
                echo '<h4>Código de Barras:</h4>';
                echo '<img class="barcode" alt="' . $barcodeText . '" src="barcode.php?text=' . $barcodeText . '&codetype=' . $barcodeType . '&orientation=' . $barcodeDisplay . '&size=' . $barcodeSize . '&print=' . $printText . '"/>';
            } else {
                echo '<div class="alert alert-danger">Introduzca el texto para generar el código de barras</div>';
            }
        }
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
        if (isset($_POST['cosecha_id']) && isset($_POST['cantidad_impresos']) && isset($_POST['cantidad_entregados'])) {
            $cosecha_id = $_POST['cosecha_id'];
            $cantidad_impresos = $_POST['cantidad_impresos'];
            $cantidad_entregados = $_POST['cantidad_entregados'];
    
            // Depuración: Verificar datos recibidos
            echo "<pre>";
            print_r($_POST);
            echo "</pre>";
    
            // Crear instancia del modelo y generar el número aleatorio
            $modelo = new CodigoDeBarras();
            $numero = $modelo->generarNumeroAleatorio();
            $data = [
                'cosecha_id' => $cosecha_id,
                'numero' => $numero,
                'cantidad_impresos' => $cantidad_impresos,
                'cantidad_entregados' => $cantidad_entregados
            ];
    
            // Depuración: Mostrar los datos que serán insertados
            echo "Datos preparados para la inserción:<br>";
            print_r($data);
    
            // Intentar insertar los datos en la base de datos
            $resultado = $modelo->insertar('codigo_de_barras', $data);
    
            if ($resultado) {
                echo "Inserción exitosa.<br>";
                header("Location: http://localhost/mvc/index.php?m=cdb&msg=success");
                exit;
            } else {
                echo "Error al insertar los datos. Verifica el método `insertar` en el modelo.<br>";
                // Evitar redirección inmediata para mostrar errores
                exit;
            }
        } else {
            echo "Error: Datos incompletos o no enviados correctamente.<br>";
            echo "Contenido de POST:<br>";
            print_r($_POST);
            // Evitar redirección inmediata
            exit;
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
        if (isset($_POST['id']) && isset($_POST['cosecha_id']) && isset($_POST['numero']) && isset($_POST['cantidad_impresos']) && isset($_POST['cantidad_entregados'])) {
            $id = $_POST['id'];
            $cosecha_id = $_POST['cosecha_id'];
            $numero = $_POST['numero'];
            $cantidad_impresos = $_POST['cantidad_impresos'];
            $cantidad_entregados = $_POST['cantidad_entregados'];
            $data = "cosecha_id='$cosecha_id', numero='$numero', cantidad_impresos='$cantidad_impresos', cantidad_entregados='$cantidad_entregados'";
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