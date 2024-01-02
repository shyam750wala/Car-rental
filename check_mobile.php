<?php
require_once("includes/config.php");
$number_pattern = "/^[0-9]{10}+$/";
// code user number availablity
 if (!empty($_POST["mobileno"])) {
 	$number = $_POST["mobileno"];
 	if (!preg_match($number_pattern, $number)) {

 		echo "error : You did not enter a valid number.";
 	} 
 	else {
 		$sql = "SELECT ContactNo FROM tblusers WHERE ContactNo=:mobile";
 		$numberquery = $dbh->prepare($sql);
 		$numberquery->bindParam(':mobile', $number, PDO::PARAM_STR);
 		$numberquery->execute();
 		$results = $numberquery->fetchAll(PDO::FETCH_OBJ);
 		$cnt = 1;
 		if ($numberquery->rowCount() > 0) {
 			echo "<span style='color:red'> number already exists .</span>";
 			echo "<script>$('#submit').prop('disabled',true);</script>";
 		} else {

 			echo "<span style='color:green'> number available for Registration .</span>";
 			echo "<script>$('#submit').prop('disabled',false);</script>";
 		}
	}
	
 }

?>