<?php 
    include_once "./modelo/ModeloAsignaciones.php";

    class ControladorAsignaciones{

        public static function consultarAsignaciones(){
            $tabla = 'v_asignaciones';
            $obj = ModeloAsignaciones::selectAsignaciones($tabla);
            $arregloAsignaciones = $obj->fetch_all();
            return $arregloAsignaciones;
        }

        public static function borrarAsignacion(){
            if(isset($_GET["accion"])&& $_GET["accion"] == "eliminar"){
                $id = $_GET["id_asignacion"];

                /*$delete = ModeloAsignaciones::deleteAsignacion($id);
                if($delete>0){
                    echo'
                        <script>
                            alert("Asignacion con Id: '.$id.' eliminada con exito");
                            window.location.href="index.php?seccion=asignaciones/asignaciones";
                        </script>
                    ';
                }*/
            }
        }

    }
?>