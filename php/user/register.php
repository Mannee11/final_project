  
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/home10/sopmycom/public_html/PHPMailer/src/Exception.php';
require '/home10/sopmycom/public_html/PHPMailer/src/PHPMailer.php';
require '/home10/sopmycom/public_html/PHPMailer/src/SMTP.php';

    include_once("dbconnect.php");
    
     $name = $_POST["name"];
     $email = $_POST["email"];
     $phone = $_POST["phone"];
     $passa = $_POST["passworda"];
     $passb = $_POST["passwordb"];
     $shapass = sha1($passa);  
     $otp = rand(1000,9999);

     if (!(isset($name) || isset($email) || isset($phone) || isset($passa) || isset($passb))){
         echo "<script>alert('Please fill in all required information')</script>";
         echo "<script>window.location.replace('../html/register.html')</script>";
     }
     else{
        $sqlregister = "INSERT INTO tbl_user(NAME,EMAIL,PHONE,PASSWORD,OTP) VALUES('$name','$email','$phone','$shapass','$otp')";
        try{
            $conn->exec($sqlregister);
            echo "<script> alert('Registration successful.An email has been sent to .$email. Please check your email for OTP verification. Also check in your spam folder.')</script>";
            echo "<script> window.location.replace('/project/php/user/login.php')</script>";
            sendEmail($otp,$email);
 
        }catch(PDOException $e){
            echo "<script> alert('Registration failed')</script>";
            echo "<script> window.location.replace('/project/html/register.html')</script>";
        }
     }
         function sendEmail($otp,$email){
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0;                                               //Disable verbose debug output
    $mail->isSMTP();                                                    //Send using SMTP
    $mail->Host       = 'mail.sopmy520.com';                          //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                           //Enable SMTP authentication
    $mail->Username   = 'ninjaz@sopmy520.com';                  //SMTP username
    $mail->Password   = 'x(a=FuQf~^.3';                                 //SMTP password
    $mail->SMTPSecure = 'tls';         
    $mail->Port       = 587;
    
    $from = "ninjaz@sopmy520.com";
    $to = $email;
    $subject = "From Ninjaz. Please Verify Your Account";
    $message = "<p>Click the following link to verify your account<br><br><a href='https://sopmy520.com/project/php/user/verify_account.php?email=".$email."&key=".$otp."'>Click Here</a>";
    
    $mail->setFrom($from,"Ninjaz");
    $mail->addAddress($to);                                             //Add a recipient
    
    //Content
    $mail->isHTML(true);                                                //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->send();
    }
?>


