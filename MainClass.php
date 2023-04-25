<?php
if(session_status() === PHP_SESSION_NONE)
session_start();
Class MainClass{
    protected $db;
    function __construct(){
        $this->db = new mysqli('localhost','root','','login_otp_db');
        if(!$this->db){
            die("Database Connection Failed. Error: ".$this->db->error);
        }
    }
    function db_connect(){
        return $this->db;
    }
    public function register(){
        foreach($_POST as $k => $v){
            $$k = $this->db->real_escape_string($v);
        }
        $password = password_hash($password, PASSWORD_DEFAULT);
        $check = $this->db->query("SELECT * FROM `users` where `email`= '$email}' ")->num_rows;
        if($check > 0){
            $resp['status'] = 'failed';
            $_SESSION['flashdata']['type']='danger';
            $_SESSION['flashdata']['msg'] = ' Email already exists.';
        }else{
            $sql = "INSERT INTO `users` (firstname,middlename,lastname,email,`password`) VALUES ('$firstname','$middlename','$lastname','$email','$password')";
            $save = $this->db->query($sql);
            if($save){
                $resp['status'] = 'success';
            }else{
                $resp['status'] = 'failed';
                $resp['err'] = $this->db->error;
                $_SESSION['flashdata']['type']='danger';
                $_SESSION['flashdata']['msg'] = ' An error occurred.';
            }
        }
        return json_encode($resp);
    }
    public function login(){
        extract($_POST);
        $sql = "SELECT * FROM `users` where `email` = ? ";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('s',$email);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            $data = $result->fetch_array();
            $pass_is_right = password_verify($password,$data['password']);
            $has_code = false;
            if($pass_is_right && (is_null($data['otp']) || (!is_null($data['otp']) && !is_null($data['otp_expiration']) && strtotime($data['otp_expiration']) < time()) ) ){
                $otp = sprintf("%'.06d",mt_rand(0,999999));
                $expiration = date("Y-m-d H:i" ,strtotime(date('Y-m-d H:i')." +1 mins"));

                //qr code
                require_once'phpqrcode/qrlib.php';
                $path = 'images/';
                $qrcodd = strval($otp);
                $qrcodefile = $path.time().".png";
                QRcode::png($qrcodd, $qrcodefile, 'H', 4,4);

                $update_sql = "UPDATE `users` set otp_expiration = '{$expiration}', otp = '{$otp}', qr_code = '{$qrcodefile}'where id='{$data['id']}' ";
                $update_otp = $this->db->query($update_sql);
                if($update_otp){
                    $has_code = true;
                    $resp['status'] = 'success';
                    $_SESSION['otp_verify_user_id'] = $data['id'];
                    $this->send_mail($data['email'],$otp."k".$qrcodefile); //email method
                }else{
                    $resp['status'] = 'failed';
                    $_SESSION['flashdata']['type'] = 'danger';
                    $_SESSION['flashdata']['msg'] = ' An error occurred while loggin in. Please try again later.';
                }
                
            }else if(!$pass_is_right){
               $resp['status'] = 'failed';
               $_SESSION['flashdata']['type'] = 'danger';
               $_SESSION['flashdata']['msg'] = ' Incorrect Password';
            }
        }else{
            $resp['status'] = 'failed';
            $_SESSION['flashdata']['type'] = 'danger';
            $_SESSION['flashdata']['msg'] = ' Email is not registered.';
        }
        return json_encode($resp);
    }
    public function get_user_data($id){
        extract($_POST);
        $sql = "SELECT * FROM `users` where `id` = ? ";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $result = $stmt->get_result();
        $dat=[];
        if($result->num_rows > 0){
            $resp['status'] = 'success';
            foreach($result->fetch_array() as $k => $v){
                if(!is_numeric($k)){
                    $data[$k] = $v;
                }
            }
            $resp['data'] = $data;
        }else{
            $resp['status'] = 'false';
        }
        return json_encode($resp);
    }
    public function resend_otp($id){
        $otp = sprintf("%'.06d",mt_rand(0,999999));
        $expiration = date("Y-m-d H:i" ,strtotime(date('Y-m-d H:i')." +1 mins"));

            include('phpqrcode/qrlib.php');
    $tempDir = './images/';    
    $codeContents = strval($otp);
    
    // we need to generate filename somehow, 
    // with md5 or with database ID used to obtains $codeContents...
    $fileName = '005_file_'.md5($codeContents).'.png';    
    $pngAbsoluteFilePath = $tempDir.$fileName;
    $urlRelativeFilePath = $tempDir.$fileName;

        $update_sql = "UPDATE `users` set otp_expiration = '{$expiration}', otp = '{$otp}' , qr_code = '{$fileName}'where id = '{$id}' ";
        $update_otp = $this->db->query($update_sql);
        if($update_otp){
            $resp['status'] = 'success';
            $email = $this->db->query("SELECT email FROM `users` where id = '{$id}'")->fetch_array()[0];
            $this->send_mail($email,$otp);
        }else{
            $resp['status'] = 'failed';
            $resp['error'] = $this->db->error;
        }
        return json_encode($resp);
    }
    public function otp_verify(){
        extract($_POST);
         $sql = "SELECT * FROM `users` where id = ? and otp = ?";
         $stmt = $this->db->prepare($sql);
         $stmt->bind_param('is',$id,$otp);
         $stmt->execute();
         $result = $stmt->get_result();
         if($result->num_rows > 0){
             $resp['status'] = 'success';
             $this->db->query("UPDATE `users` set otp = NULL, otp_expiration = NULL where id = '{$id}'");
             $_SESSION['user_login'] = 1;
             foreach($result->fetch_array() as $k => $v){
                 if(!is_numeric($k))
                 $_SESSION[$k] = $v;
             }
         }else{
             $resp['status'] = 'failed';
             $_SESSION['flashdata']['type'] = 'danger';
             $_SESSION['flashdata']['msg'] = ' Incorrect OTP.';
         }
         return json_encode($resp);
    }
    function send_mail($to="",$pin=""){
        if(!empty($to)){
            try{

                $string = strval($pin);
                $pos1 = strpos($string, "k"); // find the position of "k" in the string
                $pin1 = substr($string, 0, $pos1); // extract the text before "k"
                $filename1 = substr($string, $pos1 + 1); // extract the text after "k"

                $email = 'info@xyzapp.com';
                $headers = 'From:' .$email . '\r\n'. 'Reply-To:' .
                $email. "\r\n" .
                'X-Mailer: PHP/' . phpversion()."\r\n";
                //$headers .= "MIME-Version: 1.0" . "\r\n";
                //$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                // the message
                $msg = $pin1;
    $content = file_get_contents($filename1);
    $content = chunk_split(base64_encode($content));
    // a random hash will be necessary to send mixed content
    $separator = md5(time());
    // carriage return type (RFC)
    $eol = "\r\n";
    // main header (multipart mandatory)
    $headers .= "MIME-Version: 1.0" . $eol;
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
    $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
    $headers .= "This is a MIME encoded message." . $eol;
    // message
    $body = "--" . $separator . $eol;
    $body .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
    $body .= "Content-Transfer-Encoding: 8bit" . $eol;
    $body .= $msg . $eol;
    // attachment
    $body .= "--" . $separator . $eol;
    $body .= "Content-Type: application/octet-stream; name=\"" . $filename1 . "\"" . $eol;
    $body .= "Content-Transfer-Encoding: base64" . $eol;
    $body .= "Content-Disposition: attachment" . $eol;
    $body .= $content . $eol;
    $body .= "--" . $separator . "--";


                // send email
                mail($to,"OTP",$body,$headers);
                // die("ERROR<br>".$headers."<br>".$msg);

            }catch(Exception $e){
                $_SESSION['flashdata']['type']='danger';
                $_SESSION['flashdata']['msg'] = ' An error occurred while sending the OTP. Error: '.$e->getMessage();
            }
        }
    }
    function __destruct(){
         $this->db->close();
    }
}
$class = new MainClass();
$conn= $class->db_connect();