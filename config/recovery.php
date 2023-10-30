<?php 
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
 use PHPMailer\PHPMailer\SMPT;

 require '../PHPMailer/Exception.php';
 require '../PHPMailer/PHPMailer.php';
 require '../PHPMailer/SMTP.php';
        
 include_once 'C:\laragon\www\InventaritManager\modelo\conexion.php';


    $correo = $_POST ['correo'];
    $query = "SELECT * FROM usuarios where correo_usuario = '$correo' AND id_estado_usuario= 1";
    $con = Conexion::conectar();
    $result = $con->query($query);
    $row= $result->fetch_assoc();

    if ($result->num_rows > 0){
       
       
    $mail = new PHPMailer(true);
        try {
                       
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'johanestradacastillo1@outlook.com';                     //SMTP username
            $mail->Password   = 'Castillo4Estrada2$';                               //SMTP password
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('johanestradacastillo1@outlook.com', 'InventarIT Manager');
            $mail->addAddress('johanestradacastillo6@gmail.com', 'Johan User');     //Add a recipient
          
            //Content   
            $mail->isHTML(true);   //Set email format to HTML
            $mail->Subject = 'Recuperacion de contra';
            $mail->Body = 'Solicitaste la recuperación de tu contraseña de InventarIT Manager, 
            por favor da click en el siguiente enlace <a href="localhost/InventaritManager/cambiarContra.php?id='.$row['id_usuario'].'">Click aqui.</a>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            header ("Location: ../login.php?message=ok");
        } catch (Exception $e) {
            header ("Location: ../login.php?message=error");
                
        }


    }else{
        header ("Location: ../index.php?message=no_encontrado");
    }
?>