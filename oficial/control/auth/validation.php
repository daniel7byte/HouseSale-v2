<?php
  require_once('../config/parameters.php');
  require_once('../config/connection.php');
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
    <title>Validacion</title>
  </head>
  <body>
    <em>
      <?php
        $query = $mysql->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
        $query->execute([':usuario' => $_POST['usuario']]);
        $result = $query->fetchAll();
        foreach ($result as $row) {
          $id = $row['id'];
          $usuario = $row['usuario'];
          $hash = $row['contrasenia'];
          $rol = $row['rol'];
          break;
        }
        if (password_verify($_POST['contrasenia'], $hash)) {
          echo 'Contraseña válida!';
          $_SESSION['id'] = $id;
          $_SESSION['usuario'] = $usuario;
          $_SESSION['rol'] = $rol;
        ?>
        <script type="text/javascript">
          setTimeout(function(){ window.location = '<?=APP_URL?>dashboard/index.php'; }, 500);
        </script>
        <?php
        } else {
          echo 'La contraseña no es válida';
        ?>
        <script type="text/javascript">
          setTimeout(function(){ window.location = '<?=APP_URL?>index.php'; }, 500);
        </script>
        <?php
        }
      ?>
    </em>
    <script src="<?=APP_URL?>resources/js/jquery-3.1.1.min.js" charset="utf-8"></script>
    <script src="<?=APP_URL?>resources/bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
  </body>
</html>
