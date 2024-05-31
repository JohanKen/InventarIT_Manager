
<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    // Si no hay un usuario autenticado, redirige a la página de login
    header('Location: login.php');
   
}


;

//Controladores
include 'controlador/ControladorUsuarios.php';
include 'controlador/controladorVistas.php';
include 'controlador/ControladorDispositivos.php';

//Modelos
include_once 'modelo/ModeloDispositivos.php';
include_once 'modelo/ModeloColaboradores.php';
include 'plantilla.php';        
                            
?>
