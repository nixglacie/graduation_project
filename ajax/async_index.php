<?php
session_start();
require_once("../_require.php");
$db=new database();
if(!$db->connect())exit();

$request="SELECT * FROM quick_news WHERE deleted=0 AND quick_news_id='{$_POST['id']}' ORDER BY quick_news_id DESC LIMIT 3";
$result=$db->query($request);
$row=$db->fetch_assoc($result);
echo '<h1 class="ttle">'.$row['quick_news_title'].'</h1>';
$ultra_stripped=str_replace("&nbsp;", ' ', $row['quick_news_text']);
echo '<span onclick="close_modal()" class="close" title="Close">&times;</span>
';
echo '<div class="cntent">';
echo $ultra_stripped;
echo '</div>';
exit();
?>