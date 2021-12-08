
<?php
session_start();
require_once("../_require.php");
$db=new database();
if(!$db->connect())exit();

$option=$_GET['option'];

if ($option=="add_grp" and $_POST['cid']!="") {
    $request="INSERT INTO item_groups (item_group_category_id , item_group_name) VALUES ('{$_POST['cid']}', '{$_POST['gname']}')";
    $result=$db->query($request);
    $request="SELECT * FROM item_groups";
    $result=$db->query($request);

    while ($row=$db->fetch_assoc($result)) {
        echo '<p>['.$row['item_group_category_id'].' ]'.$row['item_group_name'].'</p>';
    }
}

if ($option=="qn_post" and $_POST['qn_id']=="") {

    /* quick_news posting */
    $request="SELECT quick_news_id FROM quick_news ORDER BY quick_news_id DESC LIMIT 1";
    $result=$db->query($request);
    $row=($db->fetch_assoc($result));
    

    
    $qn_title= $_POST['qn_title'];
    $qn_text= $_POST['qn_text'];
    if ($qn_title!='' and $qn_text!='') {
        
        /* IMG UPLOAD */
        $file = $_FILES['file'];

        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];
        /* fiding how many rows there is and adding +1 to it */
        $ServerFileName = (intval($row['quick_news_id'])+1);
        echo $ServerFileName;
        /* break file name */
        $fileExt = explode('.', $fileName);
        /* get file extension */
        $fileActualExt = strtolower(end($fileExt));
        /* allowed typed of files */
        $allow = array('png','jpg');

        if (in_array($fileActualExt, $allow)) {
            /* checks if there was an error */
            if ($fileError === 0) {
                /* checks if file is in range of allowed size */
                if ($fileSize < 5242880) {
                    /* names the file on server */
                    $fileNameNew = $ServerFileName.".".$fileActualExt;
                    /* path to file on server */
                    $fileDestination = '../uploads/'.$fileNameNew;
                } else {
                    echo "<p class='notification ORANGE'>Your file is too big!<script>setTimeout(hide, 5000);</script></p><br>";
                }
            } else {
                echo "<p class='notification RED'>There was an error uploading your file!<script>setTimeout(hide, 5000);</script></p><br>";
            }


            $requestCHECK="SELECT * FROM quick_news WHERE deleted=0 AND ( quick_news_title='$qn_title' OR quick_news_text='$qn_text' )";
            $resultCHECK=$db->query($requestCHECK);
            $row=$db->fetch_assoc($resultCHECK);
            if ($db->num_rows($resultCHECK)==1) {
                echo "<p class='notification RED'>Post with same title or text already exists!<script>setTimeout(hide, 5000);</script></p><br>";
                exit();
            } elseif ($fileName!='') {
                $request_insert="INSERT INTO quick_news (quick_news_title,quick_news_text) VALUES ('{$qn_title}','{$qn_text}')";
                $result_insert=$db->query($request_insert);
                if ($db->error($db)) {
                    echo $db->error($db);
                    echo "<p class='notification RED'>Failed to insert into database!<script>setTimeout(hide, 5000);</script></p><br>";
                    exit();
                } else {
                    echo "<p class='notification GREEN'>Succesfully submited post to database!<script>setTimeout(hide, 5000);</script></p><br>";
                    /* moves from TMP location to designed DESTINATION */
                    move_uploaded_file($fileTmpName, $fileDestination);
                }
               
            } else {
                echo "<p class='notification ORANGE'>Select image for cover<script>setTimeout(hide, 5000);</script></p><br>";
            }
        } else {
            echo "<p class='notification RED'>You cannot use image of this type<br>or cover image wasnt selected!<script>setTimeout(hide, 5000);</script></p><br>";
        }
    } else {
        echo "<p class='notification ORANGE'>Title or text missing!<script>setTimeout(hide, 5000);</script></p><br>";
    }
}

if ($option=="qn_post" and $_POST['qn_id']!="") {
    if ($_POST['qn_title']!="" and $_POST['qn_text']!="") {
        $request="UPDATE quick_news SET quick_news_text='{$_POST['qn_text']}' , quick_news_title='{$_POST['qn_title']}' WHERE quick_news_id={$_POST['qn_id']}";
        $db->query($request);
        if ($db->error($db)) {
            $response['error']="<p class='notification RED'>Something went wrong please try again!<script>setTimeout(hide, 5000);</script></p><br>";
        } else {
            $response['success']="<p class='notification GREEN'>Sucessfully updated post!<script>setTimeout(hide, 5000);</script></p><br>";
        }
    } else {
        $response['error']="<p class='notification ORANGE'>Title or text cannot be empty!<script>setTimeout(hide, 5000);</script></p><br>";
    }
    echo JSON_encode($response, 256);
}

if($option=="report_handle" and $_SESSION['status']=="Administrator"){
    $request="UPDATE item_post_report SET report_addressed=1 WHERE item_id='{$_POST['iid']}'";
    $result=$db->query($request);
    if($db->error($db)){
        echo "<p class='notification RED'>Something went wrong please try again!<script>setTimeout(hide, 5000);</script></p><br>";
    } else {
        $rep_request="SELECT * FROM view_item_reports WHERE report_addressed=0 ORDER BY report_id LIMIT 10";
        $rep_result=$db->query($rep_request);
        if($db->error($db)){
    
        }else while($rep_row=$db->fetch_assoc($rep_result)) {
            echo '<button class="rerpot_data" data-rid="'.$rep_row['item_id'].'" >Done?</button><a href="advert_page.php?iid='.$rep_row['item_id'].'">'.$rep_row['item_name'];
            if($rep_row['report_reason']==1){
                echo ' <b>[Wrong category/group]</b>';
            } else if($rep_row['report_reason']==2){
                echo ' <b>[Against rules]</b>';
            } else if($rep_row['report_reason']==3){
                echo ' <b>[Other reasons]</b>';
            }
            echo'</a><br>';
        }
    }
}

exit();
?>