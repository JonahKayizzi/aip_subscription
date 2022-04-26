<?php

//check if email & password have been submitted 
if(isset($_POST['email']) && isset($_POST['password'])){
	//assign submitted email & password to php variable
	$user_email = $_POST['email'];
	$user_password = $_POST['password'];
        $user_password = md5($user_password);
	//call database connection file
	require_once('db_connection_local.php');

	//query to check if submitted email and password exist
	$sql = "SELECT * FROM aip_sub.users 
				WHERE user_email = '$user_email'
				AND password = '$user_password'";

	//execute the query
	$query = mysqli_query($conn, $sql);

	//count number of records return with the submitted email and password
	$user_exists = mysqli_num_rows($query);

	//check if any record exists
	if ($user_exists > 0) {
		session_start();
		$_SESSION['logged_in'] = $user_email;
		?>
		<script type="text/javascript">
			//redirect back to login page - indicate username or password incorrect
			//window.location.href = '../subscription-dashboard.php'   //dev 2
			window.location.href = '../subscribers.php?menu=2'  //dev 2

		</script>
		<?php
	}else{	//if no record of submitted email and password
		?>
			<script type="text/javascript">
				//redirect back to login page - indicate username or password incorrect
				//window.location.href = '../index.php?login_failed=1'
			</script>
		<?php
	}

}
?>
<script type="text/javascript">
	//redirect back to login page - indicate username or password incorrect
	window.location.href = '../forbidden.php?'
</script>
