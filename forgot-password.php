<?php
session_start();
include('config.php');

use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
  require 'PHPMailer/PHPMailer/src/Exception.php';
  require 'PHPMailer/PHPMailer/src/PHPMailer.php';
  require 'PHPMailer/PHPMailer/src/SMTP.php';

    if(isset($_POST['login']))
    {
        $from="sonirenil12@gmail.com";
        $to=$_POST['email'];

        $subject="Password Recovery";

		$qu="SELECT * FROM user_reg WHERE email='$to'";
		$query=mysqli_query($mysqli,$qu);
        $row=mysqli_fetch_array($query);
		
        $password = base64_decode($row['password']);
        $message = "Your Password is $password";
		
        $mail = new PHPMailer(true); 
        try
        {
            $namefrom = "sonirenil";
            $nameto="sonirenil";
              //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();   // by SMTP
            $mail->SMTPAuth   = true;   // user and password
            $mail->Host       = "smtp.gmail.com";
            $mail->Port       = 465;
            $mail->Username   = $from;  
            $mail->Password   = "renilsoni@12";
            $mail->SMTPSecure = "ssl";    // options: 'ssl', 'tls' , ''  
            $mail->setFrom($from,$namefrom);   // From (origin)     
            $mail->Subject  = $subject;
            $mail->AltBody  = "hello how are you";
            $mail->Body = $message;
            $mail->isHTML();   // Set HTML type
            //$mail->addAttachment("attachment"); 

              // $addresses = explode(',',$to);
            // foreach($to as $id=>$value)
            // {
            //     // echo $value;
            //     $mail->addAddress($value);  

            // }
            $mail->addAddress($to,$nameto);

            $mail->send();
          
          
            echo '<script>alert("Mail sent.")</script>';
            echo "<script>window.location.href='login.php'</script>";

        } catch (Exception $e) { // handle error.
            echo '<script>alert("Message could not be sent. Mailer Error: ', $mail->ErrorInfo, '")</script>';
        }
        
    }
?>

<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>User Forgot Password</title>

	<link rel="stylesheet" href="css/bus(css)/font-awesome.min.css">
	<link rel="stylesheet" href="css/bus(css)/bootstrap.min.css">
	<link rel="stylesheet" href="css/bus(css)/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bus(css)/bootstrap-social.css">
	<link rel="stylesheet" href="css/bus(css)/bootstrap-select.css">
	<link rel="stylesheet" href="css/bus(css)/fileinput.min.css">
	<link rel="stylesheet" href="css/bus(css)/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/bus(css)/style.css">
</head
<body>
	
	<div class="login-page bk-img" style="background-image: url(img/bus1.jpg);">
		<div class="form-content">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<h1 class="text-center text-bold text-dark mt-4x">Forgot Password</h1>
						<div class="well row pt-2x pb-3x bk-dark">
							<div class="col-md-8 col-md-offset-2">
							<?php if(isset($_POST['login']))
{ ?>
					<!--<p>Yuor Password is <br> Change the Password After login</p>-->
					<?php }  ?>
								<form action="" class="mt" method="post">
									<label for="" class="text-uppercase text-sm text-light">Your Email</label>
									<input type="email" placeholder="Email" name="email" class="form-control mb">
									

									<input type="submit" name="login" class="btn btn-primary btn-block" value="login" ><br>
									<div class="text-center text-light">
							<a href="login.php" class="text-dark">Sign in?</a>
						</div>
								</form>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="js/bus(js)/.min.js"></script>
	<script src="js/bus(js)/bootstrap-select.min.js"></script>
	<script src="js/bus(js)/bootstrap.min.js"></script>
	<script src="js/bus(js)/.dataTables.min.js"></script>
	<script src="js/bus(js)/dataTables.bootstrap.min.js"></script>
	<script src="js/bus(js)/Chart.min.js"></script>
	<script src="js/bus(js)/fileinput.js"></script>
	<script src="js/bus(js)/chartData.js"></script>
	<script src="js/bus(js)/main.js"></script>
</body>
</html>