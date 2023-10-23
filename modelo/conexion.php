<?php
class Conexion {

    public static function conectar() {
        $servername = "127.0.0.1:3306";
        $username = "root";
        $password = "";
        $database = "inventarit";

        $con = new mysqli($servername, $username, $password, $database);
        if ($con->connect_error) {
            die("Error de conexión: " . $con->connect_error);
        }
        return $con;
    }
}

