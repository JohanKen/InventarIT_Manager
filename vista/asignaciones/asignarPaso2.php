<?php
// Este es asignarPaso2.php
require_once 'controlador/ControladorColaboradores.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');

$datoscolaborador = ControladorColaboradores::detalleColaborador();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paso 2 de la asignación</title>
</head>
<body>
    <br><br><br><br><br><br><br> <!-- Eliminar esto en el futuro --><!--salto de linea -->
    <div class="contentSeccion">
        <div class="up">
            <header class="headerTabla">
                <h1>Paso 2 - Elegir Dispositivo</h1>
                <br><!--salto de linea -->
            </header>
        </div>

        <?php if (isset($datoscolaborador) && is_array($datoscolaborador) && isset($datoscolaborador)) : ?>
        <form action ="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nombre_colaborador" class="form-label">Colaborador Seleccionado:</label>
                    <input type="text" class="form-control" name="nombre_colaborador" value="<?= $datoscolaborador[0]["nombre_colaborador"] . ' ' . $datoscolaborador[0]["apellido_paterno_colaborador"] ?>" readonly>
                    <label for="cliente" class="form-label">Cliente:</label>
                    <input type="text" class="form-control" name="cliente" value="<?= $datoscolaborador[0]["empresa"] ?>" readonly>
                </div>

                <br><!--salto de linea -->

            <?php else : ?>
                <p>El array $datoscolaborador no está definido o no tiene la estructura esperada.</p>
            <?php endif; ?>

            <div>
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

            <br><!--salto de linea -->

            <div>
                <table id="dispositivos_seleccionados">
                    <thead>
                        <tr>
                            <th>Id Dispositivo</th>
                            <th>Tipo de dispositivo</th>
                            <th>Modelo</th>
                            <th>Número de Serie</th>
                            <th>Marca</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

            <br>

            <!-- Input oculto para almacenar datos de dispositivos seleccionados -->
            <input type="hidden" name="id_colaborador" value="<?= $datoscolaborador[0]["id_colaborador"] ?>">
            <input type="hidden" name="dispositivos_seleccionados">


            <div action="mb-3" method="formForm">
                <button><a class="btn btn-danger" href="index.php?seccion=asignaciones/asignaciones">Cancelar</a></button>
                <button><a class="btn btn-danger" href="index.php?seccion=asignaciones/asignarPaso1">Volver</a></button>
                <button type="button" class="btn btn-primary" onclick="continuar()">Continuar</button>
            </div>
        
        </form>

        <script>
            cargarDispositivos();

            var dispositivosOmitidos = [];

            function cargarDispositivos() {
                console.log("La función cargarDispositivos se está ejecutando");
                var tipoSeleccionado = document.getElementById("tipo_dispositivo").value;
                var xhr = new XMLHttpRequest();


                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4) {
                        //console.log("Respuesta del servidor:", xhr.status, xhr.statusText);
                        if (xhr.status === 200) {
                            //.log("Contenido de la respuesta:", xhr.responseText);
                            document.getElementById("dispositivos2").innerHTML = xhr.responseText;
                            //console.log("Lista de dispositivos omitidos:", dispositivosOmitidos);
                        } else {
                            console.error("Error en la respuesta del servidor");
                        }
                    }
                };

                var url = "controlador/ControladorFiltros/InventarioDisponiblePorTipo.php?tipo=" + tipoSeleccionado+"&omitidos=" + dispositivosOmitidos;
                
                xhr.open("GET", url, true);
                //console.log("Solicitud AJAX enviada a: " + url);
                xhr.send();
            }
            
            function continuar() {
                // Obtener datos de dispositivos seleccionados
                var dispositivosSeleccionadosInput = document.querySelector('input[name="dispositivos_seleccionados"]');
                var datosTabla = obtenerDatosTabla();
                
                if (datosTabla.length === 0) {  
                    alert("No se a Seleccionado ningun dispositivo");
                }else{
                    dispositivosSeleccionadosInput.value = JSON.stringify(datosTabla);

                    // Redirigir a la nueva página
                    var queryParameters = "id_colaborador=" + document.querySelector('input[name="id_colaborador"]').value +
                                        "&dispositivos=" + dispositivosSeleccionadosInput.value;

                    //console.log("Redirigiendo a: index.php?seccion=asignaciones/asignarPaso3&" + queryParameters);
                    window.location.href = "index.php?seccion=asignaciones/asignarPaso3&" + queryParameters;
                }
                
            }
           

            function agregarDesdeTabla(id_dispositivo, tipo, modelo, serie, marca,precio) {
                // Agregar el ID del dispositivo a la lista de omitidos
                dispositivosOmitidos.push(id_dispositivo);

                // Obtener la tabla de dispositivos_seleccionados
                var tablaSeleccionados = document.getElementById('dispositivos_seleccionados').getElementsByTagName('tbody')[0];

                // Crear una nueva fila
                var nuevaFila = document.createElement('tr');
                nuevaFila.id = 'fila_seleccionada_' + id_dispositivo;
                nuevaFila.innerHTML =   '<td>' + id_dispositivo + '</td>' +
                                        '<td>' + tipo + '</td>' +
                                        '<td>' + modelo + '</td>' +
                                        '<td>' + serie + '</td>' +
                                        '<td>' + marca + '</td>' +
                                        '<td>' + precio + '</td>'+
                                        '<td><button type="button" onclick="eliminarFila(this, ' + id_dispositivo + '); cargarDispositivos()">Quitar</button></td>';

                // Agregar la nueva fila al tbody de la tabla de dispositivos_seleccionados
                tablaSeleccionados.appendChild(nuevaFila);

                var filaDispositivo = document.getElementById('fila_dispositivo_' + id_dispositivo);
                if (filaDispositivo) {
                    filaDispositivo.parentNode.removeChild(filaDispositivo);
                }

            }

            function obtenerDatosTabla() {
                var datos = [];
                var tabla = document.getElementById('dispositivos_seleccionados');

                if (tabla) {
                    var filas = tabla.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

                    for (var i = 0; i < filas.length; i++) {
                        var celdas = filas[i].getElementsByTagName('td');

                        if (celdas.length >= 6) {
                            datos.push({
                                id_dispositivo: celdas[0].innerText,
                                tipo: celdas[1].innerText,
                                modelo: celdas[2].innerText,
                                serie: celdas[3].innerText,
                                marca: celdas[4].innerText,
                                precio: celdas[5].innerText
                            });
                        }
                    }
                }

                return datos;
            }

            //funcion para quitar en dispositivo en dispositivos selecionados
            function eliminarFila(botonQuitar, id_dispositivo) {
                // Eliminar la fila de la tabla de dispositivos seleccionados
                var filaSeleccionada = botonQuitar.parentNode.parentNode;
                filaSeleccionada.parentNode.removeChild(filaSeleccionada);

                // Eliminar el ID del dispositivo de la lista de omitidos
                var index = dispositivosOmitidos.indexOf(id_dispositivo);
                if (index !== -1) {
                    dispositivosOmitidos.splice(index, 1);
                }

            }

        </script>

    </div>
</body>
</html>