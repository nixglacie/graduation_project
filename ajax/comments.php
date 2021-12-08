<?php
session_start();
require_once("../_require.php");
$db=new database();
if(!$db->connect())exit();

$option=$_GET['option'];
$notif_timeout="<script>setTimeout(hide, 5000);</script>";
if($option=="update")
{
    $sql="SELECT COUNT(*) FROM account_comments WHERE account_comments_user_id={$_SESSION['id']} AND account_comments_id={$_POST['id']}";
    $res=$db->query($sql);
    $row=mysqli_fetch_array($res, MYSQLI_NUM);
    if($row[0]==1){
        $sql="UPDATE account_comments SET account_comments_content='{$_POST['content']}' WHERE account_comments_id={$_POST['id']}";
        $db->query($sql);
        if($db->error($db)) echo "<p class='notification RED'>Something went wrong! Please try again.".$notif_timeout."</p><br>";//.$db->error($db);
        else echo "<p class='notification GREEN'>Succesfully updated your comment!".$notif_timeout."</p><br>";
    } else echo "<p class='notification RED'>Nice try!".$notif_timeout."</p><br>";
}

if($option=="insert")
{
    if($_POST['content']!=""){
        $sql="INSERT INTO account_comments (account_comments_replay_target,	account_comments_user_id, account_comments_content) VALUES ('{$_POST['id']}', '{$_SESSION['id']}' , '{$_POST['content']}')";
        $db->query($sql);
        if($db->error($db)) echo "<p class='notification RED'>ERROR!".$notif_timeout."</p><br>";//.$db->error($db);
        else echo "<p class='notification GREEN'>SUCCESS!".$notif_timeout."</p><br>";
    } else echo "<p class='notification ORANGE'>Please enter text before posting the comment!".$notif_timeout."</p><br>"; 
}

if($option=="delete")
{
    $sql="SELECT COUNT(*) FROM account_comments WHERE account_comments_user_id={$_SESSION['id']} AND account_comments_id={$_POST['id']}";
    $res=$db->query($sql);
    $row=mysqli_fetch_array($res, MYSQLI_NUM);
    if ($row[0]==1) {
        $sql="UPDATE account_comments SET deleted=1 WHERE account_comments_id={$_POST['id']}";
        $db->query($sql);
        if ($db->error($db)) {
            echo "<p class='notification RED'>Something went wrong! Please try again.".$notif_timeout."</p><br>";//.$db->error($db);
        }
            else echo "<p class='notification GREEN'>Succesfully deleted your comment!".$notif_timeout."</p><br>";
    } else echo "<p class='notification RED'>Nice try!".$notif_timeout."</p><br>";
}
?>