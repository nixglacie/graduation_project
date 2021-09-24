<?php 
if (login()) {
    echo '<!-- modals -->';
    echo '<div id="id01" class="none modal">';
    echo '<span onclick="close_modal()" class="close_bookmarks shadow" title="Close Modal">&times;</span>';
    echo '<div id="modal_wrapper">';
    echo ' <div id="all_user_bookmarks">';
        // OUTPUT OF BOOKMARKS
    echo '</div><!-- all user bookmarks end-->';
    echo '</div>';
    echo '</div>';
}
?>
<header>
    <a href="index.php"><img src="img/home.png" alt="" class="logo point"></a>
    <!-- LOGO IMAGE    
        <img class="logo point" src="img/logo.png" alt="logo">
-->
    <ul class="reg_log">
        <li style="font-size: 25px; padding:5px 20px;"><a href="item_search.php"><i style="font-size: 20px"class="fas fa-search"></i></a></li>
        <?php
                /* just to get stupid username */
                if(@$_SESSION['id']){
                $request="SELECT * FROM accounts WHERE account_id='{$_SESSION['id']}'";
                $result=$db->query($request);
                $row=$db->fetch_assoc($result);  
                }


                //displays certain li elements depending on session
                 if (login()) {
                    echo '<li id="bookmarks">Bookmarks</li>';
                    echo '<li id="advert"><a href="new_advert.php">New Advert</a></li>';
                    if ($_SESSION['status']=='Administrator') {
                        echo "<li class='post_menu'><a href='editor_panel.php'>Editor panel</a></li>";
                        echo "<li class='rose_glow'><a href='profile.php?u={$_SESSION['id']}'>{$row['account_username']} [{$_SESSION['status']}]</a></li>";
                    } else if ($_SESSION['status']=='Editor'){
                        echo "<li class='post_menu'><a href='editor_panel.php'>Editor panel</a></li>";
                        echo "<li class='blue_rose_glow'><a href='profile.php?u={$_SESSION['id']}'>{$row['account_username']} [{$_SESSION['status']}]</a></li>";
                    }  else {
                        echo "<li class='green_rose_glow'><a href='profile.php?u={$_SESSION['id']}'>{$row['account_username']}</a></li>";
                    }
                     echo "<li><a href='functions/logout.php'>Log out</a></li>";
                 } else {
                     echo "<li><a href='reg_log.php?r=r'>Register</a></li>";
                     echo "<li><a href='reg_log.php?r=l'>Login</a></li>";
                 }?>
    </ul>
    <!-- reg log end-->
</header><!-- header end -->
<script src="ajax/bookmarks.js"></script>
<script src="js/main.js"></script>



