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
    <title>Dispositivos para asignar</title>
    <link rel="stylesheet" href="estilos/estilosAsignacionesPaso2.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="up">
<header class="headerTabla">
                <h1 style="font-size: 28px; margin-top:20px; font-weight: bold; color: #003363; text-transform: uppercase; border-bottom: 2px solid #003363;">Dispositivos para asignar</h1>
               
            </header>
    </div>

        <?php if (isset($datoscolaborador) && is_array($datoscolaborador) && isset($datoscolaborador)) : ?>


        <div class="form-container">
        <form action ="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <div class="d-flex align-content-center" >
                <div class="d-flex align-content-center flex-wrap">
                    <label for="cliente" class="form-label">
                        <img src="images/clienteSelect.png" alt="Cliente Icon" class="form-icon">
                            <?php echo $datoscolaborador[0]["empresa"];?>
                     </label>
                     </div>
                 
                     <div class="d-flex align-content-center flex-wrap" id="ri">
                    <label for="colaborador2" class="form-label">
                        <img src="images/empleados.png" alt="Colaborador Icon" class="form-icon">
                        <?php echo $datoscolaborador[0]["nombre_colaborador"]; echo $datoscolaborador[0]["apellido_paterno_colaborador"];?>
                    </label>
                  
                    <br>        
                    
                 </div>     
                 </div>     

              

            <?php else : ?>
                <p>El array $datoscolaborador no está definido o no tiene la estructura esperada.</p>
            <?php endif; ?>
            <!--CONSTRUIR DE MANERA CORRECTA SELECT COMO EN CARROUSEL AL IGUAL QUE LA SELECCION DE DISPOSITIVOS CUANDO RECIEN SE VAN A REGISTRAR-->
            <div class="container text-center">  
                <div class="row ">
                    <div class="col-sm"></div>
                    <div class="col-sm"> <label for="tipo_dispositivo" class="form-labell">Tipo de Dispositivo</label>
                <select name="tipo_dispositivo" class="form-control" id="tipo_dispositivo"  onchange="cargarDispositivos()">
                    <option value="0" disabled selected>-- Seleccione el Tipo de Dispositivo --</option>
                    <option value="1" id="option">Laptop</option>
                    <option value="2" >Desktop</option>
                    <option value="3" >iMac</option>
                    <option value="4" >Teclado</option>
                    <option value="5" >Mouse</option>
                    <option value="6" >Monitor</option>
                    <option value="7" >Headset</option>
                    <option value="8" >Celular</option>
                    <option value="9" >Switches</option>
                    <option value="12" >Otro</option>
                </select></div>
                    <div class="col-sm"></div>
                </div>
               
            </div>
            
            <div>
                <br>
                <table class="table table-sm" id="dispositivos2">
                <div class="input-group input-group-sm mt-3" id="divBuscar" style="max-width: 300px; margin: auto;">
                <input type="text" class="buscarForm" name="buscar" id="buscar" style="border-radius: none;">
                <span class="input-group-text" id="clearSearch" style="cursor: pointer; display: none; border-radius: none;">&times;</span>
                <button type="submit" class="custom-btn1 btn-4" onclick="buscarAsignacion()">Buscar</button>
            </div>
                    <!-- La tabla no aparece hasta que se selecciona un tipo de dispositivo -->
                    
                </table>
            </div>

           <br>

            <div>
                <br><br>
                <h3 class="form-labell">Dispositivos seleccionados</h3>
                
                <table class="table table-sm" id="dispositivos_seleccionados">
                    <thead class="table-dark">
                        <tr class="w-50 p-3">
                            <th>Id Dispositivo</th>
                            <th>Tipo de dispositivo</th>
                            <th>Modelo</th>
                            <th>Número de Serie</th>
                            <th>Marca</th>
                            <th>Precio</th>
                            <th></th>
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
                <!--<button><a class="btn btn-danger" href="index.php?seccion=asignaciones/asignaciones">Cancelar</a></button>--> 
                <button class="btn btn-danger"><a style="color: white; text-decoration:none" href="index.php?seccion=asignaciones/asignarPaso1">Volver</a></button>
                <button type="button" class="btn btn-primary" onclick="continuar()">Continuar</button>
            </div>
            </div>
        </form>
        </div>
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
                    //CAMBIAR ESTE CAMPO POR SWEET ALERT...
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
                                        '<td><button type="button" class="btn btn-danger" onclick="eliminarFila(this, ' + id_dispositivo + '); cargarDispositivos()">Remover</button></td>';

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

            function buscarDispositivo() {
            console.log("La función buscarDispositivo se está ejecutando");
            var buscarDispositivo = document.getElementById("buscar").value;
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    console.log("Respuesta del servidor:", xhr.status, xhr.statusText);
                    if (xhr.status === 200) {
                        console.log("Contenido de la respuesta:", xhr.responseText);
                        document.querySelector("#inventario_dispositivos tbody").innerHTML = xhr.responseText;
                    } else {
                        console.error("Error en la respuesta del servidor");
                    }
                }
            };

            var url = "controlador/ControladorFiltros/buscadorDispositivos.php?buscar=" + encodeURIComponent(buscarDispositivo);
            xhr.open("GET", url, true);
            console.log("Solicitud AJAX enviada a: " + url);
            xhr.send();
        }


        document.addEventListener('DOMContentLoaded', function() {
            var headerTabla = document.querySelector('.headerTabla');
            headerTabla.classList.add('show');
        });

        document.getElementById('buscar').addEventListener('input', function() {
            const clearSearch = document.getElementById('clearSearch');
            if (this.value.length > 0) {
                clearSearch.style.display = 'flex';
            } else {
                clearSearch.style.display = 'none';
            }
            });

            document.getElementById('clearSearch').addEventListener('click', function() {
            const buscarInput = document.getElementById('buscar');
            buscarInput.value = '';
            this.style.display = 'none';
            window.location.reload(true);
            });

        </script>

    </div>
</body>
</html>