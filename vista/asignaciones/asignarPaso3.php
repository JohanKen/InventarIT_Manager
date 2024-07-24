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
    <title>Confirmar Asignacion</title>
</head>
<body>
    <div class="contentSeccion">
        <header class="headerTabla">
            <h1>Paso 3 - Confirmar Asignacion</h1>
        </header>
        <?php if (isset($datoscolaborador) && is_array($datoscolaborador)) { ?>
            <form id="confirmForm" action="javascript:void(0);" method="post" enctype="multipart/form-data">
                <div>
                    <label for="id_colaborador" class="form-label">ID Colaborador</label>
                    <input type="text" class="form-control" name="id_colaborador" value="<?= $datoscolaborador[0]["id_colaborador"] ?>" readonly>
                    <label for="colaborador">Colaborador</label>
                    <input type="text" class="form-control" name="colaborador" value="<?= $datoscolaborador[0]["nombre_colaborador"] . ' ' . $datoscolaborador[0]["apellido_paterno_colaborador"] ?>" readonly>
                    <label for="cliente" class="form-label">Cliente:</label>
                    <input type="text" class="form-control" name="cliente" value="<?= $datoscolaborador[0]["empresa"] ?>" readonly>
                </div>

                <div class="dispositivos_seleccionados">
                    <table class="dispositivos_seleccionados">
                        <thead>
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
                                <tr>
                                    <td><?= $dispositivo['id_dispositivo'] ?></td>
                                    <td><?= $dispositivo['tipo'] ?></td>
                                    <td><?= $dispositivo['modelo'] ?></td>
                                    <td><?= $dispositivo['serie'] ?></td>
                                    <td><?= $dispositivo['marca'] ?></td>
                                    <td><?= $dispositivo['precio'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="mb-3">
                    <a class="btn btn-danger" href="index.php?seccion=asignaciones/asignaciones">Cancelar</a>
                    <a class="btn btn-primary" name="volver" href="index.php?seccion=asignaciones/asignarPaso2&id_colaborador=<?php echo $id_colaborador; ?>">Volver</a>
                    <button type="submit" class="btn btn-primary" name="aceptar">Confirmar Asignacion</button>
                </div>
            </form>
        <?php } ?>
    </div>

    <script>
        document.getElementById('confirmForm').addEventListener('submit', function() {
            // Recoger los dispositivos seleccionados
            var dispositivosSeleccionados = <?= json_encode($dispositivosSeleccionados) ?>;
            var dispositivosEncoded = encodeURIComponent(JSON.stringify(dispositivosSeleccionados));
            
            // Recoger el ID del colaborador
            var colaboradorSeleccionado = <?= json_encode($id_colaborador) ?>;
            
            // Redirigir
            window.location.href = "index.php?seccion=asignaciones/asignarPaso4&id_colaborador=" + colaboradorSeleccionado + "&dispositivos=" + dispositivosEncoded;
        });
    </script>
</body>
</html>
