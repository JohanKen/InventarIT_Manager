<?php
    require_once 'controlador/ControladorDispositivos.php';
    error_reporting(E_ALL);
    ini_set('display_errors','1');

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST["Registrar"])){
            $registrar = new ControladorDispositivos;

            $registrar -> registrarHerramienta();
            echo  '<script>
                        alert("Registro realizado con exito!");
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
    <title>Nueva Herramienta</title>
    
</head>
<body>
    <div class="contentSeccion">

        <div class="up">
            <header class="heaserTabla">
                <h1>Nureva Herramienta</h1>
            </header>
        </div>

        <form action="" method="post" encytype="multipart/form-data">

            <div class="mb-3" id="formForm">
                <label for="nombre_herramienta" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre_herramienta">
            </div>

            <div class="mb-3" id="formForm">
                <label for="numero_piezas" class="form-label">Numero de piezas</label>
                <input type="number" class="form-control" name="numero_piezas" min="1" max="1000" >
            </div>

            <div class="mb-3" id="formForm">
                <label for="ubicacion" class="form-label">Ubicacion</label>
                <input type="text" class="form-control" name="ubicacion">
            </div>

            <div class="mb-3" id="formForm">
                <label for="fecha_compra" class="form-label">Fecha de comprar</label>
                <input type="date" class="form-control" name="fecha_compra" id="fechaCompraInput" value="" placeholder="Selecciona una fecha">
            </div>

            <div class="mb-3" id="formForm">
                <label for="descripcion" class="form-label">Nota (opcional)</label>
                <textarea class="form-control" name="descripcion" rows="4"></textarea>
            </div>

            <div class="mb-3" id="formForm">
                <a class="btn btn-danger" href="index.php?seccion=herramientas">Cancelar</a>
                <input type="submit" class="btn btn-primary" name="Registrar" value="Registrar Dispositivo">
            </div>
        </form>

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
</body>
</html>