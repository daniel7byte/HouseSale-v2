<?php

//TIMEZONE
date_default_timezone_set('America/New_York');

session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ' . APP_URL . 'index.php');
    exit;
}

$mailTo = $_GET['mailTo'];
$body = $_GET['body'];

/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//SMTPOptions
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;

$mail->Host = 'smtp.gmail.com';                       //Set the hostname of the mail server
$mail->Port = 587;                                    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->SMTPSecure = 'tls';                            //Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPAuth = true;                               //Whether to use SMTP authentication
$mail->Username = "info@joygle.com";                  //Username to use for SMTP authentication - use full email address for gmail
$mail->Password = "@Entrada1";                        //Password to use for SMTP authentication


//Recipients
$mail->setFrom('info@joygle.com', 'Joygle Inc');
$mail->addAddress('info@joygle.com', 'Joygle Inc');          // Add a recipient & Name is optional
$mail->addAddress($mailTo);
//$mail->addAddress('daniel7byte@gmail.com', 'Jose Daniel Posso Garcia');
$mail->addReplyTo('info@joygle.com', 'Joygle Inc');

//Content
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Title : ??? | ' . date('r'); // ISO 8601
$mail->Body    = $body;
$mail->AltBody = 'New message of Joygle';

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Done!";
}
?>
