<?php
//este es asignarPaso3.php
require_once 'controlador/ControladorColaboradores.php';
require_once 'controlador/ControladorDispositivos.php';
error_reporting(E_ALL);
ini_set('dispaly_errors', '1');

$datoscolaborador = ControladorColaboradores::detalleColaborador();


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['volver'])) {
    $colaboradorSeleccionado = $datoscolaborador[0]["id_colaborador"];
    header("Location: index.php?seccion=asignaciones/asignarPaso2&id_colaborador=" . $colaboradorSeleccionado);
    exit();
}
$dispositivosSeleccionados = isset($_GET['dispositivos']) ? json_decode(urldecode($_GET['dispositivos']), true) : [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['aceptar'])) {
        $asignar = new ControladorDispositivos;
        $asignar->registrarAsignacion();
        echo  '<script>
                alert("Asignacion realizada!");
                window.location.href="index.php?seccion=asignaciones/asignaciones";
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

                <div class="mb-3" id="formForm">
                    <label for="id_colaborador" class="form-label">ID Colaborador</label>
                    <input type="text" class="form-control" name="id_colaborador" value="<?= $datoscolaborador[0]["id_colaborador"] ?>" readonly>
                </div>

                <div class="mb-3" id="formForm">
                    <label for="colaborador">Colaborador</label>
                    <input type="text" class="form-control" name="colaborador" value="<?= $datoscolaborador[0]["nombre_colaborador"], ' ', $datoscolaborador[0]["apellido_paterno_colaborador"] ?>">
                </div>

        <?php
            }
        ?>

                <div class="vista_previa">
                    <table class="vista_previa">
                        <thead>
                            <tr>
                                <th>ID Dispsositivo</th>
                                <th>Tipo</th>
                                <th>Modelo</th>
                                <th>Numero de Serie</th>
                                <th>Marca</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Convertir los datos de dispositivos seleccionados de JSON a un array
                            //$dispositivosSeleccionados = json_decode(urldecode($_GET['dispositivos']), true);

                            // Mostrar los dispositivos seleccionados en la nueva tabla
                            foreach ($dispositivosSeleccionados as $dispositivo) {
                                echo '<tr>';
                                echo '<td>' . $dispositivo['id_dispositivo'] . '</td>';
                                echo '<td>' . $dispositivo['tipo'] . '</td>';
                                echo '<td>' . $dispositivo['modelo'] . '</td>';
                                echo '<td>' . $dispositivo['serie'] . '</td>';
                                echo '<td>' . $dispositivo['marca'] . '</td>';
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
                </div>
            </form>

        
    </div>
</body>
</html>
