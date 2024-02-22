<?php
    include_once 'controlador/ControladorUsuarios.php';
    if (isset($_POST["entrar"])) {
        session_start();
        include 'modelo/conexion.php';
        include_once 'modelo/ModeloUsuarios.php';
        include_once 'controlador/ControladorUsuarios.php';
        $login = new ControladorUsuarios;
        $login->validarLogin();
    }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="./images/logoNav.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <style>
        body{
            background: none;
            background-image: url(./images/perro.jpg);
            background-size: contain;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
            transition: box-shadow 0.3s ease; 
        }

        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); 
        }

        .card-body {
            padding: 30px;
        }

        .form-control {
            border-radius: 10px; 
        }

        .btn-primary {
            border-radius: 10px; 
        }

        #olvideContra {
            color: #007bff; 
            text-decoration: none; 
            margin-top: 10px; 
        }

        #olvideContra:hover {
            color: #0056b3; 
        }
        #olvideContra:hover {
            background-color: #333;
            color: white;
        }

    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6">
              
                <div class="card">
                <div class="text-center mb-4">
                    <!-- Aquí puedes colocar cualquier elemento adicional que desees centrar -->
                    <img src="./images/logoinventarit.png" alt="" style="width:300px" class="img-fluid">
                    <h2 class="mt-3">¡Bienvenido de nuevo!</h2>
                </div>
                    <div class="card-body">
                        <form method="POST" id="formLogin" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="correo" name="email" required placeholder="Correo electrónico">
                                <div class="invalid-feedback">
                                    Por favor ingresa tu correo electrónico.
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" id="password" name="password" required placeholder="Contraseña">
                                <div class="invalid-feedback">
                                    Por favor ingresa tu contraseña.
                                </div>
                            </div>
                            <?php

    if(isset($_GET['message'])){
        ?>
<div class="alert alert-primary" role="alert">
    <?php
            switch ($_GET['message']) {
                case 'ok':
                    echo 'Revisa tu correo electronico';
                    break;
                    case 'success_password':
                        echo 'Inicia sesión con tu nueva contraseña';
                        break;

                default:
                    echo 'Algo salio mal, intenta de nuevo';
                    break;
            }
            ?></div>


<?php
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
    <a href="olvideContra.php" id="olvideContra" name="entrar" style="text-decoration: none; color: #3498db; font-size: 16px; border: 1px solid #3498db; padding: 8px 16px; border-radius: 3px; transition: all 0.3s ease;">Olvidé mi contraseña</a>
</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Función para guardar la información de inicio de sesión en el almacenamiento local
        function guardarInformacionInicioSesion() {
            const correo = document.getElementById('correo').value;
            const password = document.getElementById('password').value;
            const recordarContrasena = document.getElementById('recordar-contrasena').checked;

            if (recordarContrasena) {
                localStorage.setItem('correo', correo);
                localStorage.setItem('password', password);
            } else {
                localStorage.removeItem('correo');
                localStorage.removeItem('password');
            }
        }

        // Función para cargar la información de inicio de sesión desde el almacenamiento local
        function cargarInformacionInicioSesion() {
            const correo = localStorage.getItem('correo');
            const password = localStorage.getItem('password');

            if (correo && password) {
                document.getElementById('correo').value = correo;
                document.getElementById('password').value = password;
            }
        }

        // Cargar la información de inicio de sesión al cargar la página
        window.onload = function() {
            cargarInformacionInicioSesion();
        };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
