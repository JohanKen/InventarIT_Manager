<?php
require_once 'controlador/ControladorColaboradores.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['continuar'])) {
    $colaboradorSeleccionado = $_POST['colaborador2'];
    if (empty($colaboradorSeleccionado)) {
        echo  '<script>
                alert("Por favor, seleccione un colaborador.");
                window.location.href="index.php?seccion=asignaciones/asignarPaso1";
            </script>';
        exit;
    } else {
        echo '
                <script>            
                    var colaboradorSeleccionado = ' . json_encode($colaboradorSeleccionado) . ';
                    var url = "index.php?seccion=asignaciones/asignarPaso2&id_colaborador=" + colaboradorSeleccionado;
                    window.location.href = url;
                </script>';
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Document</title> -->
    <link rel="stylesheet" href="estilos/estilosAsignacionesPaso1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="up">
        <header class="header text-center">
            <h2>Nueva Asignación</h2>
        </header>
    </div>

    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="cliente" class="form-label">
                    <img src="images/clienteSelect.png" alt="Cliente Icon" class="form-icon"> Cliente
                </label>
                <select name="cliente" class="form-control" id="cliente" onchange="cargarVistasColaboradores()">
                    <option value="0" disabled selected>-- Seleccione un cliente --</option>
                    <option value="1">RTS</option>
                    <option value="2">Saela</option>
                    <option value="3">Nutiliti</option>
                    <option value="4">Ranger Design</option>
                    <option value="5">Mega Fleet Corp</option>
                    <option value="6">Pro Movers</option>
                    <option value="7">Union Supply Group</option>
                    <option value="8">Intouch</option>
                    <option value="9">Al-Van Equip NW</option>
                    <option value="10">Allied Home Security</option>
                    <option value="12">Brandon & Clark</option>
                    <option value="13">Christie Lites Enterprises USA</option>
                    <option value="14">ConsumerTrack, Inc.</option>
                    <option value="15">Dolghih Law Group PLLC</option>
                    <option value="16">Execulink Telecom</option>
                    <option value="17">FermiHDI</option>
                    <option value="18">Freedom Mobility</option>
                    <option value="19">Freshbenies</option>
                    <option value="20">HUSL Digital</option>
                    <option value="21">Invoice IQ</option>
                    <option value="22">LHI Group Inc.</option>
                    <option value="23">LW&H Business Solutions</option>
                    <option value="24">Money Lion</option>
                    <option value="25">Mountain Land Collection</option>
                    <option value="26">Skyways</option>
                    <option value="27">Sophia Casey</option>
                </select>
            </div>

            <div class="form-group">
                <label for="colaborador2" class="form-label">
                    <img src="images/empleados.png" alt="Colaborador Icon" class="form-icon"> Colaborador
                </label>



                
                <select name="colaborador2" id="colaborador2" class="form-control">
                    <option value="" disabled selected>-- Primero Seleccione un Cliente --</option>
                </select>
            </div>

            <div class="form-groupp">
                <div class="leftButtons">
                <a href="index.php?seccion=asignaciones/asignarPaso1-2" id="aNew">
                    <br>
                        <img src="images/newUser.png" id="imgNuevoCol" alt="Nuevo Colaborador">Nuevo Colaborador
                   
                </a>
                </div>
                <div class="rightButtons">       
                    <a class="btn btn-danger btn-custom" href="index.php?seccion=asignaciones/asignaciones">Cancelar</a>
                   
                    <button type="submit" class="btn btn-primary btn-custom" name="continuar">Continuar</button>
                </div>
            </div>

        </form>
    </div>


    <script>
    function cargarVistasColaboradores() {

        console.log("cargarVistasColaboradores se está ejecutando");
        var clienteSeleccionado = document.getElementById("cliente").value;
        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                console.log("Respuesta del servidor:", xhr.status, xhr.statusText);
                if (xhr.status === 200) {
                    // Procesa la respuesta del servidor
                    console.log("Contenido de la respuesta:", xhr.responseText);
                    document.getElementById("colaborador2").innerHTML = xhr.responseText;
                } else {
                    console.error("Error en la respuesta del servidor");
                }
            }
        };

        var url = "controlador/ControladorFiltros/ColaboradorPorCliente.php?cliente=" + clienteSeleccionado;
        xhr.open("GET", url, true);
        console.log("Solicitud AJAX enviada a: " + url);
        xhr.send();
    }
    </script>

</body>

</html>