<?php
session_start();
require_once("../_require.php");
$db=new database();
if(!$db->connect())exit();

$option=$_GET['option'];
$notif_timeout="<script>setTimeout(hide, 5000);</script>";
if ($option=="bookmark") {
    if($_POST['id']!=""){
        $sql="SELECT * FROM item_bookmarks WHERE bookmark_item_id='{$_POST['id']}' AND bookmark_owner_id='{$_SESSION['id']}'";
        $res=$db->query($sql);
        $row=$db->num_rows($res);
        if ($row==0) {
            $sql="INSERT INTO item_bookmarks (bookmark_owner_id,bookmark_item_id) VALUES ('{$_SESSION['id']}','{$_POST['id']}')";
            $db->query($sql);
            if ($db->error($db)) {
                echo "<p class='notification RED'>Something went wrong! Please try again".$notif_timeout."</p><br>";
            }//.$db->error($db);
            else {
                echo "<p class='notification GREEN'>Succesfully added this item to your bookmarks!".$notif_timeout."</p><br>";
            }
        } else echo "<p class='notification ORANGE'>You already have this item bookmarked!".$notif_timeout."</p><br>";
    } 
}

if ($option=="remove_bookmark") {
    if($_POST['id']!=""){
    $sql="SELECT * FROM item_bookmarks WHERE bookmark_item_id='{$_POST['id']}' AND bookmark_owner_id='{$_SESSION['id']}'";
    $res=$db->query($sql);
    $row=$db->num_rows($res);
    if ($row!=0) {
        $sql="DELETE FROM item_bookmarks WHERE bookmark_item_id='{$_POST['id']}'";
        $db->query($sql);
        if($db->error($db)) {
            echo "<p class='notification RED'>Something went wrong! Please try again".$notif_timeout."</p><br>";//.$db->error($db);
        }else echo "<p class='notification GREEN'>Succesfully removed this item from your bookmarks!".$notif_timeout."</p><br>";
    }   
    }
}