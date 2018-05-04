<?php
  // session_start();
  // if(!isset($_SESSION['usuario'])){
  //   header('Location: ' . APP_URL . 'index.php');
  //   exit;
  // }

  require_once('../config/parameters.php');
  require_once('../config/connection.php');
  require_once('funcFavoritos.php');

  $query = $mysql->prepare("SELECT * FROM usuarios ORDER BY id DESC");
  $query->execute();
  $rows = $query->fetchAll();

  $urlMain = 'http://www.joygle.com/property_details.php?id=';

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?=APP_URL?>resources/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=APP_URL?>resources/css/flatly.min.css">
    <link rel="stylesheet" href="<?=APP_URL?>resources/datatables/css/jquery.dataTables.min.css">
    <title>Mis Favoritos</title>
    <style media="screen">
      tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
      }
    </style>
    <script src="<?=APP_URL?>resources/js/jquery-1.12.3.js" charset="utf-8"></script>
    <script>
    function createUser() {
      var user = prompt("Usuario: ");
      var mail = prompt("Mail: ");
      var password = prompt("Contraseña: ");
      //var rol = prompt("Rol, dijite: \n 1.Admin \n 2.User");
      var rol = 1;
      if (user && mail && password && rol) {

        $.ajax({
        type: 'POST',
          url: 'funcUsuarios.php',
          data: {
            api: 'createUser',
            user: user,
            mail: mail,
            password: password,
            rol: rol
          },
          success: function(result){
            alert(result);
            location.reload(true);
          }
        });
      } else {
        alert('No llenó los datos correctamente');
      }
    }
    function changeMail(id) {
      var mail = prompt("Nuevo mail: ");
      if (mail) {
        $.ajax({
        type: 'POST',
          url: 'funcUsuarios.php',
          data: {
            api: 'changeMail',
            id: id,
            mail: mail
          },
          success: function(result){
            $('#mail_' + id).html(mail);
          }
        });
      }
    }
    function changePassword(id) {
      var password = prompt("Nueva contraseña: ");
      if (password) {
        $.ajax({
        type: 'POST',
          url: 'funcUsuarios.php',
          data: {
            api: 'changePassword',
            id: id,
            password: password
          },
          success: function(result){
            alert(result);
          }
        });
      }
    }
    </script>
  </head>
  <body style="padding-top: 60px;">

    <?php include('layouts/navbar.php'); ?>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2>Usuarios
            <a target="_blank" onclick="event.preventDefault(); createUser()" class="btn btn-success">
              Crear Usuario
              <span class="glyphicon glyphicon-plus"></span>
            </a>
          </h2>
          <hr>
          <div class="row">
            <div class="col-md-12">
              <table class="table table-striped table-hover ">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Usuario</th>
                    <th>Mail</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $contador = 0;
                    foreach ($rows as $row):
                  ?>
                    <tr id="<?=$row['id']?>">
                      <td><?=$row['id']?></td>
                      <td><?=$row['usuario']?></td>
                      <td id="mail_<?=$row['id']?>"><?=$row['mail']?></td>
                      <td><?=$row['rol']?></td>
                      <td>
                        <a target="_blank" onclick="event.preventDefault(); changeMail(<?=$row['id']?>)" class="btn btn-info btn-xs">
                          <span class="glyphicon glyphicon-envelope"></span>
                        </a>
                        <a target="_blank" onclick="event.preventDefault(); changePassword(<?=$row['id']?>)" class="btn btn-danger btn-xs">
                          <span class="glyphicon glyphicon-wrench"></span>
                        </a>
                      </td>
                    </tr>
                  <?php
                    endforeach;
                  ?>
                </tbody>
              </table>
              <hr>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="<?=APP_URL?>resources/bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
  </body>
</html>
