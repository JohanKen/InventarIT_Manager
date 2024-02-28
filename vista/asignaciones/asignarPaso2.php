<?php
// Este es asignarPaso2.php
require_once 'controlador/ControladorColaboradores.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');

$datoscolaborador = ControladorColaboradores::detalleColaborador();
//$dispositivosSeleccionados = [];

/*if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['continuar'])) {
    // Obtener datos de dispositivos seleccionados
    $colaboradorSeleccionado = $datoscolaborador[0]["id_colaborador"];

    // Redirigir a la nueva página y pasar datos como parámetros GET
    $queryParameters = http_build_query([
        'id_colaborador' => $colaboradorSeleccionado,
        'dispositivos' => $dispositivosSeleccionados,
    ]);

    header("Location: index.php?seccion=asignaciones/asignarPaso3&$queryParameters");
    exit();
}*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paso 2 de la asignación</title>
</head>
<body>
    <br><br><br><br><br><br><br> <!-- Eliminar esto en el futuro -->
    <div class="contentSeccion">
        <div class="up">
            <header class="headerTabla">
                <h1>Paso 2 - Elegir Dispositivo</h1>
            </header>
        </div>

        <?php if (isset($datoscolaborador) && is_array($datoscolaborador) && isset($datoscolaborador)) : ?>
            <div action="mb-3" method="formForm">
                <label for="nombre_colaborador" class="form-label">Colaborador Seleccionado:</label>
                <input type="text" class="form-control" name="nombre_colaborador" value="<?= $datoscolaborador[0]["nombre_colaborador"] . ' ' . $datoscolaborador[0]["apellido_paterno_colaborador"] ?>" readonly>
            </div>
        <?php else : ?>
            <p>El array $datoscolaborador no está definido o no tiene la estructura esperada.</p>
        <?php endif; ?>

        <div class="mb-3" id="formForm">
            <label for="tipo_dispositivo" class="form-label">Selecciona un Tipo de Dispositivo a Asignar</label>
            <select name="tipo_dispositivo" class="form-control" id="tipo_dispositivo" onchange="cargarDispositivos()">
                <option value="0" disabled selected>-- Seleccione el Tipo de Dispositivo --</option>
                <option value="1">Laptop</option>
                <option value="2">Desktop</option>
                <option value="3">iMac</option>
                <option value="4">Teclado</option>
                <option value="5">Mouse</option>
                <option value="6">Monitor</option>
                <option value="7">Headset</option>
                <option value="8">Celular</option>
                <option value="9">Switches</option>
                <option value="12">Otro</option>
            </select>
        </div>
        
        <div>
            <table id="dispositivos2">
                <!-- La tabla no aparece hasta que se selecciona un tipo de dispositivo -->
            </table>
        </div>

        <div>
            <table id="dispositivos_seleccionados">
                <tr>
                    <th>Id Dispositivo</th>
                    <th>Tipo de dispositivo</th>
                    <th>Modelo</th>
                    <th>Número de Serie</th>
                    <th>Marca</th>
                </tr>
                <tbody></tbody>
            </table>
        </div>

        <!-- Input oculto para almacenar datos de dispositivos seleccionados -->
        <input type="hidden" name="id_colaborador" value="<?= $datoscolaborador[0]["id_colaborador"] ?>">
        <input type="hidden" name="dispositivos_seleccionados[]">

        <div action="mb-3" method="formForm">
            <a class="btn btn-danger" href="index.php?seccion=asignaciones/asignaciones">Cancelar</a>
            <a class="btn btn-danger" href="index.php?seccion=asignaciones/asignarPaso1">Volver</a>
            <button type="button" class="btn btn-primary" onclick="continuar()">Continuar</button>
        </div>

        <script>
            cargarDispositivos();

            function cargarDispositivos() {
                console.log("La función cargarDispositivos se está ejecutando");
                var tipoSeleccionado = document.getElementById("tipo_dispositivo").value;
                var xhr = new XMLHttpRequest();

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4) {
                        console.log("Respuesta del servidor:", xhr.status, xhr.statusText);
                        if (xhr.status === 200) {
                            console.log("Contenido de la respuesta:", xhr.responseText);
                            document.getElementById("dispositivos2").innerHTML = xhr.responseText;
                        } else {
                            console.error("Error en la respuesta del servidor");
                        }
                    }
                };

                var url = "controlador/controladorDispositivoTipo.php?tipo=" + tipoSeleccionado;
                xhr.open("GET", url, true);
                console.log("Solicitud AJAX enviada a: " + url);
                xhr.send();
            }

            function continuar() {
                // Obtener datos de dispositivos seleccionados
                var dispositivosSeleccionadosInput = document.querySelector('input[name="dispositivos_seleccionados[]"]');
                dispositivosSeleccionadosInput.value = JSON.stringify(obtenerDatosTabla());

                // Redirigir a la nueva página
                var queryParameters = "id_colaborador=" + document.querySelector('input[name="id_colaborador"]').value +
                                      "&dispositivos=" + dispositivosSeleccionadosInput.value;

                window.location.href = "index.php?seccion=asignaciones/asignarPaso3&" + queryParameters;
            }

            function agregarDesdeTabla(id_dispositivo, tipo, modelo, serie, marca) {
                // Obtener la tabla de dispositivos_seleccionados
                var tablaSeleccionados = document.getElementById('dispositivos_seleccionados');

                // Crear una nueva fila
                var nuevaFila = document.createElement('tr');
                nuevaFila.innerHTML = '<td>' + id_dispositivo + '</td>' +
                                    '<td>' + tipo + '</td>' +
                                    '<td>' + modelo + '</td>' +
                                    '<td>' + serie + '</td>' +
                                    '<td>' + marca + '</td>';

                // Agregar la nueva fila a la tabla de dispositivos_seleccionados
                tablaSeleccionados.appendChild(nuevaFila);
            }

            function obtenerDatosTabla() {
                var datos = [];
                var tabla = document.getElementById('dispositivos_seleccionados');

                if (tabla) {
                    var filas = tabla.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

                    for (var i = 0; i < filas.length; i++) {
                        var celdas = filas[i].getElementsByTagName('td');

                        if (celdas.length >= 5) {
                            datos.push({
                                id_dispositivo: celdas[0].innerText,
                                tipo: celdas[1].innerText,
                                modelo: celdas[2].innerText,
                                serie: celdas[3].innerText,
                                marca: celdas[4].innerText
                            });
                        }
                    }
                }

                return datos;
            }
        </script>
    </div>
</body>
</html>

