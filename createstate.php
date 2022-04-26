<?php 
	
	session_start();
	error_reporting(E_ALL ^ E_NOTICE);
	error_reporting(E_STRICT);	
    
	
	if(!isset($_SESSION['sess_role']) && $_SESSION['sess_role'] !="Administrator")
	{
	
	$_SESSION['error']="Please login to access this page";
	session_write_close();
	header("Location: ../../logout.php");
	
	}
	
		include '../../connection.php';
	
	try {
		$countryname = trim($_POST['cname']);
		$icaocode = trim($_POST['icao_code']);
		$postalcode = trim($_POST['pcode']);
		$fax = trim($_POST['fax']);
		$email = trim($_POST['email']);
		$tel = trim($_POST['tel']);
		$aftn = trim($_POST['aftn']);
		$n_fir = trim($_POST['n_fir']);
		
	

		$stmt1 = $db->prepare("SELECT * FROM countries WHERE countryname=:countryname"); 
		$stmt1->bindParam(':countryname', $countryname);
		$stmt1->execute();
		
		//die($countryname);
		if ($stmt1->rowCount() <= 0) {
			$stmt2 = $db->prepare("INSERT INTO countries (countryname, postalcode, fax, email, tel,	AFTN, ICAO_code, n_fir) VALUES (:countryname, :postalcode, :fax, :email, :tel, :AFTN, :icao_code, :n_fir)");
			$stmt2->bindParam(':countryname', $countryname);
			$stmt2->bindParam(':postalcode', $postalcode);
			$stmt2->bindParam(':fax', $fax);
			$stmt2->bindParam(':email', $email);
			$stmt2->bindParam(':tel', $tel);
			$stmt2->bindParam(':AFTN', $aftn);
			$stmt2->bindParam(':n_fir', $n_fir);
			$stmt2->bindParam(':icao_code', $icaocode);
			$stmt2->execute();
			
			$_SESSION['success']= "Country Successfully registered";
			session_write_close();
			header('Location: states.php');

		} 
		
		else{
			$_SESSION['success']= "Country Registration Failed - state already exists - ". $countryname ;
			session_write_close();
			header('Location: states.php');

		}
 
		
			
	}
		
 catch(PDOException $ex) {
    echo "An Error occured!".$ex->getMessage();
}
$db = null;
	
?>