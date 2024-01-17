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
    
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="estilos/estilosForms.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form class="row gy-2 gx-3 align-items-center">
                    <div class="col-12">
                        <label class="visually-hidden" for="id_usuario">Id Usuario:</label>
                        <input type="text" class="form-control" id="id_usuario" name="id_usuario" readonly="true" value="<?php echo $datosUsuario[0]; ?>" placeholder="Id Usuario">
                    </div>
                    <div class="col-12">
                        <label class="visually-hidden" for="apellido_paterno">Apellido Paterno:</label>
                        <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" placeholder="Apellido Paterno">
                    </div>
                    <div class="col-12">
                        <label class="visually-hidden" for="apellido_materno">Apellido Materno:</label>
                        <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" placeholder="Apellido Materno">
                    </div>
                    <div class="col-12">
                        <label class="visually-hidden" for="nombre_usuario">Nombre(s):</label>
                        <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" placeholder="Nombre(s)">
                    </div>
                    <div class="col-12">
                        <label class="visually-hidden" for="correo">Correo Electronico:</label>
                        <input type="text" class="form-control" id="correo" name="correo" placeholder="Correo Electronico">
                    </div>
                    <div class="col-12">
                        <label class="visually-hidden" for="estado">Estado:</label>
                        <input type="text" class="form-control" id="estado" name="estado" placeholder="Estado">
                    </div>
                    <div class="col-12">
                        <label class="visually-hidden" for="rol">Rol:</label>
                        <input type="text" class="form-control" id="rol" name="rol" placeholder="Rol">
                    </div>
                    <div class="col-12">
                        <label class="visually-hidden" for="fecha_ingreso">Fecha de Ingreso:</label>
                        <input type="text" class="form-control" id="fecha_ingreso" name="fecha_ingreso" placeholder="Fecha de Ingreso">
                    </div>
                    <div class="col-12">
                        <label class="visually-hidden" for="fecha_creacion">Fecha de Creación:</label>
                        <input type="text" class="form-control" id="fecha_creacion" name="fecha_creacion" placeholder="Fecha de Creación">
                    </div>
                    <div class="col-12">
                        <label class="visually-hidden" for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="col-12">
                        <label class="visually-hidden" for="repetir_password">Repetir Password:</label>
                        <input type="password" class="form-control" id="repetir_password" name="repetir_password" placeholder="Repetir Password">
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">
                                Remember me
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-secondary">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Agrega el enlace a Bootstrap JS y Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
