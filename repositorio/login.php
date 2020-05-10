<?php
include "../datos-acceso/config.php";

?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inicio de Sesión - C.I.T.A.</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../repositorio/css/repo.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css">
  </head>
  <body>
    
    <form class="form-signin">
      <?php if(isset($_SESSION['created'])): ?>
        <div class="alert alert-success">
          <?php echo $_SESSION['created']; ?>
        </div>
      <?php endif; ?>
      <?php unset($_SESSION['created']); ?>

      <?php if(isset($_SESSION['cuenta'])): ?>
        <div class="alert alert-danger">
          <?php echo $_SESSION['cuenta']; ?>
        </div>
      <?php endif; ?>
      <?php unset($_SESSION['cuenta']); ?>


      
      <div class="text-center mb-4">
        <img class="mb-4" src="../repo/img/sesion.png"  width="100" heigth="100" alt="">
        <h1 class="h3 mb-3 font-weight-normal">Inicio de Sesión al Repositorio</h1>
        <p>Centro de Investigación Tecnológico de la Armada</p>
      </div>

      <label for="email" class="sr-only">Email address</label>
      <input type="email" id="email" name="email" class="form-control" placeholder="Email">
      <div class="invalid-feedback">Email es requerido</div>
      
      <label for="password" class="sr-only">Password</label>
      <input type="password" id="password" name="password" class="form-control" placeholder="Password">
      <div class="invalid-feedback">Contraseña es requerida</div>

      <button id="login" type="button" class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
      <a class="btn btn-lg btn-secondary btn-block" href="registro.php" role="button">Registrarse</a>
      <div class="text-center"><a href="../index.html">Volver a página de inicio</a></div>

      
    </form>
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <script src="app.js"></script>
  </body>
</html>