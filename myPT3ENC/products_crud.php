<?php
include_once 'database.php';

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Create
if (isset($_POST['create'])) {

  try {

      $stmt = $conn->prepare("INSERT INTO tbl_products_a196330(prod_id,
        prod_name, prod_price, prod_type, prod_size,
        prod_quantity) VALUES(:pid, :name, :price, :type,
        :NerfSize, :quantity)");

      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_STR);
      $stmt->bindParam(':type', $type, PDO::PARAM_STR);
    $stmt->bindParam(':NerfSize', $NerfSize, PDO::PARAM_STR);

      $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);

    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $NerfSize = $_POST['NerfSize'];
    $quantity = $_POST['quantity'];

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

      $stmt = $conn->prepare("UPDATE tbl_products_a196330 SET prod_id = :pid,
        prod_name = :name, prod_price = :price, prod_type = :type,
        prod_size = :NerfSize,  prod_quantity = :quantity
        WHERE prod_id = :oldpid");

      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_STR);
      $stmt->bindParam(':type', $type, PDO::PARAM_STR);
      $stmt->bindParam(':NerfSize', $NerfSize, PDO::PARAM_STR);
      $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
      $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR);

    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $type =  $_POST['type'];
    $NerfSize = $_POST['NerfSize'];
    $quantity = $_POST['quantity'];
    $oldpid = $_POST['oldpid'];

    $stmt->execute();

    header("Location: products.php");
    }

  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}

//Delete
if (isset($_GET['delete'])) {

  try {

      $stmt = $conn->prepare("DELETE FROM tbl_products_a196330 WHERE prod_id = :pid");

      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);

    $pid = $_GET['delete'];

    $stmt->execute();

    header("Location: products.php");
    }

  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}

//Edit
if (isset($_GET['edit'])) {

  try {

      $stmt = $conn->prepare("SELECT * FROM tbl_products_a196330 WHERE prod_id = :pid");

      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);

    $pid = $_GET['edit'];

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
