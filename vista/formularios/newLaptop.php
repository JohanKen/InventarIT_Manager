<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro laptop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="estilos/estilosFormularios.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row fle">
            <div class="col-md-6 headd">
                <h1>Nueva Laptop</h1>
            </div>
            <div class="col-md-6 heaad">
                <img src="images/dis/laptop.png" alt="imagenLaptop" class="img-fluid">
            </div>
        </div>
    </div>

    <div class="container mt-52">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="col-3">
                <div class="mb-3">
                    <label for="modelo" class="form-label">Modelo</label>
                    <input type="text" class="form-control" name="modelo" value="">
                </div>

                <div class="mb-3">
                    <label for="numero_serie" class="form-label">Número de serie</label>
                    <input type="text" class="form-control" name="numero_serie">
                </div>

                <div class="mb-3">
                    <label for="marca" class="form-label">Marca</label>
                    <select name="marca" class="form-select">
                        <?php
                        $marcas = ControladorDispositivos::getMarcas();
                        foreach ($marcas as $row => $item) {
                            echo '<option value="' . $item[0] . '">' . $item[1] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label id="lblNew" for="labelrecio" class="form-label">Precio</label>
                    <input type="text" class="form-control" name="precio" id="precioInput" value="">
                </div>

                <div class="mb-3">
                    <label for="fecha_compra" class="form-label">Fecha de compra</label>
                    <input type="date" class="form-control" name="fecha_compra" id="fechaCompraInput" value=""
                        placeholder="Selecciona una fecha">
                </div>

                <div class="mb-3">
                    <label for="ram" class="form-label">RAM</label>
                    <select class="form-select" name="ram">
                        <?php
                        $ramOptions = array("4GB", "8GB", "16GB", "32GB", "64GB");
                        foreach ($ramOptions as $ramOption) {
                            $ramValue = intval(preg_replace('/[^0-9]/', '', $ramOption));
                            echo "<option value='$ramValue'>$ramOption</option>";
                        }
                        ?>
                    </select>
                </div>

            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label for="procesador" class="form-label">Procesador</label>
                    <select class="form-select" name="procesador" id="procesador">
                        <?php
                        $procesadoresBaseDatos = array("Intel Core i3 10th Gen", "AMD Ryzen 5000", "Apple M1", "Intel core i5");
                        foreach ($procesadoresBaseDatos as $procesador) {
                            echo "<option value='$procesador'>$procesador</option>";
                        }
                        ?>
                        <option value="otro">Agregar otro procesador</option>
                    </select>
                </div>

                <div class="mb-3" id="nuevoProcesadorDiv" style="display: none;">
                    <label for="nuevo_procesador" class="form-label">Nuevo Procesador</label>
                    <input type="text" class="form-control" id="nuevo_procesador" name="nuevo_procesador" placeholder="Ingresa el nuevo procesador">
                </div>

                <input type="hidden" name="procesador_seleccionado" id="procesador_seleccionado">

           
           
                <div class="mb-3">
                    <label for="sistema_operativo" class="form-label">Sistema Operativo</label>
                    <select class="form-select" name="sistema_operativo">
                        <?php
                        $sistemasOperativosBaseDatos = array(
                            "Windows 10", "Windows 10 Pro", "Windows 11", "Windows 11 pro", "Ubuntu", "Fedora", "CentOS"
                        );

                        foreach ($sistemasOperativosBaseDatos as $sistemaOperativo) {
                            echo "<option value='$sistemaOperativo'>$sistemaOperativo</option>";
                        }
                        ?>
                    </select>
                </div>
                </div>
                <div class="col-3">
                <div class="mb-3">
                    <label for="nota" class="form-label">Notas (opcional)</label>
                    <textarea class="form-control" name="nota" rows="4"></textarea>
                </div>
            
          
                <div class="mb-3">
                    <label for="foto" class="form-label" style="color:black; font-family:lato; text-align:center;"
                        required="true">Imagen del dispositivo (opcional)</label>
                    <input type="file" class="form-control" name="foto">
                </div> 
                <input type="submit" class="btn btn-primary" name="Registrar" value="Registrar Dispositivo">
                
                <hr>
                <a class="btn btn-danger" href="index.php?seccion=nuevoDispositivo">Cancelar</a>
           
        </form>
    </div>
                 
    <script>
        document.getElementById('procesador').addEventListener('change', function() {
            var select = document.getElementById('procesador');
            var nuevoProcesadorDiv = document.getElementById('nuevoProcesadorDiv');
            var procesadorSeleccionadoInput = document.getElementById('procesador_seleccionado');

            if (select.value === 'otro') {
                nuevoProcesadorDiv.style.display = 'block';
                procesadorSeleccionadoInput.value = '';
            } else {
                nuevoProcesadorDiv.style.display = 'none';
                procesadorSeleccionadoInput.value = select.value;
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            var fechaCompraInput = document.getElementById('fechaCompraInput');
            var fechaCompraHidden = document.getElementById('fechaCompraHidden');

            fechaCompraInput.addEventListener('focus', function() {
                if (fechaCompraInput.value === '') {
                    fechaCompraInput.placeholder = 'Selecciona una fecha';
                }
            });

            fechaCompraInput.addEventListener('blur', function() {
                if (fechaCompraInput.value === '') {
                    fechaCompraInput.placeholder = 'Selecciona una fecha';
                }
            });

            fechaCompraInput.addEventListener('click', function() {
                fechaCompraHidden.style.display = 'block';
                fechaCompraInput.style.display = 'none';
            });

            fechaCompraHidden.addEventListener('change', function() {
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
</body>

</html>
