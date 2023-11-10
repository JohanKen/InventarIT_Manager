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
                            alert("Producto eliminado correctamente");
                            window.location.href="index.php?seccion=dispositivos";
                        </script>
                    ';
                }
            }
        }
        static function detalleDispositivo(){
            if(isset($_GET["id_dispositivo"])){
                $tabla = "dispositivos";
                $id = $_GET["id_dispositivo"];

                $obj = ModeloDispositivos::selectDispositivosId($tabla, $id);
                $dispositivo = $obj->fetch_all();
                return $dispositivo;
            }
        }
        //Función para editar dispositivos despues de click en guardar
        static function editarDispositivo(){
            if(isset($_POST["guardar"])){
                // Validar y procesar la subida del archivo
                $target_file = ManejadorArchivos::procesarSubidaArchivo($_FILES["foto"]);
        
                if($target_file){
                    // Almacenamos la información en el modelo para que la guarde en la base de datos
                    $datos = array(
                        "id" => $_POST["id"],
                        "nombre" => $_POST["nombre"],
                        "precio" => $_POST["precio"],
                        "talla" => $_POST["talla"],
                        "idProveedor" => $_POST["idProveedor"],
                        "url_foto" => $target_file,
                        "categoria" => $_POST["categoria"]
                    );
        
                    $tabla = 'productos';
                    $insert = ModeloProductos::updateProductos($tabla, $datos);
        
                    if($insert > 0){
                        echo '
                            <script>
                                alert("Producto editado correctamente");
                                window.location.href="index.php?seccion=listaProductos";
                            </script>
                        ';
                    } else {
                        echo 'Error al actualizar el producto en la base de datos.';
                    }
                } else {
                    echo 'Error al procesar la subida del archivo.';
                }
            }
        }
        

    }


        


        ?>