<?php
  include_once 'customers_crud.php';
  include_once 'session.php';


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
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nerf Pawn Shop: Customer list</title>
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <style type="text/css">
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
    button[type="submit"], button[type="reset"] {
      padding: 10px 20px;
      margin-top: 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    button[type="submit"] {
      background-color: #28a745;
      color: #fff;
    }
    button[type="reset"] {
      background-color: #dc3545;
      color: #fff;
      margin-left: 10px;
    }
    button[type="submit"]:hover, button[type="reset"]:hover {
      opacity: 0.9;
    }
    table {
      width: 100%;
      margin-top: 20px;
    }
    th, td {
      text-align: center;
      padding: 8px;
    }
    th {
      background-color: #f2f2f2;
    }
    .pagination {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }
    .pagination li {
      display: inline;
    }
    .pagination li a, .pagination li span {
      color: #333;
      padding: 8px 16px;
      text-decoration: none;
      border: 1px solid #ddd;
      margin: 0 4px;
    }
    .pagination li a:hover {
      background-color: #ddd;
    }
    .pagination .active a {
      background-color: red;
      color: white;
      border: 1px solid red;
    }
    .pagination .disabled span {
      color: #ddd;
      border: 1px solid #ddd;
    }
  </style>
</head>

<body>

<?php include_once 'nav_bar.php'; ?>

<div class="custom-container">
  <div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <div class="page-header">
        <h2>Create New Customer</h2>
      </div>

      <form action="customers.php" method="post" class="form-horizontal">
        <div class="form-group">
          <div class="col-sm-12">
            Customer ID:
            <input name="cid" type="text" class="form-control" required value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_CUST_ID']; ?>"> <br>
            Full Name:
            <input name="fname" type="text" class="form-control" required value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_CUST_NAME']; ?>"> <br>
            Email:
            <input name="mail" type="text" class="form-control" required value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_CUST_EMAIL']; ?>"> <br>
            Phone Number:
            <input name="phone" type="text" class="form-control" required value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_CUST_PHONE']; ?>"> <br>
            Address:
            <input name="address" type="text" class="form-control" required value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_CUST_ADDRESS']; ?>"> <br>

            <?php if (isset($_GET['edit'])) { ?>
              <input type="hidden" name="oldcid" value="<?php echo $editrow['FLD_CUST_ID']; ?>">
              <button type="submit" name="update">Update</button>
            <?php } else { ?>
              <button type="submit" name="create">Create</button>
            <?php } ?>
            <button type="reset">Clear</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <hr>

  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2>Customers List</h2>
      </div>
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Customer ID</th>
            <th>FullName</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
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
            $stmt = $conn->prepare("SELECT * FROM tbl_customers_a196330 LIMIT $start_from, $per_page");
            $stmt->execute();
            $result = $stmt->fetchAll();
          }
          catch(PDOException $e){
            echo "Error: " . $e->getMessage();
          }
          foreach($result as $readrow) {
          ?>
          <tr>
            <td><?php echo $readrow['FLD_CUST_ID']; ?></td>
            <td><?php echo $readrow['FLD_CUST_NAME']; ?></td>
            <td><?php echo $readrow['FLD_CUST_EMAIL']; ?></td>
            <td><?php echo $readrow['FLD_CUST_PHONE']; ?></td>
            <td><?php echo $readrow['FLD_CUST_ADDRESS']; ?></td>
            <td>
              <a href="customers.php?edit=<?php echo $readrow['FLD_CUST_ID']; ?>" class="btn btn-success btn-xs" role="button">Edit</a>
              <a href="customers.php?delete=<?php echo $readrow['FLD_CUST_ID']; ?>" class="btn btn-danger btn-xs" role="button" onclick="return confirm('Are you sure to delete?');">Delete</a>
            </td>
          </tr>
          <?php
          }
          $conn = null;
          ?>
        </tbody>
      </table>
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
            $stmt = $conn->prepare("SELECT * FROM tbl_customers_a196330");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $total_records = count($result);
          }
          catch(PDOException $e){
            echo "Error: " . $e->getMessage();
          }
          $total_pages = ceil($total_records / $per_page);

          if ($page==1) { ?>
            <li class="disabled"><span aria-hidden="true">«</span></li>
          <?php } else { ?>
            <li><a href="customers.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php }

          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"customers.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"customers.php?page=$i\">$i</a></li>";

          if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="customers.php?page=<?php echo $page+1 ?>" aria-label="Next"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
  </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>
