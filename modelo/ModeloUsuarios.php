<?php
class ModeloUsuarios {

static function login($email, $password) {
    $sql = "SELECT id_rol, id_estado_usuario FROM usuarios WHERE correo_usuario = ? AND password = ?;";
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
static function deleteUsuarios($tabla,$id){
    $sql = "CALL inventarit_manager.eliminar_usuario('$id');";
    $res = Conexion::conectar()->query($sql);
    return $res;
}


}
?>