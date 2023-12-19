<?php
include_once 'conexion.php';

class ModeloDispositivos extends Conexion {
    
    // Función para ver toda la VISTA de dispositivos
    static function selectDispositivos($tabla) {
        $sql = "SELECT * FROM inventarit_manager.$tabla;";
        $res = Conexion::conectar()->query($sql);
        return $res;
    }



    // Función para eliminar un dispositivo
    static function deleteDispositivos($tabla, $id) {
        $sql = "CALL inventarit_manager.eliminar_dispositivo('$id');";
        $res = Conexion::conectar()->query($sql);
        return $res;
    }

    static function selectDispositivosId($tabla, $id) {
        $sql = "SELECT * FROM $tabla WHERE id_dispositivo = '$id';";
        $res = Conexion::conectar()->query($sql);
        return $res;
    }

    // Función para seleccionar los tipos de dispositivos
    static function selectTiposDispositivos($tabla) {
        $sql = "SELECT * FROM $tabla;";
        $res = Conexion::conectar()->query($sql);
        return $res;
    }




    //seleccionar dispositivos si son laptop, pc o imac
    static function selectDispositivosPLI($id) {
        try {
            $conexion = Conexion::conectar();
    
            // Usar un prepared statement con un marcador de posición ?
            $stmt = $conexion->prepare("CALL inventarit_manager.datos_laptop(?)");
            $stmt->bind_param('i', $id); // 'i' indica que el parámetro es de tipo entero
            $stmt->execute();
    
            // Obtener el resultado
            $result = $stmt->get_result();
    
            
            

            // Verificar si get_result() está disponible
            if ($result !== false) {
                // Devolver el resultado en formato asociativo
                return $result->fetch_all(MYSQLI_ASSOC);
            } else {
                // Manejar el caso donde get_result() no está disponible
                echo "Error: No se pudo obtener el resultado de la consulta.";
                return null;
            }
        } catch (mysqli_sql_exception $e) {
            // Manejar la excepción de alguna manera apropiada (puedes imprimir el mensaje o lanzar la excepción)
            echo "Error al ejecutar la consulta:" . $e->getMessage();
            // O lanzar la excepción para que sea manejada en un nivel superior
            // throw new Exception("Error al ejecutar la consulta: " . $e->getMessage());
        }
    }
    // Función para seleccionar marcas
    static function selectMarcas($tabla) {
        $sql = "SELECT * FROM $tabla;";
        $res = Conexion::conectar()->query($sql);
        return $res;
    }


    // Función para seleccionar los distintos tipos de estados
    static function selectEstados($tabla) {
        $sql = "SELECT * FROM $tabla;";
        $res = Conexion::conectar()->query($sql);
        return $res;
    }


    // funcion para actualizar las laptop mediante el id
    static function updateLaptop($datos) {
        try {
            // Ajustar max_allowed_packet para esta conexión
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
           
        
            // Llamada al procedimiento almacenado
            $sql = "CALL inventarit_manager.editar_laptop(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = Conexion::conectar()->prepare($sql);
            

           
// Crear variables para almacenar los valores
$id_dispositivo = (int)$datos["id_dispositivo"];
$id_marca = (int)$datos["id_marca"];
$ram = (int)$datos["ram"];
$estado = (int)$datos["estado"];
$precio = (double)$datos["precio"];

// Enlazar parámetros
$stmt->bind_param(
    "issiisssissi",
    $id_dispositivo,
    $datos["modelo"],
    $datos["numero_serie"],
    $id_marca,
    $precio,
    $datos["fecha_compra"],
    $datos["nota"],
    $datos["foto"],
    $ram,
    $datos["procesador"],
    $datos["sistema_operativo"],
    $estado
);

    
            // Ejecutar la sentencia preparada
            $stmt->execute();
            $stmt->close();
    
            // Mensaje de éxito
            echo "Procedimiento almacenado ejecutado con éxito.";
    
        } catch (Exception $e) {
            // Manejar errores generales
            echo '<pre>';
            var_dump($id_dispositivo);
            echo '</pre><br>';
            
            echo '<pre>';
            var_dump($datos["modelo"]);
            echo '</pre><br>';
            
            echo '<pre>';
            var_dump($datos["numero_serie"]);
            echo '</pre><br>';
            
            echo '<pre>';
            var_dump($id_marca);
            echo '</pre><br>';
            
            echo '<pre>';
            var_dump($precio);
            echo '</pre><br>';
            
            echo '<pre>';
            var_dump($datos["fecha_compra"]);
            echo '</pre><br>';
            
            echo '<pre>';
            var_dump($datos["nota"]);
            echo '</pre><br>';
            
            echo '<pre>';
            var_dump($datos["foto"]);
            echo '</pre><br>';
            
            echo '<pre>';
            var_dump($ram);
            echo '</pre><br>';
            
            echo '<pre>';
            var_dump($datos["procesador"]);
            echo '</pre><br>';
            
            echo '<pre>';
            var_dump($datos["sistema_operativo"]);
            echo '</pre><br>';
            
            echo '<pre>';
            var_dump($estado);
            echo '</pre><br>';
            
            
            echo "Error al intentar insertar los datos en el procedimiento almacenado: " . $e->getMessage();
            error_log("Error en updateLaptop: " . $e->getMessage());
        }


        
        

    }
    
    
    
}
?>
