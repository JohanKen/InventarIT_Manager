<?php
//este es asignarPaso3.php
require_once 'controlador/ControladorColaboradores.php';
require_once 'controlador/ControladorAsignaciones.php';
//require_once 'cartaResponsiva.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');


$datoscolaborador = ControladorColaboradores::detalleColaborador();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['volver'])) {
    $colaboradorSeleccionado = $datoscolaborador[0]["id_colaborador"];
    header("Location: index.php?seccion=asignaciones/asignarPaso2&id_colaborador=" . $colaboradorSeleccionado);
    exit();
}
$dispositivosSeleccionados = isset($_GET['dispositivos']) ? json_decode(urldecode($_GET['dispositivos']), true) : [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['aceptar'])) {
    $dispositivosSeleccionados = isset($_GET['dispositivos']) ? json_decode(urldecode($_GET['dispositivos']), true) : [];
    include 'cartaResponsiva.php'; // Incluye el archivo que contiene la función generarPDFyEnviarCorreo()
    $generarPDF = new PDF;
    $generarPDF->generarPDF($dispositivosSeleccionados, $datoscolaborador[0]["nombre_colaborador"] . ' ' . $datoscolaborador[0]["apellido_paterno_colaborador"]);
}

/*if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['aceptar'])) {
        $dispositivosSeleccionados = isset($_GET['dispositivos']) ? json_decode(urldecode($_GET['dispositivos']), true) : [];

        generarPDF($dispositivosSeleccionados, $datoscolaborador[0]["nombre_colaborador"] . ' ' . $datoscolaborador[0]["apellido_paterno_colaborador"]);
        $registar = new ControladorAsignaciones;
        foreach ($dispositivosSeleccionados as $item){
            $dispositivo =  $item['id_dispositivo'];
            $registar -> registrarAsignacion($dispositivo);
        }
    }
    /*echo  '<script>
                alert("Asignacion realizada!");
                window.location.href="index.php?seccion=asignaciones/asignaciones";
        </script>';
    exit;
}*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <br><br><br><br><br> <!-- Eliminar esta línea -->
    <div class="contentSeccion">
        <header class="headerTabla">
            <h1>Paso 3 - Confirmar Asignacion</h1>
        </header>
        <?php if (isset($datoscolaborador) && is_array($datoscolaborador) && isset($datoscolaborador)) { ?>

            <form action="" method="post" enctype="multipart/form-data">

                <div >
                    <label for="id_colaborador" class="form-label">ID Colaborador</label>
                    <input type="text" class="form-control" name="id_colaborador" value="<?= $datoscolaborador[0]["id_colaborador"] ?>" readonly>
                </div>

                <div >
                    <label for="colaborador">Colaborador</label>
                    <input type="text" class="form-control" name="colaborador" value="<?= $datoscolaborador[0]["nombre_colaborador"], ' ', $datoscolaborador[0]["apellido_paterno_colaborador"] ?>">
                </div>

        <?php
            }
        ?>

                <div class="dispositivos_seleccionados">
                    <table class="dispositivos_seleccionados">
                        <thead>
                            <tr>
                                <th>ID Dispsositivo</th>
                                <th>Tipo</th>
                                <th>Modelo</th>
                                <th>Numero de Serie</th>
                                <th>Marca</th>
                                <th>Marca</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Mostrar los dispositivos seleccionados en la nueva tabla
                            foreach ($dispositivosSeleccionados as $dispositivo) {
                                echo '<tr>';
                                echo '<td>' . $dispositivo['id_dispositivo'] . '</td>';
                                echo '<td>' . $dispositivo['tipo'] . '</td>';
                                echo '<td>' . $dispositivo['modelo'] . '</td>';
                                echo '<td>' . $dispositivo['serie'] . '</td>';
                                echo '<td>' . $dispositivo['marca'] . '</td>';
                                echo '<td>' . $dispositivo['precio'] . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
                
                <div action="mb-3" method="formForm">
                    <a class="btn btn-danger" href="index.php?seccion=asignaciones/asignaciones">Cancelar</a>
                    <button type="submit" class="btn btn-primary" name="volver">Volver</button>
                    <button type="submit" class="btn btn-primary" name="aceptar">Confirmar Asignacion</button>
                    <! Para la carta de resposiva se tiene que accede sin index para no de confricto con el menu y java script>
                    <?php/*<a class="btn btn-primary" href="vista/asignaciones/cartaResponsiva.php?colaborador=<?= urlencode($datoscolaborador[0]["nombre_colaborador"] . ' ' . $datoscolaborador[0]["apellido_paterno_colaborador"]) ?>&dispositivos=<?= urlencode(json_encode($dispositivosSeleccionados)) ?>" target="_blank">Carta Responsiva</a>*/?>
                </div>

            </form>
        
    </div>
</body>
</html>
