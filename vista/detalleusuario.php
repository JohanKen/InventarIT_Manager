<?php

//obtenemos el id del usuario mediante la url
$id = $_GET["id_usuario"];
// obtenemos los datos de un usuario
$datosUsuario = ObtenerDatosUsuario($id);

//array asociativo que mapea los estados para asignarlos posteriormente
$estados = array(
    1 => 1,
    2 => 2,

);

function ObtenerDatosUsuario($id){
    if($id >= 0){
        try {
            $UsuarioInfo = ControladorUsuarios::getUser($id);

            // verificar si se obtuvieron correctamente los datos del usuario
            if(empty($UsuarioInfo[0])){
                echo "Error: no se pudieron obtener los datos del usuario correctamente.";
                return null;
            }

            // aquí solo devolvemos los datos
            return $UsuarioInfo[0];
        } catch (Exception $e) {
            // Manejar la excepción, por ejemplo, registrándola o mostrándola
            echo "Error al obtener datos del usuario: " . $e->getMessage();
            return null;
        }
    } else {
        echo "No se pudo obtener ningún ID de usuario";
        return null;
    }
}
//Verificar si se envio el formulario para editar el usuario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

//Verfificar con el metodo post que se presione el boton guardar del formulario
    if(isset($_POST['guardar'])) {
        $obj = new ControladorUsuarios();
         $obj -> UpdateUser();
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
            title: 'Modificado con exito!'
          }).then(function (result){
                if (true){
                    window.location.href='index.php?seccion=usuarios';
                        }
          }
          ) 
            
          
          </script>";
        exit;     
    }
}
        

         ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
    body {
        text-align: center;
    }

    div{
            padding: 5px;
        }
    .headerr h2 {
        font-size: 40px;
    }
    .imgdiv{
            display: flex ;
        }
        select.form-select {
    max-width: 100%; /* Establece el ancho máximo al 100% del contenedor */
    height: auto; /* Establece la altura automática para mantener la proporción de aspecto */
}


    label {
        font-weight: bold;
        color: white;
    }

    .error-message {
        color: #ff2323;
        font-size: 20px;
    }

    input:hover {
        border-color: rgb(34, 18, 207) !important;
        border-style: groove !important;
    }

    .mb_3 {
        margin-bottom: 20px;
    }

    .imgEditUser {
        width: 230px;
        height: 150px;
        /* ajusta el tamaño de la imagen */
    }
    h6{
        font-size: 20px;
        color:gray;
    }
    .btnCancelar {
        margin-right: 10px;
        /* ajusta el margen derecho del botón */
    }
    </style>
</head>

<body>
    <div class="headerr">
        <h2>Editar Usuario</h2>
    </div>

    <div class="container containerr">
        <h3><?php echo $datosUsuario[3] . ' ' . $datosUsuario[1]; ?></h3>
        <h6><?php 
                 switch ($datosUsuario[6]) {
                     case 1:
                         echo "Administrador";
                         break;
                     case 2:
                         echo "Editor";
                         break;
                     case 3:
                         echo "Consultor";
                         break;
                     default:
                         echo "Desconocido";
                         break;
                 }
             ?></h6>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

        <form action="" method="post" onsubmit="return validateForm()">
        <div class="panel panel-default">
        <div class="panel-heading">
            <div class="imgdiv">   
            
                    <!--
                <div class="col-md-6">
                    <label for="id_usuario">Id Usuario:</label>
                    <input type="text" class="form-control" id="lbl" name="id_usuario" readonly="true"
                        value="<?php echo $datosUsuario[0]; ?>">
                </div>
                -->
                <div class="col-md-6 col-sm-3 col-xs-3">
                <label for="nombre_usuario">Nombre(s):</label>
                <input type="text" class="form-control" id="lbl" name="nombre_usuario"
                    value="<?php echo $datosUsuario[3]; ?>">
            </div>
            <div class="col-md-6">
                <label for="apellido_paterno">Apellido Paterno:</label>
                <input type="text" class="form-control" id="lbl" name="apellido_paterno"
                    value="<?php echo $datosUsuario[1]; ?>">
            </div>
            
            </div>
            <div class="imgdiv">
         
            <div class="col-md-6">
                <label for="apellido_materno">Apellido Materno:</label>
                <input type="text" class="form-control" id="lbl" name="apellido_materno"
                    value="<?php echo $datosUsuario[2]; ?>">
            </div>
            <div class="col-md-6 col-sm-3 col-xs-3">
                <label for="correo">Correo Electronico:</label>
                <input type="text" class="form-control" id="lbl" name="correo" value="<?php echo $datosUsuario[4]; ?>">
            </div>
            </div>
            <div class="row">
            
            <div class="col-md-3 col-sm-3 col-xs-3">
                <label for="estado" class="form-label">Estado del Usuario</label>
                <select class="form-select" id="lbl" name="estado">
                    <?php                                            
                             foreach ($estados as $estadoId => $estadoLabel) {
                                 $selected = ($datosUsuario[5] == $estadoId) ? 'selected' : '';
                                 echo "<option value='$estadoId' $selected>";
                                 switch ($estadoId) {
                                     case 1:
                                         echo "Activo";
                                         break;
                                     case 2:
                                         echo "Inactivo";
                                         break;
                                 }
                                 echo "</option>";
                             }
                         ?>
                </select>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-3">
                <label for="rol" class="form-label">Rol del Usuario</label>
                 <select class="form-select" id="lbl" name="rol">
                    <?php
                             $roles = array(
                                 1 => 1,
                                 2 => 2,
                                 3 => 3
                             );
                             foreach ($roles as $rolId => $rolLabel) {
                                 $selected = ($datosUsuario[6] == $rolLabel) ? 'selected' : '';
                                 echo "<option value='$rolLabel' $selected>";
                                 switch ($rolLabel) {
                                     case 1:
                                         echo "Administrador";
                                         break;
                                     case 2:
                                         echo "Editor";
                                         break;
                                     case 3:
                                         echo "Consultor";
                                         break;
                                     default:
                                         echo "Desconocido";
                                         break;
                                 }
                                 echo "</option>";
                             }
                         ?>
                </select>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-3">
                <label for="fecha_ingreso" id="lbl">Fecha de Ingreso:</label>
                <input type="date" class="form-control" id="fechaIngresoInput" name="fecha_ingreso"
                    value="<?php echo $datosUsuario[7]; ?>">
            </div>
            <div class="mb_3">
                <img class="imgEditUser" src="images/editUser.png" alt="">
                <div class="botones">
                    <button type="button" class="btn btn-danger btnCancelar"
                        onclick="window.location.href='index.php?seccion=usuarios'">Cancelar</button>
                    <button type="submit" name="guardar" class="btn btn-success">Guardar Cambios</button>
                </div>
            </div>
        </form>
        </div>
        </div>
        </div>
    </div>

    <!-- Agrega el enlace a Bootstrap JS y Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>