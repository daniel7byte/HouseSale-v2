<?php

    /* ------------------------------------------------------------------------------------------------
     * Filtro: Si el usuario no viene através del formulario. Se expulsa.
     * ------------------------------------------------------------------------------------------------
     */
    /*
     if(empty($_GET) OR $_GET["key"] !== "j.%0a2ede56f6523e16b6a2794c26921580%") {
         header("Location:./");
     }
     */

    include("../datosiniciales.php");
    include("../lang/langHandler.php");

    try {
        $mysql = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }


    require_once("system/filter/search-grid.php");

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
    <script src="https://use.fontawesome.com/9e7d1bdf6f.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1LHwSTnFdkSm9dA8CrIpicTLLCUJ7i7w" ></script>
    <script src="assets/js/gmaps.min.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
        var map;

        var styleArray = [{"featureType":"administrative.country","elementType":"labels.icon","stylers":[{"visibility":"on"}]}];

        $(document).ready(function(){
            map = new GMaps({
                div: '#map',
                lat: 33.756944,
                lng: -84.390278,
                zoom: 8,
                styles: styleArray
            });
        });

        // Funcion que carga las coordenadas
        function load(str, html){
          GMaps.geocode({
            address: str.trim(),
            callback: function(results, status){
              if(status=='OK'){
                var latlng = results[0].geometry.location;
                // map.setCenter(latlng.lat(), latlng.lng());
                map.addMarker({
                  lat: latlng.lat(),
                  lng: latlng.lng(),
                  infoWindow: {
                    content: html
                  }
                });
              }
            }
          });
        }

        function loadMarket(lat, lng, html, domId){
          var marker = map.addMarker({
            lat: lat,
            lng: lng,
            infoWindow: {
              content: html
            }
          });

          $("#"+domId).attr("data-marker-index", map.markers.indexOf(marker));
        }

        function loadGetGeo(str, html, domId){
          GMaps.geocode({
            address: str.trim(),
            callback: function(results, status){
              if(status == 'OK'){
                var latlng = results[0].geometry.location;
                var string = (latlng.lat() + '|' + latlng.lng()).split('|');

                // Asigna Valores
                $("#"+domId).attr("data-marker-lat", string[0]);
                $("#"+domId).attr("data-marker-lng", string[1]);

                // Crea market
                loadMarket(string[0], string[1], html, domId);
              }
            }
          });
        }

        $(document).on('click', '.set-to-marker', function(e) {
          e.preventDefault();

          var lat, lng;
          var $index = $(this).data('marker-index');
          var $lat = $(this).data('marker-lat ');
          var $lng = $(this).data('marker-lng');

          if ($index != undefined) {
            // using indices

            var $marker = map.markers[$index];

            var position = $marker.getPosition();
            lat = position.lat();
            lng = position.lng();

            map.setCenter(lat, lng);
            map.setZoom(15);

            $marker.infoWindow.open(map, $marker);

          } else {
            if ($lat != undefined || $lng != undefined) {
              // using coordinates
                lat = $lat;
                lng = $lng;

                map.setCenter(lat, lng);
                map.setZoom(15);

            } else {
              console.warn("No se tienen coordenadas");
            }
          }

        });
    </script>
</head>
<body class="sale-template">

    <?php include("header.php"); ?>

  <main class="main">
        <?php include("blocks/filter-section.php"); ?>
        <section class="pre-search">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <h3>Georgia, GA Homes For Sale & Real Estate</h3>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="allies">
                            <ul class="allies__list">
                                <li class="allies__item"><img src="http://www.joygle.com/assets/media-demo/partners/logo-company-2.png" alt=""></li>
                                <li class="allies__item"><img src="http://www.joygle.com/assets/media-demo/partners/logo-company-1.png" alt=""></li>
                                <li class="allies__item"><img src="http://www.joygle.com/assets/media-demo/partners/logo-company-4.png" alt=""></li>
                                <li class="allies__item"><img src="http://www.joygle.com/assets/media-demo/partners/logo-company-5.png" alt=""></li>
                                <li class="allies__item"><img src="http://www.joygle.com/assets/media-demo/partners/logo-company-3.png" alt=""></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="flex">
            <section class="section card-section">
                <div class="container">
                    <div class="row">
                        <?php
                            foreach ($rows as $row):

                                $price = "$" . number_format($row["dato5"]);
                        ?>
                                <div class="col-xs-6">
                                    <div class="card set-to-marker" id="<?=$row['dato2']?>">
                                        <div class="card__thumbnail" style="background-image:url(../dinamic_filter/getImages.php?id=<?=$row['dato2']?>&w=640&h=436)"></div>
                                        <div class="card__content">
                                            <div class="card__content__price"><?=$price?></div>
                                            <div class="card__content__details">N/A</div>
                                            <div class="card__content__street"><?=$row["dato7"]?></div>
                                            <div class="card_content__city"><?=$row["dato10"]?>, <?=$row["dato11"]?>, GA <?=$row["dato24"]?>, US</div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            endforeach;
                        ?>
                    </div>
                </div>
            </section>
            <section class="section">
                <div id="map"></div>
            </section>
        </div>
    </main>
    <script>
      <?php

        $count = 0;

          foreach ($rows as $row):

              $price = "$" . number_format($row["dato5"]);

              $geostr = trim($row['dato7'] . ', ' . $row['dato10'] . ', '. $row['dato11'] . ', GA ' . $row['dato24'] . ', US');
              $geohtml = trim(
                '<h3>'. $geostr . '</h3>' .
                '<h4>' . $price . '</h4>' .
                '<p>' . $row['description'] . '</p>' .
                '<a ' . " class='btn btn-joygle' href='../property_details.php?id=" . $row['dato2'] . "'> More information </a>"
              );

              $count += 500;

              echo trim('
                setTimeout(function(){
                   loadGetGeo("'.$geostr.'", "'.$geohtml.'", "'.$row['dato2'].'"); }, ' . $count . '
                );
              ');

          endforeach;
      ?>
    </script>
    <script>
    // Fixing height of main tag
    ((d)=>{
        let   clientWindow = d.querySelector('.flex')
        clientWindow.style.maxHeight = 'calc(100% - '+ clientWindow.offsetTop +'px)'
    })(document)
    </script>
    <script src="../assets/sweetalert/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../assets/sweetalert/sweetalert.css">

    <script>
    $( "form" ).submit(function( event ) {
        if ( $( "#zipcode" ).val() == "" ) {
            if ( $( "#city" ).val() == "-" ) {
                if ( $( "#county" ).val() != "-" ) {
                    return;
                }
            }else{
                return;
            }
        }else{
            return;
        }

        sweetAlert("", "Select a field. City or County!", "error");
        event.preventDefault();
    });
    </script>
    <script>
    $(document).ready(function(){
        $('#price-selector').slider({
            min: 1,
            max: 9999999,
            range: true,
            steps: 100000,
            values: [1,9999999],
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

                if(ui.values[1] == 9999999) {
                    $(".price-to .plus").css({ display: 'inline-block' });
                } else {
                    $(".price-to .plus").css({ display: 'none' });
                }
            }
        });
    });
    </script>
</body>
</html>
