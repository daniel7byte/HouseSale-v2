<?php
  // session_start();
  // if(!isset($_SESSION['usuario'])){
  //   header('Location: ' . APP_URL . 'index.php');
  //   exit;
  // }

  require_once('../config/parameters.php');
  require_once('../config/connection.php');
  require_once('funcFavoritos.php');

  $query = $mysql->prepare("SELECT * FROM favoritos WHERE usuario_id = :usuario_id ORDER BY id DESC");
  $query->execute([
    ':usuario_id' => $_SESSION['id']
  ]);
  $rows = $query->fetchAll();

  $urlMain = 'http://www.joygle.com/property_details.php?id=';
  $urlMainImg = 'http://www.joygle.com/dinamic_filter/getImages.php?id='; // &w=483&h=200

  function getContentInmo($id) {

    $mysql = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);

    $query = $mysql->prepare("SELECT * FROM datoscasas WHERE dato2 = :dato2");
    $query->execute([
      ':dato2' => $id
    ]);
    return $query->fetchAll();
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?=APP_URL?>resources/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=APP_URL?>resources/css/flatly.min.css">
    <link rel="stylesheet" href="<?=APP_URL?>resources/datatables/css/jquery.dataTables.min.css">
    <title>Mis Favoritos</title>
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
          <h2>Correo HTML <a href="<?=APP_URL?>dashboard/misFavoritos.php" class="btn btn-success">Ver Listado <span class="glyphicon glyphicon-list-alt"></span></a></h2>
          <hr>
          <div class="row">
            <div class="col-md-12">
              
              <!-- <div class="media" style="background-color: #f60;">
                <div class="media-left">
                  <a href="http://www.joygle.com/">
                    <img class="media-object" src="http://localhost/Joygle/HouseSale-PHP/img/logo-joygle-big.png" alt="Joygle">
                  </a>
                </div>
              </div> -->

              <?php
                foreach ($rows as $row):
                  $houses = getContentInmo($row['casa_dato2']);
                  foreach ($houses as $house):
              ?>
                <div class="media" id="<?=$house['dato2']?>">
                  <div class="media-left">
                    <a href="<?=$urlMain.$house['dato2']?>">
                      <!-- http://www.joygle.com/dinamic_filter/getImages.php?id=5823000&w=166&h=125 -->
                      <img class="img media-object" src="<?=$urlMainImg.$house['dato2']?>&w=166&h=125" alt="...">
                    </a>
                  </div>
                  <div class="media-body">
                    <h4 class="media-heading"><?=$house['dato7']?></h4>
                    
                    <?=$house['dato10'] . ', '. $house['dato11'] . ', GA ' . $house['dato24'] . ', US'?><br>
                    
                    <strong>$<?=number_format($house['dato5'])?></strong><br>
                    
                    <a target="_blank" href="<?=$urlMain.$house['dato2']?>">
                      <?=$urlMain.$house['dato2']?>
                    </a>
                  </div>
                </div>
                <hr>
              <?php
                  endforeach;
                endforeach;
              ?>
              <hr>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="<?=APP_URL?>resources/bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
  </body>
</html>