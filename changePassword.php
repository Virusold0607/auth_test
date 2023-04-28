<?php
    require_once('auth.php');
    require_once('MainClass.php');
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $update = json_decode($class->update());
        if($update->status == 'success'){
            $_SESSION['flashdata']['type']='success';
            $_SESSION['flashdata']['msg'] = ' Account information has been updated successfully.';
            echo "<script>location.href = './index.php';</script>";
            exit;
        }else{
            echo "<script>console.error(".json_encode($update).");</script>";
        }
    }
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
                    <form action="./edit.php" method="POST">
                        <h1>Edit Your Information <?= ucwords($_SESSION['firstname'].' '.$_SESSION['middlename'].' '.$_SESSION['lastname']) ?></h1>
                        <hr>
                        <div class="clear-fix mb-4"></div>
                        <div class="container">
                        <div class="form-group">
                               <label for="firstname" class="label-control">First Name</label>
                               <input type="text" name="firstname" id="firstname" class="form-control rounded-0" value="<?= isset($_POST['firstname']) ? $_POST['firstname'] : ($_SESSION['firstname']) ?>" value="" required>
                            </div>
                            <div class="form-group">
                               <label for="middlename" class="label-control">Middle Name</label>
                               <input type="text" name="middlename" id="middlename" class="form-control rounded-0" value="<?= isset($_POST['middlename']) ? $_POST['middlename'] : ($_SESSION['middlename']) ?>" required>
                            </div>
                            <div class="form-group">
                               <label for="lastname" class="label-control">Last Name</label>
                               <input type="text" name="lastname" id="lastname" class="form-control rounded-0" value="<?= isset($_POST['lastname']) ? $_POST['lastname'] : ($_SESSION['lastname']) ?>" required>
                            </div>
                            <div class="form-group">
                               <label for="secureWord" class="label-control">Secure Word</label>
                               <input type="text" name="secureWord" id="secureWord" class="form-control rounded-0" value="<?= isset($_POST['secureWord']) ? $_POST['secureWord'] : ($_SESSION['secureWord']) ?>" required>
                            </div>
                            <div class="clear-fix mb-4"></div>
                            <div class="form-group">
                                <h6 class=""><input type="checkbox" id="myCheckbox" name="myCheckbox" > Change Password </h6>
                               <label for="password" class="label-control">new Password</label>
                               <input type="password" name="password" id="password" class="form-control rounded-0" value="" required disabled>
                            </div>
                            <div class="form-group">
                               <label for="password" class="label-control">Confirm Password</label>
                               <input type="password" name="confirmPassword" id="confirmPassword" class="form-control rounded-0" value="" required disabled>
                            </div>
                            <div class="clear-fix mb-4"></div>
                            <div class="form-group text-end">
                                <button class="btn btn-primary bg-gradient rounded-0">Save</button>
                            </div>
                            <div class="form-group text-center">
                                <a href="./index.php">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>
    <script>
        $(function() {
            var index = 0;
            var checkbox = $('#myCheckbox');
            var password = $('#password');
            var confirmPassword = $('#confirmPassword')
            checkbox.change(function() {
                if(this.checked) {
                    password.prop('disabled', false);
                    confirmPassword.prop('disabled', false);
                } else {
                    confirmPassword.prop('disabled', true);
                    password.prop('disabled', true);
                }
            });
        });
    </script>
</body>
</html>