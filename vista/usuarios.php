<?php
    include_once 'controlador/ControladorUsuarios.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/estilosUsuarios.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    
    <title>Usuarios</title>
    <style>

.imagen-editar {
            cursor: pointer;
        }

        .acciones {
            display: flex;
        }
        
        .acciones img {
            max-width: 40px;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        .acciones img:hover {
            transform: scale(1.2); 
        }

    .disabled-btn {
        color: #6c757d; /* Color gris */
        cursor: not-allowed; /* Cursor de no permitido */
        pointer-events: none; /* Deshabilitar eventos de puntero */
      
    }
    .actions{
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .actionss{
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    h1{
        font-size: 45px;
        color: #333
    }
    
</style>

</head>

<body>
<br><br>
<div class="contentSeccion">
        <div class="up">
            <header class="headerTabla">
            <h1 style="font-size: 28px; margin-top:20px; font-weight: bold; color: #003367; text-transform: uppercase; border-bottom: 2px solid #003363;">Usuarios</h1>
                
            </header>
            <div class="col-md-12 text-center d-flex">
          


                <div class="input-group input-group-sm mt-3" style="max-width: 300px; margin: auto; display: block !important; display: flex; flex-direction: column; align-items: flex-end;">
                    <img src="./images/usuario.png" id="imgUsuario" alt="IMAGEN">
                    <a href="index.php?seccion=nuevousuario" "><button class="custom-btn btn-3">AGREGAR NUEVO USUARIO</button></a>
                    
                    <a href="javascript:window.location.reload(true)" ><img src="images/reload.png" id="imgReload" alt="" style="width:25px; margin:2%;"></a>
                    </div>        
            </div>
        </div>
            
        </div>

    </div>
    <div class="container" style="margin-top: 10px !important;">
<div class="table-responsive" style="padding:10px">
<table class="table  table-primary table-hover ">
        <thead class="table-dark align-middle border-dark">
            <tr>
             
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Nombre de Usuario</th>
                <th>Correo</th>
                <th>Estado</th>
                <th>Rol</th>
                <th>Fecha de Ingreso</th>
                <th>Fecha de Creación</th>
                
                <th>Acciones</th>
            </tr>
        </thead>
                <tbody>
                    <?php
                    $eliminarUsuario = new ControladorUsuarios;
                    $eliminarUsuario->borrarUsuarios();

                    $listaUsers = ControladorUsuarios::consultarUsuarios();
                    foreach ($listaUsers as $item) {
                        // Asociar estado a un string
                        switch ($item[5]) {
                            case 1:
                                $estadoString = "Activo";
                                break;
                            case 2:
                                $estadoString = "Inactivo";
                                break;
                            default:
                                $estadoString = "Desconocido";
                                break;
                        }

                        // Asociar rol a un string
                        switch ($item[6]) {
                            case 1:
                                $rolString = "Administrador";
                                break;
                            case 2:
                                $rolString = "Editor";
                                break;
                            case 3:
                                $rolString = "Consultor";
                                break;
                            default:
                                $rolString = "Desconocido";
                                break;
                        }
                    
                        echo '
                        
                        <tr>
                           
                            <td>' . $item[1] . '</td>
                            <td>' . $item[2] . '</td>
                            <td>' . $item[3] . '</td>
                            <td>' . $item[4] . '</td>
                            <td>' . $estadoString . '</td>
                            <td>' . $rolString . '</td>
                            <td>' . $item[7] . '</td>
                            <td>' . $item[8] . '</td>';
                            $usuarioLogueado = $_SESSION['usuario']['id_usuario'];
                            if ($item[0] == $usuarioLogueado) {
                                // Si es el mismo usuario, mostrar los botones de edición y borrado deshabilitados visualmente
                                echo '
                                <td class="actionss">
                            </td>';
                            } else {
                                // Si no es el mismo usuario, mostrar los botones de edición y borrado habilitados
                                echo  "
                                <td >
                                   <div class='acciones'>
                                            <img src='images/editar.png' alt='Editar' style='max-width:40px;' class='imagen-editar' id='editar-{$item[0]}'>
                                            <img src='images/basura.png' alt='Borrar' style='max-width:40px; cursor:pointer;' onclick='confirmarBorrar({$item[0]});'>
                                        </div>  
                                </td>"; 
                            };
                    
                    echo '
                        </tr>';

                        // Agregar click para redireccionar al hacer click en la imagen de editar
                        echo"<script>
                                        document.getElementById('editar-{$item[0]}').addEventListener('click', function() {
                                            window.location.href = 'index.php?seccion=detalleusuario&id_usuario={$item[0]}';
                                        });
                                </script>";
                    
                    }
                        ?>
                    
                
                </tbody>
            </table>
           
        </div>

    </div>
    <?php
    // Código solo para verificar que las contraseñas que se ingresan en el formulario son iguales
    if (isset($_POST["agregar"])) {
        $password = $_POST["password"];
        $passwordRepeat = $_POST["passwordRepeat"];
        if ($password == $passwordRepeat) {
            echo 'La contraseñas coinciden';
        } else {
            echo 'Las contraseñas no coinciden';
        }
    }
    ?>
    </div>
    <script>

function confirmarBorrar(id_usuario) {
            Swal.fire({
                title: '¿Estas seguro?',
                text: "El usuario se eliminara definitivamente",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "index.php?seccion=usuarios&accion=eliminarUsuario&id_usuario=" + id_usuario;
                }
            });
        }


        
    </script>
</body>

</html>
