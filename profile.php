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
    <link rel="stylesheet" href="css/profile.css">
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous"></script>
    <link rel="icon" href="img/homee.png">
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Saira+Extra+Condensed:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,500" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,300i,400,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100;300;400;600" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/bq5m2vuub7uf27yyjc5gmnx7m273hag2l53zrzvzxdt3a2ny/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>

    <?php echo "<title>Profile page</title>" ?>
    <script>
    function hide() {
        $(".notification").remove();
    }
    </script>
</head>

<body style="height:auto;">
    <div id="wrapper">
        <div id="notification_container"></div><!-- alert container end -->
        <?php require_once("_header.php"); 
        
 
        $request="SELECT account_id FROM accounts WHERE account_id='{$_GET['u']}'";
        $result=$db->query($request);
        $row=$db->num_rows($result);    

        if(!isset($_GET['u']) or $_GET['u']==""){
            header('Location: index.php');
        }
        else if($row==0){
            echo "<div id='notification_container'><p class='notification ORANGE'>User with ID <b>[".$_GET["u"]."]</b> does not exist.</p></div>";
        } else { 
            require_once("_profile.php"); 
        }

        ?>

        

</body>

</html>

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
<script src="ajax/comments.js"></script>
<script src="ajax/profile.js"></script>
<?php
exit();
?>