<?php
$search = $_POST['search'];

$servername = "192.168.100.84";
$username = "Johan";
$password = "RTStrc2023";
$database = "inventarit_manager";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error){
    die("Connection failed: ". $conn->connect_error);
}

// Escapar caracteres especiales de la variable de búsqueda para prevenir inyección SQL
$search = $conn->real_escape_string($search);

// Consulta SQL dinámica para buscar en todas las columnas
$sql = "SELECT * FROM dispositivos WHERE ";
$sql .= "CONCAT_WS('', modelo, numero_serie, precio, fecha_compra, nota) LIKE '%$search%'";

// Ejecutar consulta
$result = $conn->query($sql);

// Comprobar si se encontraron resultados
if ($result->num_rows > 0){
    // Mostrar los resultados
    while ($row = $result->fetch_assoc()){
        echo $row["modelo"]."  ".$row["numero_serie"]."  ".$row["precio"]." ".$row["fecha_compra"]." ".$row["nota"]."<br>";
    }

    //ya se muestran los resultados, hay que manejar la logica para que se muestre
} else {
    echo "0 records";
}

// Cerrar conexión
$conn->close();
?>
