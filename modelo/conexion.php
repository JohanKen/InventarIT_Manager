<?php
class Conexion {
    //metodo para conectar a base de datos mediante variables relacionadas a la misma.
    public static function conectar() {
        $servername = "192.168.1.96";
        $username = "Johan";
        $password = "RTStrc2023";
        $database = "inventarit_manager";
//verificar la correcta conexion entre las mismas
        $con = new mysqli($servername, $username, $password, $database);
        if ($con->connect_error) {
            echo 'error de conexion';
            die("Error de conexión: " . $con->connect_error);
        }
        return $con;
    }
}

