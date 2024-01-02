<?php
require_once("includes/config.php");
// code user email availablity
$number_pattern = "/^[0-9]{10}+$/";
// code user number availablity
if (!empty($_POST["mobileno"])) {
	$number = $_POST["mobileno"];
	if (!preg_match($number_pattern, $number)) {

		echo "error : You did not enter a valid number.";
	} 
	else {
		$sql = "SELECT ContactNo FROM tblusers WHERE ContactNo=:mobileno";
		$numberquery = $dbh->prepare($sql);
		$numberquery->bindParam(':mobileno', $number, PDO::PARAM_STR);
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

if (!empty($_POST["emailid"])) {
	$email = $_POST["emailid"];
	if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {

		echo "<span style='color:red'> Please Enter valid email address.</span>";
	} else {
		$sql = "SELECT EmailId FROM tblusers WHERE EmailId=:email";
		$query = $dbh->prepare($sql);
		$query->bindParam(':email', $email, PDO::PARAM_STR);
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_OBJ);
		$cnt = 1;
		if ($query->rowCount() > 0) {
			echo "<span style='color:red'> Email already exists .</span>";
			echo "<script>$('#submit').prop('disabled',true);</script>";
		} else {

			echo "<span style='color:green'> Email available for Registration .</span>";
			echo "<script>$('#submit').prop('disabled',false);</script>";
		}
	}
	
}



