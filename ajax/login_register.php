<?php
session_start();
require_once("../_require.php");
$db=new database();
if(!$db->connect())exit();

$option=$_GET['option'];

if ($option=="login") {
    if (isset($_POST['mail']) and isset($_POST['pass'])) {
        $email=$_POST['mail'];
        $password=$_POST['pass'];
        /*
        $email= stripcslashes($email);
        $password= stripcslashes($password);
        $email= mysqli_real_escape_string($db, $email);
        $password= mysqli_real_escape_string($db, $password);*/

        if ($email!="" and $password!="") {
            if (valid_string($email) and valid_string($password)) {
                $request="SELECT * FROM accounts WHERE account_email='{$email}'";
                $result=$db->query($request);
                if ($db->num_rows($result)==1) {
                    $row=$db->fetch_object($result);
                    if ($row->account_status==1) {
                        if ($row->account_password==$password) {
                            //$msg=notification::uspeh("{$row->ime} {$row->prezime}, $row->status");
                            $_SESSION['id']=$row->account_id;
                            $_SESSION['ime']=$row->account_username;
                            $_SESSION['status']=$row->account_access_level;
                            $_SESSION['city']=$row->u_city;
                            $_SESSION['pnum']=$row->u_phone;
                            if (isset($_POST['remember'])) {
                                setcookie("id", $_SESSION['id'], time()+86400, "/");
                                setcookie("ime", $_SESSION['ime'], time()+86400, "/");
                                setcookie("status", $_SESSION['status'], time()+86400, "/");
                                setcookie("city", $_SESSION['city'], time()+86400, "/");
                                setcookie("pnum", $_SESSION['pnum'], time()+86400, "/");
                            }
                            echo "<p class='notification GREEN'>Succsefully logged in! You will be redirected shortly!</p><br>";
                        //header("Location: index.php");
                        } else {
                            echo "<p class='notification RED'>Incorrect email or password!</p><br>";
                        }
                    } else {
                        echo "<p class='notification ORANGE'>User account {$row->account_username} is suspended or banned!</p><br>";
                    }
                } else {
                    echo "<p class='notification RED'>User {$row->account_username} doesnt exist!</p><br>";
                }
            } else {
                echo "<p class='notification RED'>Email or password contain forbiden characters!</p><br>";
            }
        } else {
            echo "<p class='notification RED'>Username or password is missing!</p><br>";
        }
    }
};

if ($option=="register") {
    if ($_POST['username']!="" and valid_string($_POST['username'])) {
        if ($_POST['mail']!="" and valid_string($_POST['mail'])) {
            if ($_POST['mail']==$_POST['rmail']) {
                if ($_POST['pass']!="" and valid_string($_POST['pass'])) {
                    if ($_POST['pass']==$_POST['rpass']) {
                        if ($_POST['city']!="" and valid_string($_POST['city'])) {
                            if ($_POST['phone']!="" and valid_string($_POST['phone'])) {
                                $req="INSERT INTO accounts (
                                    account_username,
                                    account_email,
                                    account_password,
                                    u_city,
                                    u_phone
                                    ) VALUES ('{$_POST['username']}', '{$_POST['mail']}' , '{$_POST['pass']}', '{$_POST['city']}', '{$_POST['phone']}')";
                                $db->query($req);
                                if ($db->error($db)) {
                                    echo "<p class='notification RED'>There was an error please try again.</p><br>";//.$db->error($db);
                                } else {
                                    echo "<p class='notification GREEN'>Succsefully Registered! You will be redirected to login page!</p><br>";
                                }
                            } else {
                                echo "<p class='notification RED'>Phone number is empty or contains forbiden characters</p><br>";
                            }
                        } else {
                            echo "<p class='notification RED'>City is empty or contains forbiden characters.</p><br>";
                        }
                    } else {
                        echo "<p class='notification ORANGE'>Passwords dont match.</p><br>";
                    }
                } else {
                    echo "<p class='notification RED'>Password is empty or contains forbiden characters.</p><br>";
                }
            } else {
                echo "<p class='notification ORANGE'>Emails dont match.</p><br>";
            }
        } else {
            echo "<p class='notification RED'>Email is empty or contains forbiden characters.</p><br>";
        }
    } else {
        echo "<p class='notification RED'>Username is empty or contains forbiden characters.</p><br>";
    }
}
