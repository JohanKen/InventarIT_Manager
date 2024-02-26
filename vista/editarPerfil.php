<?php
//obtenemos el id del usuario mediante la url
$id = $_GET["id_usuario"];
// obtenemos los datos de un usuario
$datosUsuario = ObtenerDatosUsuario($id);

//array asociativo que mapea los estados para asignarlos posteriormente
$estados = array(
    1 => 1,
    2 => 2,

);
function ObtenerDatosUsuario($id){
    if($id >= 0){
        try {
            $UsuarioInfo = ControladorUsuarios::getUser($id);

            // verificar si se obtuvieron correctamente los datos del usuario
            if(empty($UsuarioInfo[0])){
                echo "Error: no se pudieron obtener los datos del usuario correctamente.";
                return null;
            }

            // aquí solo devolvemos los datos
            return $UsuarioInfo[0];
        } catch (Exception $e) {
            // Manejar la excepción, por ejemplo, registrándola o mostrándola
            echo "Error al obtener datos del usuario: " . $e->getMessage();
            return null;
        }
    } else {
        echo "No se pudo obtener ningún ID de usuario";
        return null;
    }
}
// Verificar si se envió el formulario para editar el usuario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar que se presionó el botón guardar del formulario
    if(isset($_POST['actualizarPerfil'])) {
        // Verificar si el usuario seleccionó "No" en el campo de selección "Cambiar Contraseña"
        if ($_POST['changePassword'] === 'no') {

            
            // Actualizar el perfil del usuario sin cambiar la contraseña
            $obj = new ControladorUsuarios();
            $obj->UpdatePerfil();
            echo '<script>
                    alert("El usuario se actualizó correctamente");
                    window.location.href = "index.php?seccionvv=perfil&id_usuario=' . $_SESSION['usuario']['id_usuario'] . '";
                </script>';
       
        } else {
            // Verificar que se enviaron las contraseñas
            if(isset($_POST['passwordInput']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
                $passwordActual = $_POST['passwordInput'];
                $nuevaPassword = $_POST['password'];
                $confirmarPassword = $_POST['confirm_password'];

                // Verificar que la contraseña actual sea correcta
                if ($passwordActual !== $datosUsuario[9]) {
                    echo '<script>alert("La contraseña actual es incorrecta.");</script>';
                } else {
                    // Verificar que la nueva contraseña y la confirmación coincidan
                    if ($nuevaPassword !== $confirmarPassword) {
                        echo '<script>alert(La nueva contraseña y la confirmación no coinciden.");</script>';
                    } else {
                        // Actualizar la contraseña del usuario en la base de datos solo si se proporciona una nueva contraseña
                        if ($nuevaPassword !== '') {
                            $obj = new ControladorUsuarios();
                            $obj->UpdatePerfil();
                            echo '<script>
                            Swal.fire({
                                title: "El usuario se actualizó correctamente",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.href = "index.php?seccion=perfil&id_usuario=' . $_SESSION['usuario']['id_usuario'] . '";
                            });
                        </script>';
                            exit;
                        } else {
                            // Si no se proporciona una nueva contraseña, no se actualiza la contraseña
                            $obj = new ControladorUsuarios();
                            $obj->UpdatePerfil();
                            echo '<script>
                                    Swal.fire({
                                        title: "El usuario se actualizó correctamente",
                                        icon: "success",
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(() => {
                                        window.location.href = "index.php?seccion=perfil&id_usuario=' . $_SESSION['usuario']['id_usuario'] . '";
                                    });
                                </script>';

                            exit;
                        }
                    }
                }
            } else {
                echo "Por favor, complete todos los campos de contraseña.";
            }
        }
    }
}

        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil del Usuario</title>
    <link rel="stylesheet" href="estilos/estilosPerfil.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<section class="vh-100" style="background:none">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-9 mb-4 mb-lg-0">
                <div class="card mb-3" style="border-radius: .5rem;">
                    <div class="row g-0">
                        <div class="col-md-4 gradient-custom text-center text-white" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                            <img src="images/perro.jpg" class="rounded-circle" style="width: 150px; max-height:180px; margin:5px"  alt="" />
                            <h5><?php echo "$datosUsuario[3] $datosUsuario[1]";?></h5>
                        <?php
                            // Define el array asociativo de roles
                            $roles = array(
                                1 => "Administrador",
                                2 => "Editor",
                                3 => "Consultor"
                            );
                        ?>
                        <p>Rol: <?php echo $roles[$datosUsuario[6]]; ?></p>
                        <i class="far fa-edit mb-5"></i>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <h6>Editar Información del perfil</h6>
                                <hr class="mt-0 mb-4">
                                <form action="#" method="POST">
                                    <div class="row pt-1">
                                        <div class="col-md-6 mb-3">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre_usuario" value="<?php echo $datosUsuario[3]; ?>" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="apellido">Apellido Paterno</label>
                                            <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" value="<?php echo $datosUsuario[1]; ?>" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="apellido">Apellido Materno</label>
                                            <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" value="<?php echo $datosUsuario[2]; ?>" required>
                                        </div>
                                        <div class="col-md-6 col-sm-3 col-xs-3">
                                            <label for="fecha_ingreso" id="lbl">Fecha de Ingreso:</label>
                                            <input type="date" class="form-control" id="fechaIngresoInput" name="fecha_ingreso"
                                                value="<?php echo $datosUsuario[7]; ?>">
                                        </div>
                                    </div>
                                    <div class="row pt-1">
                                        <div class="col-md-6 mb-3">
                                            <label for="correo">Correo</label>
                                            <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $datosUsuario[4]; ?>" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="rol">Rol</label>
                                            <select class="form-select" id="lbl" name="rol">
                                                <?php
                                                            // Define el array asociativo de roles
                                                        $roles = array(
                                                            1 => 1,
                                                            2 => 2,
                                                            3 => 3
                                                        );
                                                            foreach ($roles as $rolId => $rolLabel) {
                                                                $selected = ($datosUsuario[6] == $rolLabel) ? 'selected' : '';
                                                                echo "<option value='$rolLabel' $selected>";
                                                                switch ($rolLabel) {
                                                                    case 1:
                                                                        echo "Administrador";
                                                                        break;
                                                                    case 2:
                                                                        echo "Editor";
                                                                        break;
                                                                    case 3:
                                                                        echo "Consultor";
                                                                        break;
                                                                    default:
                                                                        echo "Desconocido";
                                                                        break;
                                                                }
                                                                echo "</option>";
                                                            }
                                                        ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row pt-1">
                                        <div class="col-md-6 mb-3">
                                            <label for="changePassword">Cambiar Contraseña</label>
                                            <select class="form-select" id="changePassword" name="changePassword">
                                                <option value="no">No</option>
                                                <option value="yes">Sí</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="passwordFields" style="display: none;">
                                    <div class="row pt-1">
                                    <div class="col-md-6 mb-3">
                                        
                                            <label for="passwordInput">Ingresa contraseña Actual</label>
                                            <div class="input-group">
                                                <input type="password" id="passwordInput" class="form-control" name="passwordInput" required>
                                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="password">Nueva Contraseña</label>
                                            <input type="password" class="form-control" id="password" name="password" value="<?php echo $datosUsuario[9]; ?>" pattern="^(?=.*\d).{8,}$" title="La contraseña debe tener al menos 8 caracteres y contener al menos un número" required disabled>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="confirm_password">Confirmar Contraseña</label>
                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required disabled>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row pt-1">
                                        <div class="col-12">
                                            <a href="index.php?seccion=perfil&id_usuario=<?php echo $_SESSION['usuario']['id_usuario']; ?>" class="btn btn-secondary" >Cancelar</a>
                                            <button type="submit" name="actualizarPerfil" class="btn btn-primary">Guardar Cambios</button>

                                        </div>
                                    </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

document.addEventListener('DOMContentLoaded', function() {
    const changePasswordSelect = document.getElementById('changePassword');
    const passwordFields = document.getElementById('passwordFields');

    changePasswordSelect.addEventListener('change', function() {
        if (this.value === 'yes') {
            passwordFields.style.display = 'block';
        } else {
            passwordFields.style.display = 'none';
        }
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const currentPassword = "<?php echo isset($datosUsuario[9]) ? $datosUsuario[9] : ''; ?>";
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('passwordInput');
    const newPasswordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm_password');

    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });

    passwordInput.addEventListener('input', function() {
        // Obtener la contraseña ingresada por el usuario
        const enteredPassword = this.value;

        if (currentPassword === enteredPassword) {
            // Habilitar los campos de nueva contraseña y confirmar contraseña
            newPasswordInput.removeAttribute('disabled');
            confirmPasswordInput.removeAttribute('disabled');
        } else {
            // Deshabilitar los campos de nueva contraseña y confirmar contraseña
            newPasswordInput.setAttribute('disabled', 'disabled');
            confirmPasswordInput.setAttribute('disabled', 'disabled');
        }
    });
});
</script>

</body>
</html>
