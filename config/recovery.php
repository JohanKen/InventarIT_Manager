<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

include_once 'C:\laragon\www\InventaritManager\modelo\conexion.php';

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
                <div style="text-align: center; background-color: #3498db; padding: 20px;">
                    <img src="../images/logoinventarit.png" alt="InventarIT Manager" style="max-width: 200px;">
                </div>
                <div style="text-align: center; padding: 20px;">
                    <p style="font-size: 18px;">Recuperación de contraseña</p>
                    <p style="font-size: 16px;">Haz clic en el siguiente enlace para restablecer tu contraseña:</p>
                    <a href="http://localhost/InventaritManager/cambiarContra.php?id=' . $row['id_usuario'] . '" style="background-color: #3498db; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;">Restablecer Contraseña</a>
                </div>';
            
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
