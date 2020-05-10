<?php 
    include "../datos-acceso/config.php";
    
    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php'; 

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    $iduser = $_GET['iduser'];
    $codigo = $_GET['codigo'];
    
    $verificarDatos = $DB->prepare("SELECT codigo, id, nombre, apellido, email FROM repositorio WHERE id = ? AND codigo = ?");
    $verificarDatos->execute([$iduser, $codigo]);

    //hacemos un fetch para traer una sola fila de datos, fetchAll() si son varias..
    $valores = $verificarDatos->fetch();

    //verificamos si el código y el id existen
    if ($verificarDatos->rowCount() <= 0){
        echo 'ID y/o código son inválidos o inexistentes';
    }else{
        //verificamos el estado actual del usuario
        $verificarEstado = $DB->prepare("SELECT estado FROM repositorio WHERE id = ? AND codigo = ? ");
        $verificarEstado->execute([$iduser, $codigo]);

        if (($verificarEstado -> rowCount() > 0) && ($verificarEstado->estado == 1)){
            echo 'Este usuario ya ha sido autorizado previamente';
        }else{
            $actualizarEstado = $DB->prepare("UPDATE repositorio SET estado = 1 WHERE id = ? AND codigo = ? ");
            $actualizarEstado->execute([$iduser, $codigo]);

            if ($actualizarEstado->rowCount() > 0 ){
                
                $emailuser = $valores['email'];
                $nombreUser = $valores['nombre'];
                $apellidoUser = $valores['apellido'];

                //lógica de envío de email
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
                    $mail->addAddress($emailuser);    // Add a recipient

                    //Para aceptar acentos y ñ     
                    $mail->CharSet = 'UTF-8';
                
                    // Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'HAS SIDO AUTORIZADO CON ÉXITO';
                    $body = "Hola " . $nombreUser . ' ' . $apellidoUser . ' tu cuenta ha sido autorizada!';
                    $mail->Body    = $body ;
                    $mail->AltBody = strip_tags($body);
                    
                    $mail->send();

                    echo 'Usuario autorizado con éxito';

                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
                
            } else {
                echo 'Ha ocurrido un error, el usuario no se ha autorizado';
            }
        }
    }


?>
