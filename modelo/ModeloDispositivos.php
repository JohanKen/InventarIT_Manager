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
    }

    static function selectDispositivosId($tabla, $id){
        $sql = "SELECT * FROM $tabla WHERE id_dispositivo = '$id';";
        $res = Conexion::conectar()->query($sql);
        return $res;
    }

    //Funcion para seleccionar los tipos de dispositivos
    static function selectTiposDispositivos($tabla){
        $sql = "SELECT * FROM $tabla;";
        $res = Conexion::conectar()->query($sql);
        return $res;
    }

    //Funcion para seleccionar marcas
    static function selectMarcas($tabla){
        $sql = "SELECT * FROM $tabla;";
        $res = Conexion::conectar()->query($sql);
        return $res;
    }

    //funcion para seleccionar los distintos tipos de estados
    static function selectEstados($tabla){
        $sql = "SELECT * FROM $tabla;";
        $res = Conexion::conectar()->query($sql);
        return $res;
    }
// Función para actualizar un Dispositivo por ID

    static function updateLaptop($datos) {
        try {
            // Ajustar max_allowed_packet para esta conexión
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            Conexion::conectar()->options(MYSQLI_OPT_CONNECT_TIMEOUT, 300); // Ajusta el tiempo de espera según sea necesario
    
            // Reconectar antes de ejecutar la consulta
            Conexion::reconectar();
    
            $sqlSetMaxAllowedPacket = "SET GLOBAL max_allowed_packet=64*1024*1024";
            Conexion::conectar()->query($sqlSetMaxAllowedPacket);
    
            // Llamada al procedimiento almacenado
            $sql = "CALL inventarit_manager.editar_laptop (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = Conexion::conectar()->prepare($sql);
    
            // Enlazar parámetros
            $stmt->bind_param("issiisssissi", $datos['id_dispositivo'], $datos['modelo'], $datos['numero_serie'], $datos['id_marca'], $datos['precio'], $datos['fecha_compra'], $datos['nota'], $datos['foto'], $datos['ram'], $datos['procesador'], $datos['sistema_operativo'], $datos['estado']);
    
            // Ejecutar la sentencia preparada
            $stmt->execute();
            $stmt->close();
    
        } catch (mysqli_sql_exception $e) {
            // Manejar errores
            echo "Error al intentar insertar los datos en el procedimiento almacenado: " . $e->getMessage();
        }
    }
}



?>
