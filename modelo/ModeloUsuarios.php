<?php
    class ModeloUsuarios{
            static function login($email,$password){
                $sql = "SELECT * FROM usuarios_inventarit WHERE correo_usuario = '$email' AND password = '$password';";
                $res = Conexion::conectar()->query($sql);
                return $res;
                $res->close();
            }
            
    }
    
?>