<?php
include_once 'staffs_crud.php';
include_once 'session.php';

$gender = array(
    array("name" => "Male", "abb" => "M"),
    array("name" => "Female", "abb" => "F"),
);


if (!isset($_SESSION["sid"])) {
    echo '<script type="text/javascript">';
    echo 'alert("Please login");';
    echo 'window.location.href = "login.php";';
    echo '</script>';
    exit();
}

 if ($level === 'Staff') {
    echo '<script type="text/javascript">';
    echo 'alert("Access denied! This page is only accessible to admins.");';
    echo 'window.location.href = "index.php";';
    echo '</script>';
    exit();
}
?>

<!DOCTYPE html>
<html>
 <style type="text/css">
        /* Custom Styles */
        /* Add any custom styles here */

        .white-table {
  background-color: white;
}

.white-table th {
  color: black;
}

 body {
      background-image: url("bgn.png");
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center center;
      background-attachment: fixed;
      margin: 0;
      font-family: 'Arial', sans-serif;
    }
    .topnav {
      background-color: #333;
      overflow: hidden;
    }
    .header-right {
      float: right;
      padding: 0px 20px;
    }
    .topnav a {
      float: left;
      color: #f2f2f2;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
      font-size: 17px;
    }
    .topnav a:hover {
      background-color: #ddd;
      color: black;
    }
    .topnav a.active {
      background-color: red;
      color: white;
    }
    .custom-container {
      max-width: 900px;
      margin: 50px auto;
      padding: 20px;
      background-color: rgba(255, 255, 255, 0.9);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
    }
    .page-header h2 {
      color: #333;
    }
    .form-horizontal .form-group {
      margin: 15px 0;
    }
    .form-control {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    /* Slideshow */
    * {box-sizing: border-box}
    body {font-family: Verdana, sans-serif; margin:0}
    .mySlides {display: none}
    img {vertical-align: middle;}
    @keyframes fade {
        from {opacity: .4} 
        to {opacity: 1}
    }
    /* On smaller screens, decrease text size */
    @media only screen and (max-width: 300px) {
        .prev, .next,.text {font-size: 11px}
    }
    /*Container*/
    input[type=text], select, textarea {
      width: 100%;
      padding: 12px; 
      border: 1px solid #ccc; 
      border-radius: 4px; 
      box-sizing: border-box; 
      margin-top: 6px; 
      margin-bottom: 16px; 
      resize: vertical; 
    }
    button {
      background-color: red;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    button:hover {
      background-color: darkred;
    }
    </style>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nerf Pawn Shop : Staffs</title>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
</head>

<body>

    <?php include_once 'nav_bar.php'; ?>

    <div class="custom-container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <div class="page-header">
                    <h2>Create New Staff</h2>
                </div>

                <form action="staffs.php" method="post" class="form-horizontal">
                    <div class="form-group">
    <div class="col-sm-9">
        <label for="sid">Staff ID:</label>
        <input name="sid" type="text" class="form-control" required value="<?php if (isset($_GET['edit'])) echo $editrow['FLD_STAFF_ID']; ?>">
        <br>

        <label for="fname">Full Name:</label>
        <input name="fname" type="text" class="form-control" required value="<?php if (isset($_GET['edit'])) echo $editrow['FLD_STAFF_NAME']; ?>">
        <br>

        <label for="email">Email:</label>
        <input name="email" type="text" class="form-control" required value="<?php if (isset($_GET['edit'])) echo $editrow['FLD_STAFF_EMAIL']; ?>">
        <br>

        <label>Gender:</label>
        <br>
        <input name="gender" required type="radio" value="Male" <?php if (isset($_GET['edit'])) if ($editrow['FLD_STAFF_GENDER'] == "Male") echo "checked"; ?>> Male
        <input name="gender" required type="radio" value="Female" <?php if (isset($_GET['edit'])) if ($editrow['FLD_STAFF_GENDER'] == "Female") echo "checked"; ?>> Female
        <br><br>

        <label for="phone">Phone Number:</label>
        <input name="phone" required type="text" class="form-control" value="<?php if (isset($_GET['edit'])) echo $editrow['FLD_STAFF_NOPHONE']; ?>">
        <br>

        <label for="password">Password:</label>
        <input name="pass" type="password" class="form-control" id="password" value="" required>
        <br>

        <label for="rpassword">Retype Password:</label>
        <input name="rpass" type="password" class="form-control" id="rpassword" value="">
        <br>

        <label for="level">User Level:</label>
        <select name="level" class="form-control" id="level" required>
            <option value="">Please select</option>
            <option value="Admin" <?php if (isset($_GET['edit'])) if ($editrow['FLD_STAFF_LEVEL'] == "Admin") echo "selected"; ?>>Admin</option>
            <option value="Staff" <?php if (isset($_GET['edit'])) if ($editrow['FLD_STAFF_LEVEL'] == "Staff") echo "selected"; ?>>Normal Staff</option>
        </select>
    </div>
</div>

                            <?php if (isset($_GET['edit'])) { ?>
                                <input type="hidden" name="oldsid" value="<?php echo $editrow['FLD_STAFF_ID']; ?>">
                                <button type="submit" name="update" >Update</button>
                            <?php } else { ?>
                                <button type="submit" name="create" >Create</button>
                            <?php } ?>
                            <button type="reset">Clear</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <hr>

<div class ="custom-container">
        <div class="row">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h2>Staffs List</h2>
                </div>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Staff ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Phone Number</th>
                        <th>User Level</th>
                        <th></th>
                    </tr>

                    <?php
                    // Read
                    $per_page = 10;
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;
      $start_from = ($page-1) * $per_page;



      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_staff_a196330");
           $stmt = $conn->prepare("select * from tbl_staff_a196330 LIMIT $start_from, $per_page");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?>   
                        <tr>
                            <td><?php echo $readrow['FLD_STAFF_ID']; ?></td>
                            <td><?php echo $readrow['FLD_STAFF_NAME']; ?></td>
                            <td><?php echo $readrow['FLD_STAFF_EMAIL']; ?></td>
                            <td><?php echo $readrow['FLD_STAFF_GENDER']; ?></td>
                            <td><?php echo $readrow['FLD_STAFF_NOPHONE']; ?></td>
                            <td><?php echo $readrow['FLD_STAFF_LEVEL'];?> </td>
                            <td>
                                <a href="staffs.php?edit=<?php echo $readrow['FLD_STAFF_ID']; ?>" class="btn btn-success btn-xs" role="button">Edit</a>
                                <a href="staffs.php?delete=<?php echo $readrow['FLD_STAFF_ID']; ?>" class="btn btn-danger btn-xs" role="button" onclick="return confirm('Are you sure to delete?');">Delete</a>
                            </td>
                        </tr>
                    <?php
                    }
                    $conn = null;
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <nav>
          <ul class="pagination">
          <?php
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM tbl_staff_a196330");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $total_records = count($result);
          }
          catch(PDOException $e){
                echo "Error: " . $e->getMessage();
          }
          $total_pages = ceil($total_records / $per_page);
          ?>
          <?php if ($page==1) { ?>
            <li class="disabled"><span aria-hidden="true">«</span></li>
          <?php } else { ?>
            <li><a href="staffs.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"staffs.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"staffs.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="staffs.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
  <!-- Include all compiled plugins (below), or include individual files as needed --> 
  <script src="js/bootstrap.min.js"></script> 

    <script>
        var password = document.getElementById("password"); 
          var confirm_password = document.getElementById("rpassword"); 
         
          function validatePassword(){ 
            if(password.value != confirm_password.value) { 
              confirm_password.setCustomValidity("Your Passwords Not Match"); 
            } else { 
              confirm_password.setCustomValidity(''); 
            } 
          } 
         
          password.onchange = validatePassword; 
          confirm_password.onkeyup = validatePassword; 
     </script>

     <script> 
      const passwordInput = document.querySelector("#password") 
      const eye = document.querySelector("#eye") 
     
      eye.addEventListener("click", function(){ 
      this.classList.toggle("fa-eye-slash") 
      const type = passwordInput.getAttribute("type") === "password" ? "text" : "password" 
      passwordInput.setAttribute("type", type) 
    }) 
     
    const passes = document.querySelector("#rpassword") 
    const eyee = document.querySelector("#eyee") 
     
      eyee.addEventListener("click", function(){ 
      this.classList.toggle("fa-eye-slash") 
      const type = passes.getAttribute("type") === "password" ? "text" : "password" 
      passes.setAttribute("type", type) 
    }) 
</script> 


  

</body>

</html>
