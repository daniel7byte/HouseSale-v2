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
    <title>Casa por defecto</title>
    <style media="screen">
      tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
      }
    </style>
	<script src="<?=APP_URL?>resources/js/jquery-1.12.3.js" charset="utf-8"></script>
  </head>
  <body style="padding-top: 60px;">

    <?php include('layouts/navbar.php'); ?>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2>Casa por defecto</h2>
          <hr>
          <div class="row">
            <?php
              $query = $mysql->prepare("SELECT * FROM banderas ORDER BY id ASC");
              $query->execute();
              $rows = $query->fetchAll();
              foreach ($rows as $row):
            ?>
            <div class="col-md-4" style="margin: 0px 0px 50px 0px;">
              <form action="actualizar.php" method="post">
                <label>Casa <?=$row['id']?></label>
                <input type="hidden" name="id" value="<?=$row['id']?>">
                <input type="text" class="form-control" name="casa_id" value="<?=$row['casa_id']?>">
                <button type="submit" class="btn btn-primary" style="margin-top: 5px;">Actualizar</button>
              </form>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
    <script src="<?=APP_URL?>resources/bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
  </body>
</html>
