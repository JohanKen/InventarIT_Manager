<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/estilosUsuarios.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <title>Usuarios</title>
    <style>
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
                <h1>Usuarios</h1>
                
            </header>
            <div class="imgbtn">

                <img src="./images/userrr.png" id="IMGlaptop" alt="IMAGEN">

                <div>
                <a href="index.php?seccion=nuevousuario" class="btn btn-success btn-lg mb-3">Agregar nuevo usuario</a>

                    <br>
                </div>
            </div>
        </div>

    </div>
<div class="table-responsive" style="padding:15px">
<table class="table  table-light table-hover ">
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
                                <a href="index.php?seccion=detalleusuario&id_usuario=' . $item[0] . '" class="disabled-btn" id="enlaceEditar"><button type="button" class="btn btn-secondary">Editar</button></a>
                                <hr>
                                <a href="javascript:void(0);" class="disabled-btn" id="enlaceBorrar"><button type="button" class="btn btn-secondary">Eliminar</button></a>
                            </td>';
                            } else {
                                // Si no es el mismo usuario, mostrar los botones de edición y borrado habilitados
                                echo  '
                                <td class="actions">
                                    <a href="index.php?seccion=detalleusuario&id_usuario=' . $item[0] . '" id="enlaceEditar"><button type="button" class="btn btn-primary">Editar</button></a>
                                    <hr>
                                    <a href="javascript:void(0);" onclick="mostrarAlerta(<?php echo $item[0]; ?>,  '.$item[1]  . ')" id="btnBorrar"><button type="button" class="btn btn-danger">Eliminar</button></a>
                                    </td>'; 
                            };
                    
                    echo '
                        </tr>';
                    
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
    <script>


const btn =document.getElementById("btnBorrar");

function mostrarAlerta(id_usuario, nombreUsuario) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: '¿Seguro que deseas eliminar a este usuario?',
        text: 'No podrás deshacer esta acción',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, Deseo eliminarlo',
        cancelButtonText: 'No, Cancelar.',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            swalWithBootstrapButtons.fire({
                title: 'Eliminado!',
                text: 'El usuario fue eliminado correctamente',
                icon: 'success'
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: 'Cancelado',
                text: ':)',
                icon: 'error'
            });
        }
    });
}



        function cerrarModal() {
            document.getElementById('confirmarBorrarModal').style.display = 'none';
        }

        function confirmarBorrar(id_usuario, nombreUsuario) {
    document.getElementById('confirmarBorrarModal').style.display = 'flex';
    document.getElementById('btnBorrarModal').onclick = function () {
        window.location.href = "index.php?seccion=usuarios&accion=eliminarUsuario&id_usuario=" + id_usuario;
    }
    document.getElementById('nombreUsuario').innerText = nombreUsuario;
}

    </script>
</body>

</html>
