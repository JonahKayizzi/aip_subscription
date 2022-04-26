<?php

$sub_to_delete = $_GET['sub_id'];

include_once("db_connection_local.php");

$sql = "DELETE from subscribers WHERE sub_id = '$sub_to_delete'";

$query = mysqli_query($conn, $sql);

$sql = "DELETE from subscriptions WHERE subscriber_id = '$sub_to_delete'";

$query = mysqli_query($conn, $sql);

?>

<script type="text/javascript">
	//redirect to subscribers page
	window.location.href = '../subscribers.php?menu=2';
</script>