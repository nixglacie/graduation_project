<?php
session_start();
require_once("../_require.php");
$db=new database();
if(!$db->connect())exit();
$notif_timeout = "<script>setTimeout(hide, 5000);</script>";

/* checks if item post is owned by the person thats taking the action */
$sql_row = "SELECT * FROM item_posts WHERE item_name='{$_POST['adv_title']}' AND sold_to='{$_SESSION['id']}' AND item_rated=0";
$res_row = $db->query($sql_row);
$check_row = $db->num_rows($res_row);
$res_assoc = $db->fetch_assoc($res_row);


if ($check_row == 1 and $res_assoc['item_rated']==0) {
    if ($_POST['rcomment']!="") {
        if ($_POST['adc']!="") {
            if ($_POST['cww']!="") {
                if ($_POST['ra']!="") {
                    if ($_POST['gb']!="") {
                        $sql = "INSERT INTO account_comments (
                            account_comments_target,
                            account_comments_user_id,
                            account_comments_content,
                            account_comments_item_name,

                            comment_correct_desc,
                            comment_good_communication,
                            comment_good_deal,
                            account_comments_type
                        )
                        VALUES (
                            '{$res_assoc['item_owner_id']}',
                            '{$_SESSION['id']}',
                            '{$_POST['rcomment']}',
                            '{$_POST['adv_title']}',
                            '{$_POST['adc']}',
                            '{$_POST['cww']}',
                            '{$_POST['ra']}',
                            '{$_POST['gb']}'

                        )";
                        $db->query($sql);

                        $sql = "UPDATE item_posts SET item_rated=1 WHERE item_id='{$res_assoc['item_id']}'";
                        $db->query($sql);
                        echo "<p class='notification GREEN'>Succsefully submited your rating for this advert!".$notif_timeout."</p><br>";
                    } else {
                        echo "<p class='notification ORANGE'>Please select POSITIVE or NEGATIVE rating type.".$notif_timeout."</p><br>";
                    }
                } else {
                    echo "<p class='notification ORANGE'>Please select [Respected agreement] score.".$notif_timeout."</p><br>";
                }
            } else {
                echo "<p class='notification ORANGE'>Please select [Communication went well] score.".$notif_timeout."</p><br>";
            }
        } else {
            echo "<p class='notification ORANGE'>Please select [Advert description accuracy] score.".$notif_timeout."</p><br>";
        }
    } else {
        echo "<p class='notification ORANGE'>Comment box cannot be empty.".$notif_timeout."</p><br>";
    }
} else {
    echo "<p class='notification RED'>You cant rate this advert. Beacause it was not sold to you or you rated it already.".$notif_timeout."</p><br>";
}