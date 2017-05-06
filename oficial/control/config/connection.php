<?php
// Conexion PDO con base de datos
try {
  $mysql = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
} catch (Exception $e) {
  echo "Error: " . $e->getMessage();
  exit;
}

// Enlace con repositorio de funciones que asistirán en la aplicación
if(is_readable("includes/functions.php")) {
  include_once("includes/functions.php");
} else if (is_readable("../includes/functions.php")) {
  include_once("../includes/functions.php");
}