<?php
$db=mysqli_connect("localhost", "root", "", "rose");
mysqli_query($db, "SET NAMES utf8");
$opcija=$_GET['opcija'];
if($opcija=="update")
{
    $sql="UPDATE account_comments SET account_comments_content='{$_POST['cmnt_cont']}' WHERE account_comments_id={$_POST['cmnt_id']}";
    mysqli_query($db, $sql);
    if(mysqli_error($db)) echo "Greska!!!<br>".mysqli_error($db);
    else echo "Uspesno izmenjen korisnik";
}
?>