<?php class controladorVistas {
    public function cargarSeccion() {
        session_start();
    
        // Verificar si el usuario ha iniciado sesión
     if (!isset($_SESSION['usuario'])) {
            header('Location: login.php'); // Redirigir al usuario a la página de inicio de sesión
            exit();
        }
    
        // Puedes agregar lógica específica antes de cargar una sección
    
        if (isset($_GET["seccion"])) {
            $ruta = "vista/" . $_GET["seccion"] . ".php";
            include $ruta;
        } else {
            include_once('vista/inicio.php');
        }
    }
    
}
?>