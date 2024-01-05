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

//funcion para eliminar un usuario por medio del procedimiento almacenado...
static function deleteUsuarios($tabla,$id){
    $sql = "CALL inventarit_manager.eliminar_dispositivo('$id');";
    $res = Conexion::conectar()->query($sql);
    return $res;
}

}
?>