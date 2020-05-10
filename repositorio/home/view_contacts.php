<?php

require_once '../../datos-acceso/config.php';
include './header.php';
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

<div class="row">
  <ul class="breadcrumb">
      <li><a href="index.php">Home</a></li>
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
<?php
include './footer.php';
?>