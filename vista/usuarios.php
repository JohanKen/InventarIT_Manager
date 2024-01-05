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
    <h2>USUARIOS</h2>
    <div class="tabla">
        <table>
            <thead>
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
                                <a href="index.php?seccion=editarDispositivos&id_dispositivo=' . $item[0] . '">Editar</a>
                                <a href="javascript:void(0);" onclick="confirmarBorrar(' . $item[0] . ');">Borrar</a>
                            </td>
                        </tr>
                    ';
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function confirmarBorrar(id) {
            // Lógica para confirmar el borrado
            var confirmacion = confirm('¿Estás seguro de que deseas borrar el usuario con ID ' + id + '?');
            if (confirmacion) {
                // Aquí podrías realizar una petición AJAX para borrar el usuario
                alert('Usuario borrado correctamente.');
            }
        }
    </script>
</body>

</html>
