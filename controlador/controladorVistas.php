<?php
class controladorVistas{
    function cargarSeccion(){
        if(isset($_GET["seccion"])){
            $ruta = "vista/".$_GET["seccion"].".php";
            include $ruta;
        }else{
            include_once ('vista/inicio.php');
        }
    }
}
?>