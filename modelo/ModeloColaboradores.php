<?php
    include_once 'conexion.php';

    class ModeloColaboradores extends Conexion{

        static function selectColaboradores($tabla){
            $sql = "SELECT * FROM inventarit_manager.$tabla;";
            $res = Conexion::conectar()->query($sql);
            return $res;
        }

        static function deleteColaborador($id){
            $id_colaborador = (int)$id;
            $sql = "CALL inventarit_manager.eliminar_colaborador('$id');";
            $res = Conexion::conectar()->query($sql);
            return $res;
        }

        static function selectColaborador($id){
            try{
                $conexion = Conexion::conectar();

                $stmt = $conexion->prepare("CALL inventarit_manager.datos_colaborador(?)");
                $stmt->bind_param('i', $id);
                $stmt->execute();

                $result = $stmt->get_result();

                if($result !== false){
                    return $result->fetch_all(MYSQLI_ASSOC);
                }else{
                    echo "Error: No se pudo obtener el resultado de la consulta.";
                    return null;
                }
            }catch (mysqli_sql_exception $e){
                echo "Error al ejecutar la consulta:" . $e->getMessage();
            }
        }

        static function selectClientes($tabla){
            $sql = "SELECT * FROM $tabla;";
            $res = Conexion::conectar()->query($sql);
            return $res;
        }

        static function selectEstados($tabla){
            $sql = "SELECT * FROM $tabla;";
            $res = Conexion::conectar()->query($sql);
            return $res;
        }
        
        static function updateColaborador($datos){
            $conexion = Conexion::conectar();
            try{
                $id_colaborador = (int) $datos["id_colaborador"];
                $id_cliente = (int) $datos["id_empresa"];
                $estado = (int) $datos["estado"];

                $statement = $conexion->prepare("CALL editar_colaborador(?,?,?,?,?,?,?)");
                $statement->bind_param("issisis",
                    $id_colaborador,
                    $datos["nombre_colaborador"],
                    $datos["apellido_paterno_colaborador"],
                    $id_cliente,
                    $datos["departamento"],
                    $estado,
                    $datos["fecha_ingreso_colaborador"]
                );

                $statement->execute();
                $statement->close();
                

            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            }
        }

        static function createColaborador($datos){
            $conexion = Conexion::conectar();
            try{

                $id_cliente = (int) $datos["id_empresa"];

                $statement = $conexion->prepare("CALL insertar_colaborador(?,?,?,?,?)");
                $statement->bind_param("ssiss",
                    $datos["nombre_colaborador"],
                    $datos["apellido_paterno_colaborador"],
                    $id_cliente,
                    $datos["departamento"],
                    $datos["fecha_ingreso_colaborador"]
                );

                $statement->execute();
                
                if ($statement->error) {
                    echo 'Error al insertar el colaborador: ' . $statement->error;
                    exit;
                }

                $statement->close();

            }catch(Exception $e){
                echo 'Message: ' .$e->getMessage();
            }
        }
    }

?>