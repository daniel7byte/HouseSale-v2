<?php
  require_once('config/parameters.php');
  session_start();
  if(isset($_SESSION['usuario'])){
    header('Location: ' . APP_URL . 'dashboard/index.php');
    exit;
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?=APP_URL?>resources/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=APP_URL?>resources/css/flatly.min.css">
    <title>Login</title>
    <style media="screen">
      body {
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #eee;
      }

      .form-signin {
      max-width: 330px;
      padding: 15px;
      margin: 0 auto;
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
      margin-bottom: 10px;
      }
      .form-signin .checkbox {
      font-weight: normal;
      }
      .form-signin .form-control {
      position: relative;
      height: auto;
      -webkit-box-sizing: border-box;
         -moz-box-sizing: border-box;
              box-sizing: border-box;
      padding: 10px;
      font-size: 16px;
      }
      .form-signin .form-control:focus {
      z-index: 2;
      }
      .form-signin input[type="text"] {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
      }
      .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <form class="form-signin" action="<?=APP_URL?>auth/validation.php" method="post">
        <h2 class="form-signin-heading">Iniciar Sesión</h2>
        <label for="inputUsuario" class="sr-only">Usuario</label>
        <input type="text" id="inputUsuario" name="usuario" placeholder="Usuario" class="form-control" required autofocus>
        <label for="inputContrasenia" class="sr-only">Contraseña</label>
        <input type="password" id="inputContrasenia" name="contrasenia" placeholder="Contraseña" class="form-control" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
      </form>
    </div>
    <script src="<?=APP_URL?>resources/js/jquery-3.1.1.min.js" charset="utf-8"></script>
    <script src="<?=APP_URL?>resources/bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
  </body>
</html>
