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

        <div class="modal" id="confirmarBorrarModal">
            <div class="modal-content">
                <span class="close-modal" onclick="cerrarModal()">&times;</span>
                <h4>Confirmar Eliminación</h4>
                <p>¿Estás seguro de que deseas eliminar a este usuario?</p>
                <button class="btn-danger" id="btnBorrarModal">Eliminar</button>
                <button class="btn-secondary" onclick="cerrarModal()">Cancelar</button>
            </div>
        </div>

        <!-- Modal para agregar a un nuevo usuario -->
        <div class="modal2" id="nuevoUsuarioModal">
            <div class="modal-content2">
                <div class="tittleModal">
                    <span class="close-modal2" onclick="cerrarModal()">&times;</span>
                    <br><br>
                    <h4 id="agregarTXT">Agregar a un nuevo usuario</h4>
                </div>

                <form action="index.php?seccion=usuarios&accion=agregarUsuario" method="post" id="form">
                    <label for="apellido_paterno">Apellido Paterno:</label>
                    <input type="text" id="apellido_paterno" name="apellido_paterno" required>

                    <label for="apellido_materno">Apellido Materno:</label>
                    <input type="text" id="apellido_materno" name="apellido_materno" required>

                    <label for="nombre_usuario">Nombre:</label>
                    <input type="text" id="nombre_usuario" name="nombre_usuario" required>

                    <label for="correo_usuario">Correo:</label>
                    <input type="email" id="correo_usuario" name="correo_usuario" required>

                    <label for="id_rol">ID Rol:</label>
                    <input type="text" id="id_rol" name="id_rol" required>

                    <label for="fecha_ingreso_usuario">Fecha de Ingreso:</label>
                    <input type="date" id="fecha_ingreso_usuario" name="fecha_ingreso_usuario" required onchange="prepararFecha()">

                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required>

                    <label for="password_repeat">Repetir contraseña:</label>
                    <input type="password" id="password_repeat" name="password_repeat" required>

                    <hr><br><br><br>

                    <button class="btn-danger" type="button" onclick="cerrarModal()">Cancelar</button>
                    <button class="btn-secondary" type="submit">Agregar</button>

                </form>
            </div>
        </div>

    </div>

    <script>
        function nuevoUsuario() {
            document.getElementById('nuevoUsuarioModal').style.display = 'flex';
            modal.style.display = 'flex';
            modal.style.animationName = 'slideIn'; // Agrega la animación de apertura
        }

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

        function prepararFecha() {
            // Obtiene el valor del campo de fecha
            var fechaIngreso = document.getElementById('fecha_ingreso_usuario').value;

            // Verifica si la fecha está en formato yyyy-mm-dd
            if (/^\d{4}-\d{2}-\d{2}$/.test(fechaIngreso)) {
                // Divide la fecha en año, mes y día
                var partesFecha = fechaIngreso.split("-");

                // Construye la fecha en formato yyyy/mm/dd
                var fechaFormateada = partesFecha[0] + "/" + partesFecha[1] + "/" + partesFecha[2];

                // Asigna la fecha formateada de vuelta al campo de fecha
                document.getElementById('fecha_ingreso_usuario').value = fechaFormateada;
            }
        }
         
    </script>
</body>

</html>
