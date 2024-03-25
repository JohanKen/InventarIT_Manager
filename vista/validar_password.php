<?php

include_once "modelo/ModeloUsuarios.php";

// Verificar si se ha recibido un password desde el cliente
if(isset($_POST['password'])) {
    // Obtener el password enviado desde el cliente con el sweetalert
    $password = $_POST['password'];

    // Validar el password
    $validacionExitosa = validarPassword($password);

    // Enviar la respuesta JSON al cliente
    $response = array('success' => $validacionExitosa);
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Obtener los detalles del usuario
function detalleUsuario() {
    
        $id = $_GET["id_usuario"];
        // Ajustar el método para pasar el id correctamente
        $obj = ModeloUsuarios::selectUsuariosId($id);
        $usuario = $obj->fetch_assoc(); // Usar fetch_assoc() para obtener un array asociativo
        return $usuario;
    
}

// Función para validar el password
function validarPassword($password) {
    // Obtener el usuario para comparar su contraseña
    $usuario = detalleUsuario();

    // Verificar si se obtuvo el usuario y su contraseña coincide
    if($usuario && !empty($usuario['password'])) {
        // Obtener el hash del password almacenado en la base de datos
        $hashPassword = $usuario['password']; // Suponiendo que el hash del password se encuentra en el campo 'password'
        return password_verify($password, $hashPassword);
    }
    
    return false; // Si no se pudo obtener el usuario o el password está vacío, retornamos false
}
?>
