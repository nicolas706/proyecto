<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../modelo/trabajador.php';
require __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_GET['fecha'])) {
    $fecha = $_GET['fecha'];
} else {
    $fecha = null;
}

$trabajador = new Trabajador();
$datos = $trabajador->obtenerCajasPorTrabajador($fecha);

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

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . urlencode($filename) . '"');
$writer->save('php://output');
exit;
?>