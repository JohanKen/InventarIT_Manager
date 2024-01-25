<?php

  


//verificamos cuando se presiona el boton de registrar para irnos al controlador
if(isset($_POST['registrar'])){
                
                    
    $registrar = new ControladorUsuarios;
    $registrar->registrarUsuario();
    echo '
        <script>
            alert("Usuario creado correctamente");
            window.location.href = "index.php?seccion=usuarios";
        </script>';
    exit;
    
               
   }
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="estilos/estilosNewUser.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
<div class="headerr">
<h2>Registro de nuevo usuario</h2>

</div>
<br><br><br><br><br>
    <div class="containerr">

    <form action="" method="POST" onsubmit="return validateForm()">
            <div class="mb-3">
                    <div class="mb-3">
                        <label for="apellido_paterno" class="form-label">Apellido Paterno:</label>
                        <input type="text" class="form-control" id="lbl" name="apellido_paterno" required>
                    </div>

                    <div class="mb-3">
                        <label for="apellido_materno" class="form-label">Apellido Materno:</label>
                        <input type="text" class="form-control" id="lbl" name="apellido_materno" required>
                    </div>

                    <div class="mb-3">
                        <label for="nombres" class="form-label">Nombre(s):</label>
                        <input type="text" class="form-control" id="lbl" name="nombres" required>
                    </div>
            </div>
            <div class="mb-3">
            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input type="email" class="form-control" id="lbl" name="correo" required>
            </div>

            <div class="mb-3">
                <label for="rol" class="form-label">Rol:</label>
                <select class="form-select" id="lbl" name="rol" required>
                    <option value="1">Administrador</option>
                    <option value="2">Editor</option>
                    <option value="3">Consultor</option>
                    
                </select>
            </div>

            

            <div class="mb-3">
                <label for="fecha_ingreso" class="form-label">Fecha de Ingreso:</label>
                <input type="date" class="form-control" id="lbl" name="fecha_ingreso" required>
            </div>
            </div>
            <br><br><br><br><br>
            <div class="mb-3" >
            <div class="mb-3" >
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            

            <div class="mb-3">
                <label for="confirmar_password" class="form-label">Confirmar Contraseña:</label>
                <input type="password" class="form-control" id="confirmar_password" name="confirmar_password" required>
                <br>
                <div id="errorMessage" class="error-message"></div>
                <br>
            </div>
            </div>
            <?php
                 
            ?>
            <div class="mb-3">
            <div class="botones">
            <img src="images/newUser.png" id="imgNewUser" alt="">
                <button type="button" class="btnCancelar" onclick="window.location.href='index.php?seccion=usuarios'">Cancelar</button>
                <button type="submit" class="btnRegistrar" name="registrar">Registrar</button>
                
                </div>
            </div>
        
            
            
        </form>
        
    </div>

    <script>
    function validateForm() {
        // Limpiar mensaje de error al principio
        document.getElementById("errorMessage").innerHTML = "";

        // Obtener los valores de los campos de contraseña
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirmar_password").value;

        // Verificar si las contraseñas coinciden
        if (password !== confirmPassword) {
            // Mostrar mensaje de error
            document.getElementById("errorMessage").innerHTML = "Las contraseñas no coinciden";

            // Detener el envío del formulario
            return false;
        }

        // Validar la fortaleza de la contraseña
        if (password.length < 8 || !/[A-Z]/.test(password) || !/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
            // Mostrar mensaje de error
            document.getElementById("errorMessage").innerHTML = "La contraseña debe tener al menos 8 caracteres, una mayúscula y un símbolo";

            // Detener el envío del formulario
            return false;
        }

        // Permitir el envío del formulario si todas las validaciones son exitosas
        return true;
    }

    function updateErrorMessage() {
        // Actualizar mensaje de error antes de realizar la validación
        validateForm();
    }
</script>


    
</body>
</html>
