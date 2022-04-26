<?php
require '/usr/share/php/PHPMailer-master/src/PHPMailer.php';
require '/usr/share/php/PHPMailer-master/src/Exception.php';
require '/usr/share/php/PHPMailer-master/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";

$mail->IsHTML(true);
$mail->setFrom('publication@caa.co.ug');
$mail->addAddress('publication@caa.co.ug', 'Kayizzi Jonathan');
$mail->Subject = 'Message sent by PHPMailer';

$content = "<b>This is a Test Email sent via Gmail SMTP Server using PHP mailer class.</b>";
$mail->MsgHTML($content);

$mail->Host = 'mail.caa.co.ug';
$mail->SMTPAuth = false;
$mail->Port = 587;

//Set your existing gmail address as user name
$mail->Username = 'publication@caa.co.ug';

//Set the password of your gmail address here
$mail->Password = 'publication';
if(!$mail->Send()) {
  echo 'Email is not sent.';
  echo 'Email error: ' . $mail->ErrorInfo;
} else {
  echo 'Email has been sent.';
}
?>

