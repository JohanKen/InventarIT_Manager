<?php
// Recibir los datos de dispositivos seleccionados de la URL
$datosDispositivos = isset($_GET['datos_dispositivos']) ? $_GET['datos_dispositivos'] : '';

// Convertir los datos de dispositivos seleccionados de JSON a un array
$dispositivosSeleccionados = json_decode('[' . $datosDispositivos . ']', true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paso 3 de la asignación</title>
</head>
<body>

    <br><br><br><br><br> <! Eliminar esta linea>
    <div class="contentSeccion">
        <div class="up">
            <header class="headerTabla">
                <h1>Paso 3 - Dispositivos Seleccionados</h1>
            </header>
        </div>

        <table id="dispositivosSeleccionados">
            <tr>
                <th>Id Dispositivo</th>
                <th>Tipo de dispositivo</th>
                <th>Modelo</th>
                <th>Número de Serie</th>
                <th>Marca</th>
            </tr>
            <tbody>
                <?php  
                // Mostrar los dispositivos seleccionados en la nueva tabla
                foreach ($dispositivosSeleccionados as $dispositivo) {
                    echo '<tr>';
                    echo '<td>' . $dispositivo['id'] . '</td>';
                    echo '<td>' . $dispositivo['tipo'] . '</td>';
                    echo '<td>' . $dispositivo['modelo'] . '</td>';
                    echo '<td>' . $dispositivo['serie'] . '</td>';
                    echo '<td>' . $dispositivo['marca'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>
