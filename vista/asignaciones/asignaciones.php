<?php
    include ("controlador/ControladorAsignaciones.php");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/estilosAsignaciones.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    
<div class="contentSeccion">
        <div class="up">
    
    <header class="headerTabla">
                <h1 style="font-size: 28px; margin-top:20px; font-weight: bold; color: #003363; text-transform: uppercase; border-bottom: 2px solid #003363;">Asignaciones</h1>
                
            </header>
            <div class="col-md-12 text-center d-flex">
            <div class="input-group input-group-sm mt-3" id="divBuscar" style="max-width: 400px; margin: auto;">
                <input type="text" class="buscarForm" name="buscar" id="buscar" style="border-radius: none;">
                <span class="input-group-text" id="clearSearch" style="cursor: pointer; display: none; border-radius: none;">&times;</span>
                <!--Cmaibar nombre de la funcion por buscarColaborador y que funcione de la misma manera que la barra de buscador de dispositivos -->
                <button type="submit" class="custom-btn1 btn-4" onclick="buscarAsignacion()">Buscar</button>
            </div>
            <div class="input-group input-group-sm mt-3" style="max-width: 300px; margin: auto; display: block !important; display: flex; flex-direction: column; align-items: flex-end;">
                    <img src="images/asignar.png" id="IMGlaptop" alt="IMAGEN">
                    <a href="index.php?seccion=asignaciones/asignarPaso1"><button class="custom-btn1 btn-4" onclick="newAsignacion();">NUEVA ASIGNACIÓN</button></a>
                    
                    </div>    
</div>
</div>
        
        
        
        
        

<div class="filter-container">
        <label for="cliente" class="filter-label">Filtrar por Cliente</label>
        <select name="cliente" id="cliente" class="filter-select"  onchange="cargarVistasColaboradores()">
            <option value="0" id="optionCliente">Todos</option>
                <option value="1" id="optionCliente">RTS</option>
                <option value="2" id="optionCliente">Saela</option>
                <option value="3" id="optionCliente">Nutiliti</option>
                <option value="4" id="optionCliente">Ranger Design</option>
                <option value="5" id="optionCliente">Mega Fleet Corp</option>
                <option value="6" id="optionCliente">Pro Movers</option>
                <option value="7" id="optionCliente">Union Supply Group</option>
                <option value="8" id="optionCliente">Intouch</option>
                <option value="9" id="optionCliente">Al-Van Equip NW</option>
                <option value="10" id="optionCliente">Allied Home Security</option>
                <option value="12" id="optionCliente">Brandon & Clark</option>
                <option value="13" id="optionCliente">Christie Lites Enterprises USA</option>
                <option value="14" id="optionCliente">ConsumerTrack, Inc.</option>
                <option value="15" id="optionCliente">Dolghih Law Group PLLC</option>
                <option value="16" id="optionCliente">Execulink Telecom</option>
                <option value="17" id="optionCliente">FermiHDI</option>
                <option value="18" id="optionCliente">Freedom Mobility</option>
                <option value="19" id="optionCliente">Freshbenies</option>
                <option value="20" id="optionCliente">HUSL Digital</option>
                <option value="21" id="optionCliente">Invoice IQ</option>
                <option value="22" id="optionCliente">LHI Group Inc.</option>
                <option value="23" id="optionCliente">LW&H Business Solutions</option>
                <option value="24" id="optionCliente">Money Lion</option>
                <option value="25" id="optionCliente">Mountain Land Collection</option>
                <option value="26" id="optionCliente">Skyways</option>
                <option value="27" id="optionCliente">Sophia Casey</option>
            </select>
        </div>
        <div class="container-fluid">
        <div class="table-responsive">
            <table class="table table-secondary table-straped table-hover" id="asignaciones">
            <thead class="table-dark">
                    <tr>
                        <!-- Separacion de encabezados para hecer sub encabezados -->
                        <th colspan="1" id="tdLeft"></th>
                        <th colspan="5" id="tdLeft">Asignado a</th>
                        <th colspan="7" id="tdRight">Dispositivo Asignado</th>
                        <th colspan="1" id="tdRight"></th>
                    </tr>
                    <tr>
                        <th>ID Asignacion</th>
                        <th>ID Colaborador</th>
                        <th>Nombre Colaaborador</th>
                        <th>Apellido Colaborador</th>
                        <th>Cliente</th>
                        <th>Departamento</th>
                        
                        <th>ID Dispositivo</th>
                        <th>Tipo</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Numero de serie</th>
                        <th>Precio</th>
                        <th>Fecha de asignacion</th>
                        <th>Opciones</th>
                    </tr>    
                <thead>
                <tbody>
                    <?php  
                        $eliminarAsignacion = new ControladorAsignaciones;
                        $eliminado= $eliminarAsignacion->borrarAsignacion();
                        if ($eliminado) {
                            echo "
                            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                            <script>
                            Swal.fire({
                                position: 'center',
                                icon: 'success', 
                                title: 'Asignación eliminada con éxito',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.href = 'index.php?seccion=asignaciones/asignaciones'; 
                            });
                            </script>
                            ";
                            exit(); // Finaliza la ejecución del script PHP después de la salida del script JavaScript
                        }
                        $listaAsignaciones = ControladorAsignaciones::consultarAsignaciones();
                        foreach($listaAsignaciones as $item){
                            echo '
                                <tr>
                                    <td>'.$item[0].'</td>
                                    <td>'.$item[1].'</td>
                                    <td>'.$item[2].'</td>
                                    <td>'.$item[3].'</td>
                                    <td>'.$item[4].'</td>
                                    <td>'.$item[5].'</td>
                                    <td>'.$item[6].'</td>
                                    <td>'.$item[7].'</td>
                                    <td>'.$item[8].'</td>
                                    <td>'.$item[9].'</td>
                                    <td>'.$item[10].'</td>
                                    <td>$' . number_format($item[11], 2, '.', ',') . '</td>
                                    <td>'.$item[12].'</td>
                                    <td>
    <img src="images/basura.png" alt="Borrar" style="max-width:40px; cursor:pointer;" onclick="confirmarBorrar('.$item[0].');">
                                </tr>
                            ';
                        }
                    ?>
                </tbody>
            </table>
        </div>
        </div>
   


 



        <script>
             function confirmarBorrar(id_asignacion) {
            Swal.fire({
                title: '¿Estas seguro?',
                text: "La asignación se elimiara completamente.",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "index.php?seccion=asignaciones/asignaciones&accion=eliminar&id_asignacion=" + id_asignacion;
             }});
             }
        </script>

    <script>
        function cargarVistasColaboradores() {
            var clienteSeleccionado = document.getElementById("cliente").value;
            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    console.log("Respuesta del servidor:", xhr.status, xhr.statusText);
                    if (xhr.status === 200) {
                        // Procesa la respuesta del servidor
                        console.log("Contenido de la respuesta:", xhr.responseText);
                        // Cambia el contenido de la tabla con el nuevo HTML recibido
                        document.getElementById("asignaciones").innerHTML = xhr.responseText;
                    } else {
                        console.error("Error en la respuesta del servidor");
                    }
                }
            };

            var url = "controlador/ControladorFiltros/AsignacionesPorCliente.php?cliente=" + clienteSeleccionado;
            xhr.open("GET", url, true);
            console.log("Solicitud AJAX enviada a: " + url);
            xhr.send();
        }


        
        function buscarAsignacion() {

                var buscarAsignacion = document.getElementById("buscar").value;
                var xhr = new XMLHttpRequest();

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4) {

                        if (xhr.status === 200) {

                            document.getElementById("asignaciones").innerHTML = xhr.responseText;
                        } else {
                            console.error("Error en la respuesta del servidor");
                        }
                    }
                };


                //agregar archivo para hacer el buscador pero de asignaciones
                var url = "controlador/ControladorFiltros/buscadorAsignaciones.php?buscar="+ buscarAsignacion;
                xhr.open("GET", url, true);
                console.log("Solicitud AJAX enviada a: " + url);
                xhr.send();
                }

    </script>

    </div>
</body>
</html>