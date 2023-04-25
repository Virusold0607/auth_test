<?php
require_once('auth.php');
require_once('MainClass.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Home | Login with OTP</title>
    <link rel="stylesheet" href="./Font-Awesome-master/css/all.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./Font-Awesome-master/js/all.min.js"></script>
    <style>
        html,body{
            height:100%;
            width:100%;
        }
        main{
            height:100%;
            display:flex;
            flex-flow:column;
        }
    </style>
</head>
<body>
    <main>
    <nav class="navbar navbar-expand-lg navbar-dark bg-info bg-gradient" id="topNavBar">
        <div class="container">
            <a class="navbar-brand" href="#">
                E-Authentication Project by JIAN MING
            </a>
        </div>
    </nav>
    <div class="container py-3" id="page-container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8 col-sm-12 col-xs-12">
                <div class="card shadow rounded-0">
                    <div class="card-body py-4">
                        <h1>Welcome <?= ucwords($_SESSION['firstname'].' '.$_SESSION['middlename'].' '.$_SESSION['lastname']) ?></h1>
                        <hr>
                        <p>You are logged in using <?= $_SESSION['email'] ?></p>
                        <div class="clear-fix mb-4"></div>
                        <div class="text-end">
                            <a href="./logout.php" class="btn btn btn-primary bg-gradient rounded-0">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>
</body>
</html>