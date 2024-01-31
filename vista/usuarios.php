<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/estilosUsuarios.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  
    <title>Usuarios</title>
    <style>
    </style>
</head>

<body>
<br><br><br><br><br>
    <div class="contentSeccion">
        <div class="up">
            <header class="headerTabla">
                <h1>Usuarios</h1>
              
            </header>
            <div class="imgbtn">
                <img src="./images/userrr.png" id="IMGlaptop" alt="IMAGEN">
                <div>
                    <br>
                </div>
            </div>
        </div>

        <a href="index.php?seccion=nuevousuario"><button type="button" class="btnAgregar">Agregar nuevo usuario</button></a>

        <div class="table">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Id Usuario</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Nombre de Usuario</th>
                        <th>Correo</th>
                        <th>Estado</th>
                        <th>Rol</th>
                        <th>Fecha de Ingreso</th>
                        <th>Fecha de Creación</th>
                        <th>Password</th>
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
                                    <td>' . $item[0] . '</td>
                                    <td>' . $item[1] . '</td>
                                    <td>' . $item[2] . '</td>
                                    <td>' . $item[3] . '</td>
                                    <td>' . $item[4] . '</td>
                                    <td>' . $estadoString . '</td>
                                    <td>' . $rolString . '</td>
                                    <td>' . $item[7] . '</td>
                                    <td>' . $item[8] . '</td>
                                    <td>' . $item[9] . '</td>
                                    <td class="actions">
                                        <a href="index.php?seccion=detalleusuario&id_usuario=' . $item[0] . '" id="enlaceEditar">Editar</a>
                                        <hr>
                                        <a href="javascript:void(0);" onclick="confirmarBorrar(' . $item[0] . ');" id="enlaceBorrar">Borrar</a>
                                    </td>
                                </tr>
                            ';
                    }
                    ?>

                </tbody>
            </table>
        </div>
        <!--modal oculto que solo se muestra para confirmar que quieres o no eliminar a un usuario-->
        <div class="modal" id="confirmarBorrarModal">
            <div class="modal-content">
                <span class="close-modal" onclick="cerrarModal()">&times;</span>
                <h4>Confirmar Eliminación</h4>
                <p>¿Estás seguro de que deseas eliminar a este usuario?</p>
                <button class="btncancel" id="btnCerrarModal" onclick="cerrarModal()">Regresar </button>
                <button class="btneliminar" id="btnBorrarModal">Confirmar</button>

            </div>
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
        function cerrarModal() {
            document.getElementById('confirmarBorrarModal').style.display = 'none';
        }

        function confirmarBorrar(id_usuario) {
            document.getElementById('confirmarBorrarModal').style.display = 'flex';
            document.getElementById('btnBorrarModal').onclick = function () {
                window.location.href = "index.php?seccion=usuarios&accion=eliminarUsuario&id_usuario=" + id_usuario;
            }
        }
    </script>
</body>

</html>
