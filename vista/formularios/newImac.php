<?php
require_once 'controlador/ControladorDispositivos.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['Registrar'])){
        $registrar = new ControladorDispositivos;

        $precio = isset($_POST['precio']) ? floatval(str_replace(',', '', $_POST['precio'])) : 0;
        $dispositivoInfo[0]['precio'] = $precio;

        $registrar ->registrarImac();
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
    <title>Registro iMac</title>
    
</head>

<body>
    <div class="contentSeccion">

        <div class="up">
            <header class="headerTabla">
                <h1>Nueva iMac</h1>
                <form class="form-inline" id="searchBar">
                    <div class="input-group">
                        
                    </div>
                </form>
            </header>
        </div>

        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3" id="formForm">
                <label for="modelo" class="form-label">Modelo</Label>
                <input type="text" class=form-control name="modelo">
            </div>

            <div class="mb-3" id="formForm">
                <label for="numero_serie" class="form-label">Número de serie</label>
                <input type="text" class="form-control" name="numero_serie" >
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
                        $procesadoresBaseDatos = array("Intel Core i3 10th Gen", "AMD Ryzen 5000", "M1","M2",'Intel core i5');

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
                            "macOS Big Sur", "macOS 10 Monterey", "macOS Ventura", "macOS Sonoma", "macOS Catalina", "macOS Mojave"
                        );

                        foreach ($sistemasOperativosBaseDatos as $sistemaOperativo) {
                                echo "<option value='$sistemaOperativo'>$sistemaOperativo</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="mb-3" id="formForm">
                <label for="Keyboard_model" class="fotm-label">Modelo Del Teclado</label>
                <input type="text" class="form-control" name="Keyboard_model">
            </div>

            <div class="mb-3" id="formForm">
                <label for="keyboard_ns" class="fotm-label">Numero De Serie Del Teclado</label>
                <input type="text" class="form-control" name="keyboard_ns">
            </div>

            <div class="mb-3" id="formForm">
                <label for="mouse_model" class="fotm-label">Modelo de Mouse</label>
                <input type="text" class="form-control" name="mouse_model">
            </div>

            <div class="mb-3" id="formForm">
                <label for="mouse_ns" class="fotm-label">Numero de Serie de Mouse</label>
                <input type="text" class="form-control" name="mouse_ns">
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