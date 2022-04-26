<?php

$sup_to_end = $_GET['sup_id'];
$sub_id = $_GET['sub_id'];

include_once("processes/db_connection_local.php");

$sql = "UPDATE subscriptions
		SET sub_status = 0
		where id = '$sup_to_end'";

$query = mysqli_query($conn, $sql);

?>

<script type="text/javascript">
	//redirect to subscribers page
	window.location.href = 'subscriber-profile.php?menu=1&id=<?php echo $sub_id; ?>';
</script>