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
    <link rel="stylesheet" href="css/slider.css">
    <link rel="stylesheet" href="css/item.css">


    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous"></script>
    <link rel="icon" href="img/homee.png">
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Saira+Extra+Condensed:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,500" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,300i,400,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100;300;400;600" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/bq5m2vuub7uf27yyjc5gmnx7m273hag2l53zrzvzxdt3a2ny/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>

    <?php 
    error_reporting(0);
    $request_advert="SELECT * FROM view_item_posts WHERE item_id='{$_GET['iid']}' AND deleted=0 AND sold_to IS NULL";
    $result_advert=$db->query($request_advert);
    $row_advert_info=$db->fetch_assoc($result_advert);

    echo "<title>{$row_advert_info['item_name']}</title>" ?>
    <script>
    function hide() {
        $(".notification").remove();
    }
    </script>
</head>

<body style="height:auto;">

    <div id="wrapper">
        
        <div id="notification_container"></div><!-- alert container end -->
        <?php require_once("_header.php"); 

        
        if(!isset($_GET['iid']) or $_GET['iid']==""){
            header('Location: index.php');
        }
        else if(mysqli_num_rows($result_advert)==0){
            echo "<div id='notification_container'><p class='notification ORANGE'>Advert with id<b>[".$_GET["iid"]."]</b> is deleted or sold.</p></div>";
        } else { 
            require_once("_item_post.php"); 
        }
        ?>

    </div> <!-- wrapper end -->

</body>

</html>
<script src="js/slider.js"></script>
<script src="ajax/item_post_edit.js"></script>
<?php
exit();
?>