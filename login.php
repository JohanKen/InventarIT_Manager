<?php
include_once 'controlador/ControladorUsuarios.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>   
    <meta charset="UTF-8">
    <link rel="icon" href="./images/logoNav.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        body {
            background-image: url(images/bggg.png);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .card {
            background: none;
            border: none;
        }
        .form-control, .btn-primary {
            border-radius: 5px; 
        }
        #olvideContra {
            color: #007bff;
            text-decoration: none;
            margin-top: 10px;
        }
        #olvideContra:hover {
            background-color: #333;
            color: white;
        }
        .placeholder-white::placeholder {
            color: white;
        }
        .colorGray {
            color: gray;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-6">
            <div class="card">
                <div class="text-center mb-4">
                    <img src="./images/logoinventarit.png" alt="" style="width:300px" class="img-fluid">
                    <h2 class="mt-3 colorGray">¡Bienvenido de nuevo!</h2>
                </div>
                <div class="card-body">
                    <form method="POST" id="formLogin" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <input type="text" class="form-control bg-secondary text-white placeholder-white" id="correo" name="email" required placeholder="Correo electrónico">
                            <div class="invalid-feedback">Por favor ingresa tu correo electrónico.</div>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control bg-secondary text-white placeholder-white" id="password" name="password" required placeholder="Contraseña">
                            <div class="invalid-feedback">Por favor ingresa tu contraseña.</div>
                        </div>
                        <?php
                        if (isset($_GET['message'])) {
                            echo "<div class='alert alert-primary' role='alert'>";
                            switch ($_GET['message']) {
                                case 'ok':
                                    echo 'Revisa tu correo electrónico';
                                    break;
                                case 'success_password':
                                    echo 'Inicia sesión con tu nueva contraseña';
                                    break;
                                default:
                                    echo 'Algo salió mal, intenta de nuevo';
                                    break;
                            }
                            echo "</div>";
                        }
                        ?>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="recordar-contrasena" name="recordar-contrasena">
                            <label class="form-check-label" for="recordar-contrasena">Recordar contraseña</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="entrar" class="btn btn-primary">Iniciar Sesión</button>
                        </div>
                        <hr>
                        <div class="text-center">
                            <p class="text-center" style="margin-top: 20px;">
                                <a href="olvideContra.php" id="olvideContra" style="text-decoration: none; color: #3498db; font-size: 16px; border: 1px solid #3498db; padding: 8px 16px; border-radius: 3px; transition: all 0.3s ease;">Olvidé mi contraseña</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST["entrar"])) {
    session_start();
    include 'modelo/conexion.php';
    include_once 'modelo/ModeloUsuarios.php';
    include_once 'controlador/ControladorUsuarios.php';

    $login = new ControladorUsuarios;
    $resultado = $login->validarLogin();

    if ($resultado) {
        echo "
        <script>
           Swal.fire({
                //las imagenes cambian dependiendo del mensaje que se envia dentro de la alerta...
                imageUrl: '" . ($resultado['status'] == 'success' ? 'images/correcto.png' : 'images/cancelar.png') . "',
                title: '" . ($resultado['status'] == 'success' ? '¡Bienvenido de nuevo!' : 'Error') . "',
                text: '" . $resultado['message'] . "',
                timer: 2000, 
                showConfirmButton: false,
                 imageWidth: 100, 
                    imageHeight: 100, 
                    customClass: {
                        image: 'custom-image'
                    }
            }).then(() => {
                window.location.href = '" . $resultado['redirect'] . "';
            });

        </script>";
    }
}
?>
</body>
</html>
