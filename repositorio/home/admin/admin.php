<?php

require_once '../../../datos-acceso/config.php';

/*******PAGINATION CODE STARTS*****************/
if (!(isset($_GET['pagenum']))) {
  $pagenum = 1;
} else {
  $pagenum = $_GET['pagenum'];
}
$page_limit = ($_GET["show"] <> "" && is_numeric($_GET["show"]) ) ? $_GET["show"] : 8;


try {
  $keyword = trim($_GET["keyword"]);
  if ($keyword <> "" ) {
    $sql = "SELECT * FROM contactos_repositorio WHERE 1 AND "
            . " (nombre LIKE :keyword) ORDER BY nombre ";
    $stmt = $DB->prepare($sql);
    
    $stmt->bindValue(":keyword", $keyword."%");
    
  } else {
    $sql = "SELECT * FROM contactos_repositorio WHERE 1 ORDER BY nombre ";
    $stmt = $DB->prepare($sql);
  }
  
  $stmt->execute();
  $total_count = count($stmt->fetchAll());

  $last = ceil($total_count / $page_limit);

  if ($pagenum < 1) {
    $pagenum = 1;
  } elseif ($pagenum > $last) {
    $pagenum = $last;
  }

  $lower_limit = ($pagenum - 1) * $page_limit;
  $lower_limit = ($lower_limit < 0) ? 0 : $lower_limit;


  $sql2 = $sql . " limit " . ($lower_limit) . " ,  " . ($page_limit) . " ";
  
  $stmt = $DB->prepare($sql2);
  
  if ($keyword <> "" ) {
    $stmt->bindValue(":keyword", $keyword."%");
   }
   
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
<?php if ($ERROR_MSG <> "") { ?>
    <div class="alert alert-dismissable alert-<?php echo $ERROR_TYPE ?>">
      <button data-dismiss="alert" class="close" type="button">×</button>
      <p><?php echo $ERROR_MSG; ?></p>
    </div>
<?php } ?>

  <div class="panel panel-primary">
    <div class="panel-heading">
      <div class="panel-title">
        <h5 class="text-left">Repositorio</h5>
        <a href="../../logout.php" class="text-right"> Cerrar Sesión </a>
        
        
      </div>
    </div>
    <div class="panel-body">

      <div class="col-lg-12" style="padding-left: 0; padding-right: 0;" >
        <form action="admin.php" method="get" >
        <div class="col-lg-6 pull-left"style="padding-left: 0;"  >
          <span class="pull-left">  
            <label class="col-lg-12 control-label" for="keyword" style="padding-right: 0;">
              <input type="text" value="<?php echo $_GET["keyword"]; ?>" placeholder="Buscar por primer nombre" id="" class="form-control" name="keyword" style="height: 41px; width:300px;">
            </label>
            </span>
          <button class="btn btn-info">Buscar</button>
        </div>
        </form>
        <div class="pull-right" ><a href="contacts.php"><button class="btn btn-success"><span class="glyphicon glyphicon-user"></span>Añadir Contacto</button></a></div>
      </div>

      <div class="clearfix"></div>
<?php if (count($results) > 0) { ?>
        <div class="table-responsive">
          <table class="table table-striped table-hover table-bordered ">
            <tbody><tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Celular</th>
                <th>Email</th>
                <th>Acción </th>

              </tr>
  <?php foreach ($results as $res) { ?>
                <tr>
                  <td><?php echo $res["nombre"]; ?></td>
                  <td><?php echo $res["apellido"]; ?></td>
                  <td><?php echo $res["celular"]; ?></td>
                  <td><?php echo $res["email"]; ?></td>
                  <td>
                    <a href="view_contacts.php?cid=<?php echo $res["contact_id"]; ?>"><button class="btn btn-sm btn-info"><span class="glyphicon glyphicon-zoom-in"></span> Ver</button></a>&nbsp;
                    <a href="contacts.php?m=update&cid=<?php echo $res["contact_id"]; ?>&pagenum=<?php echo $_GET["pagenum"]; ?>"><button class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-edit"></span> Editar</button></a>&nbsp;
                    <a href="process_form.php?mode=delete&cid=<?php echo $res["contact_id"]; ?>&keyword=<?php echo $_GET["keyword"]; ?>&pagenum=<?php echo $_GET["pagenum"]; ?>" onclick="return confirm('¿Estás seguro/a?')"><button class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove-circle"></span> Eliminar</button></a>&nbsp;
                  </td>
                </tr>
  <?php } ?>
            </tbody></table>
        </div>
        <div class="col-lg-12 center">
          <ul class="pagination pagination-sm">
  <?php
  //Show page links
  for ($i = 1; $i <= $last; $i++) {
    if ($i == $pagenum) {
      ?>
                <li class="active"><a href="javascript:void(0);" ><?php echo $i ?></a></li>
                <?php
              } else {
                ?>
                <li><a href="admin.php?pagenum=<?php echo $i; ?>&keyword=<?php echo $_GET["keyword"]; ?>" class="links"  onclick="displayRecords('<?php echo $page_limit; ?>', '<?php echo $i; ?>');" ><?php echo $i ?></a></li>
                <?php
              }
            }
            ?>
          </ul>
        </div>

          <?php } else { ?>
        <div class="well well-lg">No se encontraron contactos.</div>
<?php } ?>
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