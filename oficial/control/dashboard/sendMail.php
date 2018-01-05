<?php

session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ' . APP_URL . 'index.php');
    exit;
}

if(is_readable("control/config/parameters.php")) {
  include_once("control/config/parameters.php");
} else if (is_readable("../config/parameters.php")) {
  require_once '../config/parameters.php';
}

if(is_readable("control/config/connection.php")) {
  include_once("control/config/connection.php");
} else if (is_readable("../config/connection.php")) {
  require_once '../config/connection.php';
}

$mailFrom = "daniel7byte@gmail.com";
$mailTo = $_POST['mailTo'];
$bodyContent = $_POST['body'];

// Send

$res = "NULL";

echo $res;
