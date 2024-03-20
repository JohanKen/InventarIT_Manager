<?php
require_once 'controlador/ControladorColaboradores.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');

$datoscolaborador = ControladorColaboradores::detalleColaborador();

$estados = array(
    1 => 1,
    2 => 2
);

$clientes = array(
    1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8,
);

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST['guardarColaborador'])){
        $update = new ControladorColaboradores;

        $clienteSeleccionado = $_POST['empresa'];
        $idCliente = $clientes[$clienteSeleccionado];
        $datoscolaborador[0]['id_empresa']=$idCliente;

        $estadoSeleccionado = $_POST['estado'];
        $idEstado = $estados[$estadoSeleccionado];
        $datoscolaborador[0]['id_estado']=$idEstado;

        $update->editarColaborador();
        
        echo "<script>
       
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.onmouseenter = Swal.stopTimer;
              toast.onmouseleave = Swal.resumeTimer;
            }
          });
          Toast.fire({
            icon: 'success',
            title: 'Actualización de datos realizada con exito'
          }).then(function (result){
                if (true){
                    window.location.href='index.php?seccion=colaboradores';
                        }
          }
          ) 
            
          
          </script>";
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Colaborador</title>
        <link rel="stylesheet" href="estilos/estilosFormularios.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
    body{
        font-style: bold;
    }
      #txtTitulo {
    color: white;
    font-size: 40px;
}
.form-label{
    background: none;
    
    background-color: #333;
    border-radius: 5px;
    padding: 5px;
    color:white;
    font-style: bold;
    font-size: 20px;
}
#divTitulo {
    justify-content: center;
    text-align: center;
    align-items: center;
    padding: 5%;
    display: flex;
}

#imgGODIN {
    margin-left: 2%;
    max-width: 40px;
    max-height: 40px;
}

@media only screen and (max-width: 768px) {
    #txtTitulo {
        font-size: 30px; /* Reducir el tamaño del texto en tabletas */
    }

    #divTitulo {
        padding: 3%; /* Reducir el espacio alrededor del título en tabletas */
    }

    #imgGODIN {
        max-width: 30px; /* Reducir el tamaño de la imagen en tabletas */
        max-height: 30px;
    }
}

@media only screen and (max-width: 576px) {
    #txtTitulo {
        font-size: 20px; /* Reducir el tamaño del texto en dispositivos móviles */
    }

    #divTitulo {
        padding: 2%; /* Reducir el espacio alrededor del título en dispositivos móviles */
    }

    #imgGODIN {
        max-width: 20px; /* Reducir el tamaño de la imagen en dispositivos móviles */
        max-height: 20px;
    }
}


</style>
</head>

<body>
    <div class="tittle" id="divTitulo">
        <h1 id="txtTitulo">Editar colaborador</h1>
        <img src="images/godin.png" id="imgGODIN" alt="">
    </div>
    <div class="container">
        <?php
            if (isset($datoscolaborador) && is_array($datoscolaborador) && isset($datoscolaborador[0])){
        ?>
        <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
        <div class="col-md-2">
                <label for="id_colaborador" class="form-label">ID</label>
                <input type="text" class="form-control" name="id_colaborador" value="<?=$datoscolaborador[0]["id_colaborador"]?>" >
            </div>
            <div class="col-md-4">
                <label for="nombre_colaborador" class="form-label">Nombre(s)</label>
                <input type="text" class="form-control" name="nombre_colaborador" value="<?=$datoscolaborador[0]["nombre_colaborador"]?>" >
            </div>
            <div class="col-md-4">
                <label for="apellido_paterno_colaborador" class="form-label">Apellido(s)</label>
                <input type="text" class="form-control" name="apellido_paterno_colaborador" value="<?=$datoscolaborador[0]["apellido_paterno_colaborador"]?>" >
            </div>

            <div class="col-md-3">
                <label for="empresa" class="form-Label">Cliente</label>
                    <select  name="empresa" id="" class="form-control" >
                        <?php 
                            $clientes = ControladorColaboradores::getClientes();
                            
                            foreach ($clientes as $row => $item){
                                $selected = ($datoscolaborador[0]["empresa"] == $item[1]) ? 'selected' : '';
                                echo '<option value="' . $item[0] . '" ' . $selected . '>' . $item[1] . '</option>';

                            }
                        ?>
                    </select>
                </div>

            <div class="col-md-4">
                <label for="departamento" class="form-label">Departamento</label>
                <input type="text" class="form-control" name="departamento" value="<?=$datoscolaborador[0]["departamento"]?>" >
            </div>

            <div class="col-md-2">
                <label for="estado" class="form-label">Estado</label>
                <select name="estado" id="" class="form-control">
                    <?php
                        $estados = ControladorColaboradores::getEstados();
                        foreach ($estados as $row => $item){
                            $selected = ($datoscolaborador[0]["estado"] == $item[1]) ? 'selected' : '';
                            echo '<option value="' . $item[0] . '" ' . $selected . '>' . $item[1] . '</option>';
                        }
                    ?>
                </select>
            </div>

            <div class="col-md-2">
                <label for="fecha_ingreso_colaborador" class="form-label">Fecha de ingreso</label>
                <input type="date" class="form-control" name="fecha_ingreso_colaborador" id="fechaIngresoInput" value="<?= $datoscolaborador[0]["fecha_ingreso_colaborador"]?>" placeholder= "Selecciona una fecha">
            </div>

           
            <div class="col-md-12 text-end">
                <a class="btn btn-danger" href="index.php?seccion=colaboradores">Cancelar</a>
                <input type="submit" class="btn btn-success" name="guardarColaborador" value="Actualizar Colaborador">
            </div>
            </div>
    </form>
        <?php
            } else {
                echo "El array \$dispositivoInfo no está definido o no tiene la estructura esperada.";
            }
        ?>


        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var fechaIngresoInput = document.getElementById('fechaIngresoInput');
                var fechaIngresoHidden = document.getElementById('fechaIngresoHidden');

                fechaIngresoInput.addEventListener('focus', function () {
                    if (fechaIngresoInput.value === '') {
                        fechaIngresoInput.placeholder = 'Selecciona una fecha';
                    }
                });

                fechaIngresoInput.addEventListener('blur', function () {
                    if (fechaIngresoInput.value === '') {
                        fechaIngresoInput.placeholder = 'Selecciona una fecha';
                    }
                });

                fechaIngresoInput.addEventListener('click', function () {
                    fechaIngresoHidden.style.display = 'block';
                    fechaIngresoInput.style.display = 'none';
                });

                fechaIngresoHidden.addEventListener('change', function () {
                    var fechaSeleccionada = new Date(fechaIngresoHidden.value);
                    var nombreMes = obtenerNombreMes(fechaSeleccionada.getMonth());
                    fechaIngresoInput.value = fechaSeleccionada.getDate() + '-' + nombreMes + '-' +
                    fechaSeleccionada.getFullYear();
                    fechaIngresoHidden.style.display = 'none';
                    fechaIngresoInput.style.display = 'block';
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