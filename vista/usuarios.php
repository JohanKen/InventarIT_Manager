<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/estilosUsuarios.css">
    <title>Usuarios</title>
    <style>
        /* Estilos del modal principal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: linear-gradient(0deg, rgba(0,22,249,0.24413515406162467) 14%, rgba(0,151,249,0.7819502801120448) 100%);
            padding: 20px;
            border-radius: 10px;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            color: #fff;
        }

        .modal-content h4 {
            margin-bottom: 15px;
        }

        .modal-content p {
            margin-bottom: 20px;
        }

        .close-modal {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            color: #fff;
            font-size: 20px;
        }

        .close-modal2 {
            position: absolute;
            top: 2px;
            right: 2px;
            cursor: pointer;
            color: #fff;
            font-size: 20px;
        }

        /* Estilos del modal secundario */
        .modal2 {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .modal-content2 {
            background: linear-gradient(0deg, rgba(0,22,249,0.24413515406162467) 14%, rgba(0,151,249,0.7819502801120448) 100%);
            margin-top: 50px;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            color: #fff;
        }

        .modal-content2 h4 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        .modal-content2 label {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
            color: #fff;
        }

        .modal-content2 input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
            border: 1px solid #fff;
            border-radius: 5px;
            font-size: 16px;
        }

        .modal-content2 button {
            padding: 15px 30px;
            margin-right: 10px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 18px;
            transition: all 0.4s ease;
            overflow: hidden;
        }

        .modal-content2 button.btn-danger {
            background: #ff6f6f;
            color: #fff;
            transform: translateY(0);
        }

        .modal-content2 button.btn-secondary {
            background: #4169e1;
            color: #fff;
            transform: translateY(0);
        }

        .modal-content2 button:hover {
            background: #2f74d3;
            transform: translateY(-5px);
        }

        .custom-button {
            margin-left: 85%;
            margin-top: 20px;
            background-color: #4169e1;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            transition: background 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .custom-button:hover {
            background-color: #2f74d3;
        }

        .custom-button:after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            transition: left 0.3s ease;
            pointer-events: none;
        }

        .custom-button:hover:after {
            left: 100%;
        }

        .tittleModal {
            display: flex;
            background: none;
            backdrop-filter: blur(10px);
        }

        #form {
            display: inline-block;
        }

        .btn-secondary:hover {
            background: linear-gradient(90deg, rgba(7,0,69,1) 0%, rgba(46,9,121,1) 35%, rgba(0,212,255,1) 100%);
        }

        .btn-danger:hover {
            background: #d32f2f;
        }

        #agregarTXT {
            font-size: 15px;
        }
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
        }

        function confirmarBorrar(id_usuario) {
            document.getElementById('confirmarBorrarModal').style.display = 'flex';
            document.getElementById('btnBorrarModal').onclick = function () {
                window.location.href = "index.php?seccion=usuarios&accion=eliminarUsuario&id_usuario=" + id_usuario;
            }
        }

        function cerrarModal() {
            document.getElementById('confirmarBorrarModal').style.display = 'none';
            document.getElementById('nuevoUsuarioModal').style.display = 'none';
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
