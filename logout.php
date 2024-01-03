<?php
session_start();

session_destroy();
 
// Eliminar la variable de sesión específica
unset($_SESSION['usuario']);

// Redirigir a la página de inicio de sesión
header('location: login.php');

// Asegurar que el código se detenga después de la redirección
exit();
?>
