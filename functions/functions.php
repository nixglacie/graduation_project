<?php
function connection()
{
    $database=@mysqli_connect("localhost", "root", "", "rose");
    if(!$database)
    {
        echo "Failed to connect!!!<br>";
        echo mysqli_connect_errno()."<br>";
        if(mysqli_connect_errno()==2002)
            echo "SQL server doesnt exist!<br>";
        return false;
    }
    mysqli_query($database, "SET NAMES utf8");
    return $database;
}

//error_reporting( error_reporting() & ~E_NOTICE );
         

function valid_string($str)
{
    if(strpos($str, ' ')!==false) return false;
    if(strpos($str, '"')!==false) return false;
    if(strpos($str, '=')!==false) return false;
    if(strpos($str, '(')!==false) return false;
    if(strpos($str, ')')!==false) return false;
    if(strpos($str, '*')!==false) return false;
    return true;
}

function login()
{
    if(isset($_SESSION['id']) and isset($_SESSION['ime']) and isset($_SESSION['status']))
        return true;
    else if(isset($_COOKIE['id']) and isset($_COOKIE['ime']) and isset($_COOKIE['status']) )
    {
        $_SESSION['id']=$_COOKIE['id'];
        $_SESSION['ime']=$_COOKIE['ime'];
        $_SESSION['status']=$_COOKIE['status'];
        return true;
    }
    else return false;
}


/* grab last 4 adverts from $X category */
function grabCategoryAds($x)
{
    $database = mysqli_connect("localhost", "root", "", "rose");
    mysqli_query($database, "SET NAMES utf8");

    $request = "SELECT * FROM view_item_posts WHERE  item_category_name='{$x}' AND deleted=0 AND sold_to IS NULL ORDER BY item_id DESC LIMIT 4";
    $result = mysqli_query($database, $request);
    if (mysqli_num_rows($result) == 0) {
        echo "<p class='none'>no_more</p>";
    } else {
        while ($row = mysqli_fetch_assoc($result)) {
            $dir = "img/item_images/" . $row["item_id"] . "/";
            $files = scandir($dir);
            $files = array_slice($files, 2);
            $pieces = explode(".", @$files[0]);
            $img_path = getExistingFile("img/item_images/" . $row["item_id"] . "/" . $pieces[0]);
            echo '<div class="fp_item_container left">';
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
}


/* counts number of ads that are not sold/deleted */
function grabCategoryNumOfAds($x)
{
    $database = mysqli_connect("localhost", "root", "", "rose");
    mysqli_query($database, "SET NAMES utf8");
    $request = "SELECT * FROM view_item_posts 
                WHERE  item_category_name='{$x}' 
                AND deleted=0 AND sold_to IS NULL";
    $result = mysqli_query($database, $request);
    if (mysqli_num_rows($result) == 0) {
        echo "<p class='numads'>None at the moment</p>";
    } else {
        echo "<p class='numads'>".mysqli_num_rows($result)."</p>";
    }
}



// checks if file exists on the server with all extensions from $allow 
// and deletes it before uploading new one with the same name

// allowed typed of files
$allow = array('png','jpg');

function getExistingFile($path_to_file){
    global $allow;
    for($i=0;$i<count($allow);$i++){
        if(file_exists($path_to_file.".".$allow[$i])){
            return $path_to_file.".".$allow[$i];
        }
    } 
    return false;
    }
?>