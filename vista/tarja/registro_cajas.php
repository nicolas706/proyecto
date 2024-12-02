<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Cajas por Trabajador</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <h1>Registro de Cajas por Trabajador</h1>
    <?php if (!empty($datos)): ?>
        <table>
            <thead>
                <tr>
                    <th>Nombre del Trabajador</th>
                    <th>Cantidad de Cajas</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datos as $dato): ?>
                    <tr>
                        <td><?= htmlspecialchars($dato['nombre_completo'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?= htmlspecialchars($dato['cantidad_cajas'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No se encontraron registros de cajas.</p>
    <?php endif; ?>
</body>
</html>