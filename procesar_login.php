

<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    // Si no hay un usuario autenticado, redirige a la página de login
    header('Location: login.php');
    exit; // Asegúrate de salir después de redirigir
}else{
    header('Location: incio.php');
}
?>