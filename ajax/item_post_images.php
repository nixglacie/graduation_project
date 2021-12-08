<?php
session_start();
require_once("../_require.php");
$db=new database();
if(!$db->connect())exit();

$dir = "../img/item_images/".$_POST["id"]."/"; 
$files = scandir($dir);
$files = array_slice($files, 2);
$num = count($files);
/* IMG UPLOAD */
if(isset($_FILES['selected_img']) and $num<10){
    $file = $_FILES['selected_img'];

    $fileName = $_FILES['selected_img']['name'];
    $fileTmpName = $_FILES['selected_img']['tmp_name'];
    $fileSize = $_FILES['selected_img']['size'];
    $fileError = $_FILES['selected_img']['error'];
    $fileType = $_FILES['selected_img']['type'];
    /* fiding how many rows there is and adding +1 to it */
    $ServerFileName = round(microtime(true)*1000);
    /* break file name */
    $fileExt = explode('.', $fileName);
    /* get file extension */
    $fileActualExt = strtolower(end($fileExt));
    
    require_once("../functions/functions.php");
    $file_on_disc ="../img/item_images/".$_POST['id']."/".$fileName;
    
    if (in_array($fileActualExt, $allow)) {
        /* checks if there was an error */
        if ($fileError === 0) {
            /* checks if file is in range of allowed size */
            if ($fileSize < 5242880) {
                /* names the file on server */
                $fileNameNew = $ServerFileName.".".$fileActualExt;
                /* path to file on server */
                $fileDestination = "../img/item_images/".$_POST['id']."/".$fileNameNew;
                /* moves from TMP location to designed DESTINATION */
                move_uploaded_file($fileTmpName, $fileDestination);
                echo "<p style='margin-left:0px; margin-top:20px; margin-bottom:-5px;width:100%;' class='notification GREEN'>Succesfully uploaded image!</p><br>";
            } else  echo "<p style='margin-left:0px; margin-top:20px; margin-bottom:-5px;width:100%;' class='notification ORANGE'>Your image is too big!</p><br>";
        } else  echo "<p style='margin-left:0px; margin-top:20px; margin-bottom:-5px;width:100%;' class='notification ORANGE'>There was an error uploading your image!</p><br>";
    } else echo "<p style='margin-left:0px; margin-top:20px; margin-bottom:-5px;width:100%;' class='notification RED'>You cannot upload image of this type!</p><br>";
}


if(isset($_GET['option'])){
    $option=$_GET['option'];
} else $option="";

$sql="SELECT * FROM item_posts WHERE item_id='{$_POST['id']}' AND item_owner_id='{$_SESSION['id']}'";
$res=$db->query($sql);
$row=$db->num_rows($res);

$dir = "../img/item_images/".$_POST["id"]."/";
if($option=="delete" and ($row>0 or $_SESSION['status']=="Administrator")){
    unlink($dir . $_POST['iiname']);
    echo "<p style='margin-left:0px; margin-top:20px; margin-bottom:-5px;width:100%;' class='notification GREEN'>Succesfully deleted image!</p><br>";

}
$files = scandir($dir);
$files = array_slice($files, 2);
$num = count($files);
if($num>=10){
    echo "<p id='max_pics'>This post has reached maximum number of pictures.<br>You still can replace existing pictures by left clicking and deleting.</p>";
} else {
    echo '<div class="drop-zone point">';
    echo '<span class="drop-zone__prompt point">Drop file here or click to select (PNG,JPG)';
    echo '</span>';
    echo '<input id="selected_img" class="drop-zone__input point" type="file" name="selected_img">';
    echo '</div>';

}
for ($i=0;$i<$num;$i++) {

    echo "<img onclick='clickIMAGE(this)' class='image_thumb' data-id=".($i+1)." src='img/item_images/{$_POST['id']}/{$files[$i]}');\"></img>";

    if($i==4) echo "<br>";
}

echo "<script>prettyIMGupload();</script>";
exit();
?>

