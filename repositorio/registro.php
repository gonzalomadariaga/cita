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
    <link href="css/repo.css" rel="stylesheet">

    <!-- Sweetalert -->  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css">
  </head>
  <body>
    <div class="form">
        <form class="form-signin" method="post" action="registrobd.php" id="formulario-registro-usuario">
        <div class="text-center mb-4">
            <h1 class="h3 mb-3 font-weight-normal">Crea tu cuenta</h1>
            <p>Centro de Investigación Tecnológico de la Armada</p>
        </div>

        <form-group>
            <label for="nombre" class="sr-only">Nombre</label>
            <input  id="nombre" class="form-control nombre" name="nombre" placeholder="Nombre">
            <div class="invalid-feedback">Nombre es requerido</div>
        </form-group>

        <form-group>
            <label for="apellido" class="sr-only">Apellido</label>
            <input  id="apellido" class="form-control apellido" name="apellido" placeholder="Apellido">
            <div class="invalid-feedback">Apellido es requerido</div>
        </form-group>

        <form-group>
            <label for="email" class="sr-only">Email</label>
            <input  id="email" class="form-control email" name="email" placeholder="Email">
            <div class="invalid-feedback emailError">Email es requerido</div>    
        </form-group>
    
        <div class="form-group">
            <select class="form-control institucion" name="institucion" id="institucion">
                <option selected>Institución</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
            <div class="invalid-feedback">Institución es requerido</div>
        </div>

        <form-group>
            <label for="password" class="sr-only">Contraseña</label>
            <input type="password" id="password" class="form-control password" name="password" placeholder="Contraseña">
            <div class="invalid-feedback">Contraseña es requerida</div>
        </form-group>

        <form-group>
            <label for="repcontraseña" class="sr-only">Repita contraseña</label>
            <input type="password" id="repcontraseña" class="form-control password" name="repetirPassword" placeholder="Repita contraseña">
            <div class="invalid-feedback">Contraseña es requerida</div>
        </form-group>
      

      <button type="submit" id="signup" class="btn btn-lg btn-primary btn-block">Registrarse</button>

      <div class="text-center"><a href="index.php">Volver a Inicio de Sesión</a></div>
      
    </form>
    </div>
    
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <script src="app.js"></script>
  </body>
</html>
