<?php 
class ControladorUsuarios {
    
    
    // Función para llevar a cabo el inicio de sesión
    public static function validarLogin() {

          // Verificar si el usuario ha iniciado sesión
          if (isset($_SESSION['usuario'])) {
            // Redirigir a la página de inicio de sesión si no ha iniciado sesión
            header('location: index.php');
            exit(); // Asegurar que el código se detenga después de la redirección
        }

        if (isset($_POST["entrar"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
    
            // Obtener el usuario
            $usuario = ModeloUsuarios::login($email, $password);

            // Obtener el número de filas
            $count = $usuario->num_rows;
            
            if ($count > 0) {
                $arreglo = $usuario->fetch_all(MYSQLI_ASSOC);
                if (isset($arreglo[0]['id_rol']) && isset($arreglo[0]['id_estado_usuario'])) {
                    $rol_usuario = $arreglo[0]['id_rol'];
                    $estado_usuario = $arreglo[0]['id_estado_usuario'];
                    
                    // Configurar la variable de sesión con los datos del usuario
                    $_SESSION['usuario'] = $arreglo[0];
                   
                    switch (true) {
                        case $rol_usuario == 1 && $estado_usuario == 1:
                            echo  '<script>
                                    alert("Iniciaste sesión como administrador");
                                    window.location.href="index.php";
                                    </script>';
                            break;
                        case $rol_usuario == 2 && $estado_usuario == 1:
                            echo  '<script>
                                    alert("Iniciaste sesión como editor");
                                    window.location.href="index.php";
                                    </script>';
                            break;
                        case $rol_usuario == 3 && $estado_usuario == 1:
                            echo  '<script>
                                    alert("Iniciaste sesión como consultor");
                                    window.location.href="index.php";
                                    </script>';
                            break;
                        case $rol_usuario == 1 && $estado_usuario == 2:
                            echo  '<script>
                                    alert("Tu usuario administrador está inactivo actualmente");
                                    window.location.href="login.php";
                                    </script>';
                            break;
                        case $rol_usuario == 2 && $estado_usuario == 2:
                            echo  '<script>
                                    alert("Tu usuario editor está inactivo actualmente");
                                    window.location.href="login.php";
                                    </script>';
                            break;
                        case $rol_usuario == 3 && $estado_usuario == 2:
                            echo  '<script>
                                    alert("Tu usuario consultor está inactivo actualmente");
                                    window.location.href="login.php";
                                    </script>';
                            break;
                        default:
                            // Código por defecto si no se cumplen las condiciones anteriores
                            break;
                    }
                } else {
                    echo '<script>
                            alert("Las claves necesarias no existen en el array de usuario.");
                            window.location.href="Login.php";
                          </script>';
                }
            }  else {
                $usuarioIncorrecto = ModeloUsuarios::comprobarUsuario($email);
                if ($usuarioIncorrecto) {
                    echo '<script>
                            alert("La contraseña es incorrecta");
                            window.location.href="Login.php";
                          </script>';
                } else {
                    echo '<script>
                            alert("El usuario no existe");
                            window.location.href="Login.php";
                          </script>';
                }
            }
        }
    }
}
?>