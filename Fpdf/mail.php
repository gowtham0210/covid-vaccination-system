<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer/src/Exception.php';
require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';

if(isset($_POST["send"])){
     $mail = new PHPMailer(true);
     $mail -> isSMTP();
     $mail-> Host = 'smtp.gmail.com';
     $mail->SMTPAuth = true;
     $mail->Username = 'gowthambujju02@gmail.com';
     $mail->password = 'ivlborkqgszbinpf';
     $mail->SMTPSecure = 'ssl';
     $mail->port = 465;
     $mail->setFrom('gowthambujju02@gmail.com');
     $mail->addAddress($_POST["email"]);
     $mail->isHTML(true);
     $mail->Subject = $_POST["subject"];
     $mail->Body = $_POST["message"];
     $mail->send();
     $mail->SMTPDebug = 3;
     echo "
     
     <script>
     alert('sent Successfully');
     document.location.href = 'index.php';
     </script>
     ";
}








?>