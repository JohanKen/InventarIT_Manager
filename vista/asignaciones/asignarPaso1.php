<?php
 //require_once 'controlador/controladorColaoradores.php';
 error_reporting(E_ALL);
 ini_set('display_errors','1'); 

 if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['continuar'])) {
    $colaboradorSeleccionado = $_POST['colaborador2'];
    if (empty($colaboradorSeleccionado)) {
        echo  '<script>
                alert("Por favor, seleccione un colaborador.");
                window.location.href="index.php?seccion=asignaciones/asignarPaso1";
            </script>';
        exit;
    }
    header("Location: index.php?seccion=asignaciones/asignarPaso2&id_colaborador=" . $colaboradorSeleccionado);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos/estilosFormularios.css">
</head>
<body>
    <div class="contentSeccion">

            <div class="up">
                <header class="headerTabla">
                    <h1>Paso 1 - Elegir un Colaborador</h1>
                </header>
            </div>

        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3" id="formForm">
                <label for="cliente" class="form-label" >Selecciona el cliente:</label>
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
                </select>
            </div>

            <div class="mb-3" id="formForm">
                <label for="colaborador2" class="form-label">Elige el colaborador</label>
                <select name="colaborador2" id="colaborador2" class="form-control">
                <option value="" disabled selected>-- Primero Seleccione un Cliente --</option>
                </select>
            </div>
            
            <div class="mb-3" id="formForm">
                <a href="index.php?seccion=asignaciones/asignarPaso1-2">Nuevo Colaborador</a>
            </div>

            <div class="mb3" id="formForm">
                <a class="btn btn-danger" href="index.php?seccion=asignaciones/asignaciones">Cancelar</a>
                <button type="submit" class="btn btn-primary" name="continuar">Continuar</button>
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
            


