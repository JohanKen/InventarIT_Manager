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
                            echo "<option value='$ramValue' $selected>$ramOption</option>";
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
                        echo "<option value='$sistemaOperativoActual' selected>$sistemaOperativoActual</option>";

                        $sistemasOperativosBaseDatos = array(
                            "Windows 10", "Windows 10 Pro", "Windows 11", "Windows 11 pro", "macOS High Sierra", "macOS Mojave", "macOS Catalina", "macOS Big Sur", "macOS Monterey", "Linux Mint", "Ubuntu", "Fedora", "CentOS"
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
                <a class="btn btn-danger" href="index.php?seccion=nuevoDispositivo">Cancelar</a>
                <input type="submit" class="btn btn-primary" name="guardarLaptop" value="Registrar Dispositivo">
            </div>

        </form>
    </div>
</body>
</html>