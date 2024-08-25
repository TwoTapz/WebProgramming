<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 24px;
        }

        .navbar-nav > li > a {
            font-size: 16px;
            font-weight: 400;
        }

        .navbar-nav .dropdown-menu > li > a {
            font-size: 14px;
            font-weight: 400;
        }

        .navbar-nav .dropdown-menu > li > a.disabled {
            color: #ccc;
            cursor: not-allowed;
        }

        .navbar-nav .dropdown-menu > li > a.disabled:hover {
            text-decoration: none;
            background-color: transparent;
        }

        .modal-content {
            font-size: 16px;
        }

        .modal-header .modal-title {
            font-weight: 500;
        }

        .btn {
            font-weight: 400;
        }
    </style>
    <title>Nerf Pawn Shop</title>
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php" style="font-style: italic; color:darkred;">Nerf Pawn Shop</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="index.php" style="font-style: italic; color:darkgray;">Home</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#" disabled="disabled">
                            <span class="glyphicon" aria-hidden="true" style="font-weight: bold; color: darkred;">
                                <strong><?php echo $name; ?></strong> (<strong><?php echo strtoupper($level); ?></strong>)
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu 
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="products.php"><span class="glyphicon" aria-hidden="true"></span> Products </a></li>
                            <li>
                                <?php if ($level === "Admin") { ?>
                                    <a href="customers.php"><span class="glyphicon" aria-hidden="true"></span> Customers</a>
                                <?php } else { ?>
                                    <a href="#" class="disabled" data-toggle="tooltip" data-placement="right" title="You are not authorized to access this page" onclick="showErrorBox()"><span class="glyphicon" aria-hidden="true"></span> Customers </a>
                                <?php } ?>
                            </li>
                            <li>
                                <?php if ($level === "Admin") { ?>
                                    <a href="staffs.php"><span class="glyphicon" aria-hidden="true"></span> Staffs</a>
                                <?php } else { ?>
                                    <a href="#" class="disabled" data-toggle="tooltip" data-placement="right" title="You are not authorized to access this page" onclick="showErrorBox()"><span class="glyphicon" aria-hidden="true"></span> Staffs</a>
                                <?php } ?>
                            </li>
                            <li><a href="orders.php"><span class="glyphicon" aria-hidden="true"></span> Orders </a></li>
                            <li><a href="logout.php"><span class="glyphicon" aria-hidden="true"></span> Logout </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script>
        function showErrorBox() {
            $('#errorModal').modal('show');
        }
    </script>

    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Error</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    You are not authorized to access this page.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
