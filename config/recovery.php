<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

include_once '../modelo/conexion.php';

$correo = $_POST['correo'];
$query = "SELECT nombre_usuario, id_usuario FROM usuarios WHERE correo_usuario = '$correo' AND id_estado_usuario = 1";
$con = Conexion::conectar();
$result = $con->query($query);
$row = $result->fetch_assoc();

if ($result->num_rows > 0) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP(); // Send using SMTP
        $mail->CharSet = 'UTF-8';
        $mail->Host = 'smtp.office365.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'johanestradacastillo1@outlook.com'; // SMTP username
        $mail->Password = 'Castillo4Estrada2$'; // SMTP password
        $mail->Port = 587; // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        // Recipients
        $mail->setFrom('johanestradacastillo1@outlook.com', 'InventarIT Manager');

        if (isset($row['nombre_usuario'])) {
            $mail->addAddress($correo, $row['nombre_usuario']); // Use the recipient's email and name

            // Content
            $mail->isHTML(true); // Establecer el formato del correo como HTML
            $mail->Subject = 'Recuperación de contraseña';
            
            // Construir el cuerpo del correo
            $body = '
    <div style="background: linear-gradient(90deg, rgba(255,255,255,1) 7%, rgba(0,0,0,1) 25%, rgba(0,0,0,1) 50%, rgba(0,0,0,1) 75%, rgba(255,255,255,1) 93%); padding: 20px; text-align: center;">
    <img src="https://i.postimg.cc/GmKXV8kz/logo-Inventarit.png" alt="LOGO" style="width: 300px; display: block; margin: 0 auto;">
    <p style="font-size: 28px; color: white; font-weight: bold; margin-bottom: 5px;">Recuperación de contraseña</p>
    </div>
    <div style="text-align: center; padding: 20px; font-family: Arial, sans-serif; background-image:url(https://i.postimg.cc/C5Pw1LDg/dogi.jpg);">
        
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <p style="font-size: 20px; color: #555; margin-bottom: 20px;">Haz clic en el siguiente enlace para restablecer tu contraseña:</p>
        <a href="http://localhost/InventarIT_Manager/cambiarContra.php?id=' . $row['id_usuario'] . '" style="background-color: #3498db; color: white; padding: 14px 28px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;">Restablecer Contraseña</a>
    </div>
';

        
            
            $mail->Body = $body;
            
            $mail->AltBody = 'Para restablecer tu contraseña, haz clic en el siguiente enlace: https://www.ejemplo.com/InventaritManager/cambiarContra.php?id=' . $row['id_usuario'];
            
            $mail->send();
            
            
            echo '<script>
                alert("Te enviamos un correo para reestablecer tu contraseña");
                window.location.href="../login.php?message=ok";
            </script>';
        } else {
            echo '<script>
                alert("No se encontró el usuario. Verifica tu correo electrónico");
                window.location.href="../olvideContra.php";
            </script>';
        }
    } catch (Exception $e) {
        echo '<script>
            alert("Hubo un error al enviar tus datos");
            window.location.href="../olvideContra.php";
        </script>';
    }
} else {
    echo '<script>
        alert("No se encontró el usuario. Verifica tu correo electrónico");
        window.location.href="../olvideContra.php";
    </script>';
}
?>