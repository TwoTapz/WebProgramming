<?php
  include_once 'orders_crud.php';
include_once 'session.php';

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Nerf Pawn Shop: Orders</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
 
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style type="text/css">
    body {
       background-image: url("bgn.png");
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center center;
      background-attachment: fixed;
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
    }   
    .topnav {
        background-color: #333;
        overflow: hidden;
    }
    .header-right{
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
    input[type=text], select, textarea, input[type=date] {
        width: 100%; /* Full width */
        padding: 12px; /* Some padding */ 
        border: 1px solid #ccc; /* Gray border */
        border-radius: 4px; /* Rounded borders */
        box-sizing: border-box; /* Make sure that padding and width stays in place */
        margin-top: 6px; /* Add a top margin */
        margin-bottom: 16px; /* Bottom margin */
        resize: vertical; /* Allow the user to vertically resize the textarea (not horizontally) */
        background-color: #f8f8f8; /* Light gray background */
        font-size: 16px;
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
    .container {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
    }
    .button-container {
        text-align: center;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
  </style>
</head>
<body>
  
   <?php include_once 'nav_bar.php'; ?>
    
  <div class="container">
    <form action="orders.php" method="post">
      Order ID
      <input name="oid" type="text" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['fld_order_num']; ?>"> <br>
      Order Date
      <input name="orderdate" type="date" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['fld_order_date']; ?>"> <br>
      Staff
      <select name="sid">
        <?php
        try {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_staff_a196330");
          $stmt->execute();
          $result = $stmt->fetchAll();
          foreach($result as $staffrow) {
            if((isset($_GET['edit'])) && ($editrow['fld_staff_num'] == $staffrow['FLD_STAFF_ID'])) {
              echo "<option value='".$staffrow['FLD_STAFF_ID']."' selected>".$staffrow['FLD_STAFF_NAME']."</option>";
            } else {
              echo "<option value='".$staffrow['FLD_STAFF_ID']."'>".$staffrow['FLD_STAFF_NAME']."</option>";
            }
          }
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
        ?>
      </select> <br>
      Customer
      <select name="cid">
        <?php
        try {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_customers_a196330");
          $stmt->execute();
          $result = $stmt->fetchAll();
          foreach($result as $custrow) {
            if((isset($_GET['edit'])) && ($editrow['fld_customer_num'] == $custrow['FLD_CUST_ID'])) {
              echo "<option value='".$custrow['FLD_CUST_ID']."' selected>".$custrow['FLD_CUST_NAME']."</option>";
            } else {
              echo "<option value='".$custrow['FLD_CUST_ID']."'>".$custrow['FLD_CUST_NAME']."</option>";
            }
          }
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
        ?>
      </select> <br>
      <div class="button-container">
          <?php if (isset($_GET['edit'])) { ?>
          <button type="submit" name="update">Update</button>
          <?php } 

          else { ?>
          <button type="submit" name="create">Create</button>

          <?php } ?>
          <button type="reset">Clear</button>

      </div>
    </form>
  </div>
  <hr>
  <div class="container">
    <table>
      <tr>
        <th>Order ID</th>
        <th>Order Date</th>
        <th>Staff Name</th>
        <th>Customer Name</th>
        <th></th>
      </tr>
      <?php
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM tbl_orders_a196330, tbl_staff_a196330, tbl_customers_a196330 WHERE ";
    $sql .= "tbl_orders_a196330.fld_staff_num = tbl_staff_a196330.FLD_STAFF_ID and ";
    $sql .= "tbl_orders_a196330.fld_customer_num = tbl_customers_a196330.FLD_CUST_ID";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();

    foreach ($result as $orderrow) {
        ?>
        <tr>
            <td><?php echo $orderrow['fld_order_num']; ?></td>
            <td><?php echo $orderrow['fld_order_date']; ?></td>
            <td><?php echo $orderrow['FLD_STAFF_NAME']; ?></td>
            <td><?php echo $orderrow['FLD_CUST_NAME'];?></td>
            <td>
                <a href="orders_details.php?oid=<?php echo $orderrow['fld_order_num']; ?>" class="btn btn-info">Details</a>
                <?php if ($level === "Admin" ) { ?>
                    <a href="orders.php?edit=<?php echo $orderrow['fld_order_num']; ?>" class="btn btn-warning">Edit</a>
                    <a href="orders.php?delete=<?php echo $orderrow['fld_order_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger">Delete</a>
                <?php } ?>
            </td>
        </tr>
        <?php
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>

    </table>
  </div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
</body>
</html>
