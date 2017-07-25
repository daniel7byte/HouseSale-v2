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

function getEmail($id){
  $mysql = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

  $query = $mysql->prepare("SELECT mail FROM usuarios WHERE id = :usuario_id");
  $query->execute([
      ':usuario_id' => $id,
  ]);
  $rows = $query->fetchAll();
  foreach ($rows as $row){
    $mailFrom = $row['mail'];
  }
  return $mailFrom;
}

$mailFrom = getEmail($_POST['usuario_id']);
$mailTo = $_POST['mailTo'];
$bodyContent = $_POST['body'];

// SendInBlue
