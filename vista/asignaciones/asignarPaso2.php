<?php
require_once 'controlador/ControladorColaboradores.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');

$datoscolaborador = ControladorColaboradores::detalleColaborador();

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['continuar'])){
    $colaboradorSeleccionado = $datoscolaborador[0]["id_colaborador"];
    $dispositivoSeleccionado = $_POST['dispositivo'];
    //al momento de darle en continuar se tiene que madar los datos del colaborador y del dispositivo
    header("Location: index.php?seccion=asignaciones/asignarPaso3&id_colaborador=".$colaboradorSeleccionado."&id_dispositivo=".$dispositivoSeleccionado);
    exit();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paso 2 de la asinacion</title>
    <link rel="stylesheet" href="estilos/estilosFormularios.css">
</head>
<body>
    <div class="contentSeccion">

            <div class="up">
                <header class="headerTabla">
                    <h1>Paso 2 - Eligir Dispositivo</h1>
                </header>
            </div>

    <?php if (isset($datoscolaborador) && is_array($datoscolaborador)&& isset($datoscolaborador)){ ?>

        <form action="" method="post" enctype="multipart/form-data">


            <div action="mb-3" method="formForm" >
                <label for="nombre_colaborador" class="form-label">Nombre: <?=$datoscolaborador[0]["nombre_colaborador"] ,' ',$datoscolaborador[0]["apellido_paterno_colaborador"]?></label>
                <input type="text" class="form-control" name="nombre_colaborador" value="<?=$datoscolaborador[0]["nombre_colaborador"]?>" readonly>
                <input type="text" class="form-control" name="apellido_paterno_colaborador" value="<?=$datoscolaborador[0]["apellido_paterno_colaborador"]?>" readonly>
            </div>

            <div action="mb-3" method="formForm">
                <label class="dispositivo" class="form-label">Elige el dispositivo</label>
                <select name="dispositivo" id="form-lebel" class="form-control">
                    <option value="" disabled selected>-- Seleccione un Dispositivo --</option>
                    <?php
                        // se utiliza otra funcion para que aparescan solo los dispositivos disponibles
                        $dispositivosDisponible = ControladorDispositivos::consultaDispositivosDiponibles();
                        foreach($dispositivosDisponible as $row => $item){
                            $selectedOption ='';
                            echo '<option value="'.$item[0].'"'.$selectedOption.'>'
                            .$item[0].' '.$item[1].' ' . $item[2] . ' ' . $item[3] . ' ' . $item[4] .'</option>';
                        }
                    ?>
                </select>
            </div>

            <div action="mb-3" method="formForm">
                <a class="btn btn-danger" href="index.php?seccion=asignaciones/asignaciones">Cancelar</a>
                <a class="btn btn-danger" href="index.php?seccion=asignaciones/asignarPaso1">Volver</a>
                <button type="submit" class="btn btn-primary" name="continuar">Continuar</button>
            </div>

        </form>

        <?php 
            } else {
                echo "El array \$dispositivoInfo no está definido o no tiene la estructura esperada.";
            }
        ?>

    </div>
</body>
</html>