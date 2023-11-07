<?php
    class ModeloDispositivos extends Conexion{

        static function selectDispositivos (){
            $sql = "SELECT * FROM $tabla;";
            $res = Conexion::conectar()->query($sql);
            return $res;
            $res->close();
        }

    }
?>