<?php 
include_once "modelo/ModeloUsuarios.php";
class ControladorUsuarios {

    public static function consultarUsuarios(){
        $tabla= 'usuarios';
        $obj = ModeloUsuarios::seleccionarUsuario($tabla);
        $arregloUsuario = $obj->fetch_all();
        return $arregloUsuario;
    }
    public static function registrarUsuario(){
        
        if (isset($_POST["registrar"])) {
            try {


                $password=$_POST['password'];
                $ConfirmarPassword=$_POST['confirmar_password'];

                if($password == $ConfirmarPassword){
                    $passwordCorrect=$_POST['password'];
                } else {
                    echo '
                    <script>
                        alert("Las contraseñas no coinciden");
                       
                    </script>';    
                    exit;
                }
                
                    
                    

                // Validamos el formato de la fecha para evitar problemas al insertarla en la base de datos
                $fechaIngreso = $_POST["fecha_ingreso"];
                if (DateTime::createFromFormat('Y-m-d', $fechaIngreso) !== false ){
                    $fechaIngresoFormateada = $fechaIngreso;
                } else {
                    echo 'Error en el formato de la fecha';
                    exit;
                }



    
                // Generamos un array que contiene todas las variables de los campos del formulario del usuario a editar
    


                $datos = array(
                    "apellido_paterno" =>  $_POST['apellido_paterno'],
                    "apellido_materno" => $_POST['apellido_materno'],
                    "nombres" => $_POST['nombres'],
                    "correo" =>$_POST['correo'],
                    "rol" =>$_POST['rol'],
                    "password" => $passwordCorrect,
                    "fecha_ingreso" => $fechaIngresoFormateada,
                );
                    $correoExistente = ModeloUsuarios::comprobarUsuarioExistente($_POST['correo']);

                    if ($correoExistente) {
                        echo '
                            <script>
                                alert("El correo electrónico ya está en uso. Por favor, elige otro.");
                            </script>';
                        exit;
                    }


                $insert = ModeloUsuarios::createUser($datos);
                
                

            } catch (Exception $e) {
                // Manejo de excepciones
                echo 'Error: ' . $e->getMessage();
            }
        }
    }
    

    

    public static function borrarUsuarios(){
        if(isset($_GET["accion"]) && $_GET["accion"] == "eliminarUsuario"){
            $id = $_GET ["id_usuario"];
            
              // Obtener el ID del usuario logueado
             
              $usuarioLogueado = $_SESSION['usuario']['id_usuario'];

              // Validar que el usuario que intenta eliminar no sea el mismo que está logueado
              if ($id == $usuarioLogueado) {
                  echo '<script>alert("No puedes eliminar tu propia cuenta."); window.location.href="index.php?seccion=usuarios";</script>';
                  exit;
              }
            $objDelete = ModeloUsuarios::deleteUsuarios($id);
            if($objDelete>0){
               
                echo '
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        Swal.fire({
                            title: "Usuario eliminado correctamente",
                            icon: "success",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function () {
                            window.location.href = "index.php?seccion=usuarios";
                        });
                    </script>';
                
                
            } 
        }
    } 

    static function UpdateUser(){
        
        if(isset($_POST["guardar"])){
            
            try{


                //Formateo de fechas para que se vayan al modelo como las necesita la base de datos
                $fecha_ingreso = $_POST["fecha_ingreso"];
                if (DateTime::createFromFormat('Y-m-d', $fecha_ingreso) !== false ){
                    $fecha_ingresoFormateada = $fecha_ingreso;
                } else {
                    echo 'Error en el formato de la fecha de ingreso';
                    exit;
                }

                

                $datos = array ('id' => $_GET['id_usuario'],
                'apellidoPaterno' => $_POST['apellido_paterno'],
                'apellidoMaterno' => $_POST['apellido_materno'],
                'nombre' => $_POST['nombre_usuario'],
                'correo' => $_POST['correo'],
                'estado' => $_POST['estado'],
                'rol' => $_POST['rol'],
                'fechaIngreso' => $_POST['fecha_ingreso']

            );
                $respuesta = ModeloUsuarios::updateUser($datos);
                if($respuesta > 0){
                    var_dump($datos);
                }
                }
                catch(Exception $e) {
                    echo 'Message: ' .$e->getMessage();
                  }
        
            }       
            
        }static function getUser($id){
            if(isset($id)){
                $tabla = "usuarios";
                $obj = ModeloUsuarios::selectUsuariosId($id);
                $usuarioSeleccionado = $obj->fetch_all();
                return $usuarioSeleccionado;
            } else {
                echo "No llego ningun id al controlador para poder llevar a cabo de manera correcta la consulta";
            }
        }
/* FUNCION PARA ACTUALIZAR USUARIO QUE INICIO SESION. */
        static function UpdatePerfil(){
        
            if(isset($_POST["actualizarPerfil"])){
                
                try{
                    if(empty($_POST["password"])){
                       
                        // Obtener la contraseña del usuario
                        $passwordDatabase = $_POST['oldPassword'];
                        $passwordNew = $passwordDatabase; 
 
                    }else{
                      $passwordNew = $_POST['password']; 
                    }

                  
                    //Formateo de fechas para que se vayan al modelo como las necesita la base de datos
                    $fecha_ingreso = $_POST["fecha_ingreso"];
                    if (DateTime::createFromFormat('Y-m-d', $fecha_ingreso) !== false ){
                        $fecha_ingresoFormateada = $fecha_ingreso;
                    } else {
                        echo 'Error en el formato de la fecha de ingreso';
                        exit;
                    }
    
                    /*mediante $_session OBTENER EL RESTO DE DATOS PARA PROCEDIMIENTO ALMACENADO*/
                    

                    $datos = array(
                        'id' => $_GET['id_usuario'],
                        'apellidoPaterno' => $_POST['apellido_paterno'],
                        'apellidoMaterno' => $_POST['apellido_materno'],
                        'nombre' => $_POST['nombre_usuario'],
                        'correo' => $_POST['correo'],
                        'password' => $passwordNew,
                        'rol' => $_POST['rol'],
                        'fechaIngreso' => $_POST['fecha_ingreso']
                    );
                    
                    $respuesta = ModeloUsuarios::actualizarUsuario($datos);
                   
                    }
                    catch(Exception $e) {
                        echo 'Message: ' .$e->getMessage();
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
                    $id_usuario = $arreglo[0]['id_usuario'];
                    $apellido_paterno_usuario = $arreglo[0]['apellido_materno_usuario'];
                    $nombre_usuario = $arreglo[0]['nombre_usuario'];
                    $correo_usuario = $arreglo[0]['correo_usuario'];
                    $estado_usuario = $arreglo[0]['id_estado_usuario'];
                    $rol_usuario = $arreglo[0]['id_rol'];
                    $fechaIngreso = $arreglo[0]['fecha_ingreso_usuario'];
                    $fechaCreacion = $arreglo[0]['fecha_creacion_usuario'];
                    $password = $arreglo[0]['password'];
                    
                    
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

 


    
    

}


?>