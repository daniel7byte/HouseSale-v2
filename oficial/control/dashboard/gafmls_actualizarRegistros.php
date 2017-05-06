<?php
  require_once('../config/parameters.php');
  require_once('../config/connection.php');
  session_start();
  if(!isset($_SESSION['usuario'])){
    header('Location: ' . APP_URL . 'index.php');
    exit;
  }elseif($_SESSION['rol'] != 'ADMIN'){
    header('Location: ' . APP_URL . 'index.php');
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
    <title>Documentos</title>
  </head>
  <body style="padding-top: 60px;">

    <?php include('layouts/navbar.php'); ?>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2>Formulario GAFMLS - ACTUALIZAR</h2>
          <h4>LN | Price | STAT | Address | AR | City | CNTY | BR | BAF | BAH | YR | ZIP | ELEM | MS | HS</h4>
          <hr>
          <div class="well">
            <form id="myForm" class="form-horizontal" action="gafmls_procesarActualizar.php" method="post" autocomplete="off" enctype="multipart/form-data">
              <fieldset>
                <div class="form-group">
                  <label for="usuario" class="col-lg-2 control-label">Archivo CSV</label>
                  <div class="col-lg-10">
                    <input type="file" class="form-control" id="file" name="file" required autofocus>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-10 col-lg-offset-2">
                    <button type="reset" class="btn btn-default">Limpiar</button>
                    <button class="btn btn-primary" id="next">Enviar</button>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="<?=APP_URL?>resources/js/jquery-3.1.1.min.js" charset="utf-8"></script>
    <script src="<?=APP_URL?>resources/bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
    <script src="<?=APP_URL?>resources/js/scripts.js" charset="utf-8"></script>
  </body>
</html>
