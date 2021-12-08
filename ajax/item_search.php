<?php
session_start();
require_once("../_require.php");
$db=new database();
if(!$db->connect())exit();

if(!isset($_POST['offset'])){
    $offset=0;
} else $offset=$_POST['offset'];

if($_POST['category']!=0 and $_POST['group']!=0){
    $request = "SELECT * FROM view_item_posts WHERE item_name LIKE'%{$_POST['title']}%' AND item_category_id='{$_POST['category']}' AND item_group_id='{$_POST['group']}' AND sold_to IS NULL ORDER BY item_id DESC LIMIT 16 OFFSET $offset";
    $result = $db->query($request);
    if ($db->num_rows($result) == 0) {
        echo "<p class='none'>no_more</p>";
    } else {
        while ($row = $db->fetch_assoc($result)) {
            $dir = "../img/item_images/" . $row["item_id"] . "/";
            $files = scandir($dir);
            $files = array_slice($files, 2);
            $pieces = explode(".", @$files[0]);
            $img_path = getExistingFile("../img/item_images/" . $row["item_id"] . "/" . $pieces[0]);
            $img_path = str_replace("../","",$img_path); //repositioning
            echo '<div class="item_container left shadow">';
            if ($img_path) {
                echo '<a href="advert_page.php?iid=' . $row["item_id"] . '"><img src="' . $img_path . '" alt=""><h2>' . $row["item_name"] . '</h2></a>';
            } else {
                echo '<a href="advert_page.php?iid=' . $row["item_id"] . '"><img src="img/item_images/no_image.png" alt=""><h2>' . $row["item_name"] . '</h2></a>';
            }
            $pieces = explode(" ", $row["item_post_date"]);
            echo '<p>' . $pieces[0] . '</p>';
            echo '<p>' . $row["item_price"] . ',00 &euro;</p>';
            echo '</div><!-- item container end -->';
        }
    }
} else echo "<p class='notification ORANGE' style='margin-left: auto; margin-right:auto; margin-top: 50px;'>Please select Category/Group.</p>";

?>