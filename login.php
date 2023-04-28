<?php
require_once('auth.php');
require_once('MainClass.php');
$secureWord = $_GET['secureWord'];
$email = $_GET['email'];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $login = json_decode($class->login());
    if($login->status == 'success'){
        echo "<script>location.replace('./login_verification.php');</script>";
    }
}
// if($_SESSION['fail_psw_number'] >= 3){
//     $_SESSION['fail_psw_action'] = 'true';
//     echo "<script>location.replace('./login_verification.php');</script>";
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Auth Login</title>
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
            height:calc(100%);
            width:calc(100%);
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
        }
    </style>
</head>
<body class="bg-info bg-gradient">
    <main>
       <div class="col-lg-7 col-md-9 col-sm-12 col-xs-12 mb-4">
           <h1 class="text-dark text-center">E-Authentication Project by JIAN MING</h1>
        </div>
       <div class="col-lg-3 col-md-8 col-sm-12 col-xs-12">
           <div class="card shadow rounded-0">
               <div class="card-header py-1">
                   <h4 class="card-title text-center">LOGIN</h4>
               </div>
               <div class="card-body py-4">
                   <div class="container-fluid">
                       <form action="./login.php?secureWord=<?php echo $secureWord; ?>&email=<?php echo $email;?>" method="POST">
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
                        <?php endif;?>
                            <div class="text-center">
                                <h2 class="text-info"><?php echo $secureWord; ?></h2>
                                <i class="text-muted">Do not preceed if this is not your SecureWord</i>
                                <h6 class="text-muted"><input type="checkbox" id="myCheckbox"> Yes, this is my SecureWord</h6>
                            </div>
                           <div class="form-group">
                                <input type="email" name="email" id="email" class="form-control rounded-0" value="<?php echo $email;?>" hidden>
                               <label for="password" class="label-control">Password</label>
                               <input type="password" name="password" id="password" class="form-control rounded-0" value="" required disabled>
                            </div>
                            <div class="clear-fix mb-4"></div>
                            <div class="form-group text-end">
                                <button class="btn btn-primary bg-gradient rounded-0" id='loginButton' disabled>LOGIN</button>
                            </div>
                            <div class="form-group text-cneter">
                                <a href="./forgotPassword.php?secureWord=<?php echo $secureWord; ?>&email=<?php echo $email;?>">Forgot Password?</a>
                            </div>
                       </form>
                   </div>
               </div>
           </div>
       </div>
    </main>
    <label>
    <script>
        $(function() {
            var index = 0;
            var checkbox = $('#myCheckbox');
            var textField = $('#password');
            var loginButton = $('#loginButton')
            checkbox.change(function() {
                if(this.checked) {
                    textField.prop('disabled', false);
                    loginButton.prop('disabled', false);
                } else {
                    textField.prop('disabled', true);
                    loginButton.prop('disabled', true);
                }
            });
        });
    </script>
</body>
</html>