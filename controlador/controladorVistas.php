<?php class controladorVistas {
    public function cargarSeccion() {
        

      
        
    
        // Verificar si el usuario ha iniciado sesión

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