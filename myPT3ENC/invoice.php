<?php
  include_once 'database.php';
?>
<?php
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT * FROM tbl_orders_a196330, tbl_staff_a196330, tbl_customers_a196330, tbl_orders_details_a196330 
                          WHERE tbl_orders_a196330.fld_staff_num = tbl_staff_a196330.FLD_STAFF_ID AND
                                tbl_orders_a196330.fld_customer_num = tbl_customers_a196330.FLD_CUST_ID AND
                                tbl_orders_a196330.fld_order_num = tbl_orders_details_a196330.fld_order_num AND
                                tbl_orders_a196330.fld_order_num = :oid");
  $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
  $oid = $_GET['oid'];
  $stmt->execute();
  $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Invoice</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style>
    .header {
      text-align: center;
      margin-bottom: 20px;
    }
    .total-row td {
      text-align: right;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="row">
    <div class="col-xs-6 text-center">
      <br>
      <img src="Nerf Pawn Shop.png" width="50%" height="50%">
    </div>
    <div class="col-xs-6 text-right">
      <h1>INVOICE</h1>
      <h5>Order: <?php echo $readrow['fld_order_num'] ?></h5>
      <h5>Date: <?php echo $readrow['fld_order_date'] ?></h5>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-xs-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>From: Nerf Pawn Shop</h4>
        </div>
        <div class="panel-body">
          <p>
            BLOK H, KOLEJ PENDETA ZA'BA <br>
            43700 BANGI, SELANGOR MALAYSIA <br>
            Email: a196330@siswa.ukm.edu.my <br>
            Phone: +60196837303
          </p>
        </div>
      </div>
    </div>
    <div class="col-xs-5 col-xs-offset-2 text-right">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>To : <?php echo $readrow['FLD_CUST_NAME']; ?></h4>
        </div>
        <div class="panel-body">
          <p>
            Address 1 <br>
            Address 2 <br>
            Postcode City <br>
            State <br>
          </p>
        </div>
      </div>
    </div>
  </div>

  <table class="table table-bordered">
    <tr>
      <th>No</th>
      <th>Product</th>
      <th class="text-right">Quantity</th>
      <th class="text-right">Price (RM)/Unit</th>
      <th class="text-right">Total (RM)</th>
    </tr>
    <?php
    $grandtotal = 0;
    $counter = 1;
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT * FROM tbl_orders_details_a196330, tbl_products_a196330 
                              WHERE tbl_orders_details_a196330.fld_product_num = tbl_products_a196330.prod_id AND
                                    fld_order_num = :oid");
      $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
      $oid = $_GET['oid'];
      $stmt->execute();
      $result = $stmt->fetchAll();
    } catch(PDOException $e){
      echo "Error: " . $e->getMessage();
    }
    foreach($result as $detailrow) {
      // Convert price string to float
      $price_str = preg_replace('/[^0-9.]/', '', $detailrow['prod_price']);
      $price = (float)$price_str;
      $total_price = $price * (int)$detailrow['fld_order_detail_quantity'];
    ?>
    <tr>
      <td><?php echo $counter; ?></td>
      <td><?php echo $detailrow['prod_name']; ?></td>
      <td class="text-right"><?php echo $detailrow['fld_order_detail_quantity']; ?></td>
      <td class="text-right"><?php echo number_format($price, 2); ?></td>
      <td class="text-right"><?php echo number_format($total_price, 2); ?></td>
    </tr>
    <?php
      $grandtotal += $total_price;
      $counter++;
    }
    ?>
    <tr class="total-row">
      <td colspan="4" class="text-right">Grand Total</td>
      <td class="text-right"><?php echo number_format($grandtotal, 2); ?></td>
    </tr>
  </table>

  <div class="row">
    <div class="col-xs-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Bank Details</h4>
        </div>
        <div class="panel-body">
          <p>Your Name</p>
          <p>Bank Name</p>
          <p>SWIFT: </p>
          <p>Account Number: </p>
          <p>IBAN: </p>
        </div>
      </div>
    </div>
    <div class="col-xs-7">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Contact Details</h4>
        </div>
        <div class="panel-body">
          <p>Staff: <?php echo $readrow['FLD_STAFF_NAME']; ?></p>
          <p>Email: <?php echo $readrow['FLD_STAFF_EMAIL']; ?></p>
          <p><br></p>
          <p>Computer-generated invoice. No signature is required.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
