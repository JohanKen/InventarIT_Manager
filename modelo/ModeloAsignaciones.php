<?php
    include_once 'conexion.php';

    class ModeloAsignaciones extends Conexion{

        static function selectAsignaciones($tabla){
            $sql = "SELECT * FROM inventarit_manager.$tabla;";
            $res = Conexion::conectar()->query($sql);
            return $res;
        }

        static function deleteAsignacion($id){
            $id_asignacion = (int)$id;
            $sql = "CALL inventarit_manager.eliminar_asignacion('$id')";
            $res = Conexion::conectar()->query($sql);
            return $res;
        }

        static function selectDispositivoTipo($tipoSeleccionado){
            try{
                $conexion = Conexion::conectar();

                $stmt = $conexion->prepare("CALL inventarit_manager.dispositivo_por_tipo(?)");
                $stmt -> bind_param('i',$tipoSeleccionado);
                $stmt -> execute();

                $result = $stmt->get_result();
                return $result ->fetch_all(MYSQLI_ASSOC);

            }catch (mysqli_sql_exception $e){
                echo "Error al ehecutar la consulta: ".$e->getMessage();
            }
        }

        static function selectAsignacionesPorCliente($clienteSeleccionado){
            try{
                $conexion = Conexion::conectar();

                $stmt = $conexion->prepare("CALL inventarit_manager.asignaciones_por_cliente(?)");
                $stmt -> bind_param('i',$clienteSeleccionado);
                $stmt -> execute();

                $result = $stmt->get_result();
                return $result ->fetch_all(MYSQLI_ASSOC);

            }catch (mysqli_sql_exception $e){
                echo "Error al ehecutar la consulta: ".$e->getMessage();
            }
        }

        static function createAsignacion($datos){
            $conexion = Conexion::conectar();
            try{
                $id_dispositivo = (int) $datos["id_dispositivo"];
                $id_colaborador = (int) $datos["id_colaborador"];
        
                $statement = $conexion->prepare("CALL crear_asignacion(?,?)");
                $statement->bind_param("ii",
                    $id_dispositivo,
                    $id_colaborador
                );
        
                $statement->execute();
                $statement->close();
        
            }catch (Exception $e){
                echo 'Message: '.$e ->getMessage();
            }
        }

    }
?>