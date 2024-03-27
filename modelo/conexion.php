<?php class Conexion {
    // Propiedades estáticas
    public static $servername = "192.168.100.33";
    public static $username = "Johan";
    public static $password = "RTStrc2023";
    public static $database = "inventarit_manager";
    
    // Método para conectar a la base de datos
    public static function conectar() {
        // Verificar la correcta conexión entre las mismas
        $con = new mysqli(self::$servername, self::$username, self::$password, self::$database);
        
        if ($con->connect_error) {
            echo 'error de conexion';
            die("Error de conexión: " . $con->connect_error);
        }
        return $con;
    }
  
}
?>