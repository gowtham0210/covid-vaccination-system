<?php 

use ../PHPMailer-master/src/PHPMailer;
use ../PHPMailer-master/src/SMTP;
use ../PHPMailer-master/src/Exception;

require '../PHP/db.php';

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['email'])){

    $email = $conn->real_escape_string($_POST['email']);
    $result = $conn->query("select * from benificary_details_1 where email_id = '$email';");
    if($result->num_rows){
        $_SESSION['EMAIL']=$email;
        $otp = rand(1111, 9999);
        $conn->query("update otp_verification set otp = $otp where email = '$email';");
       
        sendEmail($email, $otp);
        echo json_encode(['status' => 'success']);
    }
    else
    echo json_encode(['status' => 'failure']);
    exit();
}


if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['otp'])){
    $userProvidedOtp = $conn->real_escape_string($_POST['otp']);
    $email = $_SESSION['EMAIL'];
    $result = $conn->query("select * from otp_verification where otp = $userProvidedOtp and email = '$email' ;");
    if($result->num_rows){
        $_SESSION['LOGGEDIN']=true;
        echo json_encode(['status' => 'success']); 
    }
    else 
    echo json_encode(['status' => 'failure']);
exit();


}

// function sendEmail logic
function sendEmail($email, $otp){
   
    $mail = new PHPMailer(true);
    
    try{
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Username ='gowthambujju02@gmail.com';
    $mail->Password = 'ivlborkqgszbinpf';
    $mail->SMTPAuth=true;
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->setFrom('gowthambujju02@gmail.com', 'CodingShodingWithNJ');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject='Your OTP Code';
    $mail->Body = "Here is your OTP code: <br> $otp";
    $mail->send();
    }catch(Exception $e)
        {echo $e;}
    }
?>
