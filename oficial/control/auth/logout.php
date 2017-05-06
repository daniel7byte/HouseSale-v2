<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../resources/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resources/css/flatly.min.css">
    <title>Adios</title>
  </head>
  <body>
    <em>
      <?php
        session_unset();
        session_destroy();
        echo "Adios!";
      ?>
      <script type="text/javascript">
        setTimeout(function(){ window.location = '../index.php'; }, 500);
      </script>
    </em>
    <script src="../resources/js/jquery-3.1.1.min.js" charset="utf-8"></script>
    <script src="../resources/bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
  </body>
</html>
