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
        
                $delete = ModeloAsignaciones::deleteAsignacion($id);
        
                $ejecutado = false;
        
                if ($delete > 0 && !$ejecutado) {
                    $ejecutado = true; // Marcar como ejecutado para evitar el bucle
                    return true;
                }
            }
            return false;
        }

        static function registrarAsignacion($dispositivo,$colaborador){
            if(isset($_POST['aceptar'])){       
                try{
                    $sqlSetMaxAllowedPacket = "SET GLOBAL max_allowed_packet=64*1024*1024";
                    Conexion::conectar()->query($sqlSetMaxAllowedPacket);
    
                    $datos = array(
                        "id_dispositivo"=>$dispositivo,
                        "id_colaborador"=>$colaborador
                    );
                    $inset = ModeloAsignaciones::createAsignacion($datos);
                }catch(Exeption $e){
                    echo 'Message: '.$e ->getMessage();
                }
            }
        }
        

    }
?>