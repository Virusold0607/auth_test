<?php
require_once('auth.php');
require_once('MainClass.php');

// Include packages and files for PHPMailer and SMTP protocol

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

// Initialize PHP mailer, configure to use SMTP protocol and add credentials
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";

$mail->SMTPDebug  = 0;
$mail->SMTPAuth   = TRUE;
$mail->SMTPSecure = "ssl";
$mail->Port       = 465;
$mail->Host       = "smtp.gmail.com";
$mail->Username   = "eclassroom1999@gmail.com";
$mail->Password   = "gxptrkpjfvmrqbce";


$success = "";
$error = "";
$name = $_SESSION['firstname'].' '.$_SESSION['middlename'].' '.$_SESSION['lastname'];
$email = $_SESSION['email'];
$message  = "";
$subject = "";
$errors = array('subject' => '', 'message' => '');

if (isset($_POST["submit"])) {
    if (empty(trim($_POST["subject"]))) {
        $errors['subject'] = "Subject is required";
    } else {
        $subject = SanitizeString($_POST["subject"]);
        if (!preg_match('/^[a-zA-Z\s]{6,50}$/', $subject)) {
            $errors['subject'] = "Only letters and spaces allowed";
        }
    }

    if (empty(trim($_POST["message"]))) {
        $errors["message"] = "Please type your message";
    } else {
        $message = SanitizeString($_POST["message"]);
        if (!preg_match("/^[a-zA-Z\d\s]+$/", $message)) {
            $errors["message"] = "Only letters, spaces and maybe numbers allowed";
        }
    }

    if (array_filter($errors)) {
    } else {
        try {

            $mail->setFrom('eclassroom1999@gmail', 'Anirudha B Shetty');

            $mail->addAddress($email, $name);

            $mail->Subject = $subject;

            $mail->Body = $message;

            // send mail

            $mail->send();

            // empty users input

            $subject = $message = "";

            $success = "Message sent successfully";
        } catch (Exception $e) {

            // echo $e->errorMessage(); use for testing & debugging purposes
            $error = "Sorry message could not send, try again";
        } catch (Exception $e) {

            // echo $e->getMessage(); use for testing & debugging purposes
            $error = "Sorry message could not send, try again";
        }
    }
}

function SanitizeString($var)
{
    $var = strip_tags($var);
    $var = htmlentities($var);
    return stripslashes($var);
}

?>

<!DOCTYPE html>
<html>

<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">


    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        .error {
            color: white;
            background-color: crimson;
            border-radius: 7px;
            text-align: center;
        }

        .success {
            background-color: darkgreen;
            color: white;
            border-radius: 7px;
            text-align: center;
        }
    </style>
</head>


<body>

    <main class="container">
        <h4>Contact</h4>

        <hr>

        <div class="row">
            <div class="col s12 l5">
                <span class="bold">Get in touch with me via email</span>
            </div>
            <div class="col s12 l5 offset-l2">

                <div class="success"><?php echo $success ?></div>
                <div class="error"><?php echo $error ?></div>
                <form action="index.php" method="post">

                    <div class="input-field">
                        <i class="material-icons prefix">account_circle</i>
                        <input type="text" name="subject" id="subject" value="<?php echo htmlspecialchars($subject) ?>">

                        <label for="subject">Subject*</label>
                        <div class="error"><?php echo $errors["subject"] ?></div>
                    </div>
                    <div class="input-field">
                        <i class="material-icons prefix">mode_edit</i>
                        <textarea id="message" class="materialize-textarea" name="message"><?php echo htmlspecialchars($message) ?></textarea>
                        <label for="message">Your Message*</label>
                        <div class="error"><?php echo $errors["message"] ?></div>
                    </div>
                    <div class="input-field center">
                        <input type="submit" class="btn-large z-depth-0" name="submit" id="submit" value="Send"></input>
                    </div>

                </form>


            </div>
        </div>


    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</body>

</html>
