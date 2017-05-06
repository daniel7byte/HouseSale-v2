<?php
  require_once('../config/parameters.php');
  require_once('../config/connection.php');
  session_start();
  if(!isset($_SESSION['usuario'])){
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
    <title>Buscador</title>
  <script src="<?=APP_URL?>resources/js/jquery-1.12.3.js" charset="utf-8"></script>
  </head>
  <body style="padding-top: 60px;">

    <?php include('layouts/navbar.php'); ?>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2>Buscador</h2>
          <hr>
          <form action="resultados.php" method="get">
            <div class="row">
              <div class="col-md-6 col-md-offset-6">
                <div class="form-group">
                  <label for="state">State</label>
                  <select name="state" id="state" class="form-control">
                    <option value="Georgia">Georgia</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="zipcode">Zip Code</label>
                  <input type="text" name="zipcode" class="form-control" id="zipcode">
                </div>
                <div class="form-group">
                  <label for="county">County</label>
                  <select name="county" id="county" class="form-control">
                    <option value="-">All</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="city">City</label>
                  <select name="city" id="city" class="form-control">
                    <option value="-">All</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="priceMin">Price Min</label>
                  <input type="text" class="form-control" name="priceMin" placeholder="$USD 1">
                </div>
                <div class="form-group">
                  <label for="priceMin">Price Max</label>
                  <input type="text" class="form-control" name="priceMin" placeholder="$USD 999,999">
                </div>
                <div class="form-group">
                  <label for="id">ID</label>
                  <input type="text" name="id" class="form-control" id="id">
                </div>
                <div class="form-group">
                  <label for="system">System</label>
                  <select name="system" id="system" class="form-control">
                    <option value="-">All</option>
                    <option value="fmls">FMLS</option>
                    <option value="gamls">GAMLS</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block" style="margin-top: 5px;">Buscar <span class="glyphicon glyphicon-search"></span></button>
              </div>
            </div>
            <hr>
          </form>
        </div>
      </div>
    </div>
    <script src="<?=APP_URL?>resources/bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
  </body>
</html>
