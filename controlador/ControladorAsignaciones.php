<?php 
    include_once "./modelo/ModeloAsignaciones.php";

    class ControladorAsignaciones{

        public static function consultarAsignaciones(){
            $tabla = 'v_asignaciones';
            $obj = ModeloAsignaciones::selectAsignaciones($tabla);
            $arregloAsignaciones = $obj->fetch_all();
            return $arregloAsignaciones;
        }

    }
?>