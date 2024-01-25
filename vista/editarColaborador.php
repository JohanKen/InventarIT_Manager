<?php
require_once 'controlador/ControladorColaboradores.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');

$datoscolaborador = ControladorColaboradores::detalleColaborador();

$estados = array(
    1 => 1,
    2 => 2
);

$clientes = array(
    1 => 1,
    2 => 2,
    3 => 3,
    4 => 4,
    5 => 5,
    6 => 6,
    7 => 7,
    8 => 8,
);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Colaborador</title>
        <link rel="stylesheet" href="estilos/estilosFormularios.css">
</head>

<body>
    <div class="contentSeccion">
        <?php
            if (isset($datoscolaborador) && is_array($datoscolaborador) && isset($datoscolaborador[0]))
        ?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3" id="formForm">
            <label for="id_colaborador" class="form-label">ID</label>
            <input type="text" class="form-control" name="id_colaborador" value="<?=$datoscolaborador[0]["id_colaborador"]?>" >
        </div>
        <div class="mb-3" id="formForm">
            <label for="id_cplaborador" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre_colaborador" value="<?=$datoscolaborador[0]["nombre_colaborador"]?>" >
        </div>
        <div class="mb-3" id="formForm">
            <label for="id_dispositivo" class="form-label">Apellido</label>
            <input type="text" class="form-control" name="apellido_paterno_colaborador" value="<?=$datoscolaborador[0]["apellido_paterno_colaborador"]?>" >
        </div>

            <div class="mb-3" id="formForm">
                <label for="empresa" class="form-label">Cliente</label>
                <select  name="empresa" id="" class="form-control" >
                    <?php 
                        $clientes = ControladorColaboradores::getClientes();
                        
                        foreach ($clientes as $row => $item){
                            $selected = ($datoscolaborador[0]["nombre_empresa"] == $item[1]) ? 'selected' : '';
                            echo '<option value="' . $item[0] . '" ' . $selected . '>' . $item[1] . '</option>';

                        }
                    ?>
                </select>
            </div>

        <div class="mb-3" id="formForm">
            <label for="id_dispositivo" class="form-label">Departamento</label>
            <input type="text" class="form-control" name="departamento" value="<?=$datoscolaborador[0]["departamento"]?>" >
        </div>
        <div class="mb-3" id="formForm">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="" class="form-control">
                <?php
                    $estados = ControladorColaboradores::getEstados();
                    foreach ($estados as $row => $item){
                        $selected = ($datoscolaborador[0]["estado"] == $item[1]) ? 'selected' : '';
                        echo '<option value="' . $item[0] . '" ' . $selected . '>' . $item[1] . '</option>';
                    }
                ?>
            </select>
        </div>
        <div class="mb-3" id="formForm">
            <label for="fecha_ingreso_colaborador" class="form-label">Fecha de ingreso</label>
            <input type="date" class="form-control" name="fecha_ingreso_colaborador" value="<?= $datoscolaborador[0]["fecha_ingreso_colaborador"]?>" placeholder= "Selecciona una fecha">
        </div>
    </div>
</body>