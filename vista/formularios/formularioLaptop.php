<?php
require_once 'controlador/ControladorDispositivos.php';

// Obtener la información del dispositivo
$dispositivoInfo = ControladorDispositivos::detalleDispositivoPLI();

$id = $_GET['id_dispositivo'];
// Inicializar el controlador para realizar la actualización
$update = new ControladorDispositivos;

// Verificar si se envió el formulario para actualizar el dispositivo
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST['guardar'])) {
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            
        $update->editarDispositivos();
    
    }}else{}
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
        <?php
        if (isset($dispositivoInfo) && is_array($dispositivoInfo) && isset($dispositivoInfo[0])) {
        ?>
            <form action="" method="post" enctype="multipart/form-data">

                
                <div class="mb-3" id="formForm">
                    <label for="tipo" class="form-label">Tipo de dispositivo</label>
                    <input type="text" class="form-control" name="tipo" value="<?= $dispositivoInfo[0]["tipo"] ?>" readonly>
                </div>

                <div class="mb-3" id="formForm">
                    <label for="id_dispositivo" class="form-label">ID</label>
                    <input type="text" class="form-control" name="id_dispositivo" value="<?= $dispositivoInfo[0]["id_dispositivo"] ?>" readonly>
                </div>
                <div class="mb-3" id="formForm">
                    <label for="modelo" class="form-label">Modelo</label>
                    <input type="text" class="form-control" name="modelo" value="<?= $dispositivoInfo[0]["modelo"] ?>">
                </div>
                <div class="mb-3" id="formForm">
                    <label for="numero_serie" class="form-label">Número de serie</label>
                    <input type="text" class="form-control" name="numero_serie" value="<?= $dispositivoInfo[0]["numero_serie"] ?>">
                </div>

                <div class="mb-3" id="formForm">
                    <label for="marca" class="form-label">Marca</label>
                    <select name="marca" id="" class="form-control">
                        <?php
                        $marcas = ControladorDispositivos::getMarcas();

                        foreach ($marcas as $row => $item) {
                            // Comparar la marca del dispositivo con la marca actual del bucle
                            $selected = ($dispositivoInfo[0]["marca"] == $item[1]) ? 'selected' : '';

                            echo '<option value="' . $item[0] . '" ' . $selected . '>' . $item[1] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3" id="formForm">
    <label for="estado" class="form-label">Estado</label>
    <select class="form-select" name="estado">
        <?php
        $estados = array("Asignado", "Disponible", "Dañado");

        foreach ($estados as $estado) {
            $selected = ($dispositivoInfo[0]["estado"] == $estado) ? 'selected' : '';
            echo "<option value='$estado' $selected>$estado</option>";
        }
        ?>
    </select>
</div>

                <div class="mb-3" id="formForm">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="text" class="form-control" name="precio" value="<?= '$' . number_format($dispositivoInfo[0]["precio"], 2, '.', ',') ?>">
                </div>
                <div class="mb-3" id="formForm">
                    <label for="fechaCompraInput" class="form-label">Fecha de compra</label>
                    <input type="text" class="form-control" name="fecha_compra" id="fechaCompraInput" value="<?= $dispositivoInfo[0]["fecha_compra"] ?>" placeholder="Selecciona una fecha">
                    <input type="date" style="display: none;" name="fecha_compra_hidden" value="<?= $dispositivoInfo[0]["fecha_compra"] ?>" id="fechaCompraHidden">
                </div>
                <div class="mb-3" id="formForm">
                    <label for="nota" class="form-label">Notas</label>
                    <textarea class="form-control" name="nota" rows="4"><?= $dispositivoInfo[0]["nota"] ?></textarea>
                </div>
                <div class="mb-3" id="formForm">
                    <label for="foto" class="form-label" style="color:black; font-family:lato; text-align:center;" required="true">Imagen del dispositivo</label>
                    <input type="file" class="form-control" name="foto">
                </div>
                <!-- Sección de RAM -->
<!-- Sección de RAM -->
<!-- Sección de RAM -->
<div class="mb-3" id="formForm">
    <label for="ram" class="form-label">RAM</label>
    <select class="form-select" name="ram">
        <?php
        $ramOptions = array("4GB", "8GB", "16GB", "32GB", "64GB");
        foreach ($ramOptions as $ramOption) {
            $ramValue = intval(preg_replace('/[^0-9]/', '', $ramOption)); // Extraer el valor numérico de la opción
            $selected = ($dispositivoInfo[0]["ram"] == $ramValue) ? 'selected' : '';
            echo "<option value='$ramValue' $selected>$ramOption</option>";
        }
        ?>
    </select>
</div>


<!-- Sección de Procesador -->
<div class="mb-3" id="formForm">
    <label for="procesador" class="form-label">Procesador</label>
    <select class="form-select" name="procesador">
        <?php
        // Obtener opciones de procesador de la base de datos
        $procesadoresBaseDatos = array("Intel Core i3 10th Gen", "AMD Ryzen 5000", "Apple M1");

        foreach ($procesadoresBaseDatos as $procesador) {
            $selected = ($dispositivoInfo[0]["procesador"] == $procesador) ? 'selected' : '';
            echo "<option value='$procesador' $selected>$procesador</option>";
        }
        ?>
    </select>
</div>


<!-- Sección de Sistema Operativo -->
<div class="mb-3" id="formForm">
    <label for="sistema_operativo" class="form-label">Sistema Operativo</label>
    <select class="form-select" name="sistema_operativo">
        <?php
        // Obtener el valor actual del Sistema Operativo
        $sistemaOperativoActual = $dispositivoInfo[0]["sistema_operativo"];

        // Mostrar el valor actual como opción seleccionada
        echo "<option value='$sistemaOperativoActual' selected>$sistemaOperativoActual</option>";

        // Obtener opciones adicionales de sistema operativo de la base de datos
        $sistemasOperativosBaseDatos = array(
            "Windows 10", "Windows 10 Pro", "Windows 11", "Windows 11 pro", "macOS High Sierra", "macOS Mojave", "macOS Catalina", "macOS Big Sur", "macOS Monterey", "Linux Mint", "Ubuntu", "Fedora", "CentOS"
        );

        foreach ($sistemasOperativosBaseDatos as $sistemaOperativo) {
            // Evitar agregar la opción actual nuevamente
            if ($sistemaOperativo !== $sistemaOperativoActual) {
                echo "<option value='$sistemaOperativo'>$sistemaOperativo</option>";
            }
        }
        ?>
    </select>
</div>






                </div>

                <div class="mb-3" id="formForm">
                    <a class="btn btn-danger" href="index.php?seccion=editarDispositivos">Cancelar</a>
                    <input type="submit" class="btn btn-primary" name="guardar" value="Actualizar Dispositivo">
                </div>
            </form>

        <?php
        } else {
            echo "El array \$dispositivoInfo no está definido o no tiene la estructura esperada.";
        }
        ?>

<!-- Debugueando los arrays para verificar que esta todo en orden
    -->
    

        <!-- Agregamos un formulario -->

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
    </div>
</body>

</html>
