<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form action="index.php?seccion=usuarios&accion=agregarUsuario" method="post" id="form">
                    <label for="apellido_paterno">Apellido Paterno:</label>
                    <input type="text" id="apellido_paterno" name="apellidoPaterno" required>

                    <label for="apellido_materno">Apellido Materno:</label>
                    <input type="text" id="apellido_materno" name="apellidoMaterno" required>

                    <label for="nombre_usuario">Nombre:</label>
                    <input type="text" id="nombre_usuario" name="nombreUsuario" .| required>

                    <label for="correo_usuario">Correo:</label>
                    <input type="email" id="correo_usuario" name="correoUsuario" required>

                    <!-- hay que mostrar los nombre como cadenas de texto pero obtener cada uno como id con un array asociativo-->
                    
                    <label for="id_rol">Rol:</label>
                    <input type="text" id="id_rol" name="rol" required>
 
                    <label for="fecha_ingreso_usuario">Fecha de Ingreso:</label>
                    <input type="date" id="fecha_ingreso_usuario" name="fechaIngreso" required onchange="prepararFecha()">

                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required>


                    
                    <label for="password_repeat">Repetir contraseña:</label>
                    <input type="password" id="password_repeat" name="passwordRepeat" required>
                    
                    
                    

                    
                    <hr><br><br><br>

                    <button class="btn-danger" type="button" onclick="cerrarModal()">Cancelar</button>
                    <button class="btn-secondary" type="submit" name="agregar">Agregar</button>
                                    
                </form>
</body>
</html>
