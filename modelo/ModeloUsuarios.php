<?php class ModeloUsuarios {
    static function login($email, $password) {
        $sql = "SELECT id_rol, id_estado_usuario FROM usuarios WHERE correo_usuario = ? AND password = ?;";
        $conn = Conexion::conectar();
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res;
    }
};
?>