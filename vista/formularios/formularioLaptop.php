<?php
require_once 'controlador/ControladorDispositivos.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');


// Obtener la información del dispositivo desde el controlador mediante la consulta con el proceso almacenado datos.laptop
$dispositivoInfo = ControladorDispositivos::detalleDispositivoPLI();

// Array asociativo que mapea nombres de marcas a IDs 
$marcas = array(
    1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10,
    11 => 11, 12 => 12, 13 => 13, 14 => 14, 15 => 15, 16 => 16, 17 => 17, 18 => 18, 19 => 19, 20 => 20,
    21 => 21, 22 => 22, 23 => 23, 24 => 24, 25 => 25, 26 => 26, 27 => 27, 28 => 28, 29 => 29, 30 => 30,
    31 => 31, 32 => 32, 33 => 33, 34 => 34, 35 => 35, 36 => 36, 37 => 37, 38 => 38, 39 => 39,
);

//Array asociativo que mapea los estados y les asigna un numero para que salgan como un entero
$estados = array(
    1 => 1,
    2 => 2,
    3 => 3
);


$id = $_GET['id_dispositivo'];


// Verificar si se envió el formulario para actualizar el dispositivo
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST['guardar'])) {
        $update = new ControladorDispositivos;    
        //LAS SIGUIENTES LINEAS SON EMPAREJAMIENTOS DE VARIABLES Y ASIGNACIONES PARA QUE PUEDAN PASAR AL CONTROLADOR DEL TIPO 
        //QUE LAS ESPERA PARA QUE NO TENGA NINGUN INCONVENIENTE CON ELLO.
        //primero hay que obtener la marca como id como en las siguientes lineas...
        // Obtener el ID de la marca desde el array asociativo
        $marcaSeleccionada = $_POST['marca'];
        $idMarca = $marcas[$marcaSeleccionada];
        // Almacena el ID de la marca en el arreglo $dispositivoInfo
        $dispositivoInfo[0]['id_marca'] = $idMarca;
        //hacemos lo mismo con esl estado...
        // Obtener el ID del estado desde el array asociativo
        $estadoSeleccionado = $_POST['estado'];
        $idEstado = $estados[$estadoSeleccionado];
        // Almacena el ID del estado en el arreglo $dispositivoInfo
        $dispositivoInfo[0]['id_estado'] = $idEstado;
    
         // Obtén el valor directo del campo de precio 
        $precio = isset($_POST['precio']) ? floatval(str_replace(',', '', $_POST['precio'])) : 0;
        // Almacena el precio en el arreglo $dispositivoInfo
        $dispositivoInfo[0]['precio'] = $precio;

    
        
        $update->editarDispositivos();
            echo "
            <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: 'success',
                title: 'Dispositivo editado correctamente'
            });
            setTimeout(function(){
                window.location.href='index.php?seccion=dispositivos';
            }, 3000); 
            </script>";

        exit;

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="estilos/estilosFormularios.css">
</head>



<body>


    <div class="container-fluid">
                <div class="row fle">
                    <div class="col-md-6 headd">
                        <h1>Editar laptop</h1>
                    </div>
                    <div class="col-md-6 heaad">
                        <img src="images/dis/laptop.png" alt="imagenLaptop" class="img-fluid">
                    </div>
                </div>
            </div>

            <div class="container mt-52">
        <?php
        if (isset($dispositivoInfo) && is_array($dispositivoInfo) && isset($dispositivoInfo[0])) {
            
        ?>
        <form action="" method="post" enctype="multipart/form-data">
        <div class="col-3">

<!-------------------------------Id-------------------------------------------->
            <div class="mb-3" id="formForm">
                <label for="id_dispositivo" class="form-label">ID</label>
                <input type="text" class="form-control" name="id_dispositivo"
                    value="<?= $dispositivoInfo[0]["id_dispositivo"] ?>" readonly>
            </div>

<!-------------------------------Modelo-------------------------------------------->
            <div class="mb-3" id="formForm">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control" name="modelo" value="<?= $dispositivoInfo[0]["modelo"] ?>" required>
            </div>

<!-----------------------------------Numero de serie---------------------------------------->
            <div class="mb-3" id="formForm">
                <label for="numero_serie" class="form-label">Número de serie</label>
                <input type="text" class="form-control" name="numero_serie"
                    value="<?= $dispositivoInfo[0]["numero_serie"] ?>" required>
            </div>
            </div>
<!-------------------------------Marca-------------------------------------------->
            <div class="col-3">
            <div class="mb-3" id="formForm">
                <label for="marca" class="form-label">Marca</label>
                <select name="marca" id="" class="form-control" required>
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
<!--------------------------------Estado------------------------------------------->
            <div class="mb-3" id="formForm">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-select" name="estado" required>
                    <?php
                                    foreach ($estados as $estadoId => $estadoLabel) {
                                        $selected = ($dispositivoInfo[0]["id_estado"] == $estadoId) ? 'selected' : '';
                                        echo "<option value='$estadoId' $selected>";
                                        
                                        // Mostrar el nombre del estado en lugar del valor entero
                                        switch ($estadoId) {
                                            case 1:
                                                echo "Disponible";
                                                break;
                                            case 2:
                                                echo "Asignado ";
                                                break;
                                            case 3:
                                                echo "Dañado";
                                                break;
                                            
                                        }

                                        echo "</option>";
                                    }
                                    ?>
                </select>
            </div>
<!------------------------------Precio-------------------------------------------->
            <div class="mb-3" id="formForm">
                <label for="precio" class="form-label">Precio</label>
                <input type="text" class="form-control" name="precio" id="precioInput"
                    value="<?= '$' . number_format($dispositivoInfo[0]["precio"], 2, '.', ',') ?>" required>
            </div>
            </div>
<!---------------------------------Fecha de compra------------------------------------------>

            <div class="col-3">
            <div class="mb-3" id="formForm">
                <label for="fecha_compra" class="form-label">Fecha de compra</label>
                <input type="date" class="form-control" name="fecha_compra" id="fechaCompraInput"
                    value="<?= $dispositivoInfo[0]["fecha_compra"] ?>" placeholder="Selecciona una fecha" required>
            </div>
<!-----------------------------------Notas---------------------------------------->
            <div class="mb-3" id="formForm">
                <label for="nota" class="form-label">Notas</label>
                <textarea class="form-control" name="nota" rows="4"><?= $dispositivoInfo[0]["nota"] ?></textarea>
            </div>
<!------------------------------------Imagen--------------------------------------->
            <div class="mb-3" id="formForm">
                <label for="foto" class="form-label" style="color:black; font-family:lato; text-align:center;"
                    required="true">Imagen del dispositivo</label>
                <input type="file" class="form-control" name="foto">
            </div>
            </div>
<!-----------------------------------------RAM-------------------------------->
            <div class="col-3">
            <div class="mb-3" id="formForm">
                <label for="ram" class="form-label">RAM</label>
                <select class="form-select" name="ram">
                    <?php
                        $ramOptions = array("4GB", "8GB", "16GB", "32GB", "64GB");
                        foreach ($ramOptions as $ramOption) {
                            $ramValue = intval(preg_replace('/[^0-9]/', '', $ramOption));
                            $selected = ($dispositivoInfo[0]["ram"] == $ramValue) ? 'selected' : '';
                            echo "<option value='$ramValue' $selected>$ramOption</option>";
                        }
                        ?>
                </select>
            </div>
<!--------------------------------Procesador------------------------------------------->
            <div class="mb-3" id="formForm">
                <label for="procesador" class="form-label">Procesador</label>
                <select class="form-select" name="procesador">
                    <?php
                        $procesadoresBaseDatos = array("Intel Core i3 10th Gen", "AMD Ryzen 5000", "Apple M1");

                        foreach ($procesadoresBaseDatos as $procesador) {
                            $selected = ($dispositivoInfo[0]["procesador"] == $procesador) ? 'selected' : '';
                            echo "<option value='$procesador' $selected>$procesador</option>";
                        }
                        ?>
                </select>
            </div>
<!----------------------------------Sistema operativo----------------------------------------->
            <div class="mb-3" id="formForm">
                <label for="sistema_operativo" class="form-label">Sistema Operativo</label>
                <select class="form-select" name="sistema_operativo">
                    <?php
                        $sistemaOperativoActual = $dispositivoInfo[0]["sistema_operativo"];
                        echo "<option value='$sistemaOperativoActual' selected>$sistemaOperativoActual</option>";

                        $sistemasOperativosBaseDatos = array(
                            "Windows 10", "Windows 10 Pro", "Windows 11", "Windows 11 pro", "macOS High Sierra", "macOS Mojave", "macOS Catalina", "macOS Big Sur", "macOS Monterey", "Linux Mint", "Ubuntu", "Fedora", "CentOS"
                        );

                        foreach ($sistemasOperativosBaseDatos as $sistemaOperativo) {
                            if ($sistemaOperativo !== $sistemaOperativoActual) {
                                echo "<option value='$sistemaOperativo'>$sistemaOperativo</option>";
                            }
                        }
                        ?>
                </select>
            </div>
<!-------------------------------Botones-------------------------------------------->
            </div>
            </div>
            <div class="conn">
            <div class="mb-3" id="formForm">
            <input type="submit" class="btn btn-primary" name="guardar" value="Actualizar Dispositivo">

            <hr>
            <a class="btn btn-danger" href="index.php?seccion=dispositivos">Cancelar</a>
<!--------------------------------------------------------------------------->

                
                <hr>
            </div>
            </div>
           


        </form> 

        <?php
    

    

        } else {
            echo "El array \$dispositivoInfo no está definido o no tiene la estructura esperada.";
        }

                
            

        
        ?>


        <script>
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
    </div>
</body>

</html>