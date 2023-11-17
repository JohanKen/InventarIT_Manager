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

    // Función para editar Dispositivo
    static function editarDispositivos() {
        if (isset($_POST["guardar"])) {
            // ... (otros códigos)
            $uploadedOK = 0; // Inicializar la variable

            // Obtener el ID de la marca por su nombre
            $idMarca = isset($_POST["marca"]) ? self::obtenerIdMarcaPorNombre($_POST["marca"]) : null;
            // Almacenamos la información al modelo para que la guarde en la base de datos
            if ($uploadedOK == 1 && $idMarca !== null) {
                $datos = array(
                    "id_dispositivo" => $_POST["id_dispositivo"],
                    "tipo" => $_POST["tipo"],
                    "modelo" => $_POST["modelo"],
                    "numero_serie" => $_POST["numero_serie"],
                    "ram" => $_POST["ram"],
                    "procesador" => $_POST["procesador"],
                    "sistema_operativo" => $_POST["sistema_operativo"],
                    "id_marca" => $idMarca, // Cambio aquí
                    "precio" => $_POST["precio"],
                    "estado" => $_POST["estado"],
                    "fecha_compra" => $_POST["fecha_compra"],
                    "nota" => $_POST["nota"],
                    "url_foto" => $target_file,
                );

                $tabla = 'editar_laptop';
                $insert = ModeloDispositivos::updateDispositivos($tabla, $datos);

                if ($insert > 0) {
                    echo '
                        <script>
                            alert("Dispositivo actualizado correctamente");
                            window.location.href="index.php?seccion=dispositivos";
                        </script>
                    ';
                }
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
        //Funcion para consultar los tipos de dispositivos
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