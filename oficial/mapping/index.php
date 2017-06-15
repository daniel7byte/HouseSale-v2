<?php

  include("../datosiniciales.php");
  include("../lang/langHandler.php");

  try {
      $mysql = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
      exit;
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <meta charset="UTF-8">
    <title>Property Mapping | Joygle</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1LHwSTnFdkSm9dA8CrIpicTLLCUJ7i7w" ></script>
    <script src="assets/js/gmaps.min.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
        var map;
        $(document).ready(function(){
            map = new GMaps({
                div: '#map',
                lat: 33.756944,
                lng: -84.390278,
                zoom: 7
            });
        });
    </script>
</head>
<body class="main-template">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#main-nav" aria-expanded="false">
                    <span class="sr-only">Menu</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="./" class="navbar-brand"><img src="http://demo.joygle.com/img/logo-joygle-big.png"></a>
            </div>
            <div class="collapse navbar-collapse" id="main-nav">
                <ul class="nav navbar-nav">
                    <li><a href="#">Buy</a></li>
                    <li><a href="#">Rent</a></li>
                    <li><a href="#">Mortgage</a></li>
                    <li><a href="#">Sell</a></li>
                    <li><a href="#">Find an Agent</a></li>
                    <li><a href="#">Local Scoop</a></li>
                    <li><a href="#">More <span class="caret"></span></a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Sign In</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="main">
        <section class="flex">
            <section class="section">
                <div class="vertical-container">
                    <div class="vertical">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2 col-xs-2 hide-xs"></div>
                                <div class="col-xs-8 col-md-8">
                                    <h2 class="text-center">Find the right home and neighborhood for you</h2>
                                    <form method="GET" action="sale.php" id="joygle-form">
                                        <div class="form-group">
                                            <label for="county" class="control-label uppercase"><?php echo FORM_LABEL1; ?></label>
                                            <select name="state" id="state" class="form-control">
                                                <option value="georgia">Georgia</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="county" class="control-label uppercase"><?php echo FORM_LABEL2; ?></label>
                                            <input type="text" name="zipcode" id="zipcode" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="county" class="control-label uppercase"><?php echo FORM_LABEL3; ?></label>
                                            <select class="form-control" name="county" id="county">
                                                <option value="-"><?php echo FORM_SELECT_ALL; ?></option>
                                                <?php
                                                $queryCounty = $mysql->prepare("SELECT DISTINCT dato11 FROM datoscasas ORDER BY dato11 ASC;");
                                                $queryCounty->execute();
                                                $rowsCounty = $queryCounty->fetchAll();
                                                foreach ($rowsCounty as $row):
                                                    ?>
                                                    <option value="<?=$row['dato11']?>"><?=$row['dato11']?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="city" class="control-label uppercase"><?php echo FORM_LABEL4; ?></label>
                                            <select id="city" name="city" class="form-control">
                                                <option value="-"><?php echo FORM_SELECT_ALL; ?></option>
                                                <?php
                                                $queryCounty = $mysql->prepare("SELECT DISTINCT dato10 FROM datoscasas ORDER BY dato10 ASC;");
                                                $queryCounty->execute();
                                                $rowsCounty = $queryCounty->fetchAll();
                                                foreach ($rowsCounty as $row):
                                                    ?>
                                                    <option value="<?=$row['dato10']?>"><?=$row['dato10']?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="price" class="control-label uppercase"><?php echo FORM_LABEL6; ?></label>
                                            <input type="hidden" value="150000" name="price-min" id="price-min" style="width:100%" class="form-control">
                                            <input type="hidden" value="750000" name="price-max" id="price-max" style="width:100%" class="form-control">
                                            <div class="range-prices">
                                                <div class="price-from">$<span>150000</span></div>
                                                <div class="divisor">-</div>
                                                <div class="price-to">$<span>750000</span></div>
                                            </div>
                                            <div id="price-selector"></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="uppercase" for="id">ID</label>
                                            <input type="text" name="id" id="id" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="systemFiltro" class="control-label"><?php echo FORM_LABEL7; ?></label>
                                            <select class="form-control" name="systemFiltro" id="systemFiltro">
                                                <option value="" selected><?php echo FORM_SELECT_ALL; ?></option>
                                                <option value="1">FMLS</option>
                                                <option value="0">GAMLS</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-6">
                                                    <button class="btn btn-ghost btn-block uppercase">Reset</button>
                                                </div>
                                                <div class="col-xs-12 col-sm-6">
                                                    <input type="hidden" name="key" value="j.%0a2ede56f6523e16b6a2794c26921580%">
                                                    <button type="submit" class="btn btn-joygle btn-block uppercase">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-xs-2 col-md-2 hide-xs"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section">
                <div id="map"></div>
            </section>
        </section>
    </main>
    <script src="system/filter/magic-grid.js"></script>
    <script>
    // Fixing height of main tag
    ((d)=>{
        let   clientWindow             = d.getElementsByClassName('main')[0]
        clientWindow.style.maxHeight = 'calc(100% - '+ clientWindow.offsetTop +'px)'
    })(document)
    </script>
    <script>
    $(document).ready(function(){
        $('#price-selector').slider({
            min: 1,
            max: 900000,
            range: true,
            steps: 75000,
            values: [150000,750000],
            create: function(event, ui) {
                $('.price-from span').text(ui.values[0]);
                $('.price-to span').text(ui.values[1]);
                $('#priceMin').val(ui.values[0]);
                $('#priceMax').val(ui.values[1]);
            },
            slide: function(event, ui) {
                $('.price-from span').text(ui.values[0]);
                $('.price-to span').text(ui.values[1]);
                $('#priceMin').val(ui.values[0]);
                $('#priceMax').val(ui.values[1]);
            }
        });
    });
    </script>
</body>
</html>
