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
    include 'cartaResponsiva.php'; // Incluye el archivo que contiene la función generarPDFyEnviarCorreo()
    $correo = $_POST['correo'];
    //echo $correo;
    $generarPDF = new PDF;
    $generarPDF->generarPDF($dispositivosSeleccionados,$nombreApellidoColaborador,$correo);

    /*$registar = new ControladorAsignaciones;
    foreach ($dispositivosSeleccionados as $item){
        $dispositivo =  $item['id_dispositivo'];
        $registar -> registrarAsignacion($dispositivo);
    }

    echo  '<script>
            alert("Asignacion drealizada!");
            window.location.href="index.php?seccion=asignaciones/asignaciones";
        </script>';
    exit;
    */
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
            <div action="mb-3" method="formForm">
                <label for="correo" class="form-label">Correo</label>
                <input type="text" class="form-control" name="correo">
            </div>

            <div action="mb-3" method="formForm">
                <button type="submit" class="btn btn-primary" name="aceptar">Confirmar Asignacion</button>
            </div>

        </form>

    </div>


</body>
</html>