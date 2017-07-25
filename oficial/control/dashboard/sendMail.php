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

// PHPMailer

require '../resources/PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

// $mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'user@example.com';                 // SMTP username
$mail->Password = 'secret';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom($mailFrom, 'Mailer');
// $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
$mail->addAddress($mailTo);                           // Name is optional
$mail->addReplyTo('info@example.com', 'Information');
// $mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');

// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = $bodyContent;
$mail->AltBody = strip_tags($bodyContent);

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
