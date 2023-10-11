<?php
class Conexion {
  //variables con valores clave de la conexion a base de datos
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

// estableciendo la conexion
$conexion = Conexion::conectar();
//query solo para consultar una tabla
$query = "SELECT * FROM usuarios_inventarit";
$resultado = mysqli_query($conexion, $query);

if ($resultado) {
    // Procesa los datos (por ejemplo, mostrando los resultados en una tabla)
} else {
    echo "Error en la consulta: " . mysqli_error($conexion);
}

// Cierra la conexión después de usarla
$conexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados</title>
</head>
<body>
    <h1>Resultados de la consulta</h1>
    
    <?php
    if ($resultado) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Correo</th></tr>";
        
        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td>" . $fila['id_usuario'] . "</td>";
            echo "<td>" . $fila['nombre_usuario'] . "</td>";
            echo "<td>" . $fila['correo_usuario'] . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    }
    ?>
</body>
</html>
