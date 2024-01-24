<?php
    include_once 'conexion.php';

    class ModeloColaboradores extends Conexion{

        static function selectColaboradores($tabla){
            $sql = "SELECT * FROM inventarit_manager.$tabla;";
            $res = Conexion::conectar()->query($sql);
            return $res;
        }

        static function deleteColavorador($tabla, $id){
            $sql = "CALL inventarit_manager.eliminar_colaborador('id');";
            $res = Conexion::conectar()->query($sql);
            return $res;
        }
    }
?>