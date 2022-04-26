<?php

if($_FILES['sub_form']['size'] == 0){
	$sub_form = "";
}else{
	$target_dir = "../uploads/";
	$target_file = $target_dir . basename($_FILES['sub_form']["name"]);
	$sub_form =  basename($_FILES['sub_form']["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if($check !== false) {
	        //echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        //echo "File is not an image.";
	        $uploadOk = 0;
	    }
	}
	// Check if file already exists
	if (file_exists($target_file)) {
	    //echo "Sorry, file already exists.";
	    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES["sub_form"]["size"] > 500000) {
	    //echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" && $imageFileType != "pdf") {
	    //echo "Sorry, only JPG, JPEG, PNG, GIF & PDF files are allowed.";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    //echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["sub_form"]["tmp_name"], $target_file)) {
	        //echo "The file ". basename( $_FILES["sub_form"]["name"]). " has been uploaded.";
	    } else {
	        //echo "Sorry, there was an error uploading your file.";
	    }
	}
}

if($_FILES['sub_receipt']['size'] == 0){
	$sub_receipt = "";
}else{
	$target_file = $target_dir . basename($_FILES['sub_receipt']["name"]);
	$sub_receipt =  basename($_FILES['sub_receipt']["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if($check !== false) {
	        //echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        //echo "File is not an image.";
	        $uploadOk = 0;
	    }
	}
	// Check if file already exists
	if (file_exists($target_file)) {
	    //echo "Sorry, file already exists.";
	    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES["sub_receipt"]["size"] > 500000) {
	    //echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" && $imageFileType != "pdf") {
	    //echo "Sorry, only JPG, JPEG, PNG, GIF & PDF files are allowed.";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    //echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["sub_receipt"]["tmp_name"], $target_file)) {
	        //echo "The file ". basename( $_FILES["sub_form"]["name"]). " has been uploaded.";
	    } else {
	        //echo "Sorry, there was an error uploading your file.";
	    }
	}
}

if($_FILES['sub_invoice']['size'] == 0){
	$sub_invoice = "";
}else{
	$target_file = $target_dir . basename($_FILES['sub_invoice']["name"]);
	$sub_invoice =  basename($_FILES['sub_invoice']["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if($check !== false) {
	        //echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        //echo "File is not an image.";
	        $uploadOk = 0;
	    }
	}
	// Check if file already exists
	if (file_exists($target_file)) {
	    //echo "Sorry, file already exists.";
	    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES["sub_invoice"]["size"] > 5000000) {
	    //echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" && $imageFileType != "pdf") {
	    //echo "Sorry, only JPG, JPEG, PNG, GIF & PDF files are allowed.";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    //echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["sub_invoice"]["tmp_name"], $target_file)) {
	        //echo "The file ". basename( $_FILES["sub_form"]["name"]). " has been uploaded.";
	    } else {
	        //echo "Sorry, there was an error uploading your file.";
	    }
	}
}


// new subscription data submission file

//pick values from subscriber form
$sub_id = $_POST['sub_id'];
$sub_start = $_POST['start_date'];
$sub_end = $_POST['end_date'];
$sub_amount = $_POST['sub_amount'];
$sub_receipt_no = $_POST['sub_receipt_no'];
$sub_invoice_no = $_POST['sub_invoice_no'];
$sub_type = $_POST['sub_type'];
if($sub_type == 'eAIP'){
	$eaip_user_name = $_POST['eaip_user_name'];
	$eaip_password = $_POST['eaip_password'];
}else{
	$eaip_user_name = "";
	$eaip_password = "";
}


//call to database connection file
require_once('db_connection_local.php');

$sql = "INSERT INTO subscriptions 
				(subscriber_id, sub_type, sub_status, sub_start_date, sub_exp_date, sub_amount, receipt_no, invoice_no, subscription_form, subscription_receipt, subscription_invoice, eaip_user_name, eaip_password)
				VALUES (
					'$sub_id',
					'$sub_type',
					'1',
					'$sub_start',
					'$sub_end',
					'$sub_amount',
					'$sub_receipt_no',
					'$sub_invoice_no',
					'$sub_form',
					'$sub_receipt',
					'$sub_invoice',
					'$eaip_user_name',
					'$eaip_password')";
//execute subscription insert query

$query = mysqli_query($conn, $sql);

$sql = "SELECT sub_name,
               sub_email
               FROM subscribers
                   where sub_id = '$sub_id'";

            $query = mysqli_query($conn, $sql);

            while ($result = mysqli_fetch_assoc($query)){
                    $sub_name = $result['sub_name'];
                    $sub_email = $result['sub_email'];
                }


$sender_email = 'ais.caa.co.ug';
$subscriber_email = $sub_email;
$name = $sub_name;
$from = $sender_email;
$topic = 'RENEWAL OF UGANDA AIP SUBSCRIPTION';
$expiry_date = date('Y-m-d', strtotime($sub_end));

if($sub_type == 'eAIP'){
$message = '
Dear '.$name.',

	Payment has been confirmed and your online subscription has been updated to '.$expiry_date.' with the same login credentials.

We at AIM Uganda look forward to meeting and exceeding your expectations this year.

To access the eAIP, go to our website https://aim.caa.co.ug/, click the eAIP link and input your login credentials.
Your login credentials will remain active for one year from today.
Kindly confirm receipt of this email and successful login.

Thank You';
}else if ($sub_type == 'CD'){
$message = '
Dear '.$name.',

	Payment has been confirmed and your CD suscription and has been updated to '.$expiry_date.'

We at AIM Uganda look forward to meeting and exceeding your expectations this year.

Your CD AIP amendments will be dispatched to you in due course.

Daily NOTAM lists and other resources are available on our website https://aim.caa.co.ug/

Kindly confirm receipt of this email.

Thank You';


}else if ($sub_type == 'paper'){
$message = '
Dear '.$name.',

	Payment has been confirmed and your Paper suscription and has been updated to '.$expiry_date.'

We at AIM Uganda look forward to meeting and exceeding your expectations this year.

Your Paper AIP amendments will be dispatched to you in due course.

Daily NOTAM lists and other resources are available on our website https://aim.caa.co.ug/

Kindly confirm receipt of this email.

Thank You';

}
           
			$subject = $topic;
								 
			$headers = 'From:'.$from . "\r\n";
			
			mail($subscriber_email, $subject, $message, $headers);



			$feedback_subject = 'NEW AIP SUBSCRIPTION - '.$name;
			$feedback_from = 'admin_aipsubscription@caa.co.ug';

			$feedback_header = 'From:'.$feedback_from . "\r\n";

			$feedback_message = '
The following email has been sent to '.$name.'

-------------------------------------------------------------------------------------------
'.$message;

			//mail('ais.caa.co.ug',$feedback_subject, $feedback_message, $feedback_header);

?>
<script type="text/javascript">
//redirect to subscriptions page
window.location.href = '../subscription-dashboard.php?menu=1&submenu=1';
</script>