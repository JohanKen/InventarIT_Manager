<?php 
require_once 'controlador/ControladorColaboradores.php';
require_once 'controlador/ControladorAsignaciones.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');

$datoscolaborador = ControladorColaboradores::detalleColaborador();
$dispositivosSeleccionados = isset($_GET['dispositivos']) ? json_decode(urldecode($_GET['dispositivos']), true) : [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['aceptar'])) {

    $nombreApellidoColaborador =  $datoscolaborador[0]["nombre_colaborador"] . ' ' . $datoscolaborador[0]["apellido_paterno_colaborador"];
    $dispositivosSeleccionados = isset($_GET['dispositivos']) ? json_decode(urldecode($_GET['dispositivos']), true) : [];
    $correos = json_decode($_POST['correos_json'], true);

    /*$registar = new ControladorAsignaciones;
    foreach ($dispositivosSeleccionados as $item){
        $dispositivo =  $item['id_dispositivo'];
        $registar -> registrarAsignacion($dispositivo);
    }*/

    include 'cartaResponsiva.php';
    $generarPDF = new PDF;
    foreach ($correos as $correo) {
        $generarPDF->generarPDF($dispositivosSeleccionados,$nombreApellidoColaborador,$correo);
    }

    /*echo  '<script>
            alert("Asignacion drealizada!");
            window.location.href="index.php?seccion=asignaciones/asignaciones";
        </script>';
    exit;*/
    
    }

    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <br><br><br><br><br>
    <div class="contenSeccion">
        <header>
            <h1>Paso 4 - Enviar por correo a:</h1>
        </header>
        <form action="" method="post" enctype="multipart/form-data">
            <div id="contenedor-correos">
                <!-- Campo de entrada inicial -->
                <div class="form-group">
                    <label for="correo" class="form-label">Correo</label>
                    <input type="text" class="form-control" name="correo[]">
                </div>
            </div>

            <button type="button" class="btn btn-primary" onclick="agregarCampo()">Agregar</button>
            
            <button type="submit" class="btn btn-primary" name="aceptar" onclick="guardarCorreos()">Confirmar Asignacion</button>
            
            <input type="hidden" name="correos_json" id="correos_json">
        </form>

        <script>
            // Función para agregar un nuevo campo de entrada de texto
            function agregarCampo() {
                var contenedor = document.getElementById("contenedor-correos");
                var nuevoCampo = document.createElement("div");
                nuevoCampo.classList.add("form-group"); // Agrega la clase form-group al nuevo campo
                nuevoCampo.innerHTML = `
                    <label for="correo" class="form-label">Correo</label>
                    <input type="text" class="form-control" name="correo[]">
                `;
                contenedor.appendChild(nuevoCampo); // Agrega el nuevo campo al contenedor
            }

            function guardarCorreos() {
                var correos = [];
                var camposCorreo = document.querySelectorAll('input[name="correo[]"]');
                camposCorreo.forEach(function(input) {
                    correos.push(input.value);
                });
                document.getElementById('correos_json').value = JSON.stringify(correos);
            }
        </script>

    </div>

</body>
</html>

