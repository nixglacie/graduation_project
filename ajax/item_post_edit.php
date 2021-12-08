<?php
session_start();
require_once("../_require.php");
$db=new database();
if(!$db->connect())exit();

$notif_timeout = "<script>setTimeout(hide, 5000);</script>";
$option = $_GET['option'];

/* checks if item psot is owned by the person thats taking the action */
$sql_row = "SELECT * FROM item_posts WHERE item_id='{$_POST['id']}' AND item_owner_id='{$_SESSION['id']}'";
$res_row = $db->query($sql_row);
$check_row = $db->num_rows($res_row);

if ($option == "delete" and ($check_row == 1 or $_SESSION['status']=="Administrator")) {
    $sql = "UPDATE item_posts SET deleted=1 WHERE item_id='{$_POST['id']}'";
    $res = $db->query($sql);
    echo "<p class='notification GREEN'>Succsefully deleted your post! You will be redirected shortly!</p><br>";
} else if ($option == "delete") echo "<p class='notification RED'>You cant deleted this item post. Beacause you dont own it.</p><br>";

if ($option == "update" and ($check_row == 1 or $_SESSION['status']=="Administrator")) {
    if ($_POST['title'] != "") {
        if ($_POST['price'] != "") {
            if ($_POST['category'] != "") {
                if ($_POST['group'] != "") {
                    if ($_POST['state'] != "") {
                        if ($_POST['description'] != "") {
                            if ($_POST['city'] != "") {
                                if ($_POST['phone'] != "") {
                                    $request = "UPDATE item_posts SET 
                                    item_name='{$_POST['title']}',
                                    item_price='{$_POST['price']}',
                                    item_category='{$_POST['category']}',
                                    item_group='{$_POST['group']}',
                                    item_state='{$_POST['state']}',
                                    item_description='{$_POST['description']}',
                                    item_city='{$_POST['city']}',
                                    item_phone_num='{$_POST['phone']}'
                                    WHERE item_id='{$_POST['id']}'";

                                    $result = $db->query($request);
                                    if ($db->error($db)) {
                                        echo "<p class='notification RED'>Something went wrong! Please try again" . $notif_timeout . "</p><br>";
                                    }
                                    echo "<p class='notification GREEN'>Sucesfully edited your advert!$notif_timeout</p><br>";
                                } else
                                    echo "<p class='notification ORANGE'>PHONE NUMBER cannot be empty!$notif_timeout</p><br>";
                            } else
                                echo "<p class='notification ORANGE'>CITY cannot be empty!$notif_timeout</p><br>";
                        } else
                            echo "<p class='notification ORANGE'>DESCRIPTION cannot be empty!$notif_timeout</p><br>";
                    } else
                        echo "<p class='notification ORANGE'>Please select appropriate STATE of item you advertize!$notif_timeout</p><br>";
                } else
                    echo "<p class='notification ORANGE'>Please select appropriate GROUP of item you advertize!$notif_timeout</p><br>";
            } else
                echo "<p class='notification ORANGE'>>Please select appropriate CATEGORY of item you advertize!$notif_timeout</p><br>";
        } else
            echo "<p class='notification ORANGE'>PRICE cannot be empty!$notif_timeout</p><br>";
    } else
        echo "<p class='notification ORANGE'>Title field cant be empty!$notif_timeout</p><br>";
}

if($option=="user_search" and $check_row == 1 and $_POST['username']!=""){
    $request="SELECT account_username,account_id FROM accounts WHERE account_username LIKE '%{$_POST['username']}%'";
    $result=$db->query($request);
    while($row=$db->fetch_assoc($result)){
        if($row['account_id']!=$_SESSION['id']){
            echo '<div onclick="choseUser(this)" data-username="'.$row['account_username'].'" data-uid="'.$row['account_id'].'" class="user_s_container">';
            $img_path = getExistingFile("../img/user_profile_pictures/".$row['account_id']);
            $img_path = str_replace("../","",$img_path); //repositioning
            if($img_path){
                echo '<img src="'.$img_path.'" alt="">';
            } else echo '<img src="img/item_images/no_image.png" alt="">';

            echo '<p>'.$row['account_username']."#<b>".$row['account_id'].'<b></p>';    
            echo '</div>';
        }
    }
}

if ($option == "sell" and $check_row == 1) {
    $request="UPDATE item_posts SET sold_to='{$_POST['uid']}' WHERE item_id='{$_POST['id']}'";
    $result=$db->query($request);
    if ($db->error($db)) {
        echo "<p class='notification RED'>Something went wrong! Please try again" . $notif_timeout . "</p><br>";
    } else echo "<p class='notification GREEN'>Succesfully sold this product!" . $notif_timeout . "</p><br>";
}

if ($option == "report"){
    $request="SELECT * FROM item_post_report WHERE reporting_user_id='{$_SESSION['id']}' and item_id='{$_POST['id']}' AND report_addressed=0";
    $result=$db->query($request);
    if($db->num_rows($result)==0){
        $request="INSERT INTO item_post_report (item_id, reporting_user_id, report_type) VALUES ('{$_POST['id']}', '{$_SESSION['id']}' , '{$_POST['report_type']}')";
        $db->query($request);
        if($db->error($db)){
            echo "<p class='notification RED'>Something went wrong! Please try again" . $notif_timeout . "</p><br>";
        } else echo "<p class='notification GREEN'>Succesfully reported this advert!" . $notif_timeout . "</p><br>";
    } else echo "<p class='notification ORANGE'>You already reported this advert!" . $notif_timeout . "</p><br>";
}

exit();
?>