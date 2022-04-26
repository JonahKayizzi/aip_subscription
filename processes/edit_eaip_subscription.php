<?php
//call to database connection file
require_once('db_connection_local.php');

//pick values from subscriber form
$sup_id = $_POST['sup_id'];
$sub_id = $_POST['sub_id'];
$sub_start = $_POST['start_date'];
$sub_end = $_POST['end_date'];
$sub_amount = $_POST['sub_amount'];
$sub_receipt_no = $_POST['sub_receipt_no'];
$sub_invoice_no = $_POST['sub_invoice_no'];
$eaip_user_name = $_POST['eaip_user_name'];
$eaip_password = $_POST['eaip_password'];

if($_FILES['sub_form']['size'] == 0){
	//$sub_form = "";
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

	echo $sub_form;
	echo $sup_id;
	$sql = "UPDATE subscriptions
		SET subscription_form = '$sub_form'
			WHERE 
				id = '$sup_id'";

	$query = mysqli_query($conn, $sql);
}

if($_FILES['sub_receipt']['size'] == 0){
	//$sub_receipt = "";
}else{
	$target_dir = "../uploads/";
	$target_file = $target_dir.basename($_FILES['sub_receipt']["name"]);
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
	$sql = "UPDATE subscriptions
		SET subscription_receipt = '$sub_receipt'
			WHERE 
				id = '$sup_id'";

		$query = mysqli_query($conn, $sql);
}

if($_FILES['sub_invoice']['size'] == 0){
	//$sub_invoice = "";
}else{
	$target_dir = "../uploads/";
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

	$sql = "UPDATE subscriptions
		SET subscription_invoice = '$sub_invoice'
			WHERE 
				id = '$sup_id'";

	$query = mysqli_query($conn, $sql);

}




$sql = "UPDATE subscriptions
		SET sub_start_date = '$sub_start',
			sub_exp_date = '$sub_end',
			sub_amount = '$sub_amount',
			receipt_no = '$sub_receipt_no',
			invoice_no = '$sub_invoice_no',
			eaip_user_name = '$eaip_user_name',
			eaip_password = '$eaip_password'
			WHERE 
				id = '$sup_id'";

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
$topic = 'UGANDA AIP SUBSCRIPTION UPDATE';
$message = '
Dear '.$name.',

	AIM Uganda is pleased to inform you that your online access for AIP Uganda has been updated with the following login credentials.
Username: '.$eaip_user_name.'
Password: '.$eaip_password.'

To access the eAIP, go to our website https://aim.caa.co.ug/, click the eAIP link and input your login credentials.
Your login credentials will remain active for one year from today.
Kindly confirm receipt of this email and successful login.

Thank You';
           
			$subject = $topic;
								 
			$headers = 'From:'.$from . "\r\n";
			
			mail($subscriber_email, $subject, $message, $headers);



			$feedback_subject = 'AIP SUBSCRIPTION UPDATE - '.$name;
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
window.location.href = '../subscriber-profile.php?menu=1&id=<?php echo $sub_id; ?>';
</script>