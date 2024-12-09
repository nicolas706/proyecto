<?php
require_once __DIR__ . '/../modelo/trabajador.php';
require __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Establecer encabezados para JSON
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');

// Si es una solicitud OPTIONS (preflight), termina aquí
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

try {
    // Leer datos JSON del cuerpo de la solicitud
    $inputJSON = file_get_contents('php://input');
    $inputData = json_decode($inputJSON, true);

    // Verificar que los datos sean válidos
    if (!isset($inputData['fecha'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Falta el campo "fecha".']);
        exit;
    }

    $fecha = $inputData['fecha'];

    // Obtener datos del modelo
    $trabajador = new Trabajador();
    $datos = $trabajador->obtenerCajasPorTrabajador($fecha);

    if (empty($datos)) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'No se encontraron datos para la fecha proporcionada.']);
        exit;
    }

    // Crear el archivo Excel
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Nombre del Trabajador');
    $sheet->setCellValue('B1', 'Cantidad de Cajas');

    $row = 2;
    foreach ($datos as $dato) {
        $sheet->setCellValue('A' . $row, $dato['nombre_completo']);
        $sheet->setCellValue('B' . $row, $dato['total_cajas']);
        $row++;
    }

    $writer = new Xlsx($spreadsheet);
    $filename = 'listado_cajas_por_trabajador.xlsx';

    // Establecer encabezados para la descarga del archivo
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . urlencode($filename) . '"');
    $writer->save('php://output');
    exit;

} catch (Exception $e) {
    // Manejar errores
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error del servidor: ' . $e->getMessage()]);
    exit;
}
