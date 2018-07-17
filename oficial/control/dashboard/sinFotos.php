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

    $directorio = '../../img/casas/00000/' . $archivo;

    return file_exists($directorio);
  }
  
  $queryFMLS = $mysql->prepare("SELECT dato2 FROM datoscasas WHERE id = 1");
  $queryFMLS->execute();
  $rowsFMLS = $queryFMLS->fetchAll();

  $queryGAMLS = $mysql->prepare("SELECT dato2 FROM datoscasas WHERE id = 0");
  $queryGAMLS->execute();
  $rowsGAMLS = $queryGAMLS->fetchAll();

  $comasFormato = ',';

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
                  $RestanteContadorFMLS = 0;

                  foreach ($rowsFMLS as $row):
                    if (validatorDir(1, $row['dato2']) == false):
                      $RestanteContadorFMLS++;
                    endif;
                  endforeach;

                  foreach ($rowsFMLS as $row):
                    if (validatorDir(1, $row['dato2']) == false):
                      echo $row['dato2'] . $comasFormato;
                      $contadorFMLS++;

                      if ($contadorFMLS == 800) {
                        break;
                      }
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
                    $RestanteContadorGAMLS = 0;

                    foreach ($rowsGAMLS as $row):
                      if (validatorDir(0, $row['dato2']) == false):
                        $RestanteContadorGAMLS++;
                      endif;
                    endforeach;

                    foreach ($rowsGAMLS as $row):
                      if (validatorDir(0, $row['dato2']) == false):
                        echo $row['dato2'] . $comasFormato;
                        $contadorGAMLS++;

                        if ($contadorGAMLS == 800) {
                          break;
                        }
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
        <h1 style="float: right;">RESTAN: <?=number_format($RestanteContadorFMLS + $RestanteContadorGAMLS)?></h1>
      </div>
    </div>
    <script src="<?=APP_URL?>resources/bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
  </body>
</html>
