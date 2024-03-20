<?php
    include_once "./modelo/ModeloColaboradores.php";
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

                $delete = ModeloColaboradores::deleteColaborador($id);
          
            }
        }

        static function detalleColaborador(){
            if(isset($_GET["id_colaborador"])){
                $id = $_GET["id_colaborador"];

                $obj = ModeloColaboradores::selectColaborador($id);

                if($obj instanceof mysqli_result){
                    $colaborador = $obj->fetch_all(MYSQL_ASSOC);
                }else{
                    $colaborador = $obj;
                }
                return $colaborador;
            }
        }

        static function getClientes(){
            $tabla = "empresas";
            $respesta = ModeloColaboradores::selectClientes($tabla);
            $arreglo = $respesta->fetch_all();
            return $arreglo;
        }

        static function getEstados(){
            $tabla = "estados_colaboradores";
            $respesta = ModeloColaboradores::selectClientes($tabla);
            $arreglo = $respesta->fetch_all();
            return $arreglo;
        }

        static function editarColaborador(){
            if(isset($_POST["guardarColaborador"])){
                try{
                    $sqlSetMaxAllowedPacket = "SET GLOBAL max_allowed_packet=64*1024*1024";
                    Conexion::conectar()->query($sqlSetMaxAllowedPacket);

                    $fechaIngreso = $_POST["fecha_ingreso_colaborador"];
                    if (DateTime::createFromFormat('Y-m-d',$fechaIngreso) !==false){
                        $fechaIngresoFormateada = $fechaIngreso;
                    }else{
                        echo 'Error en el formato de la fecha';
                        exit;
                    }

                    $datos = array(
                        "id_colaborador" => (int)$_POST["id_colaborador"],
                        "nombre_colaborador"=> $_POST["nombre_colaborador"],
                        "apellido_paterno_colaborador"=> $_POST["apellido_paterno_colaborador"],
                        "id_empresa"=> (int)$_POST["empresa"],
                        "departamento"=> $_POST["departamento"],
                        "estado" => (int)$_POST["estado"],
                        "fecha_ingreso_colaborador"=> $fechaIngresoFormateada,
                    );

                    $insert = ModeloColaboradores::updateColaborador($datos);
                    
                

                }catch (mysqli_sql_exception $e){
                    echo 'Message: ' .$e->getMessage();
                }
            }
        }

        static function registrarColaborador(){
            if(isset($_POST["Registrar"])){
                try{

                    $sqlSetMaxAllowedPacket = "SET GLOBAL max_allowed_packet=64*1024*1024";
                    Conexion::conectar()->query($sqlSetMaxAllowedPacket);

                    $fechaIngreso = $_POST["fecha_ingreso_colaborador"];
                    if (DateTime::createFromFormat('Y-m-d',$fechaIngreso) !==false){
                        $fechaIngresoFormateada = $fechaIngreso;
                    }else{
                        echo "
                        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                        <script>
                            Swal.fire({
                                title: 'Fecha incorrecta',
                                text: 'Ingrese el formato de fecha correcto',
                                icon: 'warning', 
                            }).then(function(result) {
                                if (result.isConfirmed) { 
                                    window.location.href='index.php?seccion=nuevoColaborador';
                                }
                            });
                        </script>
                        
                        ";
                        exit;
                    }

                    $datos = array(
                        "nombre_colaborador"=> $_POST["nombre_colaborador"],
                        "apellido_paterno_colaborador"=> $_POST["apellido_paterno_colaborador"],
                        "id_empresa"=> (int)$_POST["empresa"],
                        "departamento"=> $_POST["departamento"],
                        "fecha_ingreso_colaborador"=> $fechaIngresoFormateada,
                    );

                    $insert = ModeloColaboradores::createColaborador($datos);

                }catch  (Exception $e){
                    echo 'Error: ' . $e->getMessage();
                }
            }
        }
    }
?>