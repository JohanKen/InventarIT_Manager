<?php
require_once 'controlador/ControladorDispositivos.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');


// Obtener la información del dispositivo desde el controlador mediante la consulta con el proceso almacenado datos.laptop
$tipo = 12;
$dispositivoInfo = ControladorDispositivos::detalleDispositivoGen($tipo);

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
    
    if (isset($_POST['guardarDispositivo'])) {
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

    
        
        $update->editarDispositivo();
        echo  '<script>
                    alert("Actualizacion realizada con exito!");
                    window.location.href="index.php?seccion=dispositivos";
                </script>';
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
    <link rel="stylesheet" href="estilos/estilosFormularios.css">
    
</head>


<body>
    <div class="contentSeccion">
        <?php
        if (isset($dispositivoInfo) && is_array($dispositivoInfo) && isset($dispositivoInfo[0])) {
            
        ?>
            <form action="" method="post" enctype="multipart/form-data">

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
                                    foreach ($estados as $estadoId => $estadoLabel) {
                                        $selected = ($dispositivoInfo[0]["id_estado"] == $estadoId) ? 'selected' : '';
                                        echo "<option value='$estadoId' $selected>";
                                        
                                        // Mostrar el nombre del estado en lugar del valor entero
                                        switch ($estadoId) {
                                            case 1:
                                                echo "Disponible";
                                                break;
                                            case 2:
                                                echo "Asignado";
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


                            <div class="mb-3" id="formForm">
                                <label for="precio" class="form-label">Precio</label>
                                <input type="text" class="form-control" name="precio" id="precioInput" value="<?= '$' . number_format($dispositivoInfo[0]["precio"], 2, '.', ',') ?>">
                            </div>




                <div class="mb-3" id="formForm">
                    <label for="fecha_compra" class="form-label">Fecha de compra</label>
                    <input type="date" class="form-control" name="fecha_compra" id="fechaCompraInput" value="<?= $dispositivoInfo[0]["fecha_compra"] ?>" placeholder="Selecciona una fecha">
                </div>

                <div class="mb-3" id="formForm">
                    <label for="nota" class="form-label">Notas</label>
                    <textarea class="form-control" name="nota" rows="4"><?= $dispositivoInfo[0]["nota"] ?></textarea>
                </div>
                <div class="mb-3" id="formForm">
                    <label for="foto" class="form-label" style="color:black; font-family:lato; text-align:center;" required="true">Imagen del dispositivo</label>
                    <input type="file" class="form-control" name="foto">
                </div>
                
                <div class="mb-3" id="formForm">
                    <a class="btn btn-danger" href="index.php?seccion=editarDispositivos">Cancelar</a>
                    <input type="submit" class="btn btn-primary" name="guardarDispositivo" value="Actualizar Dispositivo">
                </div>
                        

            </form>

        <?php
    

    

        } else {
            echo "El array \$dispositivoInfo no está definido o no tiene la estructura esperada.";
        }

                
            

        
        ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var precioInput = document.getElementById('precioInput');
        precioInput.addEventListener('input', function () {
            // Reemplaza todos los caracteres que no son dígitos o puntos
            var precioNumerico = precioInput.value.replace(/[^\d.]/g, '');
            // Convierte a número y formatea al estilo de moneda
            var precioFormateado = '$' + new Intl.NumberFormat().format(parseFloat(precioNumerico));
            precioInput.value = precioFormateado;
        });
    });
</script>
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