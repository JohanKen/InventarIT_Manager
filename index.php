<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    // Si no hay un usuario autenticado, redirige a la página de login
    header('Location: login.php');
   
}
//Modelos
include 'modelo/ModeloDispositivos.php';

//Controladores
include 'controlador/ControladorUsuarios.php';
include 'controlador/controladorVistas.php';
include 'controlador/ControladorDispositivos.php';
include 'plantilla.php';                                    
?>
