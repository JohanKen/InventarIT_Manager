<?php 
require_once 'controlador/ControladorColaboradores.php';
require_once 'controlador/ControladorAsignaciones.php';
include 'cartaResponsiva.php';

error_reporting(E_ALL);
ini_set('display_errors', '1');

$datoscolaborador = ControladorColaboradores::detalleColaborador();
$dispositivosSeleccionados = isset($_GET['dispositivos']) ? json_decode(urldecode($_GET['dispositivos']), true) : [];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos/estilosAsignacionesPaso4.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
         #loader {
        display: none;
        position: fixed;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 80px;
        height: 80px;
        border: 8px solid #f3f3f3; /* Light grey background */
        border-top: 8px solid #3498db; /* Blue spinner */
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    </style>
</head>
<body>
    <div id="loader"> <div></div></div>
    <br><br><br><br><br>
    <div class="contenSeccion">
        <header>
            <h1>Envio de cartas responsivas</h1>
        </header>
        <br><br>
        <form action="" method="post" enctype="multipart/form-data" onsubmit="mostrarLoader()">
            <div class="row">
                <div class="col-sm"></div>
                <div class="col-sm">
                    <div id="contenedor-correos">
                        <div class="form-group">
                            <label for="correo" class="form-label">Enviar a:</label>
                            <input type="text" id="cliente" placeholder="alguien@example.com" class="form-control" name="correo[]">
                        </div>
                    </div>
                    <button type="button" class="btn btn-light" onclick="agregarCampo()"> + Agregar otra dirección...</button>
                    <button type="submit" class="btn btn-success" name="aceptar" id="btnConfirmarAsignacion" onclick="guardarCorreos()">Enviar</button>
                    <input type="hidden" name="correos_json" id="correos_json">
                </div>
                <div class="col-sm"></div>
            </div>
        </form>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['aceptar'])) {

$nombreApellidoColaborador =  $datoscolaborador[0]["nombre_colaborador"] . ' ' . $datoscolaborador[0]["apellido_paterno_colaborador"];
$dispositivosSeleccionados = isset($_GET['dispositivos']) ? json_decode(urldecode($_GET['dispositivos']), true) : [];
$correos = json_decode($_POST['correos_json'], true);

//se crea la asignacion en la base de datos
$colaborador = $datoscolaborador[0]["id_colaborador"];
$registar = new ControladorAsignaciones;
foreach ($dispositivosSeleccionados as $item){
    $dispositivo =  $item['id_dispositivo'];
    $registar -> registrarAsignacion($dispositivo,$colaborador);
}

//include 'cartaResponsiva.php';
$generarPDF = new PDF;
$generarPDF->generarPDF($dispositivosSeleccionados,$nombreApellidoColaborador,$correos);
echo "
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Asignación realizada con éxito!',
        showConfirmButton: false,
        timer: 1500
    }).then(() => {
        document.getElementById('loader').style.display = 'none';
        window.location.href='index.php?seccion=asignaciones/asignaciones';   
    });
});
</script>
";
exit();
}?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function agregarCampo() {
                var contenedor = document.getElementById("contenedor-correos");
                var nuevoCampo = document.createElement("div");
                nuevoCampo.classList.add("form-group");
                nuevoCampo.innerHTML = `
                    <label for="correo" class="form-label">También dirigir a:</label>
                    <input type="text" class="form-control" name="correo[]" id="cliente" placeholder="alguien@example.com">
                `;
                contenedor.appendChild(nuevoCampo);
            }

            function guardarCorreos() {
                var correos = [];
                var camposCorreo = document.querySelectorAll('input[name="correo[]"]');
                camposCorreo.forEach(function(input) {
                    correos.push(input.value);
                });
                document.getElementById('correos_json').value = JSON.stringify(correos);
                console.log(correos);
            }

            function mostrarLoader() {
                document.getElementById('loader').style.display = 'block';
            }

            window.agregarCampo = agregarCampo;
            window.guardarCorreos = guardarCorreos;
            window.mostrarLoader = mostrarLoader;
        });
    </script>
</body>
</html>
