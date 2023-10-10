<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
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
            <form action="procesar_login.php" method="POST" id="formLogin">

                <input type="text" id="correo" name="usuario" required placeholder="Correo electronico">


                <input type="password" id="correo" name="contrasena" required placeholder="Contraseña">

                <label class="checkbox-label">
                    <input type="checkbox" id="recordar-contrasena" name="recordar-contrasena">
                    Recordar contraseña
                </label>
                <button type="submit">Iniciar Sesión</button>

            <hr>
            <br>
                <a href="olvideContra.php" id="olvideContra">Olvide mi contraseña</a>

            </form>
        </div>
    </div>
</body>

</html>