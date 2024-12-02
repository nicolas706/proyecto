<?php
require_once '../includes/db.php';
require_once '../modelo/trabajador.php';
require_once '../modelo/tarja.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = new DB();
    $db = $database->connect();

    $action = $_POST['action'] ?? '';

    if ($action === 'agregar_codigo') {
        $codigo_completo = $_POST['codigo_completo'];
        $tarja_id = $_POST['tarja_id'];

        // Obtener los primeros tres dígitos del código completo
        $codigo_trabajador = substr($codigo_completo, 0, 3);

        try {
            // Verificar si el código completo ya existe
            $stmt = $db->prepare("SELECT id FROM caja_cosechero WHERE codigo_completo = ?");
            $stmt->execute([$codigo_completo]);
            if ($stmt->rowCount() > 0) {
                echo "Error: El código completo ya existe.";
                exit;
            }

            // Buscar el trabajador correspondiente
            $trabajador = new Trabajador($db);
            $trabajador_id = $trabajador->obtenerIdPorCodigo($codigo_trabajador);

            if ($trabajador_id) {
                // Insertar en caja_cosechero usando el trabajador_id y el código completo
                $stmt = $db->prepare("
                    INSERT INTO caja_cosechero (tarja_id, trabajador_id, codigo_completo) 
                    VALUES (?, ?, ?)
                ");
                $stmt->execute([$tarja_id, $trabajador_id, $codigo_completo]);

                // Actualizar la cantidad de códigos registrados en la tarja
                $tarja = new Tarja($db);
                $tarja->actualizarCodigosRegistrados($tarja_id);

                echo "Código completo guardado exitosamente.";
            } else {
                echo "Error: Trabajador no encontrado.";
            }
        } catch (Exception $e) {
            echo "Error al agregar el código completo: " . $e->getMessage();
        }
    } else {
        $carro_id = $_POST['carro_id'];
        $huerto_id = $_POST['huerto_id'];
        $variedad_id = $_POST['variedad_id'];
        $tractorista_id = $_POST['tractorista_id'];
        $digitador_id = $_POST['digitador_id'];
        $tipo_caja_id = $_POST['tipo_caja_id'];
        $codigo = $_POST['codigo'];
        $total_fisico = $_POST['total_fisico'];

        // Obtener la fecha del día actual
        $fecha_cosecha = date('Y-m-d');
        $anio_cosecha = date('Y');

        try {
            // Verificar si el código de la tarja ya existe
            $stmt = $db->prepare("SELECT id FROM tarja WHERE codigo = ?");
            $stmt->execute([$codigo]);
            if ($stmt->rowCount() > 0) {
                echo "Error: El código de la tarja ya existe.";
                exit;
            }

            // Buscar o crear la entrada de cosecha
            $stmt = $db->prepare("SELECT id FROM cosecha WHERE anio = ?");
            $stmt->execute([$anio_cosecha]);
            $cosecha = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$cosecha) {
                // Crear una nueva entrada de cosecha si no existe
                $stmt = $db->prepare("INSERT INTO cosecha (anio, activa) VALUES (?, 1)");
                $stmt->execute([$anio_cosecha]);
                $cosecha_id = $db->lastInsertId();
            } else {
                $cosecha_id = $cosecha['id'];
            }

            $stmt = $db->prepare("
                INSERT INTO tarja (
                    cosecha_id, carro_id, variedad_huerto_id, trabajador_id, 
                    tipo_caja_id, codigo, total_fisico, fecha
                ) 
                VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
            ");
            $stmt->execute([
                $cosecha_id, $carro_id, $variedad_id, $tractorista_id,
                $tipo_caja_id, $codigo, $total_fisico
            ]);

            // Obtener el ID de la tarja recién insertada
            $tarja_id = $db->lastInsertId();

            echo "Tarja guardada exitosamente. Tarja ID: " . $tarja_id;
        } catch (Exception $e) {
            echo "Error al guardar la tarja: " . $e->getMessage();
        }
    }
}
?>