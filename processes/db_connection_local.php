 <?php
// database connection file - local host
 
    $servername = "localhost";
    $username = "root";
    //$password = "Aim@fps321";  //dev 2
	$password = "";  //dev 2
    $dbname = "aip_sub";
            
    //Create connection
    $conn = new mysqli ($servername, $username, $password, $dbname);

 ?>