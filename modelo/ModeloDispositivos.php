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
    static function selectDispositivosGen($id) {
        try {
            $conexion = Conexion::conectar();
            
            // Usar un prepared statement con un marcador de posición ?
            $stmt = $conexion->prepare("CALL inventarit_manager.datos_dispositivo(?)");
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

    static function selectDispositivoIMac($id) {
        try {
            $conexion = Conexion::conectar();
            
            // Usar un prepared statement con un marcador de posición ?
            $stmt = $conexion->prepare("CALL inventarit_manager.datos_imac(?)");
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
        $sql = "SELECT * FROM $tabla order by id_marca;";
        $res = Conexion::conectar()->query($sql);
        return $res;
    }


    // Función para seleccionar los distintos tipos de estados
    static function selectEstados($tabla) {
        $sql = "SELECT * FROM $tabla;";
        $res = Conexion::conectar()->query($sql);
        return $res;
    }


    //funcion para insertar a base de datos directamente desde el modelo con datos precargados sin usar el formulario
    //esta funcion solo es de prueba debido a que la sentencia esta fallando desde el controlador (tipos de datos no coinciden y no hace nada la funcion en el modelo)
// Función para actualizar las laptop mediante el id
static function updateLaptop($datos) {
    $conexion = Conexion::conectar();// Accede a la variable de conexión global
    try {
        // Crear variables para almacenar los valores
        $id_dispositivo = (int) $datos["id_dispositivo"];
        $id_marca = (int) $datos["id_marca"];
        $ram = (int) $datos["ram"];
        $estado = (int) $datos["estado"];
        $precio = (double) $datos["precio"];

        //nuevo statement para verificar que el problema no sea como es que se esta pidiendo el procedmienietno almacenado desde el codigo.
        $statement = $conexion->prepare("CALL editar_laptop(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $statement->bind_param("issiisssissi",
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

        // Muestra el array antes de ejecutar la sentencia preparada
      

        $statement->execute();
        $statement->close();
       
        

    } catch (Exception $e) {
        echo 'Message: ' .$e->getMessage();
    }
}

static function updateDispositivo($datos) {
    $conexion = Conexion::conectar();// Accede a la variable de conexión global
    try {
        // Crear variables para almacenar los valores
        $id_dispositivo = (int) $datos["id_dispositivo"];
        $id_marca = (int) $datos["id_marca"];
        $estado = (int) $datos["estado"];
        $precio = (double) $datos["precio"];

        //nuevo statement para verificar que el problema no sea como es que se esta pidiendo el procedmienietno almacenado desde el codigo.
        $statement = $conexion->prepare("CALL editar_dispositivo(?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $statement->bind_param("issiisssi",
            $id_dispositivo,
            $datos["modelo"],
            $datos["numero_serie"],
            $id_marca,
            $precio,
            $datos["fecha_compra"],
            $datos["nota"],
            $datos["foto"],
            $estado
        );

        // Muestra el array antes de ejecutar la sentencia preparada
      

        $statement->execute();
        $statement->close();
       
        
        
        //echo "ARRAY EN EL MODELO(datos)...($datos)";
        //var_dump($datos);

        // Mensaje de éxito
        

    } catch (Exception $e) {
        // Manejar errores generales
        echo 'Message: ' .$e->getMessage();
    }
}
    
static function updateIMac($datos) {
    $conexion = Conexion::conectar();// Accede a la variable de conexión global
    try {
        // Crear variables para almacenar los valores
        $id_dispositivo = (int) $datos["id_dispositivo"];
        $id_marca = (int) $datos["id_marca"];
        $ram = (int) $datos["ram"];
        $estado = (int) $datos["estado"];
        $precio = (double) $datos["precio"];

        //nuevo statement para verificar que el problema no sea como es que se esta pidiendo el procedmienietno almacenado desde el codigo.
        $statement = $conexion->prepare("CALL editar_imac(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $statement->bind_param("issiisssississss",
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
            $estado,
            $datos["Keyboard_model"],
            $datos["keyboard_ns"],
            $datos["mouse_model"],
            $datos["mouse_ns"]
        );

        // Muestra el array antes de ejecutar la sentencia preparada
      

        $statement->execute();
        $statement->close();
       
        
        
        //echo "ARRAY EN EL MODELO(datos)...($datos)";
        //var_dump($datos);

        // Mensaje de éxito
        

    } catch (Exception $e) {
        // Manejar errores generales
        echo 'Message: ' .$e->getMessage();
    }
}

static function createLaptop($datos){
    $conexion = Conexion::conectar();
    try{

        $id_marca = (int) $datos["id_marca"];
        $ram = (int) $datos["ram"];
        $precio = (double) $datos["precio"];

        $statement = $conexion->prepare("CALL insertar_laptop(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $statement->bind_param("ssiisssiss",
            $datos["modelo"],
            $datos["numero_serie"],
            $id_marca,
            $precio,
            $datos["fecha_compra"],
            $datos["nota"],
            $datos["foto"],
            $ram,
            $datos["procesador"],
            $datos["sistema_operativo"]
        );

        $statement->execute();
        $statement->close();

    }catch(Exception $e){
        echo 'Message: ' .$e->getMessage();
    }
}

static function createDesktop($datos){
    $conexion = Conexion::conectar();
    try{

        $id_marca = (int) $datos["id_marca"];
        $ram = (int) $datos["ram"];
        $precio = (double) $datos["precio"];

        $statement = $conexion->prepare("CALL insertar_desktop(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $statement->bind_param("ssiisssiss",
            $datos["modelo"],
            $datos["numero_serie"],
            $id_marca,
            $precio,
            $datos["fecha_compra"],
            $datos["nota"],
            $datos["foto"],
            $ram,
            $datos["procesador"],
            $datos["sistema_operativo"]
        );

        $statement->execute();
        $statement->close();

    }catch(Exception $e){
        echo 'Message: ' .$e->getMessage();
    }
}

static function createImac($datos){
    $conexion = Conexion::conectar();
    try{

        $ram = (int) $datos["ram"];
        $precio = (double) $datos["precio"];

        $statement = $conexion->prepare("CALL insertar_imac(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $statement->bind_param("ssisssissssss",
            $datos["modelo"],
            $datos["numero_serie"],
            $precio,
            $datos["fecha_compra"],
            $datos["nota"],
            $datos["foto"],
            $ram,
            $datos["procesador"],
            $datos["sistema_operativo"],
            $datos["Keyboard_model"],
            $datos["keyboard_ns"],
            $datos["mouse_model"],
            $datos["mouse_ns"]
        );

        $statement->execute();
        $statement->close();

    }catch(Exception $e){
        echo 'Message: ' .$e->getMessage();
    }
}

static function createTeclado($datos){
    $conexion = Conexion::conectar();
    try{

        $precio = (double) $datos["precio"];
        $id_marca = (int) $datos["id_marca"];

        $statement = $conexion->prepare("CALL insertar_teclado(?, ?, ?, ?, ?, ?, ?)");
        $statement ->bind_param("ssiisss",
            $datos["modelo"],
            $datos["numero_serie"],
            $id_marca,
            $precio,
            $datos["fecha_compra"],
            $datos["nota"],
            $datos["foto"],
        );

        $statement->execute();
        $statement->close();
        
   }catch(Exception $e){
        echo 'Message: ' .$e->getMessage();
   }
}

static function createMouse($datos){
    $conexion = Conexion::conectar();
    try{

        $precio = (double) $datos["precio"];
        $id_marca = (int) $datos["id_marca"];

        $statement = $conexion->prepare("CALL insertar_mouse(?, ?, ?, ?, ?, ?, ?)");
        $statement ->bind_param("ssiisss",
            $datos["modelo"],
            $datos["numero_serie"],
            $id_marca,
            $precio,
            $datos["fecha_compra"],
            $datos["nota"],
            $datos["foto"],
        );

        $statement->execute();
        $statement->close();
        
   }catch(Exception $e){
        echo 'Message: ' .$e->getMessage();
   }
}

static function createMonitor($datos){
    $conexion = Conexion::conectar();
    try{

        $precio = (double) $datos["precio"];
        $id_marca = (int) $datos["id_marca"];

        $statement = $conexion->prepare("CALL insertar_monitor(?, ?, ?, ?, ?, ?, ?)");
        $statement ->bind_param("ssiisss",
            $datos["modelo"],
            $datos["numero_serie"],
            $id_marca,
            $precio,
            $datos["fecha_compra"],
            $datos["nota"],
            $datos["foto"],
        );

        $statement->execute();
        $statement->close();
        
   }catch(Exception $e){
        echo 'Message: ' .$e->getMessage();
   }
}

static function createHeadset($datos){
    $conexion = Conexion::conectar();
    try{

        $precio = (double) $datos["precio"];
        $id_marca = (int) $datos["id_marca"];

        $statement = $conexion -> prepare("CALL insertar_headsets(?, ?, ?, ?, ?, ?, ?)");
        $statement ->bind_param("ssiisss",
            $datos["modelo"],
            $datos["numero_serie"],
            $id_marca,
            $precio,
            $datos["fecha_compra"],
            $datos["nota"],
            $datos["foto"],
        );

        $statement->execute();
        $statement->close();

    }catch(Expcetion $e){
        echo 'Message:' .$e->getMessage();
    }
}

static function createCelular($datos){
    $conexion = Conexion::conectar();
    try{

        $precio = (double) $datos["precio"];
        $id_marca = (int) $datos["id_marca"];

        $statement = $conexion -> prepare("CALL insertar_celular(?, ?, ?, ?, ?, ?, ?)");
        $statement ->bind_param("ssiisss",
            $datos["modelo"],
            $datos["numero_serie"],
            $id_marca,
            $precio,
            $datos["fecha_compra"],
            $datos["nota"],
            $datos["foto"],
        );

        $statement->execute();
        $statement ->close();

    }catch (Exception $e) {
        echo 'Message: ' .$e->getMessage();
    }
}

static function createSwitch($datos){
    $conexion = Conexion::conectar();
    try{

        $precio = (double) $datos["precio"];
        $id_marca = (int) $datos["id_marca"];

        $statement = $conexion -> prepare("CALL insertar_switch(?, ?, ?, ?, ?, ?, ?)");
        $statement ->bind_param("ssiisss",
            $datos["modelo"],
            $datos["numero_serie"],
            $id_marca,
            $precio,
            $datos["fecha_compra"],
            $datos["nota"],
            $datos["foto"],
        );

        $statement ->execute();
        $statement ->close();

    }catch (Exception $e){
        echo 'Message: '.$e ->getMessage();
    }
}

static function createImpresora($datos){
    $conexion = Conexion::conectar();
    try{

        $precio = (double) $datos["precio"];
        $id_marca = (int) $datos["id_marca"];

        $statement = $conexion -> prepare("CALL insertar_impresora(?, ?, ?, ?, ?, ?, ?)");
        $statement ->bind_param("ssiisss",
            $datos["modelo"],
            $datos["numero_serie"],
            $id_marca,
            $precio,
            $datos["fecha_compra"],
            $datos["nota"],
            $datos["foto"],
        );

        $statement ->execute();
        $statement ->close();

    }catch (Exception $e){
        echo 'Message: '.$e ->getMessage();
    }
}

static function createOtro($datos){
    $conexion = Conexion::conectar();
    try{

        $precio = (double) $datos["precio"];
        $id_marca = (int) $datos["id_marca"];

        $statement = $conexion -> prepare("CALL insertar_otro(?, ?, ?, ?, ?, ?, ?)");
        $statement ->bind_param("ssiisss",
            $datos["modelo"],
            $datos["numero_serie"],
            $id_marca,
            $precio,
            $datos["fecha_compra"],
            $datos["nota"],
            $datos["foto"]

        );

        $statement -> execute();
        $statement -> close();

    }catch (Exception $e){
        echo 'Message: '.$e ->getMessage();
    }
}

static function selectHerramienta($tabla){
    $sql = "SELECT * FROM inventarit_manager.$tabla order by id_herramienta desc;";
    $res = Conexion::conectar()->query($sql);
    return $res;
}

static function deleteHerramienta($id){
    $id_herramienta = (int)$id;
    $sql = "CALL inventarit_manager.eliminar_herramienta('$id');";
    $res = Conexion::conectar()->query($sql);
    return $res;
}

static function createHerramienta($datos){
    $conexion = Conexion::conectar();
    try{

        
        $numero_piezas = (int) $datos["numero_piezas"];

        $statement = $conexion -> prepare("CALL insertar_herramienta(?, ?, ?, ?, ?)");
        $statement ->bind_param("sisss",
            $datos["nombre_herramienta"],
            $numero_piezas,
            $datos["ubicacion"],
            $datos["fecha_compra"],
            $datos["descripcion"]

        );

        $statement -> execute();
        $statement -> close();

    }catch (Exception $e){
        echo 'Message: '.$e ->getMessage();
    }
}

}
?>
