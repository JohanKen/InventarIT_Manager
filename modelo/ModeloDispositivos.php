<?php
include_once 'conexion.php';

class ModeloDispositivos extends Conexion {
    
    // Función para ver toda la VISTA de dispositivos
    static function selectDispositivos($tabla) {
        $sql = "SELECT * FROM inventarit_manager.$tabla;";
        $res = Conexion::conectar()->query($sql);
        return $res;
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

    //Funcion para agregar un nuevo desktop
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



    // Función para eliminar un dispositivo
    static function deleteDispositivos($id) {
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

    // Método para obtener el ID de una marca basándose en su nombre
    public static function obtenerIdMarca($nuevaMarca) {
        try {
            // Preparar la consulta SQL
            $sql = "SELECT id_marca FROM marcas WHERE marca = ?";
            $stmt = Conexion::conectar()->prepare($sql);
    
            // Ejecutar la consulta con el valor pasado como parámetro
            $stmt->execute([$nuevaMarca]);
    
            // Obtener el resultado
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Verificar si se encontraron resultados
            if ($resultado !== false) {
                // Retornar el ID de la marca
                return $resultado['id_marca'];
            } else {
                // Retornar false si la marca no se encontró
                return false;
            }
        } catch (PDOException $e) {
            // Manejar el error en caso de excepción
            echo "Error al obtener el ID de la marca: " . $e->getMessage();
            return false;
        }
    }
    
    

    // Función para seleccionar marcas
    static function selectMarcas($tabla) {
        $sql = "SELECT * FROM $tabla order by id_marca asc;";
        $res = Conexion::conectar()->query($sql);
        return $res;
    }
    //insertar nueva marca...
    public static function insertarNuevaMarca($nuevaMarca) {
        try {
            $query = "INSERT INTO marcas (marca) VALUES (?)";
            $stmt = Conexion::conectar()->prepare($query);
            $stmt->bindParam(1, $nuevaMarca, PDO::PARAM_STR);
            $stmt->execute();
            return Conexion::conectar()->lastInsertId();
        } catch (PDOException $e) {
            // Manejar el error de inserción aquí, si es necesario
            echo "<script>alert('Error al insertar nueva marca: ".$e->getMessage()."');</script>";
            return false; // Retornar false en caso de error
        }
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
        $statement->execute();
        $statement->close();
       

    } catch (Exception $e) {
        // Manejar errores generales
        echo "Error al intentar insertar los datos en el procedimiento almacenado: " . $e->getMessage();
        error_log("Error en updateLaptop: " . $e->getMessage());
    }
}

   
}
?>
