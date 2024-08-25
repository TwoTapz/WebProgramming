<?php
include_once 'database.php';

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Create
if (isset($_POST['create'])) {
    try {
        $stmt = $conn->prepare("INSERT INTO tbl_staff_a196330(FLD_STAFF_ID, FLD_STAFF_NAME, FLD_STAFF_EMAIL, FLD_STAFF_GENDER, FLD_STAFF_NOPHONE, FLD_STAFF_PASS, FLD_STAFF_LEVEL) VALUES(:sid, :fname, :email, :gender, :phone, :pass, :level)");

        $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
        $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
        $stmt->bindParam(':level', $level, PDO::PARAM_STR);

        $sid = $_POST['sid'];
        $fname = $_POST['fname'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        $level = $_POST['level'];

        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

//Update
if (isset($_POST['update'])) {
    try {
        $stmt = $conn->prepare("UPDATE tbl_staff_a196330 SET FLD_STAFF_ID = :sid, FLD_STAFF_NAME = :fname, FLD_STAFF_EMAIL = :email, FLD_STAFF_GENDER = :gender, FLD_STAFF_NOPHONE = :phone, FLD_STAFF_PASS = :pass, FLD_STAFF_LEVEL = :level WHERE FLD_STAFF_ID = :oldsid");

        $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
        $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
        $stmt->bindParam(':level', $level, PDO::PARAM_STR);
        $stmt->bindParam(':oldsid', $oldsid, PDO::PARAM_STR);

        $sid = $_POST['sid'];
        $fname = $_POST['fname'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        $level = $_POST['level'];
        $oldsid = $_POST['oldsid'];

        $stmt->execute();

        header("Location: staffs.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

//Delete
if (isset($_GET['delete'])) {
    try {
        $stmt = $conn->prepare("DELETE FROM tbl_staff_a196330 WHERE FLD_STAFF_ID= :sid");

        $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);

        $sid = $_GET['delete'];

        $stmt->execute();

        header("Location: staffs.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

//Edit
if (isset($_GET['edit'])) {
    try {
        $stmt = $conn->prepare("SELECT * FROM tbl_staff_a196330 WHERE FLD_STAFF_ID = :sid");

        $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);

        $sid = $_GET['edit'];

        $stmt->execute();

        $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$conn = null;
?>
