<?php
    include_once 'conexion.php';

    class ModeloAsignaciones extends Conexion{

        static function selectAsignaciones($tabla){
            $sql = "SELECT * FROM inventarit_manager.$tabla;";
            $res = Conexion::conectar()->query($sql);
            return $res;
        }

        static function deleteAsignacion($id){
            $id_asignacion = (int)$id;
            $sql = "CALL inventarit_manager.eliminar_asignacion('$id')";
            $res = Conexion::conectar()->query($sql);
            return $res;
        }

    }
?>