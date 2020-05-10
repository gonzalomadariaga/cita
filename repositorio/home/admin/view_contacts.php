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
      <li class="active">Perfil</li>
    </ul>
</div>

  <div class="row">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Perfil</h3>
      </div>
      <div class="panel-body">
        <form class="form-horizontal" name="contact_form" id="contact_form" enctype="multipart/form-data" method="post" action="process_form.php">
          <fieldset>
            <div class="form-group">
              <label class="col-lg-4 control-label" for="nombre">Nombre:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" placeholder="Nombre" value="<?php echo $results[0]["nombre"] ?>" id="nombre" class="form-control" name="nombre">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="apellido">Apellido:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results[0]["apellido"] ?>" placeholder="Apellido" id="apellido" class="form-control" name="apellido">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="institucion">Institución:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results[0]["institucion"] ?>" placeholder="Institución" id="institucion" class="form-control" name="institucion">
              </div>
            </div>
            
             <div class="form-group">
              <label class="col-lg-4 control-label" for="cargo">Cargo:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results[0]["cargo"] ?>" placeholder="Cargo" id="cargo" class="form-control" name="cargo">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="email">Email:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results[0]["email"] ?>" placeholder="Email" id="email" class="form-control" name="email">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="celular">Celular</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results[0]["celular"] ?>" placeholder="Celular" id="celular" class="form-control" name="celular">
              </div>
            </div>
                        
            <div class="form-group">
              <label class="col-lg-4 control-label" for="address">Apreciación:</label>
              <div class="col-lg-5">
                <textarea id="address" readonly="" name="address" rows="3" class="form-control"><?php echo $results[0]["apreciacion"] ?></textarea>
              </div>
            </div>
          </fieldset>
        </form>

      </div>
    </div>
  </div>
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