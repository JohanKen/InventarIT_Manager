<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="./images/logoNav.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olvidaste tu Contraseña</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <style>
        body {
            background: none;
            background-image: url(./images/perro2.jpg);
            background-size: contain;
            backdrop-filter: blur(3px);
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }
        #inicia:hover { 
    background-color: #333;
    color: white;
    
}

        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 30px;
        }

        .form-control {
            width: 100% !important;
            text-align: center;
            border-radius: 10px;
        }

        .btn-primary {
            width: 100% !important;
            text-align: center;
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
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6">
                <div class="text-center mb-4">
                    <!-- Aquí puedes colocar cualquier elemento adicional que desees centrar -->
                </div>
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Olvidaste tu contraseña?</h2>
                        <p class="text-center" id="texto">Lo entendemos, suceden cosas. ¡Simplemente ingrese su dirección de correo electrónico a continuación y le enviaremos un enlace para restablecer su contraseña!</p>
                        <form action="./config/recovery.php" method="POST" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <input type="email" class="form-control" id="correo" name="correo" required placeholder="Ingresa tu dirección de correo electrónico">
                                <div class="invalid-feedback">
                                    Por favor ingresa tu dirección de correo electrónico.
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Enviar Contraseña</button>
                            <hr>
                        </form>
                        <p class="text-center" style="margin-top: 20px;">
                            <a href="login.php" id="inicia" style="text-decoration: none; color: #3498db; font-size: 16px; border: 1px solid #3498db; padding: 8px 16px; border-radius: 3px; transition: all 0.3s ease;">Volver a Inicio de sesión</a>
                        </p>


                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
