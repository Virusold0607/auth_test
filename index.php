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
                        <?php 
                            if(isset($_SESSION['flashdata'])):
                        ?>
                        <div class="dynamic_alert alert alert-<?php echo $_SESSION['flashdata']['type'] ?> my-2 rounded-0">
                            <div class="d-flex align-items-center">
                                <div class="col-11"><?php echo $_SESSION['flashdata']['msg'] ?></div>
                                <div class="col-1 text-end">
                                    <div class="float-end"><a href="javascript:void(0)" class="text-dark text-decoration-none" onclick="$(this).closest('.dynamic_alert').hide('slow').remove()">x</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php unset($_SESSION['flashdata']) ?>
                        <?php endif; ?>
                        <h1>Welcome <?= ucwords($_SESSION['firstname'].' '.$_SESSION['middlename'].' '.$_SESSION['lastname']) ?></h1>
                        <hr>
                        <p>You are logged in using <?= $_SESSION['email'] ?></p>
                        <div class="clear-fix mb-4"></div>
                        <div class="container">
                            <a href="./delete.php" class="btn m-2 btn-danger bg-gradient rounded-0">Delete Account</a>
                            <a href="./edit.php" class="btn m-2 btn-secondary bg-gradient rounded-0">Edit</a>
                            <!-- <a href="./changePassword.php" class="btn m-2 btn-secondary bg-gradient rounded-0">Change Password</a> -->
                            <a href="./contact.php" class="btn m-2 btn-info bg-gradient rounded-0">Contact Us</a>
                            <a href="./logout.php" class="btn m-2 btn-primary bg-gradient rounded-0">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>
    
</body>
</html>