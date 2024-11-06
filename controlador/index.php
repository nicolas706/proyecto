<?php
require_once("modelo/index.php");

class modeloController {
    private $model;

    public function __construct() {
        $this->model = new Modelo();
    }

    // Método para mostrar la lista de personas
    static function index() {
        $persona = new Modelo();
        $dato = $persona->mostrar("persona", "1");
        require_once("vista/index.php");
    }
    
    //nuevo
    static function nuevo(){        
        require_once("vista/nuevo.php");
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
            $modelo = new Modelo();
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
        $persona = new Modelo();
        $dato = $persona->mostrar("persona","id=".$id);        
        require_once("vista/editar.php");
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
            $modelo = new Modelo();
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
        $persona = new Modelo();
        $resultado = $persona->eliminar("persona","id=".$id);
        header("location:".urlsite);
    }
}

// index.php o controlador correspondiente

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['m']) && $_GET['m'] == 'guardar') {
    // Incluye la clase modelo
    require_once('C:\xampp\htdocs\MVC\modelo\index.php');
    $modelo = new Modelo();

    // Recoger los datos del formulario
    $data = [
        'nombre' => $_POST['nombre'],
        'apellido_paterno' => $_POST['apellido_paterno']
    ];

    // Insertar en la base de datos
    $resultado = $modelo->insertar('persona', $data);

    if ($resultado) {
        // Redirigir o mostrar mensaje de éxito
        echo "Registro insertado correctamente.";
        header("Location: index.php"); // Redirige al listado
        exit;
    } else {
        echo "Error al insertar el registro.";
    }
}