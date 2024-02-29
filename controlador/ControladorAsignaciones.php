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

        static function registrarAsignacion($dispositivo){
            if(isset($_POST['aceptar'])){       
                try{
                    $sqlSetMaxAllowedPacket = "SET GLOBAL max_allowed_packet=64*1024*1024";
                    Conexion::conectar()->query($sqlSetMaxAllowedPacket);
    
                    $datos = array(
                        "id_dispositivo"=>$dispositivo,
                        "id_colaborador"=>(int)$_POST["id_colaborador"],
                    );
                    $inset = ModeloAsignaciones::createAsignacion($datos);
                }catch(Exeption $e){
                    echo 'Message: '.$e ->getMessage();
                }
            }
        }
        

    }
?>