<?php 
    include "../datos-acceso/config.php";

    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php'; 
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $errores = array();
    $mensaje = null;

    //declaramos variables  

    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $passwordEncriptada = crypt($password, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
    $repetirPassword = trim($_POST['repetirPassword']);
    $institucion = trim($_POST['institucion']);
    $estado = 0;
    $privilegio = 0;


    $checkEmail = $db->prepare("SELECT email FROM repositorio WHERE email = ?");
    $checkEmail->execute([$email]);

    if (empty($nombre)) {
        $errores[] = 'Debes ingresar tu nombre';
    }

    if ($nombre && strlen($nombre) > 20) {
        $errores[] = 'El nombre debe contener menos de 20 caracteres';
    }

    if ($nombre && !ctype_alpha($nombre)) {
        $errores[] = 'El nombre debe contener únicamente letras';
    }

    if (empty($apellido)) {
        $errores[] = 'Debes ingresar tu apellido';
    }

    if ($apellido && strlen($apellido) > 20) {
        $errores[] = 'El apellido debe contener menos de 20 caracteres';
    }

    if ($apellido && !ctype_alpha($apellido)) {
        $errores[] = 'El apellido debe contener únicamente letras';
    }

    if (empty($email)) {
        $errores[] = 'Debes ingresar tu email';
    }

    if ($email && strlen($email) > 100) {
        $errores[] = 'El e-mail es muy largo';
    }

    if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'El e-mail es inválido';
    }

    if (empty($password)) {
        $errores[] = 'Debes ingresar tu clave';
    }

    if (empty($repetirPassword)) {
        $errores[] = 'Debes repetir tu clave';
    }

    if ($password != $repetirPassword) {
        $errores[] = 'Las claves no coinciden';
    }

    if (empty($institucion)) {
        $errores[] = 'Debes seleccionar una institución';
    }

    if ($checkEmail->rowCount() > 0 ) {
        $errores[] = 'El e-mail ya se encuentra en uso';
    }
    if (count($errores) > 0) {
        //si existe algún error los recorremos con un foreach y los mostramos en el front

        foreach (array_reverse($errores) as $key => $error) {
            $params['error'] = $error;
        } 

        $mensaje = array(
            'success' => false,
            'message' => $params['error']
        );
    } else {
        //no hay errores, hacemos lo otro.. 

        $codigo = rand(1000, 1000000);
        $Query = $db->prepare("INSERT into repositorio (estado,codigo,nombre,apellido,email,password,institucion, privilegios) VALUES (?,?,?,?,?,?,?,?)");
        $Query->execute([$estado,$codigo,$nombre, $apellido, $email, $passwordEncriptada, $institucion, $privilegio]);

        if ($Query) {
            $mensaje = array(
                'success' => true,
                'message' => 'Tu cuenta se ha creado exitosamente'
            );
            $iduser = $db->lastInsertId();
        }

        //enviar correo
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
            $mail->Subject = 'NUEVO USUARIO REGISTRADO';
            $body = "Hola, un nuevo usuario se ha registrado en la base de datos. <br/>
                    Nombre: $nombre $apellido<br/ >
                    Email: $email <br/ >
                    ¿Desea autorizarlo? <br/>
                    <a href=\"http://www.madro.cl/cita/repositorio/updateuser.php?iduser=$iduser&codigo=$codigo\">[SI]</a>
                    <br/ >
                    ";
            $mail->Body    = $body ;
            $mail->AltBody = strip_tags($body);
            
            $mail->send();
           
           } catch (Exception $e) {
               echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
           }       
    } 

    if ($mensaje) {
        echo json_encode($mensaje);
    }

    
?>

