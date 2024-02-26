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
            if(isset($_GET["accion"]) && $_GET["accion"] == "eliminar"){
                $id = $_GET["id_asignacion"];
                $cliente = isset($_GET["cliente"]) ? $_GET["cliente"] : '';
        
                $delete = ModeloAsignaciones::deleteAsignacion($id);
        
                if($delete > 0){
                    echo '
                        <script>
                            alert("Asignación con Id: ' . $id . ' eliminada con éxito");
                            window.location.href = "index.php?seccion=asignaciones/asignaciones&cliente=" . encodeURIComponent("' . $cliente . '");
                        </script>
                    ';
                }
            }
        }
        

    }
?>