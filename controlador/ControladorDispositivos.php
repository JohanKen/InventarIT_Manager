<?php

    class ControladorDispositivos{
        
        //Funcion para consultar el listado de productos en venta.
        static function consultaDispositivos(){
            $tabla = 'v_inv_dispositivos';
            $obj = ModeloDispositivos::selectDispositivos($tabla);
            $arregloDispositivos = $obj->fetch_all();
            return $arregloDispositivos;
        }
        //funcion para eliminar dispositivos
        static function borrarDispositivos(){
            if(isset($_GET["accion"]) && $_GET["accion"] == "eliminarDispositivos"){
                $id = $_GET["id_dispositivo"];
                $tabla = 'dispositivos';
                $delete = ModeloDispositivos::deleteDispositivos($tabla, $id);
                if($delete>0){
                    echo '
                        <script>
                            alert("Dispositivo eliminado correctamente");
                            window.location.href="index.php?seccion=dispositivos";
                        </script>
                    ';
                }
            }
        }

       

        static function detalleDispositivo(){
            if(isset($_GET["id_dispositivo"])){
                $tabla = "v_inv_dispositivos";
                $id = $_GET["id_dispositivo"];

                $obj = ModeloDispositivos::selectDispositivosId($tabla, $id);
                $dispositivo = $obj->fetch_all();
                return $dispositivo;
            }
        }
        static function detalleDispositivoPLI(){
            if(isset($_GET["id_dispositivo"])){
                $id = $_GET["id_dispositivo"];
                
                $obj = ModeloDispositivos::selectDispositivosPLI($id);
        
                // Verificar si $obj es un objeto mysqli_result
                if ($obj instanceof mysqli_result) {
                    // Si es un objeto mysqli_result, aplicar fetch_all()
                    $dispositivo = $obj->fetch_all(MYSQLI_ASSOC);
                } else {
                    // Si no es un objeto mysqli_result, asumir que ya es un array
                    $dispositivo = $obj;
                }
                
                return $dispositivo;
                
            }
        }
        

        static function detalleLaptop(){
            if(isset($_GET["id_dispositivo"])){
                $tabla = "v_inv_laptops";
                $id = $_GET["id_dispositivo"];
                
                $obj = ModeloDispositivos::selectDispositivosId($tabla, $id);
                $dispositivoInfo = $obj->fetch_all();
                return $dispositivoInfo;
            }
        }

        
         // Función para obtener el ID de la marca por su nombre
   /*    
    static function obtenerIdMarcaPorNombre($nombreMarca) {
        $tabla = 'marcas';
        $marcas = ModeloDispositivos::selectMarcas('marcas')->fetch_all(MYSQLI_ASSOC);

        foreach ($marcas as $marca) {
            if ($marca['marca'] === $nombreMarca) {
                return $marca['id_marca'];
            }
        }
        return null; // o manejar el caso de marca no encontrada
    }
*/

// Función para editar Dispositivo
static function editarDispositivos()
{
    if (isset($_POST["guardar"])) {

        // ... (otros códigos)
        $uploadedOK = 1; // Inicializar la variable


         // Obtener el ID de la marca por su nombre
         function obtenerIdMarcaPorNombre($nombreMarca)
         {
             $tabla = 'marcas';
             $marcas = ModeloDispositivos::selectMarcas($tabla)->fetch_all(MYSQLI_ASSOC);
 
             foreach ($marcas as $marca) {
                 if ($marca['marca'] === $nombreMarca) {
                     return $marca['id_marca'];
                 }
             }
             return null; // o manejar el caso de marca no encontrada
         }

        // Almacenamos la información al modelo para que la guarde en la base de datos
        if ($uploadedOK == 1) {
            try {
                // Ajustar max_allowed_packet para esta conexión
                $sqlSetMaxAllowedPacket = "SET GLOBAL max_allowed_packet=64*1024*1024";
                Conexion::conectar()->query($sqlSetMaxAllowedPacket);

                // Obtener el ID de la marca por su nombre (descomentar y adaptar según necesidades)
                $idMarca = isset($_POST["marca"]) ? obtenerIdMarcaPorNombre($_POST["marca"]) : null;

                $fechaCompra = $_POST["fecha_compra"];
                $fechaCompraFormateada = DateTime::createFromFormat('d-m-Y', $fechaCompra);

                // Verificar si la conversión fue exitosa
                if ($fechaCompraFormateada instanceof DateTime) {
                    // Obtener la fecha formateada en el formato requerido
                    $fechaCompraFormateada = $fechaCompraFormateada->format('Y-m-d');
                } else {
                    // Manejar el caso en que la conversión falla
                    echo 'Error al convertir la fecha';
                    // Puedes agregar una redirección o manejo de errores adicional según tus necesidades
                    exit;
                }

                $datos = array(
                    "id_dispositivo" => $_POST["id_dispositivo"],
                    "modelo" => $_POST["modelo"],
                    "numero_serie" => $_POST["numero_serie"],
                    "ram" => $_POST["ram"],
                    "procesador" => $_POST["procesador"],
                    "sistema_operativo" => $_POST["sistema_operativo"],
                    "id_marca" => $idMarca,
                    "precio" => $_POST["precio"],
                    "estado" => $_POST["estado"],
                    "fecha_compra" => $fechaCompraFormateada,
                    "nota" => $_POST["nota"],
                    "foto" => "foto",
                );

                $insert = ModeloDispositivos::updateLaptop($datos);

                if ($insert > 0) {
                    echo '
                        <script>
                            alert("Dispositivo actualizado correctamente");
                            window.location.href="index.php?seccion=dispositivos";
                        </script>
                    ';
                }
            } catch (mysqli_sql_exception $e) {
                // ... (manejo de errores)
            }
        } else {
            echo 'Por favor, introduce una imagen';
        }
    }
}

    

           //Funcion para consultar los tipos de dispositivos
           static function getTiposDispositivos(){
            $tabla = "tipos_dispositivos";
            $respuesta = ModeloDispositivos::selectTiposDispositivos($tabla);
            $arreglo = $respuesta->fetch_all();
            return $arreglo;
        }
        //Funcion para consultar la marca de los dispositivos
        static function getMarcas(){
            $tabla = "marcas";
            $respuesta = ModeloDispositivos::selectMarcas($tabla);
            $arreglo = $respuesta->fetch_all();
            return $arreglo;
        }
        //funcion para consultar los tipos de estados
        static function getEstados(){
            $tabla = "estados_dispositivos";
            $respuesta = ModeloDispositivos::selectEstados($tabla);
            $arreglo = $respuesta->fetch_all();
            return $arreglo;
    }
    // funcion para obtener el tipo de dispositivo actual
    public static function getTipoDispositivoActual($id_dispositivo) {
        $tabla = "v_inv_dispositivos";
        $obj = ModeloDispositivos::selectDispositivosId($tabla, $id_dispositivo);
        $dispositivo = $obj->fetch_all();

        return array($dispositivo[0][0], $dispositivo[0][1]); // Ajusta esto según la estructura de tu tabla.
    }

        

    }


        


        ?>