<?php

session_start();

require_once("config/parameters.php");
require_once("config/connection.php");


function getSystemInmo($id) {
    if ($id == null) {
        return 'NULL';
    }else{
        if ($id == "1") {
            return 'FMLS';
        } elseif ($id == "0") {
            return 'GAMLS';
        }else{
            return $id;
        }
    }
}

function getStatus($dato2, $usuario_id)
{

    $mysql = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

    $query = $mysql->prepare("SELECT * FROM favoritos WHERE casa_dato2 = :dato2 and usuario_id = :usuario_id");
    $query->execute([
        ':dato2'      => $dato2,
        ':usuario_id' => $usuario_id,
    ]);
    $count = $query->rowCount();

    if ($count > 0) {

        // Está en mis favoritos
        return true;
    } else {

        // No está en mis favoritos
        return false;
    }
}

function changeStatus($id, $dato2, $usuario_id)
{
    $mysql = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

    $query = $mysql->prepare("SELECT * FROM favoritos WHERE casa_dato2 = :dato2 and usuario_id = :usuario_id");
    $query->execute([
        ':dato2'      => $dato2,
        ':usuario_id' => $usuario_id,
    ]);
    $count = $query->rowCount();

    if ($count > 0) {

        $queryDelete = $mysql->prepare("DELETE FROM favoritos WHERE casa_dato2 = :dato2 and usuario_id = :usuario_id");
        $queryDelete->execute([
            ':dato2'      => $dato2,
            ':usuario_id' => $usuario_id,
        ]);

        // Envía FALSE cuando la casa ya no está en mis favoritos
        return false;

    } else {

        $queryInsert = $mysql->prepare("INSERT INTO favoritos(casa_id, casa_dato2, usuario_id) VALUES(:id, :dato2, :usuario_id);");
        $queryInsert->execute([
            ':id'         => $id,
            ':dato2'      => $dato2,
            ':usuario_id' => $usuario_id,
        ]);

        // Envía TRUE cuando la casa ya pertenece a mis favoritos
        return true;

    }
}

function clearUser($usuario_id)
{
    $mysql = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

    $query = $mysql->prepare("SELECT * FROM favoritos where usuario_id = :usuario_id");
    $query->execute([
        ':usuario_id' => $usuario_id,
    ]);
    $count = $query->rowCount();

    if ($count > 0) {

        $queryDelete = $mysql->prepare("DELETE FROM favoritos WHERE usuario_id = :usuario_id");
        $queryDelete->execute([
            ':usuario_id' => $usuario_id,
        ]);

    }

    // Envía TRUE cuando la operacion finaliza correctamente
    return true;
}

if (isset($_POST['api'])) {

    if ($_POST['api'] == 'getStatus') {

        if (isset($_POST['dato2'])) {

            echo getStatus($_POST['dato2'], $_SESSION['id']);

        } else {

            echo "ERROR: No se tiene el dato2";

        }

    } elseif ($_POST['api'] == 'changeStatus') {

        if (isset($_POST['dato2']) and isset($_POST['usuario_id'])) {

            echo changeStatus($_POST['id'], $_POST['dato2'], $_POST['usuario_id']);

        } else {

            echo "ERROR: No se tiene el dato2 o usuario_id";

        }

    } elseif ($_POST['api'] == 'clearUser') {

        echo clearUser($_SESSION['id']);

    }

}
