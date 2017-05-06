<?php

// Validar sesion

session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: ' . APP_URL . 'index.php');
    exit;
}elseif($_SESSION['rol'] != 'ADMIN'){
    header('Location: ' . APP_URL . 'index.php');
    exit;
}

// Conexion

require_once('../config/parameters.php');

$mysql = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$queryUpdate = $mysql->query('DELETE FROM datoscasas WHERE dato6 != "A";');
if ($queryUpdate) {
    header('location: index.php');
}else{
    echo "ERROR?";
}