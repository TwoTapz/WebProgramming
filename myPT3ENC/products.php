<?php 
include_once 'products_crud.php';
include_once 'session.php';
?>

<!DOCTYPE html>
<html>
<head>
  <style type="text/css">
    body {
       /*background-image: url("bg.png"); */
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
    /* Styling for DataTables pagination */
    .dataTables_wrapper .dataTables_paginate {
        float: right;
        margin-top: 10px;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        box-sizing: border-box;
        display: inline-block;
        min-width: 1.5em;
        padding: 0.5em 1em;
        margin-left: 2px;
        text-align: center;
        text-decoration: none !important;
        cursor: pointer;
        color: #fff !important;
        border: 1px solid transparent;
        border-radius: 2px;
        background-color: #A94438;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #4758F5;
        border-color: #4758F5;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current, 
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        color: #fff !important;
        background-color: #A94438;
        border-color: #4758F5;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
        color: #ccc !important;
        cursor: default;
    }
    @media screen and (max-width: 768px) {
        .dataTables_wrapper .dataTables_paginate {
            float: none;
            text-align: center;
        }
    }
  </style>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nerf Pawn Shop : Products</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap.min.css" />
  <link href="https://cdn.datatables.net/v/bs/jszip-3.10.1/b-2.4.2/b-html5-2.4.2/datatables.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap.min.css">
</head>

<body>
  <?php include_once 'nav_bar.php'; ?>
  <?php if ($level === "Admin") { ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <div class="page-header">
          <h2>Create New Product</h2>
        </div>
        <form action="products.php" method="post" class="form-horizontal">
          <div class="form-group">
            <div class="col-sm-9">
              Product ID:
              <input name="pid" type="text" class="form-control" required value="<?php if(isset($_GET['edit'])) echo $editrow['prod_id']; ?>">
            </div>
          </div>
          Name:
          <input name="name" type="text" required class="form-control" value="<?php if(isset($_GET['edit'])) echo $editrow['prod_name']; ?>">
          Price:
          <input name="price" type="text" required class="form-control" value="<?php if(isset($_GET['edit'])) echo $editrow['prod_price']; ?>">
          Type:
          <select name="type" class="form-control" required>
            <option value="">Please select</option>
            <option value="MicroShots" <?php if(isset($_GET['edit'])) if($editrow['prod_type']=="MicroShots") echo "selected"; ?>>Micro Shots</option>
            <option value="Elite" <?php if(isset($_GET['edit'])) if($editrow['prod_type']=="Elite") echo "selected"; ?>>Elite</option>
            <option value="Elite 2.0" <?php if(isset($_GET['edit'])) if($editrow['prod_type']=="Elite 2.0") echo "selected"; ?>>Elite 2.0</option>
            <option value="FortniteXNerf" <?php if(isset($_GET['edit'])) if($editrow['prod_type']=="ForniteXNerf") echo "selected"; ?>>Fortnite X Nerf</option>
            <option value="Rival" <?php if(isset($_GET['edit'])) if($editrow['prod_type']=="Rival") echo "selected"; ?>>Rival</option>
            <option value="SuperSoaker" <?php if(isset($_GET['edit'])) if($editrow['prod_type']=="SuperSoaker") echo "selected"; ?>>Super Soaker</option>
          </select> 
          <br>
          Size:
          <select name="NerfSize" class="form-control" required>
            <option value="">Please select</option>
            <option value="Small" <?php if(isset($_GET['edit'])) if($editrow['prod_size']=="Small") echo "selected"; ?> >Small</option>
            <option value="Medium" <?php if(isset($_GET['edit'])) if($editrow['prod_size']=="Medium") echo "selected"; ?> >Medium</option>
            <option value="Large" <?php if(isset($_GET['edit'])) if($editrow['prod_size']=="Large") echo "selected"; ?>>Large</option>
          </select> 
          <br>
          Quantity:
          <input name="quantity" type="text" required class="form-control" value="<?php if(isset($_GET['edit'])) echo $editrow['prod_quantity']; ?>">
          <br>
          <?php if (isset($_GET['edit'])) { ?>
          <input type="hidden" name="oldpid" value="<?php echo $editrow['prod_id']; ?>">
          <button type="submit" name="update">Update</button>
          <?php } else { ?>
          <button type="submit" name="create">Create</button>
          <?php } ?>
          <button type="reset">Clear</button>
        </form>
      </div>
    </div>
  </div>
  <?php } ?>
  <hr>
  <br>
  <div class ="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2>Products List</h2>
      </div>
      <table class="table table-striped table-bordered" id="product-table">
        <thead>
          <tr>
            <th>Product ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Type</th>
            <th>Size</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM tbl_products_a196330");
            $stmt->execute();
            $result = $stmt->fetchAll();
          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
          }
          foreach($result as $readrow) {
          ?>   
          <tr>
            <td><?php echo $readrow['prod_id']; ?></td>
            <td><?php echo $readrow['prod_name']; ?></td>
            <td><?php echo $readrow['prod_price']; ?></td>
            <td><?php echo $readrow['prod_type']; ?></td>
            <td><?php echo $readrow['prod_size']; ?></td>
            <td>
              <button data-href="products_details.php?pid=<?php echo $readrow['prod_id']; ?>" class="btn btn-warning btn-xs btn-details" role="button">Details</button>
              <?php if ($level === "Admin") { ?>
              <a href="products.php?edit=<?php echo $readrow['prod_id']; ?>" class="btn btn-success btn-xs" role="button">Edit</a>
              <a href="products.php?delete=<?php echo $readrow['prod_id']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
              <?php } ?>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
  <div id="myModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Product Details</h3>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js"></script>
  <script>
    $(document).ready(function() {
      var table = $('#product-table').DataTable({
        "order": [[1, "asc"]],
        "pagingType": "full_numbers",
        "pageLength": 5,
        "lengthMenu": [[5, 10, 20, 30, -1], [5, 10, 20, 30, "All"]],
        "searching": true,
        "columnDefs": [{ "searchable": false, "targets": 2 }],
        "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        "buttons": [
          {
            extend: 'excelHtml5',
            text: 'Excel',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            },
            className: 'btn btn-primary'
          }
        ]
      });

      $('#myModal').on('hidden.bs.modal', function () {
        $('.modal-body').html('');
      });

      $('#product-table tbody').on('click', 'button.btn-details', function() {
        var dataURL = $(this).attr('data-href');
        $('.modal-body').load(dataURL, function() {
          $('#myModal').modal({
            backdrop: 'static',
            keyboard: false
          });
        });
      });

      var exportContainer = $('<div class="export-container"></div>').insertAfter('.dataTables_info');
      table.buttons().container().appendTo(exportContainer);
      $('.export-container .btn-primary').removeClass('btn-secondary').addClass('btn-primary');
    });
  </script>
</body>
</html>
