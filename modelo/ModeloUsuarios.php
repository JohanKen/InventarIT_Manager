<?php
class ModeloUsuarios {

static function login($email, $password) {
    $sql = "SELECT * FROM usuarios WHERE correo_usuario = ? AND password = ?;";
    $conn = Conexion::conectar();
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $res = $stmt->get_result();
    return $res;
}



static function comprobarUsuario($email) {
    $sql = "SELECT * FROM usuarios WHERE correo_usuario = ?";
    $conn = Conexion::conectar();
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();
    return $res->num_rows > 0;
}

// Función para seleccionar usuarios para usarlos posteriormente en el sistema de manera general
static function seleccionarUsuario($tabla){
    $sql = "SELECT * FROM inventarit_manager.$tabla;";
    $conn = Conexion::conectar();
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $res = $stmt->get_result();
    return $res;
}


//funcion para seleccionar usuarios por id (individualmente para despues poderlos editar)
static function selectUsuariosId($id){
    try {
        $sql = "SELECT * FROM usuarios WHERE id_usuario = ?";
        $conn = Conexion::conectar();
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res;
    } catch (Exception $e) {
        // Manejar la excepción, por ejemplo, registrándola o lanzándola nuevamente
        echo "Error en la consulta: " . $e->getMessage();
        return false;
    }
}



//funcion para eliminar un usuario por medio del procedimiento almacenado...
static function deleteUsuarios($id){
    $id_usuario= (int)$id;
    $sql = "CALL inventarit_manager.eliminar_usuario('$id_usuario');";
    $res = Conexion::conectar()->query($sql);
    return $res;
}
static function comprobarUsuarioExistente($email) {
    $sql = "SELECT * FROM usuarios WHERE correo_usuario = ?";
    $conn = Conexion::conectar();
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();
    return $res->num_rows > 0;
}

static function createUser($datos){
    $conexion = Conexion::conectar();
    try{
        $statement = $conexion->prepare("CALL insertar_usuario(?,?,?,?,?,?,?);");
        $statement->bind_param("sssssss",
        $datos["apellido_paterno"],
        $datos["apellido_materno"],
        $datos["nombres"],
        $datos["correo"],
        $datos["rol"],
        $datos["fecha_ingreso"],
        $datos["password"]
    );
    $statement->execute();

            if ($statement->error) {
                echo 'Error al insertar el usuario: ' . $statement->error;
                exit;
             }

$statement->close();


    }catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
      }

}


    static function actualizarPassword($id, $newPassword){
        $conexion = Conexion::conectar();
        try {
            $statement = $conexion->prepare("CALL inventarit_manager.cambiar_password(?,?)");
            $statement->bind_param("is",
            $id,
            $newPassword);
            
        $statement->execute();
        $statement->close();
        
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
        }

static function actualizarUsuario($datos){
    $conexion = Conexion::conectar();
    try{
       $id_usuario= (int) $datos['id'];

       $id_rol= (int) $datos['rol'];
       

        $statement = $conexion->prepare("CALL editar_usuario2(?,?,?,?,?,?,?)");
        $statement->bind_param("issssis",
        $id_usuario,
        $datos["apellidoPaterno"],
        $datos["apellidoMaterno"],
        $datos["nombre"], 
        $datos["correo"],
        $id_rol,
        $datos["fechaIngreso"]
    );
    
    $statement->execute();
    $statement->close();

    
     
    }catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
      }
}

static function updateUser($datos){
    $conexion = Conexion::conectar();
    try{
       $id_usuario= (int) $datos['id'];
       //Se creara la insercion a base de datos mediante el procedimiento almacenado 
       $id_estado= (int) $datos['estado'];
       $id_rol= (int) $datos['rol'];
       
        /*APLICAR NUEVO PROCEDIMIENTO ALMACENADO PARA ACTUALIZAR USUARIO*/
        $statement = $conexion->prepare("CALL editar_usuario(?,?,?,?,?,?,?,?)");
        $statement->bind_param("issssiis",
        $id_usuario,
        $datos["apellidoPaterno"],
        $datos["apellidoMaterno"],
        $datos["nombre"],
        $datos["correo"],
        $id_estado,
        $id_rol,
        $datos["fechaIngreso"]
    );
    
    $statement->execute();
    $statement->close();

    
     
    }catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
      }
}


}
?>