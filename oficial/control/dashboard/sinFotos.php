  <?php
  require_once('../config/parameters.php');
  require_once('../config/connection.php');
  session_start();
  if(!isset($_SESSION['usuario'])){
    header('Location: ' . APP_URL . 'index.php');
    exit;
  }


  function validatorDir($id, $dato2)
  {
    if ($id == 0) {
      $formato = '_1.JPG';
    }elseif ($id == 1) {
      $formato = '_0.jpg';
    }

    $archivo = $dato2 . $formato;

    $directorio = '../../oficial/img/casas/00000/' . $archivo;

    if(file_exists($directorio) == true){
      return true;
    }else{
      return false;
    }
  }
  
  $queryFMLS = $mysql->prepare("SELECT id, dato2 FROM datoscasas WHERE id = 1 ORDER BY dato18 DESC");
  $queryFMLS->execute();
  $rowsFMLS = $queryFMLS->fetchAll();

  $queryGAMLS = $mysql->prepare("SELECT id, dato2 FROM datoscasas WHERE id = 0 ORDER BY dato18 DESC");
  $queryGAMLS->execute();
  $rowsGAMLS = $queryGAMLS->fetchAll();

  $comasFormato = ',';

  $contador = 0;

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?=APP_URL?>resources/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=APP_URL?>resources/css/flatly.min.css">
    <link rel="stylesheet" href="<?=APP_URL?>resources/datatables/css/jquery.dataTables.min.css">
    <title>Casa por defecto</title>
    <style media="screen">
      tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
      }
      .well {
        overflow: auto;
      }
    </style>
  <script src="<?=APP_URL?>resources/js/jquery-1.12.3.js" charset="utf-8"></script>
  </head>
  <body style="padding-top: 60px;">

    <?php include('layouts/navbar.php'); ?>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2>Casas sin fotos</h2>
          <hr>
          <div class="row">
            <div class="col-md-12">
              <h2>FMLS</h2>
                <div class="well">
                  <?php
                  $contadorFMLS = 0;
                  foreach ($rowsFMLS as $row):
                    if (validatorDir($row['id'], $row['dato2']) == false):
                      echo $row['dato2'] . $comasFormato;
                      $contadorFMLS++;
                      $contador++;
                    endif;
                  endforeach;
                ?>
                </div>
              <hr>
              <h3 style="float: right;">FMLS: <?=number_format($contadorFMLS)?></h3>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <h2>GAMLS</h2>
                <div class="well">
                  <?php
                    $contadorGAMLS = 0;
                    foreach ($rowsGAMLS as $row):
                      if (validatorDir($row['id'], $row['dato2']) == false):
                        echo $row['dato2'] . $comasFormato;
                        $contadorGAMLS++;
                        $contador++;
                      endif;
                    endforeach;
                  ?>
                </div>
              <hr>
              <h3 style="float: right;">GAMLS: <?=number_format($contadorGAMLS)?></h3>
            </div>
          </div>
        </div>
        <hr>
        <h1 style="float: right;">Total: <?=number_format($contador)?></h1>
      </div>
    </div>
    <script src="<?=APP_URL?>resources/bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
  </body>
</html>
