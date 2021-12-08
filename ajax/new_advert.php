<?php
session_start();
require_once("../_require.php");
$db=new database();
if(!$db->connect())exit();
$option = $_GET['option'];
$notif_timeout = "<script>setTimeout(hide, 5000);</script>";


if ($option == "grab_groups") {
    $request = "SELECT * FROM item_groups WHERE item_group_category_id='{$_POST['cid']}'";
    $result = $db->query( $request);
    echo '<label for="group">Group *</label>';
    echo '<select name="group" id="group" class="shadow">';
    echo '<option value="0" selected>Chose...</option>';
    while ($row = $db->fetch_assoc($result)) {
        echo '<option class="groups" value="' . $row['item_group_id'] . '">' . $row['item_group_name'] . '</option>';
    }
    echo '</select>';
}

if ($option == "post_advert") {

    if ($_POST['title'] != "") {
        if ($_POST['price'] != "") {
            if ($_POST['category'] != "") {
                if ($_POST['group'] != "") {
                    if ($_POST['state'] != "") {
                        if ($_POST['description'] != "") {
                            if ($_POST['city'] != "") {
                                if ($_POST['phone'] != "") {
                                    $request = "INSERT INTO item_posts (item_owner_id,item_name,item_price,item_category,item_group,item_state,item_description,item_city,item_phone_num) VALUES ('{$_SESSION['id']}','{$_POST['title']}', '{$_POST['price']}','{$_POST['category']}','{$_POST['group']}','{$_POST['state']}','{$_POST['description']}','{$_POST['city']}','{$_POST['phone']}')";
                                    $result = $db->query( $request);
                                    if ($db->error($db)) {
                                        echo "<p class='notification RED'>Something went wrong! Please try again" . $notif_timeout . "</p><br>";

                                    }
                                    $last_item_id = "SELECT item_id FROM item_posts ORDER BY item_id DESC LIMIT 1";
                                    $result_item_id = $db->query( $last_item_id);
                                    if ($db->error($db)) {
                                        echo "<p class='notification RED'>Something went wrong! Please try again" . $notif_timeout . "</p><br>";

                                    }
                                    $row = $db->fetch_assoc($result_item_id);
                                    $new_folder = '../img/item_images/' . $row['item_id'] . '/';
                                    mkdir($new_folder, 0777, true);

                                    echo "<p class='notification GREEN'>Sucesfully posted your advert!$notif_timeout</p><br>";
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

exit();

