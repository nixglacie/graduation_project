<?php
if(file_exists("classes/database.php"))
    $folder="";
else
    $folder="../";
require_once($folder."functions/functions.php");
require_once($folder."classes/notifications.php");
require_once($folder."classes/database.php");
?>