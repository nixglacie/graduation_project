<?php
session_start();
require_once("../_require.php");
$db=new database();
if(!$db->connect())exit();

$option=$_GET['option'];


if($option=="all_posts_pagination"){
   $request = "SELECT * FROM item_posts WHERE item_owner_id='{$_POST['uid']}' AND deleted=0 and sold_to IS NULL ORDER BY item_id DESC LIMIT 16 OFFSET {$_POST['offset']} ";
    $result = $db->query($request);
    if ($db->num_rows($result) == 0) {
        echo "<p class='notification ORANGE' style='margin-left: auto; margin-right:auto; margin-top: 50px;'>This user has nothing for sale at the moment</p><br>";
    } else while ($row = $db->fetch_assoc($result)) {
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

if ($option=="sale_history_pagination") {
    $request_shistory="SELECT * FROM view_sale_history WHERE item_owner_id='{$_SESSION['id']}' ORDER BY item_id DESC LIMIT 16 OFFSET {$_POST['offset']}";
    $result_shistory=$db->query($request_shistory);
    if ($result_shistory=="0") {
        echo "<p class='notification ORANGE' style='margin-left: auto; margin-right:auto; margin-top: 50px;'>You havent sold anything yet.</p><br>";
    } else while ($row_shistory=$db->fetch_assoc($result_shistory)) {
            $dir = "../img/item_images/" . $row_shistory["item_id"] . "/";
            $files = scandir($dir);
            $files = array_slice($files, 2);
            $pieces = explode(".", @$files[0]);
            $img_path = getExistingFile("img/item_images/" . $row_shistory["item_id"] . "/" . $pieces[0]);
            echo '<div class="item_container left shadow">';
            $img_path = str_replace("../","",$img_path); //repositioning
            if ($img_path) {
                echo '<a href="profile.php?u=' . $row_shistory["sold_to_id"] . '"><img style="filter:grayscale(100%);" src="' . $img_path . '" alt=""><h2>' . $row_shistory["item_name"] . '</h2></a>';
            } else {
                echo '<a href="profile.php?u=' . $row_shistory["sold_to_id"] . '"><img style="filter:grayscale(100%);" src="img/item_images/no_image.png" alt=""><h2>' . $row_shistory["item_name"] . '</h2></a>';
            }
            echo '<p>Sold to – <a href="profile.php?u='. $row_shistory["sold_to_id"].'"><b>' . $row_shistory['sold_to_name'] . '</b></a></p>';
            echo '<p>' . $row_shistory["item_price"] . ',00 &euro;</p>';
            echo '</div><!-- item container end -->';
        }
    
}

if($option=="purchase_history_pagination"){
    $request_phistory="SELECT * FROM view_purchase_history WHERE sold_to_id='{$_SESSION['id']}' ORDER BY item_id DESC LIMIT 16 OFFSET {$_POST['offset']}";
    $result_phistory=$db->query($request_phistory);
    if ($result_phistory) {
        while ($row_phistory=$db->fetch_assoc($result_phistory)) {
            $dir = "../img/item_images/" . $row_phistory["item_id"] . "/";
            $files = scandir($dir);
            $files = array_slice($files, 2);
            $pieces = explode(".", @$files[0]);
            $img_path = getExistingFile("img/item_images/" . $row_phistory["item_id"] . "/" . $pieces[0]);
            $img_path = str_replace("../","",$img_path); //repositioning
            echo '<div class="item_container left shadow">';
            if ($img_path) {
                echo '<a href="profile.php?u=' . $row_phistory["item_owner_id"] . '"><img style="filter:grayscale(100%);" src="' . $img_path . '" alt=""><h2 class="adve_title">' . $row_phistory["item_name"] . '</h2></a>';
            } else {
                echo '<a href="profile.php?u=' . $row_phistory["item_owner_id"] . '"><img style="filter:grayscale(100%);" src="img/item_images/no_image.png" alt=""><h2 class="adve_title">' . $row_phistory["item_name"] . '</h2></a>';
            }
            echo '<p>Bought from – <a href="profile.php?u='. $row_phistory["item_owner_id"].'"><b>' . $row_phistory['purchased_from_name'] . '</b></a></p>';
            echo '<p>' . $row_phistory["item_price"] . ',00 &euro;</p>';
            if ($row_phistory["item_rated"]==0) {
                echo '<button onclick="rateThis(this)" class="rate_btn" data-atitle="'.$row_phistory["item_name"].'" class="shadow">Rate</button>';
            }
            echo '</div><!-- item container end -->';
        }
    } else {
        echo "<p class='notification ORANGE' style='margin-left: auto; margin-right:auto; margin-top: 50px;'>You havent sold anything yet.</p><br>";
    }
}
?>