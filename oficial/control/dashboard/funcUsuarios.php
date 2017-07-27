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

function changeMail($id, $mail)
{

    $mysql = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

    $query = $mysql->prepare("UPDATE usuarios SET mail = :mail WHERE id = :id");
    $query->execute([
        ':mail' => $mail,
        ':id' => $id
    ]);

    if($query) return true;
}

function changePassword($id, $password)
{

    $mysql = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

    $options = [
      'cost' => 12,
    ];

    $hash = password_hash($password, PASSWORD_BCRYPT, $options);

    $query = $mysql->prepare("UPDATE usuarios SET contrasenia = :contrasenia WHERE id = :id");
    $query->execute([
        ':contrasenia' => $hash,
        ':id' => $id
    ]);

    if($query) echo "Contraseña cambiada";
}

function createUser($usuario, $password, $mail, $rol)
{
    $mysql = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

    $rol = ($rol == 1 ? 'ADMIN' : 'USER');

    $options = [
      'cost' => 12,
    ];

    $hash = password_hash($password, PASSWORD_BCRYPT, $options);

    $query = $mysql->prepare("INSERT INTO usuarios (id, usuario, contrasenia, rol, mail) VALUES (NULL, :usuario, :contrasenia, :rol, :mail)");
    $query->execute([
        ':usuario' => $usuario,
        ':contrasenia' => $hash,
        ':rol' => $rol,
        ':mail' => $mail
    ]);

    if($query) echo "Usuario creado";
}

if (isset($_POST['api'])) {

    if ($_POST['api'] == 'changeMail') {

      changeMail($_POST['id'], $_POST['mail']);

    } elseif ($_POST['api'] == 'changePassword') {

      changePassword($_POST['id'], $_POST['password']);

    } elseif ($_POST['api'] == 'createUser') {

      createUser($_POST['user'], $_POST['password'], $_POST['mail'], $_POST['rol']);

    }

}
