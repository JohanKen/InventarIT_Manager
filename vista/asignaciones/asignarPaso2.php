<?php
require_once 'controlador/ControladorColaboradores.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');

$datoscolaborador = ControladorColaboradores::detalleColaborador();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['continuar'])) {
    $colaboradorSeleccionado = $datoscolaborador[0]["id_colaborador"];
    $dispositivoSeleccionado = $_POST['dispositivo'];
    // Al presionar "continuar", enviar los datos del colaborador y del dispositivo
    header("Location: index.php?seccion=asignaciones/asignarPaso3&id_colaborador=" . $colaboradorSeleccionado . "&id_dispositivo=" . $dispositivoSeleccionado);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paso 2 de la asignación</title>
</head>
<body>
    <br><br><br><br><br><br><br> <! se tiene que liminar esto en un futuro >
    <div class="contentSeccion">
        <div class="up">
            <header class="headerTabla">
                <h1>Paso 2 - Elegir Dispositivo</h1>
            </header>
        </div>

        <?php if (isset($datoscolaborador) && is_array($datoscolaborador) && isset($datoscolaborador)) : ?>
            <form action="" method="post" enctype="multipart/form-data">
                <!-- Agregamos el campo oculto para almacenar los datos seleccionados -->
                <input type="hidden" id="datos_seleccionados" name="datos_seleccionados" value="">

                <div action="mb-3" method="formForm">
                    <label for="nombre_colaborador" class="form-label">Colaborador Seleccionado:</label>
                    <input type="text" class="form-control" name="nombre_colaborador" value="<?= $datoscolaborador[0]["nombre_colaborador"] . ' ' . $datoscolaborador[0]["apellido_paterno_colaborador"] ?>" readonly>
                </div>

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

                <table id="dispositivos2">
                    <!-- La tabla no aparece hasta que se selecciona un tipo de dispositivo -->
                </table>

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

                <div action="mb-3" method="formForm">
                    <a class="btn btn-danger" href="index.php?seccion=asignaciones/asignaciones">Cancelar</a>
                    <a class="btn btn-danger" href="index.php?seccion=asignaciones/asignarPaso1">Volver</a>
                    <button type="submit" class="btn btn-primary" name="continuar">Continuar</button>
                </div>
            </form>

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

            function agregarDesdeTabla(id, tipo, modelo, serie, marca) {
                // Obtener la tabla de dispositivos_seleccionados
                var tablaSeleccionados = document.getElementById('dispositivos_seleccionados');

                // Crear una nueva fila
                var nuevaFila = document.createElement('tr');
                nuevaFila.innerHTML = '<td>' + id + '</td>' +
                                    '<td>' + tipo + '</td>' +
                                    '<td>' + modelo + '</td>' +
                                    '<td>' + serie + '</td>' +
                                    '<td>' + marca + '</td>';

                // Agregar la nueva fila a la tabla de dispositivos_seleccionados
                tablaSeleccionados.appendChild(nuevaFila);
            }

            function limpiarTablaSeleccionados() {
                var tablaSeleccionados = document.getElementById('dispositivos_seleccionados');
                while (tablaSeleccionados.rows.length > 1) {
                    tablaSeleccionados.deleteRow(1);
                }
            }

            function mostrarDispositivosSeleccionados() {
                var campoOculto = document.getElementById('datos_seleccionados');
                var datosActuales = campoOculto.value;

                var dispositivos = datosActuales.split(',');
                for (var i = 0; i < dispositivos.length; i++) {
                    var dispositivoJSON = dispositivos[i];
                    if (dispositivoJSON !== '') {
                        var dispositivo = JSON.parse(dispositivoJSON);
                        agregarDispositivoATabla(dispositivo.id, dispositivo.tipo, dispositivo.modelo, dispositivo.serie, dispositivo.marca);
                    }
                }
            }

            function agregarDispositivoATabla(id, tipo, modelo, serie, marca) {
                var tablaSeleccionados = document.getElementById('dispositivos_seleccionados');
                var nuevaFila = tablaSeleccionados.insertRow(-1);

                var celdaId = nuevaFila.insertCell(0);
                var celdaTipo = nuevaFila.insertCell(1);
                var celdaModelo = nuevaFila.insertCell(2);
                var celdaSerie = nuevaFila.insertCell(3);
                var celdaMarca = nuevaFila.insertCell(4);

                celdaId.innerHTML = id;
                celdaTipo.innerHTML = tipo;
                celdaModelo.innerHTML = modelo;
                celdaSerie.innerHTML = serie;
                celdaMarca.innerHTML = marca;
            }
        </script>

        <?php else : ?>
            <p>El array $datoscolaborador no está definido o no tiene la estructura esperada.</p>
        <?php endif; ?>
    </div>
</body>
</html>
