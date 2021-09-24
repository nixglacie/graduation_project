<?php
session_start();
require_once("_require.php");
$db=new database();
if(!$db->connect())exit();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/mod.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous"></script>
    <title>Editor panel</title>

    <script>
    function hide() {
        $(".notification").remove();
    }
    </script>
    <script src="https://cdn.tiny.cloud/1/bq5m2vuub7uf27yyjc5gmnx7m273hag2l53zrzvzxdt3a2ny/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
</head>

<body>
    <div id="wrapper">
        <div id="notification_container"> </div><!-- alert container end -->
        <?php
        require_once("_header.php");
        
        if(login() and $_SESSION['status']=='Administrator'){
            echo '<div id="report_handling"><h2>Reports queue</h2><div id="reports_queue">';
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
            echo '</div></div>';
        }
        ?>

        <form style="display:inline-block;width:29%; loat:left;" id="categorys">
            <div class="input-container">
                <i class="fa fa-file icon fa-lg"></i>
                <input id="ct_title" class="input-field" type="text" placeholder="Category" name="ct_title">
            </div>
            <button id="ctg_sumbit" class="button btn" style="margin-bottom:30px;" type="submit"
                name="submit">Submit</button>
            <?php 
                $request="SELECT * FROM item_categories";
                $result=$db->query($request);

                while($row=$db->fetch_assoc($result)){
                    echo '<p class="categorys point" data-id="'.$row['item_category_id'].'">['.$row['item_category_id'].'] '.$row['item_category_name'].'</p>';
                }
            ?>
        </form>
        <form style="width:29%;float:left;" id="groups">
            <div class="input-container">
                <i class="fa fa-file icon fa-lg"></i>
                <input readonly="readonly" id="cat_id" class="input-field" type="text" placeholder="Category id" name="cat_id">
            </div>
            <div class="input-container">
                <i class="fa fa-file icon fa-lg"></i>
                <input id="grp_name" class="input-field" type="text" placeholder="Group" name="grp_name">
            </div>
            <button id="grp_submit" class="button btn" style="margin-bottom:30px;" type="submit"
                name="submit">Submit</button>
            <div id="group_output" style="max-height:320px;overflow-y:scroll; margin-bottom:20px;">
                <?php
                    $request="SELECT * FROM item_groups";
                    $result=$db->query($request);

                    while($row=$db->fetch_assoc($result)){
                        echo '<p>['.$row['item_group_category_id'].'] '.$row['item_group_name'].'</p>';
                    }
                ?>
            </div>
        </form>

        <form id="post_form" class="form1" action="editor_panel.php" method="POST" enctype="multipart/form-data"
            style="background-color: rgb(0,  0,  0, 0.5); padding: 20px; margin-bottom: 20px;">
            <h2 style="margin-bottom: 20px;">Block news post</h2>

            <div class="input-container right">
                <i class="fa fa-key icon fa-lg"></i>
                <input readonly="readonly" class="input-field" type="text" id="qn_id" placeholder="ID" name="qn_id">
            </div>

            <div class="input-container">
                <i class="fa fa-file icon fa-lg"></i>
                <input id="qn_title" class="input-field" type="text" placeholder="Title" name="qn_title">
            </div>
            <textarea id="qn_text" class="txtinput txtarea left" name="qn_text" placeholder="Text"></textarea>

            <div class="drop-zone point">
                <span class="drop-zone__prompt point">Drop file here or click to select (PNG only 270x350)
                </span>
                <input id="selected_img" class="drop-zone__input point drpz" type="file" name="file">
            </div>

            <button id="qn_sumbit" class="button btn" type="submit" name="submit">SUBMIT</button>
        </form>

        <?php
    $request="SELECT * FROM quick_news WHERE deleted=0 ORDER BY quick_news_id DESC LIMIT 3";
    $result=$db->query( $request);
    // 3 quick news blocks reading from DB
    while ($row=$db->fetch_assoc($result)) {
        echo '<div class="quick_news_box">';
        echo '<img src="uploads/'.$row['quick_news_id'].'.png" alt="">';
        echo '<div class="qnb_text_container">';
        echo '<h3>'.$row['quick_news_title'].'</h3>';

        echo '<p class="qn_short_text">';
        /* strips html tags beside exceptions under '' */
        $stripped=strip_tags($row['quick_news_text'], '<b><tbody><table><th><tr><td>');
        //cuz of ckeditor
        $ultra_stripped=str_replace("&nbsp;", ' ', $stripped);
        $tmp=explode(" ", $ultra_stripped);
        for ($i=0;$i<15&&$i<count($tmp);$i++) {
            echo $tmp[$i].' ';
        }
        echo '...</p>';
        echo '<p class="p_edit" data-nid="'.$row['quick_news_id'].'">EDIT</p>';
        echo '<p class="read_more" data-nid="'.$row['quick_news_id'].'">Read more &#8599;</p>';
        echo '</div>';
        echo '</div><!-- quick_news_box end -->';
    }
    ?>


        <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar: 'undo redo styleselect bold italic alignleft aligncenter alignright bullist numlist image link ',
            toolbar_mode: 'wrap',
            menubar: false,
            width: 800,
            min_height: 500,
            statusbar: true,
        });
        </script>
    </div><!-- wrapper end-->
    
            <!-- read more popup full text -->
            <div id="id03" class="modal none">
            <div id="read_more_wrapper" class="">

            </div>

        </div><!-- read full post popup end-->
</body>

</html>
<script src="ajax/editor_panel.js"></script>
<script src="ajax/async_index.js"></script>
<script>
$("form").submit(function(e) {
    e.preventDefault();
});
</script>