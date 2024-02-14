<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recupera tu contraseña</title>
    <link rel="icon" href="./images/logoNav.png">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        body {
            background-image: url("./images/perro3.jfif");
            background-size: contain;
            
            background-position: center;
            padding-top: 50px;
            padding-bottom: 50px;
        }

        .login-container {
            display: flex;
            justify-content: center; /* Centra horizontalmente los elementos */
            align-items: center; /* Centra verticalmente los elementos */
            height: 100vh;
        }

        .login-form {
            background-color: rgba(255, 255, 255, 0.9); /* Color de fondo con opacidad */
            padding: 30px;
            border-radius: 10px;
        }

        .login-form h2 {
            margin-bottom: 30px;
            text-align: center;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .login-form button[type="submit"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        .login-form button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .login-form p {
            text-align: center;
            margin-top: 20px;
        }

        .login-form a {
            color: #007bff;
            text-decoration: none;
        }

        .login-form a:hover {
            color: #0056b3;
        }
        #inicia:hover {
    background-color: #333;
    color: white;
    
}
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-form">
            <h2>Recupera tu contraseña</h2>
            <form action="./config/cambiarContra.php" method="POST">

                <input type="text" id="correo" name="new_password" required placeholder="Nueva contraseña">
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                <button type="submit" class="btn btn-primary">Enviar Contraseña</button>

                <hr>

                <p class="text-center" style="margin-top: 20px;">
                            <a href="login.php" id="inicia" style="text-decoration: none; color: #3498db; font-size: 16px; border: 1px solid #3498db; padding: 8px 16px; border-radius: 3px; transition: all 0.3s ease;">Volver a Inicio de sesión</a>
                        </p>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS (opcional, solo si necesitas funcionalidad de Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>
