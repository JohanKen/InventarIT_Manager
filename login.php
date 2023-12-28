<?php
    include 'modelo/conexion.php';
    include 'modelo/ModeloUsuarios.php';
    include 'controlador/ControladorUsuarios.php';
    $login = new ControladorUsuarios;
    $login->validarLogin();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="./images/logoNav.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="./estilos/estilosLogin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</head>
<style>
.alert-primary {
    z-index: 1 !important;
    padding: 5px !important;

}
</style>

<body>
    <div class="login-container">
        <div class="login-image">
            <img src="./images/perro.jpg" alt="Imagen de inicio de sesión" id="imgPERRlogin" width="200">
        </div>
        <div class="login-form">
            <img src="./images/logoinventarit.png" id="imgLogo" alt="">
            <h2 id="h2Bienvenido">¡Bienvenido de nuevo!</h2>
            <form method="POST" id="formLogin">

                <input type="text" id="correo" name="email" required placeholder="Correo electronico">


                <input type="password" id="correo" name="password" required placeholder="Contraseña">
                <?php

if(isset($_GET['message'])){
    ?>
                <div class="alert alert-primary" role="alert" id="alertasLogin">
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
                <label class="checkbox-label">
                    <input type="checkbox" id="recordar-contrasena" name="recordar-contrasena">
                    Recordar contraseña
                </label>
                <input type="submit" name="entrar" value="Iniciar Sesión" style="background-color: #3498db; color: white; text-align: center; border-radius: 10px; padding: 5px 15px;">


                <hr>
                <br>
                <a href="olvideContra.php" id="olvideContra" name="entrar">Olvide mi contraseña</a>

            </form>
        </div>
    </div>
</body>

</html>