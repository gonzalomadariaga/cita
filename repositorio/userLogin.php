<?php 
    include "../datos-acceso/config.php";;
    
    $errores = array();
    $mensaje = null;  

    //declaramos variables

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $passwordEncriptada = crypt($password, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
     

    if (empty($email)) {
        $errores[] = 'Debes ingresar tu email';
    }
    if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'El e-mail es inválido';
    }

    if (empty($password)) {
        $errores[] = 'Debes ingresar tu clave';
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
    }else{
        //no hay errores, hacemos lo otro...
        $Query = $DB->prepare("SELECT * FROM repositorio WHERE email = ? AND estado = '1' ");
        $Query->execute([$email]);

        if($Query->rowCount() > 0 ){
            $row = $Query->fetch(PDO::FETCH_OBJ);
            $dbPassword = $row->password;
            $nombre = $row->nombre;
            $id = $row->id;
            $estado = $row->estado; 
            $privilegio = $row->privilegios;
    
            if(password_verify($password, $dbPassword)) {
                //los datos son correctos, por lo tanto ingresamos..
                //ahora verificamos si es admin o user normal
                if ( $privilegio == 1 ){
                    // cuenta admin
                    //$_SESSION['id'] = $id;
                    //$_SESSION['nombre'] = $nombre;

                    $mensaje = array(
                    'success' => true,
                    'message' => 'Cuenta admin',
                    'isAdmin' => true
                    );

                }else{
                    // cuenta user sin admin
                    //$_SESSION['id'] = $id;
                    //$_SESSION['nombre'] = $nombre;

                    $mensaje = array(
                    'success' => true,
                    'message' => 'Cuenta no admin',
                    'isAdmin' => false
                    );
                }
                /*
                    $_SESSION['id'] = $id;
                    $_SESSION['nombre'] = $nombre;

                    $mensaje = array(
                    'success' => true,
                    'message' => 'Datos correctos, redireccionando...',
                    'isAdmin' => true
                    );
                    */
       
            } else {
                //los datos son incorrectos
                $mensaje = array(
                    'success' => false,
                    'message' => 'Correo electrónico y/o contraseña incorrectos.'
                );
            }
        } else {
            //la cuenta no ha sido autorizada aún..
            $mensaje = array(
                'success' => false,
                'message' => 'Cuenta no existe o aún no se ha autorizado, espere correo de confirmación.'
            );
        }


    }

    if ($mensaje) {
        //mandamos el mensaje a través de un json
        echo json_encode($mensaje);
    }

    
    
?>