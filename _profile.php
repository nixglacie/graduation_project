
        <div id="profile_container" class="shadow">
            <div class="left_block left">
                <div class="color_block">Joined</div>
                <?php
                $request = "SELECT * FROM accounts WHERE account_id='{$_GET['u']}'";
                $result = $db->query($request);
                $row = $db->fetch_assoc($result);
                $pieces = explode(" ", $row['account_creation_time']);
                echo '<p id="join_date">' . $pieces[0] . '</p>';
                echo '<img id="R3" src="img/3R.png" alt="3r">';
                echo "<p class='u_status'>" . $row['account_access_level'] . "</p>";
                echo "<p class='u_name '>" . $row['account_username'] . "<label> // " . $row['u_city'] . "</label></p>";
                ?>
                <p class="u_rating"><b class="roboto300">Rating</b> –––
                <div class="rate">
                    <?php
                    $requestRATING = "SELECT round((AVG(comment_correct_desc)+AVG(comment_good_communication)+ AVG(comment_good_deal))/3,2) as 'average_rating' FROM account_comments WHERE account_comments_target='{$_GET['u']}'";
                    $resultRATING = $db->query($requestRATING);
                    $rowRATING = $db->fetch_assoc($resultRATING);
                    echo   '<p>' . $rowRATING['average_rating'] . '</p>';

                    for ($i = 1; $i <= floor($rowRATING['average_rating']); $i++) {
                        echo '<div class="active" ">' . $i . '</div>';
                    }
                    for ($i = (floor($rowRATING['average_rating']) + 1); $i <= 5; $i++) {
                        echo '<div>' . $i . '</div>';
                    }

                    ?>
                </div>
                </p><!-- u_rating -->
                <div class="u_trades">

                    <p>SALES</p>
                    <?php
                    $request = "SELECT * FROM account_comments WHERE account_comments_target='{$_GET['u']}' AND account_comments_type=1";
                    $result = $db->query($request);
                    echo "<p>&#9745; " . $db->num_rows($result) . "</p>";
                    $request = "SELECT * FROM account_comments WHERE account_comments_target='{$_GET['u']}' AND account_comments_type=0";
                    $result = $db->query($request);
                    echo "<p>" . $db->num_rows($result) . " &#9746;</p>";
                    ?>
                </div>
            </div><!-- left end -->
            <div class="right_block right">
                <img class="u_picture_frame " src="img/frame.png" alt="">
                <?php

                $img_path = getExistingFile("img/user_profile_pictures/" . $_GET['u']);

                echo '<img class="u_picture " src="' . $img_path . '" alt="">';
                echo '<p class="u_id"><label>';
                if ($row["verification_status"] == "0") {
                    echo "UNVERIFIED";
                } else {
                    echo "VERIFIED";
                }
                echo '</label>#' . $row['account_id'] . '</p>';
                if ($row['account_description'] == null) {
                    echo '<div class="u_description null "><p>No<br>Description</p></div>';
                } else {
                    echo '<div class="u_description read">' . $row['account_description'] . '</div>';
                }
                ?>
            </div><!-- right end -->
        </div><!-- end of profile_container -->
        <?php
        echo '<div class="tabs">';
        echo '<button class="up_down shadow">☑ &nbsp;☒</button>';
        if (@$_SESSION['id'] == $_GET['u']) {
            echo '<button class="purchase_history shadow right" data-o="0">&#8644; Purchase history</button>';
            echo '<button class="sale_history shadow right" data-o="0" >&#10064; Sale history</button>';
            echo '<button class="btn" id="profile_edit" data-id="' . $row['account_id'] . '" ><img src="img/edit.png" alt=""></button>';
        }
        echo '<button data-o="0" class="all_posts shadow">&#9712; All adverts</button>';
        echo '</div><!-- tabs end -->';

        if (@$_GET['ap'] == 1 or @$_GET['ph']== 1) {
            echo '<div id="profile_comments_container" class="none">';
        } else {
            echo '<div id="profile_comments_container">';
        }

        ?>
        <div class="u_commentUP" id="u_commentUP">
        </div><!-- end of u_commentUP -->

        <div class="u_commentDOWN" id="u_commentDOWN">
        </div><!-- end of u_commentDOWN -->
    </div><!-- prof comments cont end -->

    <?php

    $request_pages = "SELECT COUNT(*) FROM item_posts WHERE item_owner_id='{$_GET['u']}' AND deleted=0 and sold_to IS NULL";
    $result_page = $db->query($request_pages);
    $row_page = mysqli_fetch_array($result_page, MYSQLI_NUM);
    $num_pages = ceil($row_page[0] / 16);
    
    if (@$_GET['ap'] == 1) {
        echo '<div class="allposts_pagination flex">';
    } else {
        echo '<div class="allposts_pagination none">';
    }

    
    if ($num_pages > 1) {
        for ($i = 1; $i <= $num_pages; $i++) {
            if ($i==1) {
                echo '<button class="ap_pagination shadow" data-o="0">' . $i . '</button>';
            } else {
                echo '<button class="ap_pagination shadow" data-o="'.((16*$i)-16).'">' . $i . '</button>';
            }
        }
    }
    echo '</div>';

    if (@$_GET['ap'] == 1) {
        echo '<div id="all_user_posts">';
    } else {
        echo '<div id="all_user_posts" class="none">';
    }


    $request = "SELECT * FROM item_posts WHERE item_owner_id='{$_GET['u']}' AND deleted=0 and sold_to IS NULL ORDER BY item_id DESC LIMIT 16 ";
    $result = $db->query($request);
    if ($db->num_rows($result) == 0) {
        echo "<p class='notification ORANGE' style='margin-left: auto; margin-right:auto; margin-top: 50px;'>This user has nothing for sale at the moment</p><br>";
    } else {
        while ($row = $db->fetch_assoc($result)) {
            $dir = "img/item_images/" . $row["item_id"] . "/";
            $files = scandir($dir);
            $files = array_slice($files, 2);
            $pieces = explode(".", @$files[0]);
            $img_path = getExistingFile("img/item_images/" . $row["item_id"] . "/" . $pieces[0]);
            echo '<div class="item_container left shadow">';
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
    }
    ?>
    </div><!-- all user posts end-->

    <?php
    if (@$_SESSION['id']==$_GET['u']) {

        $request_pages = "SELECT COUNT(*) FROM item_posts WHERE item_owner_id='{$_GET['u']}' AND deleted=0 and sold_to IS NOT NULL";
        $result_page = $db->query($request_pages);
        $row_page = mysqli_fetch_array($result_page, MYSQLI_NUM);
        $num_pages = ceil($row_page[0] / 16);
        
            echo '<div class="saleposts_pagination none">';

    
        
        if ($num_pages > 1) {
            for ($i = 1; $i <= $num_pages; $i++) {
                if ($i==1) {
                    echo '<button class="sh_pagination shadow" data-o="0">' . $i . '</button>';
                } else {
                    echo '<button class="sh_pagination shadow" data-o="'.((16*$i)-16).'">' . $i . '</button>';
                }
            }
        }
        echo '</div>';

        echo '<div id="sale_history" class="none">';

    }
        echo '</div><!-- sale history end-->';
    ?>



    <?php
        if (@$_SESSION['id']==$_GET['u']) {

            if (@$_GET['ap'] == 1 ) {
                echo '<div class="purchaseposts_pagination flex">';
            } else echo '<div class="purchaseposts_pagination none">';

            $request_pages = "SELECT COUNT(*) FROM item_posts WHERE sold_to='{$_SESSION['id']}'";
            $result_page = $db->query($request_pages);
            $row_page = mysqli_fetch_array($result_page, MYSQLI_NUM);
            $num_pages = ceil($row_page[0] / 16);

            if ($num_pages > 1) {
                for ($i = 1; $i <= $num_pages; $i++) {
                    if ($i==1) {
                        echo '<button class="ph_pagination shadow" data-o="0">' . $i . '</button>';
                    } else {
                        echo '<button class="ph_pagination shadow" data-o="'.((16*$i)-16).'">' . $i . '</button>';
                    }
                }
            }
            echo '</div>';

            if(@$_GET['ph']==1){
                echo '<div id="purchase_history" class="">';
            } else echo '<div id="purchase_history" class="none">';

            $request_phistory="SELECT * FROM view_purchase_history WHERE sold_to_id='{$_SESSION['id']}' ORDER BY item_id DESC LIMIT 16";
            $result_phistory=$db->query($request_phistory);
            if ($result_phistory) {
                while ($row_phistory=$db->fetch_assoc($result_phistory)) {
                    $dir = "img/item_images/" . $row_phistory["item_id"] . "/";
                    $files = scandir($dir);
                    $files = array_slice($files, 2);
                    $pieces = explode(".", @$files[0]);
                    $img_path = getExistingFile("img/item_images/" . $row_phistory["item_id"] . "/" . $pieces[0]);
                    echo '<div class="item_container left shadow">';
                    if ($img_path) {
                        echo '<a href="profile.php?u=' . $row_phistory["item_owner_id"] . '"><img style="filter:grayscale(100%);" src="' . $img_path . '" alt=""><h2 class="adve_title">' . $row_phistory["item_name"] . '</h2></a>';
                    } else {
                        echo '<a href="profile.php?u=' . $row_phistory["item_owner_id"] . '"><img style="filter:grayscale(100%);" src="img/item_images/no_image.png" alt=""><h2 class="adve_title">' . $row_phistory["item_name"] . '</h2></a>';
                    }
                    echo '<p>Bought from – <a href="profile.php?u='. $row_phistory["item_owner_id"].'"><b>' . $row_phistory['purchased_from_name'] . '</b></a></p>';
                    echo '<p>' . $row_phistory["item_price"] . ',00 &euro;</p>';
                    if ($row_phistory["item_rated"]==0) {
                        echo '<button onclick="rateThis(this)" class="rate_btn" data-atitle="'.$row_phistory["item_name"].'" class="shadow">Rate</button>';
                    }
                    echo '</div><!-- item container end -->';
                }
            } else {
                echo "<p class='notification ORANGE' style='margin-left: auto; margin-right:auto; margin-top: 50px;'>You havent sold anything yet.</p><br>";
            }
        }
            echo '</div><!-- purchase history end-->';
        ?>
    </div><!-- wrapper end-->


    <!-- modals -->
    <div id="id03" class="modal none">
        <!-- edit modal -->
        <form class="form2 none" id="edit_form" method="POST">

            <div class="input-container">
                <i class="fa fa-envelope icon fa-lg"></i>
                <textarea class="input-field comment_editor" type="text" id="cmnt_cont" placeholder="Content"
                    name="cmnt_cont" value=""></textarea>
            </div>

            <div class="input-container none">
                <i class="fa fa-key icon fa-lg"></i>
                <input class="input-field" type="text" id="cmnt_id" placeholder="ID" name="cmnt_id">
            </div>
            <input type="submit" class="btn" id="edit-btn" value="&#9745;">
            <input type="button" class="btn no-btn" value="&#9746;">
        </form>
        <!-- replay modal -->
        <form class="form2 none" id="replay_form" method="POST">

            <div class="input-container">
                <i class="fa fa-envelope icon fa-lg"></i>
                <textarea class="input-field comment_editor" type="text" id="newcmnt_cont" placeholder="..."
                    name="cmnt_cont"></textarea>
            </div>

            <div class="input-container none">
                <i class="fa fa-key icon fa-lg"></i>
                <input class="input-field" type="text" id="newcmnt_id" placeholder="ID" name="cmnt_id">
            </div>
            <input type="submit" class="btn" id="replay-btn" value="&#9745;">
            <input type="button" class="btn no-btn" value="&#9746;">
        </form>
        <!-- deleting modal -->
        <form class="form2 none" id="delete_form" method="POST">

            <div class="input-container none">
                <i class="fa fa-key icon fa-lg"></i>
                <input class="input-field" type="text" id="delcmnt_id" placeholder="ID" name="cmnt_id">
            </div>
            <p>Are you sure that you want to delete this comment?</p>
            <input type="submit" class="btn" id="delete-btn" value="&#9745;">
            <input type="button" class="btn no-btn" value="&#9746;">
        </form>

        <!-- profile editing form -->

        <form class="form2 none" id="profile_edit_form" method="POST">

            <div class="input-container right none">
                <i class="fa fa-key icon fa-lg"></i>
                <input class="input-field" type="text" id="user_profile_id" placeholder="ID" name="user_profile_id">
            </div>

            <div class="input-container right">
                <i class="fa fa-address-card icon fa-lg"></i>
                <input class="input-field" type="text" id="u_username" placeholder="Username" name="u_username">
            </div><br>

            <div class="input-container right"">
                <i class=" fa fa-city icon fa-lg"></i>
                <input class="input-field" type="text" id="u_city" placeholder="City" name="u_city">
            </div>

            <div class="input-container right"">
            <i class="fa fa-phone icon fa-lg"></i>
                <input class="input-field" type="text" id="u_phone" placeholder="Phone number" value="<?php echo $_SESSION["pnum"]; ?>"name="u_phone">
            </div>

            <div class="drop-zone point" style="margin-top:-15px;">
                <span class="drop-zone__prompt point">Drop file here or click to select (200x200)
                </span>
                <input id="selected_img" class="drop-zone__input point" type="file" name="selected_img">
            </div>

            <div class="input-container">
                <i class="fa fa-edit icon fa-lg"></i>
                <textarea class="input-field comment_editor" type="text" id="user_profile_description"
                    placeholder="Content" name="user_profile_description" value=""></textarea>
            </div>
            <input type="submit" class="btn" id="profile-edit-btn" value="&#9745;">
            <input type="button" class="btn no-btn" value="&#9746;">
        </form>

        <!-- rating modal -->
        <form class="form2 none" id="rating_form" method="POST">
            <h2 id="advert_title"></h2>
            <div class="input-container">
                <i class="fa fa-envelope icon fa-lg"></i>
                <textarea class="input-field comment_editor" type="text" id="rate_comment" placeholder="..."
                    name="cmnt_cont"></textarea>
            </div>

            <div id="adv_adc" class="input-container">
                <label for="adc">Advert description accuracy*</label>
                <input type="radio" value="1" class="radio" name="adc">1
                <input type="radio" value="2" class="radio" name="adc">2
                <input type="radio" value="3" class="radio" name="adc">3
                <input type="radio" value="4" class="radio" name="adc">4
                <input type="radio" value="5" class="radio" name="adc">5
            </div>
            <div id="adv_cww" class="input-container">
                <label for="cww">Communication went well *</label>
                <input type="radio" value="1" class="radio" name="cww">1
                <input type="radio" value="2" class="radio" name="cww">2
                <input type="radio" value="3" class="radio" name="cww">3
                <input type="radio" value="4" class="radio" name="cww">4
                <input type="radio" value="5" class="radio" name="cww">5
            </div>
            <div id="adv_ra" class="input-container">
                <label for="ra">Respected agreement *</label>
                <input type="radio" value="1" class="radio" name="ra">1
                <input type="radio" value="2" class="radio" name="ra">2
                <input type="radio" value="3" class="radio" name="ra">3
                <input type="radio" value="4" class="radio" name="ra">4
                <input type="radio" value="5" class="radio" name="ra">5
            </div>
            <div id="adv_gb" class="input-container">
                <label for="gb">Positive or negative rating *</label>
                <input type="radio" value="1" class="radio" name="gb">☑
                <input type="radio" value="0" class="radio" name="gb">☒
            </div>
            <input type="submit" class="btn" id="rate-btn" value="&#9745;">
            <input type="button" class="btn no-btn" value="&#9746;">
        </form>

    </div>
