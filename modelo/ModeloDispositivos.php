<?php
include_once 'conexion.php';

class ModeloDispositivos extends Conexion {
    //Funcion para ver toda la VISTA de dispositivos
    static function selectDispositivos($tabla) {
        $sql = "SELECT * FROM inventarit_manager.$tabla;";
        $res = Conexion::conectar()->query($sql);
         return $res;
    }
   
     //Función para eliminar un dispositivo
     static function deleteDispositivos($tabla, $id){
        $sql = "DELETE FROM $tabla WHERE id_dispositivo = '$id';";
        $res = Conexion::conectar()->query($sql);
        return $res;
        $res->close();
    }
    static function selectDispositivosId($tabla, $id){
        $sql = "SELECT * FROM $tabla WHERE id_dispositivo = '$id';";
        $res = Conexion::conectar()->query($sql);
        return $res;
        $res->close();
    }

}
?>
