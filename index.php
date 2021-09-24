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
    <link rel="stylesheet" href="css/slider.css">
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous"></script>
    <link rel="icon" href="img/homee.png">
    <title>ROSE</title>
</head>

<body>
    <div id="wrapper">
        <div id="notification_container"> </div><!-- alert container end -->
        <?php
        require_once("_header.php");
        ?>




        <!-- slider container -->
        <div class="snb_container">

            <div class="slider">
                <div class="slide active" style="background-image: url('img/FPS/01.png')">
                <div class="container">
                        <div class="caption" style="background-color:transparent;">
                            <!--
                            <h1>Dedan tritun dolor sit amet</h1>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quisquam accusamus eius
                                molestiae labore sequi blanditiis nulla, ipsa quae saepe praesentium suscipit sit?
                                Perspiciatis voluptas enim nemo impedit aspernatur eos eveniet.</p>
                            -->
                            <a href="https://www.tehnomanija.rs/akcija/huawei-letnja-promocija">Visit site</a>
                        </div>
                    </div>
                </div>
                <div class="slide" style="background-image: url('img/FPS/02.png')">
                
                    <div class="container">
                        <div class="caption" style="background-color:transparent;">
                            <!--
                            <h1>Dedan tritun dolor sit amet</h1>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quisquam accusamus eius
                                molestiae labore sequi blanditiis nulla, ipsa quae saepe praesentium suscipit sit?
                                Perspiciatis voluptas enim nemo impedit aspernatur eos eveniet.</p>
                            -->
                            <a href="https://www.tehnomanija.rs/akcija/apple-ipad-8">Visit site</a>
                        </div>
                    </div>
                </div>
                <div class="slide" style="background-image: url('img/FPS/03.png')">
                    <div class="container">
                        <div class="caption" style="background-color:transparent;">
                            <!--
                            <h1>Dedan tritun dolor sit amet</h1>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quisquam accusamus eius
                                molestiae labore sequi blanditiis nulla, ipsa quae saepe praesentium suscipit sit?
                                Perspiciatis voluptas enim nemo impedit aspernatur eos eveniet.</p>
                            -->
                            <a href="https://www.tehnomanija.rs/akcija/tvoj-telefon-tvoj-izbor-ponuda">Visit site</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- controls  -->
            <div class="controls">
                <div class="prev"></div>
                <div class="next"></div>
            </div>

            <!-- indicators -->
            <div class="indicator">
            </div>

        </div>

        <!-- status container -->
        <div class="status_container">
            <H1>Number of active ads per category</H1>
            <?php
            $categoryNum_request="SELECT * FROM item_categories";
            $categoryNum_result=$db->query($categoryNum_request);
            while($categoryNum_row=$db->fetch_assoc($categoryNum_result)){
                echo '<div class=""><p class="ctgry_numads shadow">'.$categoryNum_row['item_category_name'].'</p>';
                echo grabCategoryNumOfAds($categoryNum_row['item_category_name']);
                echo '</div>';
            }
        ?>
        </div><!-- status container end -->

        <?php
    $request="SELECT * FROM quick_news WHERE deleted=0 ORDER BY quick_news_id DESC LIMIT 3";
    $result=$db->query($request);

    if ($db->error($db)) {
        echo "Greska prilikom izvrsavanja upita!!!!<br>";
        echo $db->error($db)." (".$db->$db->errorno($db).")";
        exit();
    }
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
        echo '<p class="read_more" data-nid="'.$row['quick_news_id'].'">Read more &#8599;</p>';
        echo '</div>';
        echo '</div><!-- quick_news_box end -->';

    }
    ?>


        <!-- title container -->
        <div class="title_container_wide">
            <h2>Advert categories</h2>
        </div>

        <!-- title container -->
        <div class="title_container none"></div>


        <?php
            $category_request="SELECT * FROM item_categories";
            $category_result=$db->query($category_request);
            while($category_row=$db->fetch_assoc($category_result)){
                echo '<div class="category_container shadow">';
                echo '<h2>'.$category_row['item_category_name'].'</h2>';
                grabCategoryAds($category_row['item_category_name']);
                echo '</div>';
            }
        ?>

        <!-- read more popup full text -->
        <div id="id03" class="modal none">
            <div id="read_more_wrapper" class="">

            </div>

        </div><!-- read full post popup end-->

        <footer>

        </footer><!-- footer end -->
    </div><!-- wrapper end -->
    </div>

    <?php 
    require_once("_footer.php");
    ?>
</body>

</html>
<script src="js/main.js"></script>
<script src="js/slider.js"></script>
<script src="ajax/async_index.js"></script>
<?php
exit();
?>