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
        $sql = "call inventarit_manager.eliminar_dispositivo('$id');";
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

    //Funcion para seleccionar los tipos de dispositivos
    static function selectTiposDispositivos($tabla){
        $sql = "SELECT * FROM $tabla;";
        $res = Conexion::conectar()->query($sql);
        return $res;
        $res->close();
    }
    //aFuncion para seleccionar marcas
    static function selectMarcas($tabla){
        $sql = "SELECT * FROM $tabla;";
        $res = Conexion::conectar()->query($sql);
        return $res;
        $res->close();
    }

    //funcion para seleccionar los distintos tipos de estados
    static function selectEstados($tabla){
        $sql = "SELECT * FROM $tabla;";
        $res = Conexion::conectar()->query($sql);
        return $res;
        $res->close();
    }

     // Función para actualizar un Dispositivo por ID
static function updateDispositivos($tabla, $datos) {
    $stmt = Conexion::conectar()->prepare("CALL inventarit_manager.editar_laptop(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issidsssiss", $datos['id_dispositivo'], $datos['modelo'], $datos['numero_serie'], $datos['id_marca'], $datos['precio'], $datos['fecha_compra'], $datos['nota'], $datos['url_foto'], $datos['ram'], $datos['procesador'], $datos['sistema_operativo']);

    // Ejecutar la sentencia preparada
    $stmt->execute();

    // Cerrar la conexión
    $stmt->close();
}
}
?>
