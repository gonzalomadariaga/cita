<?php
require_once '../../../datos-acceso/config.php';

try {
   $sql = "SELECT * FROM contactos_repositorio WHERE 1 AND contact_id = :cid";
   $stmt = $DB->prepare($sql);
   $stmt->bindValue(":cid", intval($_GET["cid"]));
   
   $stmt->execute();
   $results = $stmt->fetchAll();
} catch (Exception $ex) {
  echo $ex->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo PROJECT_NAME; ?></title>
    
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../style.css" rel="stylesheet">
    <script src="../bootstrap/js/jquery-1.9.0.min.js"></script>
  </head>
  <body>
    <div class="container mainbody">
      <div class="clearfix"></div>
<div class="row">
  <ul class="breadcrumb">
      <li><a href="admin.php">Home</a></li>
      <li class="active"><?php echo ($_GET["m"] == "update") ? "Editar" : "Añadir"; ?> Contacto</li>
    </ul>
</div>

  <div class="row">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title"><?php echo ($_GET["m"] == "update") ? "Editar" : "Añadir"; ?> Contacto</h3>
      </div>
      <div class="panel-body">

        <form class="form-horizontal" name="contact_form" id="contact_form" enctype="multipart/form-data" method="post" action="process_form.php">
          <input type="hidden" name="mode" value="<?php echo ($_GET["m"] == "update") ? "update_old" : "add_new"; ?>" >   
          <input type="hidden" name="cid" value="<?php echo intval($results[0]["contact_id"]); ?>" >
          <input type="hidden" name="pagenum" value="<?php echo $_GET["pagenum"]; ?>" >
          <fieldset>

            <div class="form-group">
              <label class="col-lg-4 control-label" for="nombre"><span class="required">*</span>Nombre:</label>
              <div class="col-lg-5">
                <input type="text" value="<?php echo $results[0]["nombre"] ?>" placeholder="Nombre" id="nombre" class="form-control" name="nombre"><span id="nombre_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="apellido"><span class="required">*</span>Apellido:</label>
              <div class="col-lg-5">
                <input type="text" value="<?php echo $results[0]["apellido"] ?>" placeholder="Apellido" id="apellido" class="form-control" name="apellido"><span id="apellido_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="institucion"><span class="required">*</span>Institución:</label>
              <div class="col-lg-5">
                <input type="text" value="<?php echo $results[0]["institucion"] ?>" placeholder="Institución" id="institucion" class="form-control" name="institucion"><span id="institucion_err" class="error"></span>
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-4 control-label" for="cargo"><span class="required">*</span>Cargo:</label>
              <div class="col-lg-5">
                <input type="text" value="<?php echo $results[0]["cargo"] ?>" placeholder="Cargo" id="cargo" class="form-control" name="cargo"><span id="cargo_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="email"><span class="required">*</span>Email:</label>
              <div class="col-lg-5">
                <input type="text" value="<?php echo $results[0]["email"] ?>" placeholder="Email" id="email" class="form-control" name="email"><span id="email_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="celular"><span class="required">*</span>Celular</label>
              <div class="col-lg-5">
                <input type="text" value="<?php echo $results[0]["celular"] ?>" placeholder="Celular" id="celular" class="form-control" name="celular"><span id="celular_err" class="error"></span>
                <span class="help-block">Sólo 9 dígitos</span>
              </div>
            </div>       
                        
            <div class="form-group">
              <label class="col-lg-4 control-label" for="apreciacion">Apreciación:</label>
              <div class="col-lg-5">
                <textarea id="apreciacion" name="apreciacion" rows="3" class="form-control"><?php echo $results[0]["apreciacion"] ?></textarea>
              </div>
            </div>
            
            <div class="form-group">
              <div class="col-lg-5 col-lg-offset-4">
                <button class="btn btn-primary" type="submit">Enviar</button> 
              </div>
            </div>
          </fieldset>
        </form>

      </div>
    </div>
  </div>

<script type="text/javascript">
$(document).ready(function() {
	
	// the fade out effect on hover
	$('.error').hover(function() {
		$(this).fadeOut(200);  
	});
	
	
	$("#contact_form").submit(function() {
		$('.error').fadeOut(200);  
		if(!validateForm()) {
            // go to the top of form first
            $(window).scrollTop($("#contact_form").offset().top);
			return false;
		}     
		return true;
    });

});

function validateForm() {
	 var errCnt = 0;
	 
     var nombre = $.trim( $("#nombre").val());
     var apellido = $.trim( $("#apellido").val());
     var institucion = $.trim( $("#institucion").val());
     var cargo = $.trim( $("#cargo").val());
	 var email = $.trim( $("#email").val());
	 var celular = $.trim( $("#celular").val());
     

	// validate name
	if (nombre == "" ) {
		$("#nombre_err").html("Tu nombre es requerido.");
		$('#nombre_err').fadeIn("fast"); 
		errCnt++;
	}  else if (nombre.length <= 2 ) {
		$("#nombre_err").html("Ingresa al menos 3 carácteres.");
		$('#nombre_err').fadeIn("fast"); 
		errCnt++;
    }
    
    if (apellido == "" ) {
		$("#apellido_err").html("Tu apellido es requerido.");
		$('#apellido_err').fadeIn("fast"); 
		errCnt++;
	}  else if (apellido.length <= 2 ) {
		$("#apellido_err").html("Ingresa al menos 3 carácteres.");
		$('#apellido_err').fadeIn("fast"); 
		errCnt++;
	}
    
    if (institucion == "" ) {
		$("#institucion_err").html("Tu institución es requerida.");
		$('#institucion_err').fadeIn("fast"); 
		errCnt++;
	}  else if (institucion.length <= 2 ) {
		$("#institucion_err").html("Ingresa al menos 3 carácteres.");
		$('#institucion_err').fadeIn("fast"); 
		errCnt++;
    }
    
    if (cargo == "" ) {
		$("#cargo_err").html("Tu cargo es requerido.");
		$('#cargo_err').fadeIn("fast"); 
		errCnt++;
	}  else if (cargo.length <= 2 ) {
		$("#cargo_err").html("Ingresa al menos 3 carácteres.");
		$('#cargo_err').fadeIn("fast"); 
		errCnt++;
	}
    
    if (!isValidEmail(email)) {
		$("#email_err").html("Ingresa un email válido.");
		$('#email_err').fadeIn("fast"); 
		errCnt++;
	}
    
    if (celular == "" ) {
		$("#celular_err").html("Ingresa tu número telefónico.");
		$('#celular_err').fadeIn("fast"); 
		errCnt++;
	}  else if (celular.length <= 8 || celular.length > 9 ) {
		$("#celular_err").html("Se aceptan sólo 9 dígitos.");
		$('#celular_err').fadeIn("fast"); 
		errCnt++;
	} else if ( !$.isNumeric(celular) ) {
		$("#celular_err").html("Ingresa sólo números");
		$('#celular_err').fadeIn("fast"); 
		errCnt++;
	}
    
	if(errCnt > 0) return false; else return true;
}

function isValidEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
</script>
</div>

<footer>
  <div class="navbar navbar-inverse footer">
    <div class="container-fluid">
      <div class="copyright">
        <a href="http://www.madro.cl/cita" target="_blank">Volver a página de inicio</a>
      </div>
    </div>
  </div>
</footer>


<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>