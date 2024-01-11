<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/estilosUsuarios.css">
    <title>Usuarios</title>
    <style>
       
    </style>
</head>
        
<body>
    
    <div class="contentSeccion">
        <div class="up">
            <header class="headerTabla">
                <h1>Usuarios</h1>
                <form class="form-inline" id="searchBar">
                    <div class="input-group">
                        <!-- Barra de búsqueda si es necesario -->
                    </div>
                </form>
            </header>
            <img src="./images/userrr.png" id="IMGlaptop" alt="IMAGEN">
        </div>

        <button class="custom-button" onclick="nuevoUsuario();">AGREGAR NUEVO USUARIO</button>
    
        <div class="tabla">
            <table class="tabla">
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
                        echo '
                            <tr>
                                <td>' . $item[0] . '</td>
                                <td>' . $item[1] . '</td>
                                <td>' . $item[2] . '</td>
                                <td>' . $item[3] . '</td>
                                <td>' . $item[4] . '</td>
                                <td>$' . $item[5] . '</td>
                                <td>' . $item[6] . '</td>
                                <td>' . $item[7] . '</td>
                                <td>' . $item[8] . '</td>
                                <td>' . $item[9] . '</td>
                                <td class="actions">
                                    <a href="index.php?seccion=editarUsuarios&id_usuario=' . $item[0] . '">Editar</a>
                                    <a href="javascript:void(0);" onclick="confirmarBorrar(' . $item[0] . ');">Borrar</a>
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
                <button class="btn-danger" id="btnBorrarModal">Eliminar</button>
                <button class="btn-secondary" onclick="cerrarModal()">Cancelar</button>
            </div>
        </div>
        <?php
            $agregar = new ControladorUsuarios;
            $agregar->agregarUsuarios();
        ?>
        <!-- Modal para agregar a un nuevo usuario -->
        <div class="modal2" id="nuevoUsuarioModal">
            <div class="modal-content2">
                <div class="tittleModal">
                
                <br><br>
                    <h4 id="agregarTXT">Agregar a un nuevo usuario</h4>
                </div>
            
                
            </div>
        </div>

    </div>
                    <?php

                    //codigo solo para verificar que las contraseñas que se ingresan en el formulario son iguales

                    if(isset ($_POST["agregar"])){

                        
                        $password = $_POST["password"];
                        $passworRepeat = $_POST ["passwordRepeat"];
                        if($password == $passworRepeat){
                            echo 'La contraseñas coinciden';

                        }else{
                            echo 'Las contraseñas no coinciden';
                        }
                    }
                    ?>
    <script>
       
        function confirmarBorrar(id_usuario) {
            document.getElementById('confirmarBorrarModal').style.display = 'flex';
            document.getElementById('btnBorrarModal').onclick = function () {
                window.location.href = "index.php?seccion=usuarios&accion=eliminarUsuario&id_usuario=" + id_usuario;
            }
        }

        function cerrarModal() {
            var modal = document.getElementById('nuevoUsuarioModal');
            modal.style.animationName = 'slideOut'; // Agrega la animación de cierre
            setTimeout(function () {
                modal.style.display = 'none';
            }, 500); // Ajusta el tiempo para que coincida con la duración de la animación
        }

         
    </script>
</body>

</html>