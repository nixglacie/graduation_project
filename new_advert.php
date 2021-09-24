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

    <title>New Advert</title>
    <script>
    function hide() {
        $(".notification").remove();
    }
    </script>
</head>

<body style="height:auto;">
    <div id="wrapper">
        <div id="notification_container"></div><!-- alert container end -->
        <?php
        require_once("_header.php");
        ?>
        <form id="new_advert_form" method="POST">
        <button style="z-index:0;"class="submit_advert" title="Submit advert">&#x2714;</button>

            <div id="adv_title" class="input-container">
                <i class="fa fa-address-card icon fa-lg"></i>
                <input class="input-field" type="text" id="ad_title" placeholder="Title*" name="ad_name">
            </div>

            <div id="adv_price" class="input-container">
                <i class=" fa fa-euro-sign icon fa-lg"></i>
                <input class="input-field" type="text" id="ad_price"
                    placeholder="Price* (without . , eg. '100')" name="ad_price">
            </div>

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

            <div id="adv_state" class="input-container">
                <label for="state">State *</label>
                <input type="radio" value="1" class="radio" name="state" id="new_not_used">Like new(never used)
                <input type="radio" value="2" class="radio" name="state" id="used">Used
                <input type="radio" value="3" class="radio" name="state" id="broken_not_working">Broken / Not Working
            </div>
            <div id="instr">
                <h2>Image upload after completing advert form</h2>
                <img src="img/img_upload_inst.png" alt="">
                <h2>Maximum number of images is limtied to 10</h2>
            </div>
                

            <div id="tiny_editor" class="input-container" style="margin-top:10px;">
                <i class="fa fa-edit icon fa-lg"></i>
                <textarea class="input-field comment_editor" type="text" id="advert_description"
                    placeholder="Description*" name="item_post_description" value=""></textarea>
            </div>

            <div id="adv_city" class="input-container">
                <i class="fa fa-city icon fa-lg"></i>
                <input class="input-field" type="text" id="ad_city" placeholder="City*" value="<?php echo $_SESSION['city'];?>" name="ad_name">
            </div>
            <div id="adv_phone" class="input-container">
                <i class="fa fa-phone icon fa-lg"></i>
                <input class="input-field" type="text" id="ad_phone" placeholder="Phone number*" value="<?php echo $_SESSION['pnum'];?>" name="ad_name">
            </div>
            </form>

        <div id="all_user_posts">
        <h2 class="shadow">Last few adverts</h2>
        <?php 
        $request="SELECT * FROM item_posts WHERE item_owner_id='{$_SESSION['id']}' AND deleted=0 AND sold_to IS NULL ORDER BY item_id DESC LIMIT 4";
        $result=$db->query($request);
        if($db->num_rows($result)==0){
            echo "<p class='notification ORANGE' style='margin-left: auto; margin-right:auto; margin-top: 50px;'>This user has nothing for sale at the moment</p><br>";
        } else while($row=$db->fetch_assoc($result)) {
            $dir = "img/item_images/".$row["item_id"]."/";
            $files = scandir($dir);
            $files = array_slice($files, 2);
            $pieces=explode(".",@$files[0]);
            $img_path=getExistingFile("img/item_images/".$row["item_id"]."/".$pieces[0]);
            echo '<div class="item_container left shadow">';
            if($img_path){
                echo '<a href="advert_page.php?iid='.$row["item_id"].'"><img src="'.$img_path.'" alt=""><h2>'.$row["item_name"].'</h2></a>';
            } else {
                echo '<a href="advert_page.php?iid='.$row["item_id"].'"><img src="img/item_images/no_image.png" alt=""><h2>'.$row["item_name"].'</h2></a>';
            }
            $pieces=explode(" ", $row["item_post_date"]);
            echo '<p>'.$pieces[0].'</p>';
            echo '<p>'.$row["item_price"].',00 &euro;</p>';
            echo '</div><!-- item container end -->';
        }
        ?>
        </div><!-- all user posts end-->
    </div><!-- wrapper end -->
</body>

<script>
tinymce.init({
    selector: 'textarea',
    plugins: 'advlist  lists charmap print preview hr anchor pagebreak',
    toolbar: 'undo redo styleselect bold italic alignleft aligncenter bullist numlist',
    toolbar_mode: 'wrap',
    menubar: false,
    statusbar: false,
    width: 470,
    height: 360,
});
</script>
<script src="ajax/new_advert.js"></script>
