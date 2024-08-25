<?php
 
include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
 
  try {
 
    $stmt = $conn->prepare("INSERT INTO tbl_customers_a196330(FLD_CUST_ID, FLD_CUST_NAME,
      FLD_CUST_EMAIL, FLD_CUST_PHONE, FLD_CUST_ADDRESS) VALUES(:cid, :fname, :mail,
      :phone, :address)");
   
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
    $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
    $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':address', $address, PDO::PARAM_STR);
       
    $cid = $_POST['cid'];
    $fname = $_POST['fname'];
    $mail = $_POST['mail'];
    $phone =  $_POST['phone'];
    $address = $_POST['address'];
       
    $stmt->execute();
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Update
if (isset($_POST['update'])) {
   
  try {
 
    $stmt = $conn->prepare("UPDATE tbl_customers_a196330 SET FLD_CUST_ID = :cid,
      FLD_CUST_NAME= :fname, 	FLD_CUST_EMAIL= :mail,
      FLD_CUST_PHONE = :phone, FLD_CUST_ADDRESS = :address
      WHERE FLD_CUST_ID = :oldcid");
   
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
    $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
    $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
     $stmt->bindParam(':address', $address, PDO::PARAM_STR);
    $stmt->bindParam(':oldcid', $oldcid, PDO::PARAM_STR);
       
    $cid = $_POST['cid'];
    $fname = $_POST['fname'];
    $mail = $_POST['mail'];
    $phone = $_POST['phone'];
     $address =  $_POST['address'];
    $oldcid = $_POST['oldcid'];
       
    $stmt->execute();
 
    header("Location: customers.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Delete
if (isset($_GET['delete'])) {
 
  try {
 
    $stmt = $conn->prepare("DELETE FROM tbl_customers_a196330 WHERE FLD_CUST_ID = :cid");
   
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
       
    $cid = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: customers.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Edit
if (isset($_GET['edit'])) {
   
  try {
 
    $stmt = $conn->prepare("SELECT * FROM tbl_customers_a196330 WHERE FLD_CUST_ID = :cid");
   
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
       
    $cid = $_GET['edit'];
     
    $stmt->execute();
 
    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
  $conn = null;
 
?>