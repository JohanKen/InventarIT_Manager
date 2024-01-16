<?php
//obtenemos el id del usuario mediante la url
$id = $_GET["id_usuario"];
// obtenemos los datos de un usuario
$datosUsuario = ObtenerDatosUsuario($id);

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
        
   //Llamamos al metodo UpdateUser para actualizar
         //$obj = new ControladorUsuarios();
         //$obj -> UpdateUser();
    
?>
<div class="container">
    <div class="row">
        <div class="columna">
            <div class="cardHeader">Editar usuario</div>
                <div class="cardBody">
                <form action="procesar_formulario.php" method="POST">
    <label for="id_usuario">Id Usuario:</label>
    <input  type="text" id="id_usuario" name="id_usuario" readonly="true" value="<?php echo $datosUsuario[0]; ?>"><br>

    <label for="apellido_paterno">Apellido Paterno:</label>
    <input type="text" id="apellido_paterno" name="apellido_paterno"><br>

    <label for="apellido_materno">Apellido Materno:</label>
    <input type="text" id="apellido_materno" name="apellido_materno"><br>

    <label for="nombre_usuario">Nombre de Usuario:</label>
    <input type="text" id="nombre_usuario" name="nombre_usuario"><br>

    <label for="correo">Correo:</label>
    <input type="text" id="correo" name="correo"><br>

    <label for="estado">Estado:</label>
    <input type="text" id="estado" name="estado"><br>

    <label for="rol">Rol:</label>
    <input type="text" id="rol" name="rol"><br>

    <label for="fecha_ingreso">Fecha de Ingreso:</label>
    <input type="text" id="fecha_ingreso" name="fecha_ingreso"><br>

    <label for="fecha_creacion">Fecha de Creación:</label>
    <input type="text" id="fecha_creacion" name="fecha_creacion"><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password"><br>

    <!-- Acciones (Editar y Borrar) no se incluyen en el formulario de creación -->

    <button type="submit">Guardar</button>
</form>

                </div>
            
        </div>
    </div>
</div>