<?php
    include_once 'conexion.php';

    class ModeloColaboradores extends Conexion{

        static function selectColaboradores($tabla){
            $sql = "SELECT * FROM inventarit_manager.$tabla;";
            $res = Conexion::conectar()->query($sql);
            return $res;
        }

        static function deleteColavorador($tabla, $id){
            $sql = "CALL inventarit_manager.eliminar_colaborador('id');";
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
        
    }

?>