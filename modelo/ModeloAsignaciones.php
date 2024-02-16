<?php
    include_once 'conexion.php';

    class ModeloAsignaciones extends Conexion{

        static function selectAsignaciones($tabla){
            $sql = "SELECT * FROM inventarit_manager.$tabla;";
            $res = Conexion::conectar()->query($sql);
            return $res;
        }

    }
?>