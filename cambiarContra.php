<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recupera tu contraseña</title>
    <link rel="stylesheet" href="./estilos/estilosLogin.css">

    <style>
        body{
            background: gray;
        }
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
            <img src="./images/perro3.jfif" alt="">
        </div>
        <div class="login-form">
            <h2>Recupera tu contraseña</h2>
            <form action="./config/cambiarContra.php" method="POST">

                <input type="text" id="correo" name="new_password" required placeholder="Nueva contraseña">
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                <button type="submit">Enviar Contraseña</button>
                
                <hr>

                <p>¿Ya tienes una cuenta? <a href="login.php" id="inicia">Inicia sesión</a></p>
            </form>
        </div>
    </div>
</body>

</html>
