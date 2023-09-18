<?php

session_start();
include './admin/inc/database.php';
require './admin/inc/validate.php';
require './admin/inc/valid.php';

$db = new Database();
$mobile_no = trim(filter_input(INPUT_POST, "mobile_number"));
$pass = filter_input(INPUT_POST, "password");

$user_login = $db->select("users", "*", ["AND" => ['mobile_number' => $mobile_no, 'password' => MD5($pass)]]);

if (sizeof($user_login) > 0) {
    $_SESSION['user_login'] = $user_login[0];

    header("location:dashboard.php");
} else {

    echo '<script>alert("Username/Password is wrong. Please try again"); window.location="login.php"; </script>';
}
?>