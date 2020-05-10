<?php
require_once '../../../datos-acceso/config.php';
$mode = $_REQUEST["mode"];
if ($mode == "add_new" ) {
  $nombre = trim($_POST['nombre']);
  $apellido = trim($_POST['apellido']);
  $institucion = trim($_POST['institucion']);
  $cargo = trim($_POST['cargo']);
  $email = trim($_POST['email']);
  $celular = trim($_POST['celular']);
  $apreciacion = trim($_POST['apreciacion']);
  $error = FALSE;


  if (!$error) {
        $sql = "INSERT INTO `contactos_repositorio` (`nombre`, `apellido`, `institucion`, `cargo`, `email`, `celular`, `apreciacion`) VALUES "
                . "( :nombre, :apellido, :institucion, :cargo, :email, :celular, :apreciacion)";

        try {
        $stmt = $DB->prepare($sql);

        // bind the values
        $stmt->bindValue(":nombre", $nombre);
        $stmt->bindValue(":apellido", $apellido);
        $stmt->bindValue(":institucion", $institucion);
        $stmt->bindValue(":cargo", $cargo);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":celular", $celular);
        $stmt->bindValue(":apreciacion", $apreciacion);


        // execute Query
        $stmt->execute();
        $result = $stmt->rowCount();
        if ($result > 0) {
            $_SESSION["errorType"] = "success";
            $_SESSION["errorMsg"] = "Contacto añadido con éxito.";
        } else {
            $_SESSION["errorType"] = "danger";
            $_SESSION["errorMsg"] = "Error al añadir el contacto.";
        }
        } catch (Exception $ex) {

        $_SESSION["errorType"] = "danger";
        $_SESSION["errorMsg"] = $ex->getMessage();
        }
    } else {
    $_SESSION["errorType"] = "danger";
    $_SESSION["errorMsg"] = "failed to upload image.";
  }
  header("location:admin.php");
}else if( $mode == "update_old"){
  $nombre = trim($_POST['nombre']);
  $apellido = trim($_POST['apellido']);
  $institucion = trim($_POST['institucion']);
  $cargo = trim($_POST['cargo']);
  $email = trim($_POST['email']);
  $celular = trim($_POST['celular']);
  $apreciacion = trim($_POST['apreciacion']);
  $cid = trim($_POST['cid']);
  $error = FALSE;

  if (!$error) {
    $sql = "UPDATE `contactos_repositorio` SET `nombre` = :nombre, 
                                              `apellido` = :apellido, 
                                              `institucion` = :institucion,
                                              `cargo` = :cargo,
                                              `email` = :email,
                                              `celular` = :celular,
                                              `apreciacion` = :apreciacion 
                                              "
            . "WHERE contact_id = :cid ";

    try {
      $stmt = $DB->prepare($sql);

      // bind the values
      $stmt->bindValue(":nombre", $nombre);
      $stmt->bindValue(":apellido", $apellido);
      $stmt->bindValue(":institucion", $institucion);
      $stmt->bindValue(":cargo", $cargo);
      $stmt->bindValue(":email", $email);
      $stmt->bindValue(":celular", $celular);
      $stmt->bindValue(":apreciacion", $apreciacion);
      $stmt->bindValue(":cid", $cid);

      // execute Query
      $stmt->execute();
      $result = $stmt->rowCount();
      if ($result > 0) {
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = "Conctacto actualizado correctamente.";
      } else {
        $_SESSION["errorType"] = "info";
        $_SESSION["errorMsg"] = "No se hicieron cambios al contacto.";
      }
    } catch (Exception $ex) {

      $_SESSION["errorType"] = "danger";
      $_SESSION["errorMsg"] = $ex->getMessage();
    }
  } else {
    $_SESSION["errorType"] = "danger";
    $_SESSION["errorMsg"] = "Failed to upload image.";
  }
  header("location:admin.php?pagenum=".$_POST['pagenum']);
} elseif ( $mode == "delete" ) {
   $cid = intval($_GET['cid']);
   
   $sql = "DELETE FROM `contactos_repositorio` WHERE contact_id = :cid";
   try {
     
      $stmt = $DB->prepare($sql);
      $stmt->bindValue(":cid", $cid);
        
       $stmt->execute();  
       $res = $stmt->rowCount();
       if ($res > 0) {
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = "Contacto eliminado con éxito.";
      } else {
        $_SESSION["errorType"] = "info";
        $_SESSION["errorMsg"] = "Error al eliminar el contacto.";
      }
     
   } catch (Exception $ex) {
      $_SESSION["errorType"] = "danger";
      $_SESSION["errorMsg"] = $ex->getMessage();
   }
   
   header("location:admin.php?pagenum=".$_GET['pagenum']);
}
?>