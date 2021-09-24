        <?php
        $viewers_ip = $_SERVER['REMOTE_ADDR'];
        $viewers_request = "SELECT viewers_ip FROM item_views WHERE viewers_ip='{$viewers_ip}' AND viewed_item_id='{$_GET['iid']}'";
        $viewers_result = $db->query($viewers_request);
        if ($db->num_rows($viewers_result) < 1) {
            $viewers_request = "INSERT INTO item_views(viewers_ip,viewed_item_id) VALUES('{$viewers_ip}','{$_GET['iid']}')";
            $viewers_result = $db->query($viewers_request);
        }
        ?>
        <div id="left_block" class="left">
            <div id="main_cont" class="left">

                <div id="image_slider">
                    <!-- slider container -->
                    <div class="snb_container">

                        <div class="slider">

                            <?php
                            $dir = "img/item_images/" . $_GET["iid"] . "/";
                            $files = scandir($dir);
                            $files = array_slice($files, 2);
                            $num = count($files) - 1;
                            for ($i = 0; $i <= $num; $i++) {
                                if ($i == 0) {
                                    echo "<div class=\"slide active\" style=\"background-image:url('img/item_images/{$_GET['iid']}/{$files[$i]}');\"></div>";
                                } else echo "<div class=\"slide\" style=\"background-image:url('img/item_images/{$_GET['iid']}/{$files[$i]}');\"></div>";
                            }
                            ?>
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
                </div><!-- image_slider end -->

                <h1 class="item_name"><?php echo $row_advert_info["item_name"] ?></h1>

                <?php
                if ($_SESSION['id'] == $row_advert_info["item_owner_id"] or $_SESSION['status']=="Administrator") {
                    echo '<button id="edit_post" class="btn right"><i class="fas fa-edit"></i>Edit advert</button>';
                    echo '<button id="delete_post" class="btn right"><i class="fas fa-trash-alt"></i>Delete advert</button>';
                } else {
                    if (isset($_SESSION['id'])) {
                        $button_request = "SELECT * FROM item_bookmarks WHERE bookmark_owner_id='{$_SESSION['id']}' AND bookmark_item_id='{$_GET['iid']}'";
                        $button_result = $db->query($button_request);
                        $button_row = $db->num_rows($button_result);
                        if ($button_row != 0) {
                            echo '<button id="bookmarked" class="btn right"><i class="fas fa-bookmark"></i>Bookmarked</button>';
                            echo '<button id="bookmark" class="btn right none"><i class="far fa-bookmark"></i>Bookmark</button>';
                        } else {
                            echo '<button id="bookmarked" class="btn right none"><i class="fas fa-bookmark"></i>Bookmarked</button>';
                            echo '<button id="bookmark" class="btn right"><i class="far fa-bookmark"></i>Bookmark</button>';
                        }
                    }
                }

                ?>

                <p class="price">
                    <span class="price_title">Price</span><br><span
                        class="price_content"><?php echo $row_advert_info["item_price"] ?>,00&nbsp;&euro;</span>

                    <button id="contact" class="btn right"><i class="fas fa-phone-alt"></i>Contact</button>
                </p>

                <ul id="stats">
                    <li><i class="fas fa-address-card"></i> <?php echo $_GET["iid"] ?></li>
                    <li><i class="fas fa-eye"></i>
                        <?php
                        $request_view = "SELECT COUNT(*) FROM item_views WHERE viewed_item_id='{$_GET['iid']}'";
                        $result_view = $db->query($request_view);
                        $row_view = mysqli_fetch_array($result_view);
                        if ($row_view[0]) echo $row_view[0];
                        else echo "0";
                        ?>
                    </li>
                    <li><i class="far fa-clock"></i> <?php
                    $pieces = explode(" ", $row_advert_info["item_post_date"]);
                    echo $pieces[0] ?></li>
                </ul>

                <ul id="item_atributes">
                    <h2>Product atributes</h2>
                    <li class="left">
                        <p class="left">State</p>
                        <?php
                        if ($row_advert_info['item_state'] == 1) {
                            echo '<p id="advert_state" data-state_value="1" class="right">Like new (never used)</p>';
                        } else if ($row_advert_info['item_state'] == 2) {
                            echo '<p id="advert_state" data-state_value="2" class="right">Used</p>';
                        } else echo '<p id="advert_state" data-state_value="3" class="right">Broken / not Working</p>';
                        ?>
                    </li>

                    <li class="left">
                    </li>
                </ul>

            </div><!-- main_cont end -->

            <div id="item_desc_cont" class="left">
                <h2>Description</h2>
                <div data-category_value="<?php echo $row_advert_info["item_category_id"] ?>" id="item_desc_txt">
                    <?php echo $row_advert_info["item_description"] ?>
                </div>
                <p><b>Category : </b><?php echo $row_advert_info['item_category_name']; ?><br><b>Group : </b> 
                    <?php echo $row_advert_info['item_group_name']; ?> </p>
            </div><!-- item description end -->
        </div><!-- left block end -->


        <div id="right_block" class="right">
            <div data-id="<?php echo $_SESSION['id']; ?>" id="profile_cont">
                <!--<img src="img/frame.png" alt="">-->
                <?php
                $img_path = getExistingFile("img/user_profile_pictures/" . $row_advert_info["item_owner_id"]);
                echo '<img class="shadow point" src="' . $img_path . '" alt="">';
                echo '<p class="rose point"><a href="profile.php?u=' . $row_advert_info["item_owner_id"] . '&ap=1"><i class="fas fa-folder-plus"></i>All posts of '.$row_advert_info["account_username"].'</p></a>';
                echo '<p id="cntact" class="rose point"><i class="fas fa-phone-square-alt"></i> Contact</p>';
                ?>
            </div>

            <?php
                if($_SESSION['id']==$row_advert_info["item_owner_id"]){
                    echo '<div id="sell_to_user_search"><h2>Search and select user that bought this product.</h2>';
                    echo '<div class="input-container"><i class=" fa fa-people-carry icon fa-lg"></i>';
                    echo '<input class="input-field" type="text" id="user_search" placeholder="Username" name="user_search">';
                    echo '</div><div id="user_search_output"></div><h2>After which they can rate your service and product.</h2></div>';
                }
            ?>

            <div id="user_location_cont">
                <h2>Location</h2>
                <p id="advert_city"><?php echo $row_advert_info['item_city']; ?></p>
            </div>

            <?php
            if(login()){
            echo '<div id="report_cont">';
            echo '<p id="report_ad" class="point"><i class="fas fa-flag"></i>Report this post</p>';
            echo '</div>';
            }

            ?>

            <?php

            $request = "SELECT * FROM item_posts WHERE item_owner_id='{$row_advert_info['item_owner_id']}' AND deleted=0 AND sold_to IS NULL AND item_id!='{$_GET['iid']}' ORDER BY item_id DESC LIMIT 3";
            $result = $db->query($request);
            if ($db->num_rows($result) != 0) {
                echo '<div id="more_posts_cont">';
                echo '<h2>More post of this user</h2>';
                while ($row = $db->fetch_assoc($result)) {
                    $dir = "img/item_images/" . $row["item_id"] . "/";
                    $files = scandir($dir);
                    $files = array_slice($files, 2);
                    $pieces = explode(".", $files[0]);
                    $img_path = getExistingFile("img/item_images/" . $row["item_id"] . "/" . $pieces[0]);
                    echo '<div class="more_item_container">';
                    if ($img_path) {
                        echo '<a href="advert_page.php?iid=' . $row["item_id"] . '"><img src="' . $img_path . '" alt=""><h2>' . $row["item_name"] . '</h2></a>';
                    } else {
                        echo '<a href="advert_page.php?iid=' . $row["item_id"] . '"><img src="img/item_images/no_image.png" alt=""><h2>' . $row["item_name"] . '</h2></a>';
                    }
                    $pieces = explode(" ", $row["item_post_date"]);
                    echo '<p>' . $pieces[0] . '</p>';
                    echo '<p>' . $row["item_price"] . ',00 &euro;</p>';
                    echo '</div><!-- item container end -->';
                }
                echo '</div><!-- more posts end -->';
            }

            ?>
        </div>

        <!-- modals -->
        <div id="id03" class="modal none">
            <!-- item_post editing form -->
            <form class="form2 shadow none" id="item_post_edit_form" method="POST">
                <div class="input-container">
                    <i class="fa fa-address-card icon fa-lg"></i>
                    <input class="input-field" type="text" id="ad_title" placeholder="Title" name="i_name">
                </div>

                <div class="input-container">
                    <i class=" fa fa-euro-sign icon fa-lg"></i>
                    <input class="input-field" type="text" id="ad_price" placeholder="Price // without , . symbols"
                        name="i_price">
                </div>

                <div id="adv_category" class="input-container">
                    <label for="category">Category *</label>
                    <select name="category" id="category" class="shadow">
                        <option value="0" selected>Chose...</option>
                        <?php
                        // grabbing categories
                        $request = "SELECT * FROM item_categories";
                        $result = $db->query($request);

                        while ($row_cat = $db->fetch_assoc($result)) {
                            echo '<option value="' . $row_cat['item_category_id'] . '">' . $row_cat['item_category_name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div id="adv_group" class="input-container">
                    <label for="group">Group *</label>
                    <select name="group" id="group" class="shadow">
                        <option value="<?php echo $row_advert_info['item_group_id']?>" selected>
                            <?php echo $row_advert_info['item_group_name']?></option>
                        <?php
                        // grabbing groups coresponding to category
                        $request = "SELECT * FROM item_groups";
                        $result = $db->query($request);

                        while ($row_cat = $db->fetch_assoc($result)) {
                            echo '<option value="' . $row_cat['item_group_id'] . '">' . $row_cat['item_group_name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div id="adv_state" class="input-container">
                    <label for="state">State *</label>
                    <input type="radio" value="1" class="radio" name="state" id="new_not_used">Like new(never used)
                    <input type="radio" value="2" class="radio" name="state" id="used">Used
                    <input type="radio" value="3" class="radio" name="state" id="broken_not_working">Broken / Not
                    Working
                </div>

                <div id="form_images_cont">

                </div>

                <div class="input-container" style="margin-top:10px;">
                    <i class="fa fa-edit icon fa-lg"></i>
                    <textarea class="input-field comment_editor" type="text" id="advert_description"
                        placeholder="Description" name="item_post_description" value=""></textarea>
                </div>
                <div id="adv_city" class="input-container">
                    <i class="fa fa-city icon fa-lg"></i>
                    <input class="input-field" type="text" id="ad_city" placeholder="City*" value="" name="ad_name">
                </div>
                <div id="adv_phone" class="input-container">
                    <i class="fa fa-phone icon fa-lg"></i>
                    <input class="input-field" type="text" id="ad_phone" placeholder="Phone number*" value=""
                        name="ad_name">
                </div>

                <input type="submit" class="btn" id="advert_edit_sumit" value="&#9745;">
                <input type="button" class="btn no-btn" value="&#9746;">
            </form>

            <!-- deleting modal -->
            <form class="form2 shadow none" id="item_post_delete_form" method="POST">

                <div class="input-container none">
                    <i class="fa fa-key icon fa-lg"></i>
                    <input class="input-field" type="text" id="item_post_id" placeholder="ID" name="item_post_id">
                </div>
                <p>Are you sure that you want to delete this advert?</p>
                <input type="submit" class="btn" id="ip_delete-btn" value="&#9745;">
                <input type="button" class="btn no-btn" value="&#9746;">
            </form>

            <!-- sell to modal -->
            <form class="form2 shadow none" id="sell_to_form" method="POST">

                <div class="input-container none">
                    <i class="fa fa-key icon fa-lg"></i>
                    <input class="input-field" type="text" id="uid" placeholder="ID" name="uid">
                </div>
                <p id="choseUserOutput">Are you sure that you want to sell this product to ?</p>
                <input type="submit" class="btn" id="sell_to-btn" value="&#9745;">
                <input type="button" class="btn no-btn" value="&#9746;">
            </form>

            <!-- phone num modal -->
            <form class="form2 shadow none" id="item_post_phone_num" method="POST">
                <p style="font-size:20px;">Phone number :</p>
                <p id="advert_phone_number" style="font-size:20px;"><?php echo $row_advert_info['item_phone_num']; ?>
                </p>

                <input type="button" style="width:150px" class="btn no-btn" value="&#9746;">
            </form>

            <!-- report to modal -->
            <form class="form2 shadow none" id="report_form" method="POST">
            <p id="choseUserOutput">Why do you want to report this advert ?</p>
            <div id="report_choices" class="input-container">
                    <input type="radio" value="1" class="radio" name="state" id="new_not_used">Advert is in the wrong category.
                    <input type="radio" value="2" class="radio" name="state" id="used">Advert is agianst site rules.
                    <input type="radio" value="3" class="radio" name="state" id="broken_not_working">Other reasons.
                </div>
                <input type="submit" class="btn" id="report-btn" value="&#9745;">
                <input type="button" class="btn no-btn" value="&#9746;">
            </form>

        </div><!-- id03 end -->

        <script>
tinymce.init({
    selector: 'textarea',
    plugins: 'advlist  lists charmap print preview hr anchor pagebreak',
    toolbar: 'undo redo styleselect bold italic alignleft aligncenter alignright bullist numlist',
    toolbar_mode: 'wrap',
    menubar: false,
    statusbar: false,
    height: 360,
});
        </script>