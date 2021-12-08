<?php 
session_start();
require_once("../_require.php");
$db=new database();
if(!$db->connect())exit();

$bookmark_request="SELECT * FROM view_item_bookmarks WHERE bookmark_owner_id='{$_SESSION['id']}' AND deleted=0 AND sold_to IS NULL";
$bookmark_result=$db->query($bookmark_request);
if ($db->num_rows($bookmark_result)==0) {
    echo "<p class='notification ORANGE' style='margin-left: 32%; margin-right:auto; margin-top: 70px;'>You didnt bookmark any item yet.</p><br>";
} else {
    while ($row=$db->fetch_assoc($bookmark_result)) {
        $dir = "../img/item_images/".$row["item_id"]."/";
        $files = scandir($dir);
        $files = array_slice($files, 2);
        $pieces=explode(".", @$files[0]);
        $img_path=getExistingFile("../img/item_images/".$row["item_id"]."/".$pieces[0]);
        echo '<div class="item_container left shadow">';
        if ($img_path) {
            echo '<a href="advert_page.php?iid='.$row["item_id"].'"><img src="ROSE/'.$img_path.'" alt=""><h2>'.$row["item_name"].'</h2></a>';
        } else {
            echo '<a href="advert_page.php?iid='.$row["item_id"].'"><img src="img/item_images/no_image.png" alt=""><h2>'.$row["item_name"].'</h2></a>';
        }
        $pieces=explode(" ", $row["item_post_date"]);
        echo '<p>'.$pieces[0].'</p>';
        echo '<p>'.$row["item_price"].',00 &euro;</p>';
        echo '</div><!-- item container end -->';
    }
}
?>