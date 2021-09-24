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
    <link rel="stylesheet" href="css/advert.css">
    <link rel="stylesheet" href="css/item_search.css">
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

    <title>Search</title>
    <script>
    function hide() {
        $(".notification").remove();
    }
    </script>
</head>

<body style="height:auto;">
    <div id="wrapper">
        <div id="notification_container"> </div><!-- alert container end -->
        <?php
        require_once("_header.php");
        ?>
        <div id="search_input" class="shadow">
            <div id="adv_category" class="input-container">
                <label for="category">Category *</label>
                <select name="category" id="category" class="shadow">
                    <option value="0" selected>Chose...</option>
                    <?php 
                $request="SELECT * FROM item_categories";
                $result=$db->query($request);

                while($row=$db->fetch_assoc($result)){
                    echo '<option value="'.$row['item_category_id'].'">'.$row['item_category_name'].'</option>';
                }
                ?>
                </select>
            </div>
            <div id="adv_group" class="input-container">
                <label for="group">Group *</label>
                <select name="group" id="group" class="shadow">
                    <option value="0" selected>Chose category first...</option>
                </select>
            </div>

            <div id="adv_title" class="input-container shadow">
                <i class="fas fa-box-open icon"></i>
                <input class="input-field" type="text" id="ad_title" placeholder="Title(can be empty)" name="ad_name">
            </div>
        </div>


        <div id="search_output">

        </div><!-- search output end -->
        <button onclick="loadMore()" class="none" id="load_more">Load more</button>
    </div><!-- wrapper end -->
</body>

</html>
<script src="ajax/item_search.js"></script>