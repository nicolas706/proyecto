<?php
// Habilitar CORS/PERMISOS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');

// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

// Verificar si se especifica la función
if (!isset($_GET['funcion'])) {
    echo json_encode([
        'success' => false,
        'message' => 'No se especificó ninguna función a ejecutar.'
    ]);
    exit;
}

$funcion = $_GET['funcion'];

try {
    // Lógica para manejar diferentes funciones
    switch ($funcion) {
        case 'mostrarDatos':
            mostrarDatos();
            break;

        case 'mostrarFilas':
            mostrarFilas();
            break;

        default:
            echo json_encode([
                'success' => false,
                'message' => "La función '$funcion' no está definida."
            ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error en la ejecución: ' . $e->getMessage()
    ]);
}

function mostrarDatos(){
    try {
        $dsn = "mysql:host=localhost;dbname=e-cosecha;charset=utf8";
        $db = new PDO($dsn, "root", ""); // Usuario root sin contraseña
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        //Obtener lista de Tarjas
        $tarjas = $db->query("SELECT id, cosecha_id, carro_id, variedad_huerto_id, trabajador_id, tipo_caja_id, codigo, total_fisico, codigos_registrados, fecha FROM tarja")->fetchAll(PDO::FETCH_ASSOC);
    
        // Obtener cosechas activas
        $cosechas = $db->query("SELECT id, anio, activa FROM cosecha WHERE activa = 1")->fetchAll(PDO::FETCH_ASSOC);
    
        // Obtener carros
        $carros = $db->query("SELECT id, nombre FROM carro")->fetchAll(PDO::FETCH_ASSOC);
    
        // Obtener huertos
        $huertos = $db->query("SELECT id, nombre FROM huerto")->fetchAll(PDO::FETCH_ASSOC);
    
        //Obtiene las variedades de cada huerto
        $variedad = $db->query("
                SELECT v.id AS id_variedad, h.id AS id_huerto, v.nombre 
                FROM HUERTO h JOIN variedad_huerto vh ON h.id = vh.huerto_id
                JOIN variedad v ON vh.variedad_id = v.id ORDER BY h.id")->fetchAll(PDO::FETCH_ASSOC);
    
        // Obtener trabajadores (tractoristas y digitadores)
        $trabajadores = $db->query("
            SELECT trabajador.id, tipo_trabajo_id, CONCAT(persona.nombre, ' ', persona.apellido_paterno) AS nombre
            FROM trabajador 
            INNER JOIN persona ON trabajador.persona_id = persona.id
        ")->fetchAll(PDO::FETCH_ASSOC);
    
        // Obtener tipos de caja
        $tipo_cajas = $db->query("SELECT id, nombre, capacidad_kg FROM tipo_caja")->fetchAll(PDO::FETCH_ASSOC);

        //Obtiene la cantidad de cajas
        $cantCajas = $db->query("
                SELECT ta.id AS tarja_id, CONCAT(pe.nombre,' ' ,pe.apellido_paterno, ' ', pe.apellido_materno) AS nombre_cosechero, COUNT(*) AS cantidad_cajas
                FROM caja_cosechero ca
                JOIN tarja ta ON ca.tarja_id = ta.id
                JOIN trabajador tr ON ca.trabajador_id = tr.id
                JOIN persona pe ON tr.persona_id = pe.id
                GROUP BY pe.nombre, ta.id")->fetchAll(PDO::FETCH_ASSOC);
    
        $totalCajas = $db->query("
        SELECT ta.id, CONCAT(pe.nombre,' ' ,pe.apellido_paterno, ' ', pe.apellido_materno) AS nombre_cosechero, COUNT(*) AS cantidad_cajas
        FROM caja_cosechero ca
        JOIN tarja ta ON ca.tarja_id = ta.id
        JOIN trabajador tr ON ca.trabajador_id = tr.id
        JOIN persona pe ON tr.persona_id = pe.id
        GROUP BY pe.nombre")->fetchAll(PDO::FETCH_ASSOC);
        // Preparar la respuesta
        $response = [
            'success' => true,
            'data' => [
                'tarjas' => $tarjas,
                'cosechas' => $cosechas,
                'carros' => $carros,
                'huertos' => $huertos,
                'variedades' => $variedad,
                'trabajadores' => $trabajadores,
                'tipo_cajas' => $tipo_cajas,
                'cajas_cosechero' => $cantCajas,
                'total_cajas' => $totalCajas
            ]
        ];
    
        // Enviar la respuesta como JSON
        echo json_encode($response);
    
    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => "Error al consultar la base de datos: " . $e->getMessage()
        ]);
        exit;
    }
}

function mostrarFilas(){
    try {
        $dsn = "mysql:host=localhost;dbname=e-cosecha;charset=utf8";
        $db = new PDO($dsn, "root", ""); // Usuario root sin contraseña
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $filaTarja = $db->query("
                SELECT t.id AS tarja_id, t.codigo, co.anio, ca.nombre, per.nombre AS nombre_persona, tt.nombre AS tipo_trabajo,
                hu.nombre AS nombre_huerto, va.nombre AS nombre_variedad, tc.nombre AS nombre_tipo_caja, t.total_fisico, t.codigos_registrados 
                FROM `tarja` t 
                JOIN cosecha co ON t.cosecha_id = co.id
                JOIN carro ca ON t.carro_id = ca.id
                JOIN trabajador tra ON t.trabajador_id = tra.id
                JOIN persona per ON tra.persona_id = per.id
                JOIN tipo_trabajo tt ON tra.tipo_trabajo_id = tt.id
                JOIN variedad_huerto vh ON t.variedad_huerto_id = vh.id
                JOIN huerto hu ON vh.huerto_id = hu.id
                JOIN variedad va ON vh.variedad_id = va.id
                JOIN tipo_caja tc ON t.tipo_caja_id = tc.id
                ORDER BY t.id;")->fetchAll(PDO::FETCH_ASSOC);
        
        // Preparar la respuesta
        $response = [
            'success' => true,
            'data' => [
                'registroFila' => $filaTarja
            ]
        ];
    
        // Enviar la respuesta como JSON
        echo json_encode($response);

    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => "Error al consultar la base de datos: " . $e->getMessage()
        ]);
        exit;
    }
}