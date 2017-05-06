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

  function getSystemInmo($id) {
    if ($id == null) {
      return 'NULL';
    }else{
      if ($id == "1") {
        return 'FMLS';
      } elseif ($id == "0") {
        return 'GAMLS';
      }else{
        return $id;
      }
    }
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
    <script>
      function changeStatus(id, dato2) {
        if (confirm("¿Eliminar?") == true) {
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
                  $("#"+dato2).remove();
                  var count = parseInt($("#contador").html());
                  count = count - 1;
                  $("#contador").html(count);
              }else{
                  console.log(result)
              }
            }
          });
        }
      }
      function clearUser() {
        if (confirm('¿Seguro?') == true) {
          $.ajax({
          type: 'POST',
            url: 'funcFavoritos.php',
            data: {
              api: 'clearUser'
            },
            success: function(result){
              if(result == true){
                  location.reload(true);
              }else{
                  console.log(result)
              }
            }
          });
        }
      }
    </script>
  </head>
  <body style="padding-top: 60px;">

    <?php include('layouts/navbar.php'); ?>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2>Mis Favoritos 
            <a href="<?=APP_URL?>dashboard/generarCorreoHtml.php" class="btn btn-success">Generar HTML <span class="glyphicon glyphicon-wrench"></span></a>
            <a href="#" onclick="event.preventDefault(); clearUser();" class="btn btn-danger">Limpiar Listado <span class="glyphicon glyphicon-trash"></span></a>
            </h2>
          <hr>
          <div class="row">
            <div class="col-md-12">
              <table class="table table-striped table-hover ">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Sistema</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $contador = 0;
                    foreach ($rows as $row):
                  ?>
                    <tr id="<?=$row['casa_dato2']?>">
                      <td><?=$row['casa_dato2']?></td>
                      <td><?=(getSystemInmo($row['casa_id']))?></td>
                      <td>
                        <a target="_blank" href="<?=$urlMain.$row['casa_dato2']?>" class="btn btn-success btn-xs">
                          <span class="glyphicon glyphicon-link"></span>
                        </a>
                        <a target="_blank" onclick="event.preventDefault(); changeStatus(<?=$row['casa_id']?>, <?=$row['casa_dato2']?>)" class="btn btn-danger btn-xs">
                          <span class="glyphicon glyphicon-floppy-remove"></span>
                        </a>
                      </td>
                    </tr>
                  <?php
                      $contador++;
                    endforeach;
                  ?>
                </tbody>
              </table> 
              <hr>
              <h1 style="float: right;">Total: <span id="contador"><?=number_format($contador)?></span></h1>
              <br><br><br><br><br>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="<?=APP_URL?>resources/bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
  </body>
</html>