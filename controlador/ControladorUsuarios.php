<?php 
include_once "modelo/ModeloUsuarios.php";
class ControladorUsuarios {
    
    public static function consultarUsuarios(){
        $tabla= 'usuarios';
        $obj = ModeloUsuarios::seleccionarUsuario($tabla);
        $arregloUsuario = $obj->fetch_all();
        return $arregloUsuario;
    }
    public static function agregarUsuarios(){
        $tabla = 'usuarios';
        if (isset($_POST["agregar"])) {
            try {
                // Validamos el formato de la fecha para evitar problemas al insertarla en la base de datos
                $fechaIngreso = $_POST["fechaIngreso"];
                if (DateTime::createFromFormat('Y-m-d', $fechaIngreso) !== false ){
                    $fechaIngresoFormateada = $fechaIngreso;
                } else {
                    echo 'Error en el formato de la fecha';
                    exit;
                }
    
                // Generamos un array que contiene todas las variables de los campos del formulario del usuario a editar
    
            } catch (Exception $e) {
                // Manejo de excepciones
                echo 'Error: ' . $e->getMessage();
            }
        }
    }
    

    

    public static function borrarUsuarios(){
        if(isset($_GET["accion"]) && $_GET["accion"] == "eliminarUsuario"){
            $id = $_GET ["id_usuario"];
            $tabla = 'usuarios';
            $objDelete = ModeloUsuarios::deleteUsuarios($tabla,$id);
            if($objDelete>0){
                echo    '
                <script>
                    alert("Usuario eliminado correctamente");
                    window.location.href="index.php?seccion=usuarios";
                </script>
            ';
            } 
        }
    } 

    public static function detalleUsuario(){
        if(isset($_GET["id_usuario"])){
        $tabla="usuarios";
        $id = $_GET["id_usuario"];


        $obj = ModeloUsuarios::selectUsuariosId($tabla, $id);
        $usuario = $obj->fetch_all();
        return $usuario;
        }

    }


    // Función para llevar a cabo el inicio de sesión
    public static function validarLogin() {
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
                            exit;
                            break;
                        case $rol_usuario == 2 && $estado_usuario == 1:
                            echo  '<script>
                                    alert("Iniciaste sesión como editor");
                                    window.location.href="index.php";
                                    </script>';
                            exit;
                            break;
                        case $rol_usuario == 3 && $estado_usuario == 1:
                            echo  '<script>
                                    alert("Iniciaste sesión como consultor");
                                    window.location.href="index.php";
                                    </script>';
                            exit;
                            break;
                        case $rol_usuario == 1 && $estado_usuario == 2:
                            echo  '<script>
                                    alert("Tu usuario administrador está inactivo actualmente");
                                    window.location.href="login.php";
                                    </script>';
                            exit;
                            break;
                        case $rol_usuario == 2 && $estado_usuario == 2:
                            echo  '<script>
                                    alert("Tu usuario editor está inactivo actualmente");
                                    window.location.href="login.php";
                                    </script>';
                            exit;
                            break;
                        case $rol_usuario == 3 && $estado_usuario == 2:
                            echo  '<script>
                                    alert("Tu usuario consultor está inactivo actualmente");
                                    window.location.href="login.php";
                                    </script>';
                            exit;
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
                    exit;
                }
            } else {
                $usuarioIncorrecto = ModeloUsuarios::comprobarUsuario($email);
                if ($usuarioIncorrecto) {
                    echo '<script>
                            alert("La contraseña es incorrecta");
                            window.location.href="Login.php";
                          </script>';
                    exit;
                } else {
                    echo '<script>
                            alert("El usuario no existe");
                            window.location.href="Login.php";
                          </script>';
                    exit;
                }
            }
        }
    }

    static function getUser($id){
        if(isset($id)){
            $tabla = "usuarios";
            $obj = ModeloUsuarios::selectUsuariosId($id);
            $usuarioSeleccionado = $obj->fetch_all();
            return $usuarioSeleccionado;
        } else {
            echo "No llego ningun id al controlador para poder llevar a cabo de maner correcta la consulta";
        }
    }


    static function UpdateUser($id){
        if(isset($_POST["guardar"]) && $_POST["editar"] == "Actualizar"){
            $tabla= "usuarios";
            $datos = array ('id' => $_POST['id_usuario'],
                            'apellidoPaterno' => $_POST['apellido_paterno'],
                            'apellidoMaterno' => $_POST['apellido_materno'],
                            'nombre' => $_POST['nombre_usuario'],
                            'correo' => $_POST['correo'],
                            'estado' => $_POST['estado'],
                            'rol' => $_POST['rol'],
                            'fechaIngreso' => $_POST['fecha_ingreso'],
                            'fechaCreacion' => $_POST['fecha_creacion'],
                            'password' => $_POST[$password]
                            
                        );
            $respuesta = ModeloUsario::UpdateUser($tabla, $datos);
        }
    
    

}

?>