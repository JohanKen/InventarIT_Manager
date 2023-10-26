<?php
    include './modelo/conexion.php';
    include './modelo/ModeloUsuarios.php';
    include 'C:\laragon\www\InventaritManager\controlador\ControladorUsuarios.php';
    $login = new ControladorUsuarios;
    $login->validarLogin();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesiónnnn</title>
    <link rel="stylesheet" href="./estilos/estilosLogin.css">
</head>

<body>
    <div class="login-container">
        <div class="login-image">
            <img src="./images/perro.jpg" alt="Imagen de inicio de sesión" id="imgPERRlogin" width="200">
        </div>
        <div class="login-form">
            <img src="./images/logoinventarit.png" id="imgLogo" alt="">
            <h2 id="h2Bienvenido">¡Bienvenido de nuevo!</h2>
            <form  method="POST" id="formLogin">

                <input type="text" id="correo" name="email"required placeholder="Correo electronico">


                <input type="password" id="correo" name="password"  required placeholder="Contraseña">

                <label class="checkbox-label">
                    <input type="checkbox" id="recordar-contrasena" name="recordar-contrasena">
                    Recordar contraseña
                </label>
                <input type="submit" name="entrar" value="Entrarrrr"></input>

            <hr>
            <br>
                <a href="olvideContra.php" id="olvideContra" 
            name="entrar" >Olvide mi contraseña</a>

            </form>
        </div>
    </div>
</body>

</html>