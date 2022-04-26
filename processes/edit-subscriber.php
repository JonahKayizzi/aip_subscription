<?php
// edit subscriber data submission file

$sub_id = $_POST['sub_id'];

//pick values from subscriber form
$sub_name = $_POST['subscriber_name'];
$sub_cat = $_POST['subscriber_category'];
$sub_email = $_POST['subscriber_email'];
$sub_phy = $_POST['subscriber_phy_add'];
$sub_tel = $_POST['subscriber_tel'];
$sub_contact_per = $_POST['subscriber_contact_person'];
$sub_postal = $_POST['subscriber_post_add'];
$sub_other_contact = $_POST['subscriber_other_contact'];

//call to database connection file
require_once('db_connection_local.php');

//subscriber insert query
$sql = "UPDATE subscribers SET
				sub_name ='$sub_name',
				sub_category ='$sub_cat',
				sub_email =	'$sub_email',
				phy_address = '$sub_phy',
				sub_telephone =	'$sub_tel',
				sub_contact_per = '$sub_contact_per',
				sub_box_number = '$sub_postal',
				sub_other_contact_info = '$sub_other_contact' 
				WHERE sub_id = '$sub_id' ";
//execute subscriber insert query
$query = mysqli_query($conn, $sql);

?>
<script type="text/javascript">
//redirect to subscribers page
window.location.href = '../subscribers.php?menu=2';
</script>