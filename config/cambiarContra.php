<?php
    require_once('../modelo/conexion.php');
    $id = $_POST['id'];
    $pass= $_POST['new_password'];

    $query = "UPDATE usuarios set password= '$pass' WHERE id_usuario= $id";
    $con = Conexion::conectar();
    $con->query($query);
    
    header("Location: ../login.php?message=success_password");


?>