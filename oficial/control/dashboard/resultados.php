<?php

// Conexion base de datos
require_once("../config/parameters.php");
require_once("../config/connection.php");
require_once('funcFavoritos.php');

// Recuperación de parámetros de búsqueda
$state = $_GET["state"] ?? "Georgia";
$county = $_GET["county"] ?? "-";
$city = $_GET["city"] ?? "-";
$priceMin = $_GET["priceMin"] ?? "";
$priceMax = $_GET["priceMax"] ?? "";
$id = $_GET["id"] ?? "";
$system = $_GET["system" ?? "-"];
$zipCode = $_GET["zipcode"] ?? "";

// Busqueda directa por ID. Ignora los demás campos
if(isset($id) AND !empty($id) AND $id != "") {
    $query = $mysql->prepare("SELECT * FROM datoscasas WHERE dato2 LIKE :id AND dato6 = 'A'");
    $query->execute([':id' => "%$id%"]);
    $rows = $query->fetchAll();
} else {
// Busqueda según los parámetros del formulario
    // Construccion de condicional
    $conditional = SearchConditional($zipCode,$county,$city,$priceMin,$priceMax,$system);
    $sql = sprintf("SELECT * FROM datoscasas WHERE {$conditional}");
    $query = $mysql->prepare($sql);
    $query->execute();
    $rows = $query->fetchAll();
}

$urlMain = 'http://www.joygle.com/property_details.php?id=';
$urlMainImg = 'http://www.joygle.com/dinamic_filter/getImages.php?id='; // &w=483&h=200


?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?=APP_URL?>resources/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=APP_URL?>resources/css/flatly.min.css">
    <title>Resultados</title>
    <style media="screen">
      tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
      }
    </style>
    <script src="<?=APP_URL?>resources/js/jquery-1.12.3.js" charset="utf-8"></script>
    <script>
      function changeStatus(id, dato2) {
        // if (confirm("Cambiar estado") == true) {
          $.ajax({
          type: 'POST',
            url: 'funcFavoritos.php',
            data: {
              api: 'changeStatus',
              id: id,
              dato2: dato2
            },
            success: function(result){
              if(result == false){
                $("#"+dato2).removeClass('btn-info');
                $("#"+dato2).addClass('btn-danger');
                $("#"+dato2).html('<span class="glyphicon glyphicon-star-empty"></span>');
              }else{
                $("#"+dato2).removeClass('btn-danger');
                $("#"+dato2).addClass('btn-info');
                $("#"+dato2).html('<span class="glyphicon glyphicon-star"></span>');
              }
            }
          });
        // }
      }
    </script>
  </head>
  <body style="padding-top: 60px;">

    <?php include('layouts/navbar.php'); ?>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2>Resultados 
            <!-- <a href="<?=APP_URL?>dashboard/misFavoritos.php" class="btn btn-success">Mis Favoritos <span class="glyphicon glyphicon-star"></span></a> -->
            </h2>
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
              ?>
                <div class="media">
                  <div class="media-left">
                    <a href="<?=$urlMain.$row['dato2']?>">
                      <!-- http://www.joygle.com/dinamic_filter/getImages.php?id=5823000&w=166&h=125 -->
                      <img class="img media-object" src="<?=$urlMainImg.$row['dato2']?>&w=166&h=125">
                    </a>
                  </div>
                  <div class="media-body">
                    <h4 class="media-heading"><?=$row['dato7']?></h4>
                    
                    <?=$row['dato10'] . ', '. $row['dato11'] . ', GA ' . $row['dato24'] . ', US'?><br>
                    
                    <strong>$<?=number_format($row['dato5'])?></strong><br>

                    <span class="label label-primary"><?=(getSystemInmo($row['id']))?></span><br><br>

                    <?php if (getStatus($row['dato2'], $_SESSION['id']) == true): ?>

                      <a id="<?=$row['dato2']?>" target="_blank" onclick="event.preventDefault(); changeStatus(<?=$row['id']?>, <?=$row['dato2']?>)" class="btn btn-info btn-xs">
                        <span class="glyphicon glyphicon-star"></span>
                      </a>

                    <?php else: ?>

                      <a id="<?=$row['dato2']?>" target="_blank" onclick="event.preventDefault(); changeStatus(<?=$row['id']?>, <?=$row['dato2']?>)" class="btn btn-danger btn-xs">
                        <span class="glyphicon glyphicon-star-empty"></span>
                      </a>

                    <?php endif; ?>

                    <a target="_blank" href="<?=$urlMain.$row['dato2']?>" class="btn btn-success btn-xs">
                      More details
                      <span class="glyphicon glyphicon-share"></span>
                    </a>
                  </div>
                  <div class="media-right">
                  </div>
                </div>
                <hr>
              <?php
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