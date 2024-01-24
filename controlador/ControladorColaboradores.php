<?php
    include_once "modelo/ModeloColaboradores.php";
    class ControladorColaboradores{
        public static function consultarColaboradores(){
            $tabla = 'v_colaboradores';
            $obj = ModeloColaboradores::selectColaboradores($tabla);
            $arregloColaboradores = $obj->fetch_all();
            return $arregloColaboradores;
        }
        
        static function borrarColaboradores(){
            if(isset($_GET["accion"])&& $_GET["accion"] == "eliminarColaborador"){
                $id = $_GET["id_colaborador"];
                $tabla = 'colaboradores';
                $delete = ModeloColaboradores::deleteColavorador($tabla,$id);
                if($delete>0){
                    echo '
                        <script>
                            alert("Colaborador eliminado correctamente");
                            window.location.href="index.php?seccion=dispositivos";
                        </script>
                    ';
                }
            }
        }
    }
?>