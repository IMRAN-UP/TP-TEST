<?php 
session_start();
if( isset($_GET['change']) ){
    session_destroy();
    if (isset($_COOKIE['Username_Admin'])) {
        setcookie('Username_Admin', '', time() - 3600, '/');
        unset($_COOKIE['Username_Admin']);
    }

    if (isset($_COOKIE['Password_Admin'])) {
        setcookie('Password_Admin', '', time() - 3600, '/');
        unset($_COOKIE['Password_Admin']);
    }
}
setcookie('loggedin', '', time() - 3600, "/");
header('Location: login.php');

?>