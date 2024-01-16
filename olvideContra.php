<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="./images/logoNav.png">2
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olvidaste tu Contraseña</title>
    <link rel="stylesheet" href="./estilos/estilosLogin.css">

    <style>
        .login-container {
            display: flex;
            align-items: center; /* Centra verticalmente los elementos */
        }

        .login-container img {
            margin-top:3px;
            width: 420px;
            height: 501px;
            border-radius:10px;
            margin-right: 20px; /* Espacio entre la imagen y el formulario */
        }

        .login-form {
            /* Estilos para el formulario (como en tu código original) */
        }
    </style>
</head>

<body>
    
    <div class="login-container">
        <div>
            <img src="./images/perro2.jpg" alt="">
        </div>
        <div class="login-form">
            <h2>Olvidaste tu contraseña?</h2>
            <p id="texto">Lo entendemos, suceden cosas. ¡Simplemente ingrese su dirección de correo electrónico a continuación y le enviaremos un enlace para restablecer su contraseña!</p>
            <form action="./config/recovery.php" method="POST">

                <input type="email" id="correo" name="correo" required placeholder="Ingresa tu dirección de correo electrónico">

                <button type="submit">Enviar Contraseña</button>
                
                <hr>

                
            </form>
            <p>¿Ya tienes una cuenta? <a href="login.php" id="inicia">Inicia sesión</a></p>
        </div>
    </div>
</body>

</html>
