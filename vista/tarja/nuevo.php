<?php
require_once '../../includes/db.php';

try {
    $database = new DB();
    $db = $database->connect();

    // Verifica datos de cosechas
    $cosechas = $db->query("SELECT id, anio FROM cosecha WHERE activa = 1")->fetchAll(PDO::FETCH_ASSOC);
    if (empty($cosechas)) {
        echo "No se encontraron cosechas activas.<br>";
    }

    // Verifica datos de carros
    $carros = $db->query("SELECT id, nombre FROM carro")->fetchAll(PDO::FETCH_ASSOC);
    if (empty($carros)) {
        echo "No se encontraron carros.<br>";
    }

    // Verifica datos de huertos
    $huertos = $db->query("SELECT id, nombre FROM huerto")->fetchAll(PDO::FETCH_ASSOC);
    if (empty($huertos)) {
        echo "No se encontraron huertos.<br>";
    }

    // Verifica datos de trabajadores
    $trabajadores = $db->query("
        SELECT trabajador.id, tipo_trabajo_id, CONCAT(persona.nombre, ' ', persona.apellido_paterno) AS nombre
        FROM trabajador 
        INNER JOIN persona ON trabajador.persona_id = persona.id
    ")->fetchAll(PDO::FETCH_ASSOC);
    if (empty($trabajadores)) {
        echo "No se encontraron trabajadores.<br>";
    }

    // Verifica datos de tipo de caja
    $tipo_cajas = $db->query("SELECT id, nombre FROM tipo_caja")->fetchAll(PDO::FETCH_ASSOC);
    if (empty($tipo_cajas)) {
        echo "No se encontraron tipos de caja.<br>";
    }
} catch (PDOException $e) {
    die("Error al consultar la base de datos: " . $e->getMessage());
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ingresar Tarja</title>
    <script>
        async function cargarVariedades() {
            const huertoId = document.getElementById('huerto').value;

            if (huertoId) {
                const response = await fetch(`../../controlador/getVariedades.php?huerto_id=${huertoId}`);
                const variedades = await response.json();

                const variedadSelect = document.getElementById('variedad');
                variedadSelect.innerHTML = '<option value="">Seleccione una variedad</option>';

                variedades.forEach(variedad => {
                    const option = document.createElement('option');
                    option.value = variedad.id;
                    option.textContent = variedad.nombre;
                    variedadSelect.appendChild(option);
                });
            }
        }

        async function guardarTarja(event) {
            event.preventDefault();

            const formData = new FormData(document.getElementById('tarjaForm'));
            formData.append('action', 'guardar_tarja');

            const response = await fetch('../../controlador/tarjaController.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.text();
            const tarjaIdMatch = result.match(/Tarja ID: (\d+)/);

            if (tarjaIdMatch && tarjaIdMatch[1]) {
                const tarjaId = tarjaIdMatch[1];
                document.getElementById('codigoSection').innerHTML = `
                    <p>${result}</p>
                    <label for="codigo_completo">Código Completo:</label>
                    <input type="text" name="codigo_completo" id="codigo_completo" maxlength="6" required>
                    <button type="button" onclick="agregarCodigo(${tarjaId})">Agregar Código</button>
                `;
            } else {
                document.getElementById('codigoSection').innerHTML = `<p>${result}</p>`;
            }
        }

        async function agregarCodigo(tarjaId) {
            const codigoCompleto = document.getElementById('codigo_completo').value.padStart(6, '0');
            const formData = new FormData();
            formData.append('action', 'agregar_codigo');
            formData.append('codigo_completo', codigoCompleto);
            formData.append('tarja_id', tarjaId);

            const response = await fetch('../../controlador/tarjaController.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.text();
            alert(result);
        }
    </script>
</head>
<body>
    <h1>Ingresar Nueva Tarja</h1>
    <form id="tarjaForm" onsubmit="guardarTarja(event)">
        <!-- Tus campos actuales -->
        <label for="codigo">Código Tarja:</label>
        <input type="text" name="codigo" id="codigo" required>
        <br>

        <label for="cosecha">Año de Cosecha:</label>
        <select name="cosecha_id" id="cosecha" required>
            <?php foreach ($cosechas as $cosecha): ?>
                <option value="<?= $cosecha['id']; ?>"><?= $cosecha['anio']; ?></option>
            <?php endforeach; ?>
        </select>
        <br>

        <label for="carro">Carro:</label>
        <select name="carro_id" id="carro" required>
            <?php foreach ($carros as $carro): ?>
                <option value="<?= $carro['id']; ?>"><?= $carro['nombre']; ?></option>
            <?php endforeach; ?>
        </select>
        <br>

        <label for="huerto">Huerto:</label>
        <select name="huerto_id" id="huerto" onchange="cargarVariedades()" required>
            <option value="">Seleccione un huerto</option>
            <?php foreach ($huertos as $huerto): ?>
                <option value="<?= $huerto['id']; ?>"><?= $huerto['nombre']; ?></option>
            <?php endforeach; ?>
        </select>
        <br>

        <label for="variedad">Variedad:</label>
        <select name="variedad_id" id="variedad" required>
            <option value="">Seleccione un huerto primero</option>
        </select>
        <br>

        <label for="tractorista">Tractorista:</label>
        <select name="tractorista_id" id="tractorista" required>
            <?php foreach ($trabajadores as $trabajador): ?>
                <?php if ($trabajador['tipo_trabajo_id'] == 1): // 1 es Tractorista ?>
                    <option value="<?= $trabajador['id']; ?>"><?= $trabajador['nombre']; ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <br>

        <label for="digitador">Digitador:</label>
        <select name="digitador_id" id="digitador" required>
            <?php foreach ($trabajadores as $trabajador): ?>
                <?php if ($trabajador['tipo_trabajo_id'] == 2): // 2 es Digitador ?>
                    <option value="<?= $trabajador['id']; ?>"><?= $trabajador['nombre']; ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <br>

        <label for="tipo_caja">Tipo de Caja:</label>
        <select name="tipo_caja_id" id="tipo_caja" required>
            <?php foreach ($tipo_cajas as $tipo_caja): ?>
                <option value="<?= $tipo_caja['id']; ?>"><?= $tipo_caja['nombre']; ?></option>
            <?php endforeach; ?>
        </select>
        <br>

        <label for="total_fisico">Total Físico:</label>
        <input type="number" name="total_fisico" id="total_fisico" required>
        <br>

        <button type="submit">Guardar</button>
    </form>

    <div id="codigoSection"></div>
</body>
</html>

<?php
require_once(__DIR__ . "/../layouts/footer.php");
?>
