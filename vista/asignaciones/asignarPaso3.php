<?php
// Este es asignarPaso3.php
require_once 'controlador/ControladorColaboradores.php';
require_once 'controlador/ControladorAsignaciones.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');

$datoscolaborador = ControladorColaboradores::detalleColaborador();
$dispositivosSeleccionados = isset($_GET['dispositivos']) ? json_decode(urldecode($_GET['dispositivos']), true) : [];
$id_colaborador = $datoscolaborador[0]["id_colaborador"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/estilosAsignacionesPaso3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Confirmar datos</title>
</head>
<body>
<div class="row ">
<div class="col-sm"></div>
<div class="col-sm">
        <header class="headerTabla">
            <br>
            <h1>Confirmar Asignación</h1>
            <br>
        </header>
        <?php if (isset($datoscolaborador) && is_array($datoscolaborador)) { ?>
            <form id="confirmForm" action="javascript:void(0);" method="post" enctype="multipart/form-data">
                <div>
                    
                <!--
                    <label for="id_colaborador" class="form-label">ID Colaborador</label>
                    <input type="text" class="form-control" name="id_colaborador" value=" <?/*= $datoscolaborador[0]["id_colaborador"] */?>" readonly>
        -->         <div class="flext">
                        <img src="images/empleados.png" alt="Colaborador Icon" class="form-icon">
                        <h4 style="color:#333;"><?= $datoscolaborador[0]["nombre_colaborador"] . ' ' . $datoscolaborador[0]["apellido_paterno_colaborador"] ?></h4>
                    </div>
                    <br><br>
      

                    <div class="flext">
                    <img src="images/clienteSelect.png" alt="Cliente Icon" class="form-icon">
                    <h4 style="color:#333;"><?= $datoscolaborador[0]["empresa"] ?></h4>
                    </div>
                </div>
            <br><br>
                <div class="dispositivos_seleccionados">
                    <table class="table table-bordered" id="tableConfirm">
                        <thead class="table-dark">
                            <tr>
                                <th>ID Dispositivo</th>
                                <th>Tipo</th>
                                <th>Modelo</th>
                                <th>Numero de Serie</th>
                                <th>Marca</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dispositivosSeleccionados as $dispositivo) { ?>
                                <tr class="w-50 p-3">
                                    <td class="table-secondary" ><?= $dispositivo['id_dispositivo'] ?></td>
                                    <td class="table-secondary"><?= $dispositivo['tipo'] ?></td>
                                    <td class="table-secondary"><?= $dispositivo['modelo'] ?></td>
                                    <td class="table-secondary"><?= $dispositivo['serie'] ?></td>
                                    <td class="table-secondary"><?= $dispositivo['marca'] ?></td>
                                    <td class="table-secondary"><?= $dispositivo['precio'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="flext">
                <div class="mb-3" style="margin-bottom:0px !important;">
                    
                    <button class="btn btn-danger"><a style="color: white; text-decoration:none" name="volver" href="index.php?seccion=asignaciones/asignarPaso2&id_colaborador=<?php echo $id_colaborador; ?>">Volver</a></button>
                   
                </div>
                <div class="end">
                    <button type="submit" class="btn btn-primary" name="aceptar">Confirmar Asignacion</button>

                    </div>
                    </div>
            </form>
            </div>
            <div class="col-sm"></div>
            </div>
        <?php } ?>
    </div>

    <script>
        document.getElementById('confirmForm').addEventListener('submit', function() {
            // Recoger los dispositivos seleccionados
            var dispositivosSeleccionados = <?= json_encode($dispositivosSeleccionados) ?>;
            var dispositivosEncoded = encodeURIComponent(JSON.stringify(dispositivosSeleccionados));
            
            // Recoger el ID del colaborador
            var colaboradorSeleccionado = <?= json_encode($id_colaborador) ?>;
            

            //ANTES DE CONTINUAR MOSTRAR ALERTA DE QUE LA ASIGNACION SERA CREADA
            // Redirigir
            window.location.href = "index.php?seccion=asignaciones/asignarPaso4&id_colaborador=" + colaboradorSeleccionado + "&dispositivos=" + dispositivosEncoded;
        });
    </script>
</body>
</html>
