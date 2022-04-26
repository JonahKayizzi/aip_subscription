<?php
session_start();
unset($_SESSION['logged_in']);
session_destroy();

//header("Location: index.php");
//exit;
?>
<script type="text/javascript">
	//redirect back to login page - indicate username or password incorrect
	window.location.href = 'index.php?'
</script>