<?php
			$sub_id = $_GET['id'];
			$name = $_GET['nm'];
			$sub_type = $_GET['ty'];
			$exp_date = $_GET['ed'];
			$subscriber_email = $_GET['em'];
			$sender_email = 'ais.caa.co.ug';
			/*pick up post values*/
			$from = $sender_email;
            $topic = 'UGANDA AIP SUBSCRIPTION EXPIRY ALERT';
            $message = '
Dear '.$name.',

	Kindly note that your '.$sub_type.' subscription to AIP Uganda expires on '.$exp_date.'.

Thank You';
           
			$subject = $topic;
								 
			$headers = 'From:'.$from . "\r\n";
			
			mail($subscriber_email, $subject, $message, $headers);



			$feedback_subject = 'AIP SUBSCRIPTION EXPIRY ALERT - '.$name;
			$feedback_from = 'admin_aipsubscription@caa.co.ug';

			$feedback_header = 'From:'.$feedback_from . "\r\n";

			$feedback_message = '
The following email has been sent to '.$name.'

-------------------------------------------------------------------------------------------
'.$message;

			//mail('ais.caa.co.ug',$feedback_subject, $feedback_message, $feedback_header);

			header ('Location: subscriber-profile.php?menu=1&id='.$sub_id);

			

 ?>