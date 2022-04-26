<?php
require '/usr/share/php/libphp-phpmailer/class.phpmailer.php';
require '/usr/share/php/libphp-phpmailer/class.smtp.php';
$mail = new PHPMailer;
$mail->setFrom('publication@caa.co.ug');
$mail->addAddress('jonathan@caa.co.ug');
$mail->Subject = 'Message sent by PHPMailer';
$mail->Body = 'Hello! use PHPMailer to send email using PHP';


$mail->IsSMTP();
$mail->SMTPSecure = 'ssl';
$mail->Host = 'ssl://mail.caa.co.ug';
$mail->SMTPAuth = true;
$mail->Port = 587;

//Set your existing gmail address as user name
$mail->Username = <a href="mailto:'jonathan@caa.co.ug">'ais@caa.co.ug</a>';

//Set the password of your gmail address here
$mail->Password = 'publication';
if(!$mail->send()) {
  echo 'Email is not sent.';
  echo 'Email error: ' . $mail->ErrorInfo;
} else {
  echo 'Email has been sent.';
}
?>
