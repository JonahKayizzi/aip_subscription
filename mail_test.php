<?php

require_once('smtp_client.php');

$subscriber_email = 'jonathan@caa.co.ug';
$name = 'Jonathan';
$subject = 'NEW UGANDA AIP SUBSCRIPTION';
$message = "
Dear '.$name.',

	AIM Uganda is pleased to inform you that your online access for AIP Uganda has been activated with the following login credentials.

To access the eAIP, go to our website https://aim.caa.co.ug/, click the eAIP link and input your login credentials.
Your login credentials will remain active for one year from today.
Kindly confirm receipt of this email and successful login.

Thank You";



$smtpClient = new SMTPClient();
$smtpClient->setServer("mail.caa.co.ug", "587", true);
		$smtpClient->setSender("publication@caa.co.ug",
								"publication");

$smtpClient->setMail('$subscriber_email', '$subject',
								'$message');


$smtpClient->sendMail();


/*

			$feedback_subject = 'NEW AIP SUBSCRIPTION - '.$name;
	
		

			$feedback_message = '
The following email has been sent to '.$name.'

-------------------------------------------------------------------------------------------
'.$message;

			mail('louise@caa.co.ug',$feedback_subject, $feedback_message, $feedback_header);



$smtpClient->setMail('louise@caa.co.ug', $feedback_subject,
								$feedback_message);

//$smtpClient->attachFile("Texte.txt", file_get_contents("./myTextFile.txt");
//$smtpClient->attachFile("Image.PNG", file_get_contents("./myImageFile.png"));
$smtpClient->sendMail();

	

*/


?>
