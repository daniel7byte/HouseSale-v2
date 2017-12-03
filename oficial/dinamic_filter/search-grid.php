<?php

// Favoritos
require_once('../control/funcFavoritos.php');
if(isset($_SESSION['usuario'])){
    $loggedIn = true;
}else{
    $loggedIn = false;
}

$id = $_GET['id'];
$zipcode = $_GET['zipcode'];
$county = $_GET['county'];
$city = $_GET['city'];
$priceMin = $_GET['priceMin'];
$priceMax = $_GET['priceMax'];
$system = $_GET['systemFiltro'];
$keyword = $_GET['keyword'];

include("../datosiniciales.php");

try {
    $mysql = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit;
}

// KEYWORD
if($keyword != ''){

    $query = $mysql->prepare("SELECT * FROM datoscasas WHERE dato7 LIKE :keyword AND dato24 LIKE :zipcode AND dato6 = 'A'");
    $query->execute([
        ':keyword' => "%$keyword%",
        ':zipcode' => "%$zipcode%"
    ]);
    $rows = $query->fetchAll();

    foreach ($rows as $row):

        include('tpl-property-grid.php');

    endforeach;

    exit;
}

// IDENTIFICADOR
if($id != ''){

    $query = $mysql->prepare("SELECT * FROM datoscasas WHERE dato2 LIKE :id AND dato6 = 'A'");
    $query->execute([':id' => "%$id%"]);
    $rows = $query->fetchAll();

    foreach ($rows as $row):

        include('tpl-property-grid.php');

    endforeach;

}else{

    if($priceMax < 9999999) {
        $queryOne = $mysql->prepare("SELECT * FROM datoscasas WHERE dato11 LIKE :county AND dato10 LIKE :city AND dato5 >= :priceMin AND dato5 <= :priceMax  AND dato6 = 'A' AND dato24 LIKE :zipcode AND id LIKE :system");

        $queryOne->execute([
            ':zipcode' => "%$zipcode%",
            ':county' => "%$county%",
            ':system' => "%$system%",
            ':city' => "%$city%",
            ':priceMin' => $priceMin,
            ':priceMax' => $priceMax
        ]);
    } else {
        $queryOne = $mysql->prepare("SELECT * FROM datoscasas WHERE dato11 LIKE :county AND dato10 LIKE :city AND dato5 >= :priceMin AND dato6 = 'A' AND dato24 LIKE :zipcode AND id LIKE :system");

        $queryOne->execute([
            ':zipcode' => "%$zipcode%",
            ':county' => "%$county%",
            ':system' => "%$system%",
            ':city' => "%$city%",
            ':priceMin' => $priceMin
        ]);
    }

    $rowsOne = $queryOne->fetchAll();

    foreach ($rowsOne as $row):

        include('tpl-property-grid.php');

    endforeach;

}
