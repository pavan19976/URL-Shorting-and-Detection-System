<?php
session_start();
if (isset($_SESSION['user_login'])) {
    $user_id = $_SESSION['user_login']["id"];
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="url shortener">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Make It Short</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <link href="js/vendor/animate/animate.min.css" rel="stylesheet">
    <link href="./admin/assets/lib/sweet-alerts2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

</head>

<nav class="navbar navbar-default nav-css">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php" style="color:red;">MakeItShort</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
            <?php if(!isset($user_id)){ ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
            <?php } ?>

            <?php if(isset($user_id)){ ?>
            <li><a href="#">Dashboard</a></li>
            <li><a href="all-links.php">All Short Links</a></li>
            <li><a href="report-spam.php">Report Spam</a></li>
            <li><a href="logout.php"><i class="icon icon-logout"></i><span>Logout</span></a></li>
            <?php } ?>
        </ul>
    </div>
</nav>

<style>
.nav-css {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

}
</style>