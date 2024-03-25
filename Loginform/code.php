<?php 
session_start();
include('dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function sendemail_verification($name,$email,$verify_token)
{

	$mail = new PHPMailer(true);
	// $mail->SMTDebug = 2;	
	$mail->isSMTP();                                            
    $mail->SMTPAuth   = true; 

    $mail->Host       = "smtp.gmail.com";                     
    $mail->Username   = "ligaliggenoel@gmail.com";                     
    $mail->Password   = "genoel@gmail";                               

    $mail->SMTPSecure = "tls";
    $mail->Port = 587;

    $mail->setFrom("ligaliggenoel@gmail.com",$name);
    $mail->addAddress($email);

    $mail->isHTML(true);                                  
    $mail->Subject = "Email Verification from Midterm Project";

    $email_template = "
    	<h2>You have registered already</h2>
    	<h5>Verify your Email Address to Login with the Link below</h5>
    	<br></br>
    	<a href= 'http://localhost/Registration%20&%20Login%20Form/verify-email.php?token=$verify_token'> click me </a>
    ";

    	$mail->Body = $email_template;
    	$mail->send();
   //  	echo 'Message has been sent';

}

if (isset($_POST['register_btn'])) 
{
	$name = $_POST['name']; 
	$phone = $_POST['phone']; 
	$email = $_POST['email']; 
	$password = $_POST['password'];  
	$verify_token = md5(rand());  

	sendemail_verification("$name","$email",$verify_token);
	echo "sent or not";


//$check_email_query = "SELECT email FROM users WHERE email ='$email' LIMIT 1";
//$check_email_query_run = mysqli_query($con,$check_email_query);

//if(mysqli_num_rows($check_email_query_run) >0);
//{
//	$_SESSION['status'] = "Email ID is already exists";
//	header('Location: register.pphp');
//}
//else
//{
//	$query = "INSERT INTO users (name,phone,email,password,verify_token) VALUES ('$name','$phone','$email','$password','$verify_token')";
//	$query_run = mysqli_query($con, $query);

//if ($query_run)
//{
	//sendemail_verification("$name","$email",$verify_token);

 //		$_SESSION['status'] = "Registred successfully! Please verify your email address";
//	header("Location: register.php");
//}
//else
//{
//	$_SESSION['status'] = "Registration failed";
//	header("Location: register.php");
//}


//		}
	}
?>


