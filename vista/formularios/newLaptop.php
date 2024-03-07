<?php
require_once 'controlador/ControladorDispositivos.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');

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


        $tipo = 1;
        $registrar ->registrarPc($tipo);
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
    <title>Registro laptop</title>
    <link rel="stylesheet" href="estilos/estilosFormularios.css">
</head>
<body>
    <div class ="contentSeccion">

        <div class="up">
            <header class="headerTabla">
                <h1>Nueva Laptop</h1>
                <form class="form-inline" id="searchBar">
                    <div class="input-group">
                        
                    </div>
                </form>
            </header>
        </div>

        <form action="" method="post" encytype="multipart/form-data">

            <div class ="mb-3" id="formForm">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control" name="modelo" value="">
            </div>

            <div class="mb-3" id="formForm">
                <label for="numero_serie" class="form-label">Número de serie</label>
                <input type="text" class="form-control" name="numero_serie" >
            </div>
            
            <div class="mb-3" id="formForm">
                <label for="marca" class="form-label">Marca</label>
                <select name="marca" id="" class="form-control">
                    <?php
                        $marcas = ControladorDispositivos::getMarcas();

                        foreach ($marcas as $row => $item) {
                            // Comparar la marca del dispositivo con la marca actual del bucle
                            //$selected = ($dispositivoInfo[0]["marca"] == $item[1]) ? 'selected' : '';

                            echo '<option value="' . $item[0] . '" ' . $selected . '>' . $item[1] . '</option>';
                        }
                    ?>
                </select>
            </div>

            <div class="mb-3" id="formForm">
                <label for="precio" class="form-label">Precio</label>
                <input type="text" class="form-control" name="precio" id="precioInput" value="">
            </div>

            <div class="mb-3" id="formForm">
                <label for="fecha_compra" class="form-label">Fecha de compra</label>
                <input type="date" class="form-control" name="fecha_compra" id="fechaCompraInput" value="" placeholder="Selecciona una fecha">
            </div>

            <div class="mb-3" id="formForm">
                <label for="ram" class="form-label">RAM</label>
                <select class="form-select" name="ram">
                    <?php
                        $ramOptions = array("4GB", "8GB", "16GB", "32GB", "64GB");
                        foreach ($ramOptions as $ramOption) {
                            $ramValue = intval(preg_replace('/[^0-9]/', '', $ramOption));
                            //$selected = ($dispositivoInfo[0]["ram"] == $ramValue) ? 'selected' : '';
                            echo "<option value='$ramValue' >$ramOption</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="mb-3" id="formForm">
                <label for="procesador" class="form-label">Procesador</label>
                <select class="form-select" name="procesador">
                    <?php
                        $procesadoresBaseDatos = array("Intel Core i3 10th Gen", "AMD Ryzen 5000", "Apple M1",'Intel core i5');

                        foreach ($procesadoresBaseDatos as $procesador) {
                            //$selected = ($dispositivoInfo[0]["procesador"] == $procesador) ? 'selected' : '';
                            echo "<option value='$procesador' $selected>$procesador</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="mb-3" id="formForm">
                <label for="sistema_operativo" class="form-label">Sistema Operativo</label>
                <select class="form-select" name="sistema_operativo">
                    <?php
                        //$sistemaOperativoActual = $dispositivoInfo[0]["sistema_operativo"];
                        //echo "<option value='$sistemaOperativoActual' selected>$sistemaOperativoActual</option>";

                        $sistemasOperativosBaseDatos = array(
                            "Windows 10", "Windows 10 Pro", "Windows 11", "Windows 11 pro", "Ubuntu", "Fedora", "CentOS"
                        );

                        foreach ($sistemasOperativosBaseDatos as $sistemaOperativo) {
                                echo "<option value='$sistemaOperativo'>$sistemaOperativo</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="mb-3" id="formForm">
                <label for="nota" class="form-label">Notas (opcional)</label>
                <textarea class="form-control" name="nota" rows="4"></textarea>
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