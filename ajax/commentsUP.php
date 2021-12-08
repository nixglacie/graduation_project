<?php  
session_start();
require_once("../_require.php");
$db=new database();
if(!$db->connect())exit();

$request="SELECT * FROM view_account_comments WHERE account_comments_target='{$_GET['u']}' AND account_comments_type=1 AND account_comments_replay_target IS NULL AND deleted=0 ORDER BY account_comments_id DESC";
$result=$db->query($request);



while($row=$db->fetch_assoc($result)) {

$img_path=getExistingFile("../img/user_profile_pictures/".$row['account_comments_user_id']);
$img_path = substr($img_path,3);
$pieces=explode(" ", $row['account_comments_date']);
echo '<div class="comment_container">';
echo '<a href="profile.php?u='.$row['account_comments_user_id'].'"><img class="uc_comm_picture" src="'.$img_path.'" alt=""></a>';
echo '<a class="u_profileLINK" href="profile.php?u='.$row['account_comments_user_id'].'">'.$row['account_username'].' ––– '.$pieces[0].'</a>';
echo '<div class="rating_div default"><p><img src="img/description.png">'.$row["comment_correct_desc"].'</p><p><img src="img/communication.png">'.$row["comment_good_communication"].'</p><p><img src="img/deal.png">'.$row["comment_good_deal"].'</p></div>';
echo '<div class="comment_title"><p><b>'.$row['account_comments_item_name'].'</b></p></div>';
echo '<div class="uc_container">'.$row['account_comments_content'].'</div>';
echo '<p class="commentUP">&#9745;</p>';
if(@$_SESSION['id']==$row['account_comments_user_id']){
    echo '<div class="edit" data-id="'.$row["account_comments_id"].'" data-content="'.rawurlencode($row["account_comments_content"]).'"><img src="img/edit.png" alt=""></div>';
    echo '<div class="replay" data-id="'.$row["account_comments_id"].'"><img src="img/replay.png" alt=""></div>';
    echo '<div class="delete" data-id="'.$row["account_comments_id"].'"><img src="img/delete.png" alt=""></div>';
} else if(@$_SESSION['id']==$_GET['u']){
    echo '<p class="replay" data-id="'.$row["account_comments_id"].'"><img src="img/replay.png" alt=""></p>';
} 
echo '</div>';
$request2="SELECT * FROM view_account_comments WHERE  account_comments_replay_target=".$row['account_comments_id']." AND account_comments_target IS NULL AND deleted=0";
$result2=$db->query($request2);

if($result2=="0"){
} else {
    while($row2=$db->fetch_assoc($result2)){  
        $pieces2=explode(" ", $row2['account_comments_date']);
        $img_path=getExistingFile("../img/user_profile_pictures/".$row2['account_comments_user_id']);
        $img_path = substr($img_path,3);
        echo '<div class="ucr_container">';
        echo '<a href="profile.php?u='.$row2['account_comments_user_id'].'"><img class="ucr_comm_picture" src="'.$img_path.'" alt=""></a>';
        echo '<a class="u_profileLINK" href="profile.php?u='.$row2['account_comments_user_id'].'">'.$pieces2[0].' ––– '.$row2['account_username'].'</a>';
        echo '<div class="uc_replay">'.$row2['account_comments_content'].'</div>';
        if(@$_SESSION['id']==$row2['account_comments_user_id']){
            echo '<div class="edit" data-id="'.$row2["account_comments_id"].'" data-content="'.rawurlencode($row2["account_comments_content"]).'"><img src="img/edit.png" alt=""></div>';
            echo '<div class="delete" data-id="'.$row2["account_comments_id"].'"><img src="img/delete.png" alt=""></div>';
        }
        echo '</div>';
    }
}
}
exit();
?>