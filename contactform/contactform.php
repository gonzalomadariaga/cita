<?php
  
  include "../datos-acceso/keys.php";

  require '../PHPMailer/src/Exception.php';
  require '../PHPMailer/src/PHPMailer.php';
  require '../PHPMailer/src/SMTP.php'; 
      
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  $conexion=mysqli_connect(DB_SERVER,DB_SERVER_USERNAME,DB_SERVER_PASSWORD,DB_DATABASE);

  $nombre=$_POST['name'];
	$email=$_POST['email'];
  $asunto=$_POST['subject'];
  $mensaje=$_POST['message'];

  $sql="INSERT INTO mensajes ( nombre , email , asunto , mensaje)
			VALUES ('$nombre','$email','$asunto','$mensaje')";
  echo mysqli_query($conexion,$sql);
  
  
  
  
  

  
  $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                       // Enable verbose debug output
            /*$mail->isSMTP();  */                                          // Set mailer to use SMTP
            $mail->Host       = SMTP_SERVER;  // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = SMTP_USERNAME;                     // SMTP username
            $mail->Password   = SMTP_PASSWORD;                               // SMTP password
            $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port       = 465;                                    // TCP port to connect to
        
            //Recipients
            $mail->setFrom(SMTP_USERNAME);
            $mail->addAddress('gonxxamd@gmail.com');    // Add a recipient
         
            
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'NUEVO MENSAJE';
            $body = "Hola, un nuevo usuario se ha contactado vía formulario. <br/>
                    Nombre: $nombre <br/ >
                    Email: $email <br/ >
                    Asunto: $asunto <br/>
                    Mensaje: $mensaje <br/>
                    ";
            $mail->Body    = $body ;
            $mail->AltBody = strip_tags($body);
            
            $mail->send();
           
           } catch (Exception $e) {
               echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
           }      

?>
