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
        
    //Llamamos al metodo update del controlador para actualizar
         $obj = new ControladorUsuarios();
         $obj -> UpdateUser();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="estilos/estilosForms.css">
</head>
<body>
    <h1>Editar Usuario</h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form class="row gy-2 gx-3 align-items-center">
                    <?php
                    var_dump ($datosUsuario);
                    ?>
                    <div class="col-12">
                        <label  for="id_usuario">Id Usuario:</label>
                        <input type="text" class="form-control" id="id_usuario" name="id_usuario" readonly="true" value="<?php echo $datosUsuario[0]; ?>">
                    </div>
                    <div class="col-12">
                        <label  for="apellido_paterno">Apellido Paterno:</label>
                        <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" value="<?php echo $datosUsuario[1]; ?>"  >
                    </div>
                    <div class="col-12">
                        <label  for="apellido_materno">Apellido Materno:</label>
                        <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" value="<?php echo $datosUsuario[2]; ?>" >
                    </div>
                    <div class="col-12">
                        <label  for="nombre_usuario">Nombre(s):</label>
                        <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" value="<?php echo $datosUsuario[3]; ?>" >
                    </div>
                    <div class="col-12">
                        <label  for="correo">Correo Electronico:</label>
                        <input type="text" class="form-control" id="correo" name="correo" value="<?php echo $datosUsuario[4]; ?>" >
                    </div> 
                    <!-- Crear metodo para obtener los estados por nombre y no por ID-->
                    <div class="col-12">
                        <label  for="estado">Estado:</label>
                        <input type="text" class="form-control" id="estado" name="estado" value="<?php echo $datosUsuario[5]; ?>" >
                    </div>
                    <!-- Crear metodo para obtener los roles por nombre y no por ID-->
                    <div class="col-12">
                        <label  for="rol">Rol:</label>
                        <input type="text" class="form-control" id="rol" name="rol" value="<?php echo $datosUsuario[6]; ?>" >
                    </div>
                    <div class="col-12">
                        <label  for="fecha_ingreso">Fecha de Ingreso:</label>
                        <input type="text" class="form-control" id="fecha_ingreso" name="fecha_ingreso" value="<?php echo $datosUsuario[7]; ?>">
                    </div>
                    <div class="col-12">
                        <label  for="fecha_creacion">Fecha de Creación:</label>
                        <input type="text" class="form-control" id="fecha_creacion" name="fecha_creacion" value="<?php echo $datosUsuario[8]; ?>" >
                    </div>
                    <div class="col-12">
                        <label  for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" value="<?php echo $datosUsuario[9]; ?>" >
                    </div>
                    
                    <!--
                    <div class="col-12">
                        <label  for="repetir_password">Repetir Password:</label>
                        <input type="password" class="form-control" id="repetir_password" name="repetir_password" value="<?php echo $datosUsuario[0]; ?>" placeholder="Repetir Password">
                    </div>
-->
                    <div class="col-12">
                        <button type="submit" name="guardar" class="btn btn-primary">Guardar Cambios</button>
                        <button type="button" class="btn btn-secondary">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Agrega el enlace a Bootstrap JS y Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></scr