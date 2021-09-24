<?php
session_start();
require_once("_require.php");
$db=new database();
if(!$db->connect())exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <link rel="icon" href="img/homee.png">
    <?php
    if($_GET['r']=='l'){
         echo '<title>ROSE//Login</title>';
        }
        else echo '<title>ROSE//Registration</title>';
    ?>
</head>
<body style="height:auto;">
    <div id="wrapper">
    <div id="notification_container"></div><!-- alert container end -->
    
    <?php
        if($_GET['r']=='l'){
         require_once("forms/login.html");   
        }
        else require_once("forms/register.html");
     ?>
    </div><!-- wrapper end -->
</body>
</html>

<script src="js/main.js"></script>
<script src="ajax/login_register.js"></script>