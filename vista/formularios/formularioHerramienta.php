<?php
require_once 'controlador/ControladorDispositivos.php';
error_reporting(E_ALL);
ini_set('display_errors','1');

$herramientaInfo = ControladorDispositivos::detalleHerramienta();

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST['guardarHerramienta'])){
        $update = new ControladorDispositivos;
        $update ->editarHerramienta();

        echo  '<script>
                    alert("Actualizacion realizada con exito!");
                    window.location.href="index.php?seccion=herramientas";
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
    <link rel="stylesheet" href="estilos/estilosFormularios.css">
</head>

<body>
    <div class="contentSeccion">
        <?php
            if (isset($herramientaInfo)&& is_array($herramientaInfo)&& isset($herramientaInfo[0])){
        ?>

            <form action="" method="post" enctype="multipart/form-data">

                <div class="mb-3" id="formForm">
                    <label for="id_herramienta" class="form-label">ID</label>
                    <input type="text" class="form-control" name="id_herramienta" value="<?= $herramientaInfo[0]["id_herramienta"] ?>" readonly>
                </div>

                <div class="mb-3" id="formForm">
                    <label for="nombre_herramienta" class="form-label">Nombre Herramienta</label>
                    <input type="text" class="form-control" name="nombre_herramienta" value="<?=$herramientaInfo[0]["nombre"]?>">
                </div>

                <div class="mb-3" id="formForm">
                    <label for="numero_piezas" class="form-label">Numero de piezas</label>
                    <! para el numero de piezas se va introducir puros numero completos>
                    <input type="number" class="form-control" name="numero_piezas" min="1" max="1000" value="<?=$herramientaInfo[0]["numero_piezas"]?>">
                </div>

                <div class="mb-3" id="formForm">
                    <label for="ubicacion" class="form-label">Ubicacion</label>
                    <input type="text" class="form-control" name="ubicacion" value="<?=$herramientaInfo[0]["ubicacion"]?>">
                </div>

                <div class="mb-3" id="formForm">
                    <label for="fecha_compra" class="fecha-label">Fecha de Compra</label>
                    <input type="date" class="form-control" name="fecha_compra" id="fechaCompraInput" value="<?=$herramientaInfo[0]["fecha_compra"]?>" placeholder="Selecciona una fecha">
                </div>

                <div class="mb-3" id="formForm">
                    <label for="descripcion" class="fecha-label">Nota (opcional)</label>
                    <textarea class="form-control" name="descripcion" rows="4"><?=$herramientaInfo[0]["descripcion"]?></textarea>
                </div> 

                <div class="mb-3" id="formForm">
                    <a class="btn btn-danger" href="index.php?seccion=herramientas">Cancelar</a>
                    <input type="submit" class="btn btn-primary" name="guardarHerramienta" value="Actualizar Herramienta">
                </div>

            </form>

        <?php
            } else  {
                echo "El array \$herramientainfo no está definido o no tiene la estructura esperada.";
            }
        ?>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var fechaCompraInput = document.getElementById('fechaCompraInput');
                var fechaCompraHidden = document.getElementById('fechaCompraHidden');

                fechaCompraInput.addEventListener('focus', function () {
                    if (fechaCompraInput.value === '') {
                        fechaCompraInput.placeholder = 'Selecciona una fecha';
                    }
                });

                fechaCompraInput.addEventListener('blur', function () {
                    if (fechaCompraInput.value === '') {
                        fechaCompraInput.placeholder = 'Selecciona una fecha';
                    }
                });

                fechaCompraInput.addEventListener('click', function () {
                    fechaCompraHidden.style.display = 'block';
                    fechaCompraInput.style.display = 'none';
                });

                fechaCompraHidden.addEventListener('change', function () {
                    var fechaSeleccionada = new Date(fechaCompraHidden.value);
                    var nombreMes = obtenerNombreMes(fechaSeleccionada.getMonth());
                    fechaCompraInput.value = fechaSeleccionada.getDate() + '-' + nombreMes + '-' +
                        fechaSeleccionada.getFullYear();
                    fechaCompraHidden.style.display = 'none';
                    fechaCompraInput.style.display = 'block';
                });

                function obtenerNombreMes(numeroMes) {
                    var meses = [
                        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                    ];
                    return meses[numeroMes];
                }
            });
        </script>

    </div>
</html>