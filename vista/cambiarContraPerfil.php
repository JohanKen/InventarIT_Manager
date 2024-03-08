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
// Verificar si se envió el formulario para editar el usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cambiarContra'])) {

   
        if (isset ($_POST['password'], $_POST['confirm_password'])) {
           
            $nuevaPassword = $_POST['password'];
            $confirmarPassword = $_POST['confirm_password'];
        if ($nuevaPassword !== $confirmarPassword) {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Contraseñas incorrectas",
                        text: "Las nuevas contraseñas no coinciden",
                    });</script>';
            } else {
                $obj = new ControladorUsuarios();
                $obj->UpdatePassword();
                echo '<script>
                        Swal.fire({
                            title: "Contraseña actualizada con exito!",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = "index.php?seccion=editarPerfil&accion=editarPerfil&id_usuario= ' . $_SESSION['usuario']['id_usuario'] . '";
                        });
                    </script>';
                exit;
            }
        } 
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar contraseña</title>
    <link rel="stylesheet" href="estilos/estilosPerfil.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    body{
        
        background-image: url("images/bgEdit.jpg") !important;
    }
</style>
</head>

<body>
<section class="vh-100" style="background:none">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-9 mb-4 mb-lg-0">
                <div class="card mb-3" style="border-radius: .5rem;">
                    <div class="row g-0">
                        <div class="col-md-4 gradient-custom text-center text-white" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                            <img src="images/perro.jpg" class="rounded-circle" style="width: 150px; max-height:180px; margin:5px"  alt="" />
                            <h5><?php echo "$datosUsuario[3] $datosUsuario[1]";?></h5>
                        <?php
                            // Define el array asociativo de roles
                            $roles = array(
                                1 => "Administrador",
                                2 => "Editor",
                                3 => "Consultor"
                            );
                        ?>
                        <p>Rol: <?php echo $roles[$datosUsuario[6]]; ?></p>
                        <i class="far fa-edit mb-5"></i>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <h6>Editar Información del perfil</h6>
                              

                                <hr class="mt-0 mb-4">
                                <form action="#" method="POST">
                                    <div class="row pt-1">
                                        <div class="col-md-6 mb-3">
                                            <label for="nombre">CAMBIAR CONTRASEÑA:</label>

                                        </div>
                                       
                                    </div>
                                   
                                    <div class="row pt-1">
                                 
                                        <div class="col-md-6 mb-3">
                                            <label for="password">Nueva Contraseña</label>
                                            <input type="password" style="border-color:#333;" class="form-control" id="password" name="password" value="" pattern="^(?=.*\d).{8,}$" title="La contraseña debe tener al menos 8 caracteres y contener al menos un número" required >
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="confirm_password">Confirmar Contraseña</label>
                                            <input style="border-color:#333;" type="password" class="form-control" id="confirm_password" name="confirm_password" required >
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row pt-1">
                                        <div class="col-12">
                                            <a href="index.php?seccion=editarPerfil&id_usuario=<?php echo $_SESSION['usuario']['id_usuario']; ?>" class="btn btn-secondary" >Cancelar</a>
                                            <button type="submit" name="cambiarContra" class="btn btn-warning">Guardar cambios</button>
                                           

                                        </div>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
</section>

<script>


</script>
</body>
</html>
