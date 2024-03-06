<?php
// Verificamos cuando se presiona el botón de registrar para irnos al controlador
if(isset($_POST['registrar'])){
    $registrar = new ControladorUsuarios;
    $registrado= $registrar->registrarUsuario();
    if ($registrado) {
        echo "<script>Swal.fire('Usuario registrado con éxito', '', 'success');</script>";
        echo "<script>window.location.href='index.php?seccion=usuarios';</script>";
    }
    
    
    


    exit;
}
?>
v
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js
"></script>
<link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css
" rel="stylesheet">
    <style>
        body {
            text-align: center;
        }

        .headerr h2 {
            margin-top: 10px;
            font-size: 40px;
        }
        
      div{
            padding: 5px;
        }

        .containerr {
            margin-bottom: 100px;
            background-color: #333;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 3px 3px 3px rgb(25, 0, 255);
        }

        label {
            font-weight: bold;
            color: white;
        }

        .imgdiv{
            display: flex ;
        }

        .error-message {
            color: #ff2323;
            font-size: 20px;
        }

        input:hover {
            border-color: rgb(34, 18, 207) !important;
            border-style: groove !important;
        }

        .m{
            color: #333;
            font-size: 22px;
            
        }

        .mm{
            margin-top: 35px;
            color: #333;
            font-size: 20px;
            
        }
        .mmm{
            color: #333;
            font-size: 16px;
            
        }
       
        #inputConfirmar{
            margin-top: 33px;
            
        }

    </style>
</head>
<body>
<div class="headerr">
    <h2>Registro de nuevo usuario</h2>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <form action="" method="POST" onsubmit="return validateForm()" id="form" class="credit-card-div">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="imgdiv">
        <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Nombre(s)" name="nombres" required>
                </div>
           
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Apellido Paterno" name="apellido_paterno" required>
                </div>
                

                
                </div>
                <div class="imgdiv">
         
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Apellido Materno" name="apellido_materno" required>
                </div>
                
                <div class="col-md-6 col-sm-3 col-xs-3">
                   
                   <input type="email" class="form-control" placeholder="Correo" name="correo" required>
               </div>
           
               </div>
            <div class="row">
                
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <h8 class="m">Rol:</h8>
                    <select class="form-select" name="rol" required>
                        <option value="1">Administrador</option>
                        <option value="2">Editor</option>
                        <option value="3">Consultor</option>
                    </select>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <h8 class="mm">Fecha de Ingreso:</h8>
                    <input type="date" class="form-control" placeholder="Fecha de Ingreso" name="fecha_ingreso" required>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                <h8 class="m">Contraseña:</h8>

                    <input type="password" class="form-control" placeholder="" name="password" required>
                </div>
         
            
                <div class="col-md-3 col-sm-3 col-xs-3">
              
                    <input type="password" id="inputConfirmar" class="form-control" placeholder="Confirmar contraseña" style="font-size:14px" name="confirmar_password" required>
                    
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 pad-adjust" style="margin-left:40% !important; ">
                    <div id="errorMessage" class="error-message"></div>
                </div>
    </div>
                
              
            
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6 pad-adjust">
                    <button type="button" class="btn btn-danger" onclick="window.location.href='index.php?seccion=usuarios'">Cancelar</button>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 pad-adjust">
                    <button type="submit" id="btnreg" onclick="alertaRegistro()" class="btn btn-warning btn-block" name="registrar">Registrar</button>
                </div>


            </div>
        </div>
    </div>
</form>

        </div>
    </div>
</div>

<script>
    

    



    function validateForm() {
        // Limpiar mensaje de error al principio
        document.getElementById("errorMessage").innerHTML = "";

        // Obtener los valores de los campos de contraseña
        var password = document.getElementsByName("password")[0].value;
        var confirmPassword = document.getElementsByName("confirmar_password")[0].value;

        // Verificar si las contraseñas coinciden
        if (password !== confirmPassword) {
            // Mostrar mensaje de error
            document.getElementById("errorMessage").innerHTML = "Las contraseñas no coinciden";

            // Detener el envío del formulario
            return false;
        }

        // Verificar si la contraseña tiene más de 8 caracteres
        if (password.length < 8) {
            // Mostrar mensaje de error
            document.getElementById("errorMessage").innerHTML = "La contraseña debe tener al menos 8 caracteres";

            // Detener el envío del formulario
            return false;
        }

        // Verificar si la contraseña contiene al menos un número
        if (!/\d/.test(password)) {
            // Mostrar mensaje de error
            document.getElementById("errorMessage").innerHTML = "La contraseña debe contener al menos un número";

            // Detener el envío del formulario
            return false;
        }

        // Permitir el envío del formulario si todas las validaciones son exitosas
        return true;
    }


</script>


</body>
</html>
