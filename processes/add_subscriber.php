<?php
// new subscriber data submission file

//pick values from subscriber form
$sub_name = $_POST['subscriber_name'];
$sub_cat = $_POST['subscriber_category'];
$sub_email = $_POST['subscriber_email'];
$sub_phy = $_POST['subscriber_phy_add'];
$sub_tel = $_POST['subscriber_tel'];
$sub_postal = $_POST['subscriber_post_add'];
$sub_other_contact = $_POST['subscriber_other_contact'];
$sub_contact_per = $_POST['subscriber_contact_person'];

//call to database connection file
require_once('db_connection_local.php');

//query to check if subscriber already exists database
$sql_exists = "SELECT * FROM subscribers
					WHERE
					sub_name = '$sub_name'";

//execute query to check if subscriber already exists
$query_exists = mysqli_query($conn, $sql_exists);

//count number of times subsscriber exists
$sub_exists = mysqli_num_rows($query_exists);

//if subscriber exists atleast once
if ($sub_exists > 0){

	?>
	<script type="text/javascript">
	//redirect to subscriber form indicating subscriber exists
	window.location.href = '../add-subscriber.php?menu=2&exists=1';
	</script>
	<?php

}else{ //if subscriber does not exist

	//subscriber insert query
	$sql = "INSERT INTO subscribers 
					(sub_name, sub_category, sub_email, phy_address, sub_telephone, sub_box_number, sub_other_contact_info, sub_contact_per)
					VALUES (
						'$sub_name',
						'$sub_cat',
						'$sub_email',
						'$sub_phy',
						'$sub_tel',
						'$sub_postal',
						'$sub_other_contact',
						'$sub_contact_per')";
	//execute subscriber insert query
	$query = mysqli_query($conn, $sql);

	?>
	<script type="text/javascript">
	//redirect to subscribers page
	window.location.href = '../subscribers.php?menu=2';
	</script>
	<?php
	}
	?>