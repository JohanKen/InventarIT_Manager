<?php
    include_once "./modelo/ModeloDispositivos.php";
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
        

       
       
        //funcion para consultar los detalles de dispositivos de manera general sin especificar
        //que sea de algun tipo en especifico
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

        static function editarDispositivos()
    {
    if (isset($_POST["guardar"])) {
   

        // Almacenamos la información al modelo para que la guarde en la base de datos
      
            try {
                // Ajustar max_allowed_packet para esta conexión
                $sqlSetMaxAllowedPacket = "SET GLOBAL max_allowed_packet=64*1024*1024";
                Conexion::conectar()->query($sqlSetMaxAllowedPacket);

                // Validar el formato de la fecha
                $fechaCompra = $_POST["fecha_compra"];
                if (DateTime::createFromFormat('Y-m-d', $fechaCompra) !== false) {
                    $fechaCompraFormateada = $fechaCompra;
                } else { 
                    // Manejar el caso en que la fecha no tiene el formato correcto
                    echo 'Error en el formato de la fecha';
                    exit;
                }
                
                // Obtén el valor directo del campo de precio 
                

                $datos = array(
                    "id_dispositivo" => (int)$_POST["id_dispositivo"],
                    "modelo" => $_POST["modelo"],
                    "numero_serie" => $_POST["numero_serie"],
                    "ram" => (int)$_POST["ram"],
                    "procesador" => $_POST["procesador"],
                    "sistema_operativo" => $_POST["sistema_operativo"],
                    "id_marca" => (int)$_POST["marca"],
                    "precio" => isset($_POST['precio']) ? floatval(str_replace(',', '', $_POST['precio'])) : 0,  // Se usa el precio procesado como double
                    "estado" => (int)$_POST["estado"],
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
                } else {
                    echo 'Error al intentar actualizar el dispositivo.';
                }
            } catch (mysqli_sql_exception $e) {
                // Manejar excepciones de MySQL
                echo 'Error en la conexión a la base de datos.';
            }
        } else {
            echo 'Por favor, introduce una imagen';
        }

        echo "ARRAY EN EL CONTROLADOR (datos)...";
        var_dump ($datos); 
    
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