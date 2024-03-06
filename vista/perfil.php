<?php
//obtenemos el id del usuario mediante la url
$id = $_GET["id_usuario"];
// obtenemos los datos de un usuario
$datosUsuario = ObtenerDatosUsuario($id);

//array asociativo que mapea los estados para asignarlos posteriormente
$estados = array(
    1 => 1,
    2 => 2,

);

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

        ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del usuario</title>
    <link rel="stylesheet" href="estilos/estilosPerfil.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <style>

    </style>
</head>

<body>
    <section class="vh-100" style="background:none">
  
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-9 mb-4 mb-lg-0">
                    <div class="card mb-3" style="border-radius: .5rem;">
                        <div class="row g-0">
                            <div class="col-md-4 gradient-custom text-center text-white"
                                style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                <img src="images/perro.jpg" class="rounded-circle"
                                    style="width: 150px; max-height:180px; margin:5px" alt="" />

                                <h5><?php echo $datosUsuario[3] . ' ' . $datosUsuario[1];?>
                                </h5>

                                <p><?php 
                switch ($datosUsuario[6]) {
                    case 1:
                        echo "Administrador";
                        break;
                    case 2:
                     echo "Editor";
                      break;
                   case 3:
                       echo "Consultor";
                        break;
                   default:
                         echo "Desconocido";
                         break;
                 }
             ?></p>
                                <i class="far fa-edit mb-5"></i>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-4">
                                    <h6>Información del perfil</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>Correo</h6>
                                            <p class="text-muted"><?php echo $datosUsuario[4] ?>
                                            </p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Fecha de ingreso</h6>
                                            <p class="text-muted">
                                                <?php echo $datosUsuario[7] ?></p>
                                        </div>
                                    </div>

                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        


                                        <div class="col-6 mb-3">
                                            <h6>Fecha de creación</h6>
                                            <p class="text-muted">
                                                <?php echo $datosUsuario[8]?></p>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" onclick="solicitarPassword(<?php echo $datosUsuario[0]; ?>);" class="btn btn-warning" id="btnWar">Actualizar Información</a>

                                    <div class="d-flex justify-content-start">
                                        <a href="#!"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                                        <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                                        <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
   function solicitarPassword(idUsuario) {
    Swal.fire({
        title: 'Ingrese su contraseña',
        input: 'password',
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar',
        showLoaderOnConfirm: true,
        preConfirm: (password) => {
            return new Promise((resolve, reject) => {
                // Comparar la contraseña ingresada con la contraseña almacenada
                if (password === '<?php echo $datosUsuario[9]; ?>') {
                    resolve();
                } else {
                    reject('Intente de nuevo');
                }
            });
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirigir al usuario si la contraseña es correcta
            window.location.href = "index.php?seccion=editarPerfil&id_usuario=" + idUsuario;
        }
    }).catch((error) => {
        // Mostrar un mensaje de error si la contraseña es incorrecta
        Swal.fire({
            icon: 'error',
            title: 'Contraseña incorrecta',
            text: error
        });
    });
}




    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('passwordInput');

    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
    </script>  

</body>

</html>