<?php
if(session_status() === PHP_SESSION_NONE)
session_start();
$link = $_SERVER['PHP_SELF'];
if(!strpos($link,'login.php') && !strpos($link,'login_verification.php') && !strpos($link,'registration.php') && !isset($_SESSION['user_login'])){
echo "<script>location.replace('./login.php');</script>";
}
if(strpos($link,'login_verification.php') && !isset($_SESSION['otp_verify_user_id'])){
    echo "<script>location.replace('./login.php');</script>";
}
if(strpos($link,'login.php') > -1 && isset($_SESSION['user_login'])){
echo "<script>location.replace('./');</script>";
}
