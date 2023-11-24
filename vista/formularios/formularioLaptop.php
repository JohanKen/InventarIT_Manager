<?php

require_once 'controlador/ControladorDispositivos.php';

// Obtener la información del dispositivo
$dispositivoInfo = ControladorDispositivos::detalleLaptop();

// Inicializar el controlador para realizar la actualización
$update = new ControladorDispositivos;

// Verificar si se envió el formulario para actualizar el dispositivo
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['guardar'])) {
        $update->editarDispositivos();
    }
}

// Renderizar el formulario con la información del dispositivo
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar dispositivo</title>
    <link rel="stylesheet" href="estilos/estilosFormularios.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="contentSeccion">
        <!-- Agregamos un formulario -->
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3" id="formForm">
                <label for="id_dispositivo" class="form-label">ID</label>
                <input type="text" class="form-control" name="id_dispositivo" value="<?= $dispositivoInfo[0][0] ?>" readonly>
            </div>
            <div class="mb-3" id="formForm">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control" name="modelo" value="<?= $dispositivoInfo[0][2] ?>">
            </div>
            <div class="mb-3" id="formForm">
                <label for="numero_serie" class="form-label">Número de serie</label>
                <input type="text" class="form-control" name="numero_serie" value="<?= $dispositivoInfo[0][3] ?>">
            </div>
            <div class="mb-3" id="formForm">
                <label for="ram" class="form-label">RAM</label>
                <select class="form-select" name="ram">
                    <option value="4GB" <?php echo ($dispositivoInfo[0][4] == '4GB') ? 'selected' : ''; ?>>4GB</option>
                    <option value="8GB" <?php echo ($dispositivoInfo[0][4] == '8GB') ? 'selected' : ''; ?>>8GB</option>
                    <option value="16GB" <?php echo ($dispositivoInfo[0][4] == '16GB') ? 'selected' : ''; ?>>16GB</option>
                    <option value="32GB" <?php echo ($dispositivoInfo[0][4] == '32GB') ? 'selected' : ''; ?>>32GB</option>
                    <option value="64GB" <?php echo ($dispositivoInfo[0][4] == '64GB') ? 'selected' : ''; ?>>64GB</option>
                </select>
            </div>
            <div class="mb-3" id="formForm">
                <label for="procesador" class="form-label">Procesador</label>
                <select class="form-select" name="procesador">
                    <?php
                    // Procesadores Intel Core i5 e i7 de las generaciones 10 en adelante
                    $generacionesIntel = array(10, 11, 12, 13); // Ajusta según tus necesidades
                    $i5 = array_map(function ($gen) { return "Intel Core i5 $gen"; }, $generacionesIntel);
                    $i7 = array_map(function ($gen) { return "Intel Core i7 $gen"; }, $generacionesIntel);

                    // Procesadores AMD Ryzen de las generaciones 3000, 5000 y 7000
                    $generacionesAMD = array(3000, 5000, 7000); // Ajusta según tus necesidades
                    $procesadoresAMD = array_map(function ($gen) { return "AMD Ryzen $gen"; }, $generacionesAMD);

                    // Procesadores de Mac
                    $procesadoresMac = array("Apple M1", "Apple M2"); // Ajusta según tus necesidades

                    // Combina todos los procesadores en un solo array
                    $procesadoresTotales = array_merge($i5, $i7, $procesadoresAMD, $procesadoresMac);

                    foreach ($procesadoresTotales as $procesador) {
                        $selected = ($dispositivoInfo[0][5] == $procesador) ? 'selected' : '';
                        echo "<option value='$procesador' $selected>$procesador</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3" id="formForm">
                <label for="sistema_operativo" class="form-label">Sistema Operativo</label>
                <select class="form-select" name="sistema_operativo">
                    <?php
                    // Sistemas operativos de Windows desde 2018
                    $windowsVersions = array("Windows 10", "Windows 11");

                    // Sistemas operativos de Mac desde 2018
                    $macVersions = array("macOS High Sierra", "macOS Mojave", "macOS Catalina", "macOS Big Sur", "macOS Monterey");

                    $allOperatingSystems = array_merge($windowsVersions, $macVersions);

                    foreach ($allOperatingSystems as $os) {
                        $selected = ($dispositivoInfo[0][6] == $os) ? 'selected' : '';
                        echo "<option value='$os' $selected>$os</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3" id="formForm">
                <label for="marca" class="form-label">Marca</label>
                <select name="marca" id="" class="form-control">
                    <?php
                    $marcas = ControladorDispositivos::getMarcas();

                    foreach ($marcas as $row => $item) {
                        echo '<option value="' . $item[0] . '" ' . ($dispositivoInfo[0][9] == $item[1] ? 'selected' : '') . '>' . $item[1] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3" id="formForm">
                <label for="precio" class="form-label">Precio</label>
                <input type="text" class="form-control" name="precio" value="<?= '$' . number_format($dispositivoInfo[0][8], 2, '.', ',') ?>">
            </div>
            <div class="mb-3" id="formForm">
                <label for="estado" class="form-label">Estado</label>
                <select name="estado" id="" class="form-control">
                    <?php
                    $estados = ControladorDispositivos::getEstados();

                    foreach ($estados as $row => $item) {
                        echo '<option value="' . $item[0] . '" ' . ($dispositivoInfo[0][9] == $item[1] ? 'selected' : '') . '>' . $item[1] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3" id="formForm">
                <label for="fechaCompraInput" class="form-label">Fecha de compra</label>
                <input type="text" class="form-control" name="fecha_compra" id="fechaCompraInput" value="<?= $dispositivoInfo[0][10] ?>" placeholder="Selecciona una fecha">
                <input type="date" style="display: none;" name="fecha_compra_hidden" value="<?= $dispositivoInfo[0][10] ?>" id="fechaCompraHidden">
            </div>
            <div class="mb-3" id="formForm">
                <label for="nota" class="form-label">Notas</label>
                <textarea class="form-control" name="nota" rows="4"><?= $dispositivoInfo[0][11] ?></textarea>
            </div>
            <div class="mb-3" id="formForm">
                <label for="" class="form-label" style="color:black; font-family:lato; text-align:center;" required="true">Imagen del dispositivo</label>
                <input type="file" class="form-control" name="foto">
            </div>
            <div class="mb-3" id="formForm">
                <a class="btn btn-danger" href="index.php?seccion=editarDispositivos">Cancelar</a>
                <input type="submit" class="btn btn-primary" name="guardar" value="Actualizar Dispositivo">
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

            // Mostrar el campo de fecha oculto cuando se hace clic en el campo de texto
            fechaCompraInput.addEventListener('click', function () {
                fechaCompraHidden.style.display = 'block';
                fechaCompraInput.style.display = 'none';
            });

            // Ocultar el campo de fecha oculto cuando se selecciona una fecha
            fechaCompraHidden.addEventListener('change', function () {
                // Obtener la fecha seleccionada
                var fechaSeleccionada = new Date(fechaCompraHidden.value);

                // Obtener el nombre del mes
                var nombreMes = obtenerNombreMes(fechaSeleccionada.getMonth());

                // Actualizar el valor del campo de texto con el nombre del mes
                fechaCompraInput.value = fechaSeleccionada.getDate() + ' de ' + nombreMes + ' de ' +
                    fechaSeleccionada.getFullYear();

                fechaCompraHidden.style.display = 'none';
                fechaCompraInput.style.display = 'block';
            });

            // Función para obtener el nombre del mes
            function obtenerNombreMes(numeroMes) {
                var meses = [
                    'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                ];
                return meses[numeroMes];
            }
        });
    </script>
</body>

</html>
