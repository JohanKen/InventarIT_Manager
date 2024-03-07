<?php
require_once 'controlador/ControladorDispositivos.php';
error_reporting(E_ALL);
ini_set('display_errors','1');

$marcas = array(
    1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10,
    11 => 11, 12 => 12, 13 => 13, 14 => 14, 15 => 15, 16 => 16, 17 => 17, 18 => 18, 19 => 19, 20 => 20,
    21 => 21, 22 => 22, 23 => 23, 24 => 24, 25 => 25, 26 => 26, 27 => 27, 28 => 28, 29 => 29, 30 => 30,
    31 => 31, 32 => 32, 33 => 33, 34 => 34, 35 => 35, 36 => 36, 37 => 37, 38 => 38, 39 => 39,
); 

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['Registrar'])){
        $registrar = new ControladorDispositivos;

        $marcaSeleccionada = $_POST['marca'];
        $idMarca = $marcas[$marcaSeleccionada];
        $dispositivoInfo[0]['id_marca'] = $idMarca;

        $precio = isset($_POST['precio']) ? floatval(str_replace(',', '', $_POST['precio'])) : 0;
        $dispositivoInfo[0]['precio'] = $precio;

        $tipo = 8;
    
        $registrar -> registrarDispositivo($tipo);

        echo  '<script>
                    alert("Registro realizado con exito!");
                    window.location.href="index.php?seccion=dispositivos";
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
    <title>Registro celular</title>
    
</head>

<body>
    <div class="contentSeccion">

        <div class="up">
            <header class="headerTabla">
                <h1>Nuevo Celular</h1>
            </header>
        </div>

        <form action="" method="post" encytype="maultipart/form-data">

            <div class="mb-3" id="formForm">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control" name="modelo">
            </div>

            <div class="mb-3" id="formForm">
                <label for="modelo" class="form-label">Número de serie</label>
                <input type="text" class="form-control" name="numero_serie">
            </div>

            <div class="mb-3" id="formForm">
                <label for="marca" class="form-label">Marca</label>
                <select name="marca" id="" class="form-control">
                    <?php
                        $marcas = ControladorDispositivos::getMarcas();

                        foreach($marcas as $row => $item){
                            echo '<option value="' .$item[0]. '" ' .$selected . '>'. $item[1]. '</option>';
                        }
                    ?>
                </select>
            </div>

            <div class="mb-3" id="formForm">
                <label for="precio" class="form-label">Precio</label>
                <input typr="text" class="form-control" name="precio" id="precioInput">
            </div>

            <div class="mb-3" id="formForm">
                <label for="fecha_compra" class="form-label">Fecha de compra</lable>
                <input type="date" class="form-control" name="fecha_compra" id="fechaCompraInput" value="" placeholder="Selecciona una fecha">
            </div>

            <div class="mb-3" id="formForm">
                <label for="nota" class="form-label">Nota (opcional)</label>
                <textarea class="form-label" name="nota" rows="4"></textarea>
            </div>

            <div class="mb-3" id="formForm">
                <label for="foto" class="form-label" style="color:black; font-family:lato; text-align:center;" required="true">Imagen del dispositivo (opcional)</label>
                <input type="file" class="form-control" name="foto">
            </div>

            <div class="mb-3" id="formForm">
                <a class="btn btn-danger" href="index.php?seccion=nuevoDispositivo">Cancelar</a>
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