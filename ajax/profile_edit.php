<?php
session_start();
require_once("../_require.php");
$db=new database();
if(!$db->connect())exit();
$notif_timeout="<script>setTimeout(hide, 5000);</script>";

if($_SESSION['id']==$_POST['user_profile_id']){
    if($_POST["u_username"]!=""){
    $sql="UPDATE accounts SET account_username='{$_POST['u_username']}', u_phone='{$_POST['u_phone']} ',u_city='{$_POST['u_city']}', account_description='{$_POST['user_profile_description']}' WHERE account_id={$_POST['user_profile_id']}";
    $db->query($sql);
    if($db->error($db)) {echo "<p class='notification RED'>Something went wrong! Please try again.$notif_timeout</p><br>"; exit();}//.$db->error($db);
    else echo "<p class='notification GREEN'>Succesfully updated your profile!$notif_timeout</p><br>"; 
    } else {echo "<p class='notification ORANGE'>Username cannot be empty!$notif_timeout</p><br>"; exit();}
} else {echo "<p class='notification RED'>Nice try!$notif_timeout</p><br>"; exit();}

// image // 

/* IMG UPLOAD */
$file = $_FILES['selected_img'];

$fileName = $_FILES['selected_img']['name'];
$fileTmpName = $_FILES['selected_img']['tmp_name'];
$fileSize = $_FILES['selected_img']['size'];
$fileError = $_FILES['selected_img']['error'];
$fileType = $_FILES['selected_img']['type'];
/* fiding how many rows there is and adding +1 to it */
$ServerFileName = $_SESSION['id'];
/* break file name */
$fileExt = explode('.', $fileName);
/* get file extension */
$fileActualExt = strtolower(end($fileExt));

//require_once("../functions/functions.php");
$file_on_disc = getExistingFile("../img/user_profile_pictures/".$_SESSION['id']);

if (in_array($fileActualExt, $allow)) {
    /* checks if there was an error */
    if ($fileError === 0) {
        /* checks if file is in range of allowed size */
        if ($fileSize < 5242880) {
            /* names the file on server */
            $fileNameNew = $ServerFileName.".".$fileActualExt;
            /* path to file on server */
            $fileDestination = '../img/user_profile_pictures/'.$fileNameNew;

            if ($fileName!='') {
                if($file_on_disc!=false){
                    unlink($file_on_disc);
                }
                /* moves from TMP location to designed DESTINATION */
                move_uploaded_file($fileTmpName, $fileDestination);
            } 
        } else  echo "<p class='notification ORANGE'>Your file is too big!$notif_timeout</p><br>";
    }
} else if($fileName!=''){
    echo "<p class='notification RED'>You cannot upload file of this type!$notif_timeout</p><br>";
}
exit();
?>