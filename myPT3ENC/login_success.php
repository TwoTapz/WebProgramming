<?php  
include_once 'database.php';
include_once 'session.php';

if(isset($_SESSION["sid"]))  
{  
    
    echo '<script type="text/javascript">';

    if ($level === 'Admin') {
        echo 'alert("WELCOME Boss ' . $name . '! TO NERF PAWN SHOP");';
    } else if ($level === 'Staff') {
        echo 'alert("WELCOME ' . $name . ', work properly, else boss is going to be mad");';
    } else {
        echo 'alert("Welcome ' . $name . '! To Nerf Pawn Shop your position is: ' . $level . '");';
    }

    echo 'window.location.href = "index.php";';
    echo '</script>';
}
else  
{  
    echo '<script type="text/javascript">';
    echo 'alert("Please login ");'; 
    echo 'window.location.href = "login.php";';
    echo '</script>';
}  
?> 
