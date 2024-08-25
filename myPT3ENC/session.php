<?php
include_once 'db.php';

session_start(); 
	
	$sid = $_SESSION['sid'];
	
	$stmt = $conn->prepare("SELECT * FROM tbl_staff_a196330 WHERE FLD_STAFF_ID = '$sid'");

	$stmt->execute();
	
	$readrow = $stmt->fetch(PDO::FETCH_ASSOC);

	$sid = $readrow['FLD_STAFF_ID'];
	$name = $readrow['FLD_STAFF_NAME'];
	$email = $readrow['FLD_STAFF_EMAIL'];
	$gender = $readrow['FLD_STAFF_GENDER'];
    $phone = $readrow['FLD_STAFF_NOPHONE'];
	$pass= $readrow['FLD_STAFF_PASS'];
	$level = $readrow['FLD_STAFF_LEVEL'];
	
		
if($sid==''){
	header("location:login.php");
	}
	else {
	header("");
	}
?>