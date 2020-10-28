<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
  require '../PHPMailer/PHPMailer/src/Exception.php';
  require '../PHPMailer/PHPMailer/src/PHPMailer.php';
  require '../PHPMailer/PHPMailer/src/SMTP.php';
  
if(isset($_GET['update']))
{
	$from="sonirenil12@gmail.com";
	$to=$_GET['email'];
	$subject="Verify Admin";
	
	$message="You are approved as an admin now you can login with your email-id and password";
	
	$id=intval($_GET['update']);
	$adn="update admin set status=1 where id=? and email='$to'";
		$stmt= $mysqli->prepare($adn);
		$stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->close();	   
		
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
          
            echo "<script>alert('Accepted');</script>" ;
            echo "<script>window.location.href='dashboard.php'</script>";

        } catch (Exception $e) { // handle error.
            echo '<script>alert("Message could not be sent. Mailer Error: ', $mail->ErrorInfo, '")</script>';
        }
        
}

if(isset($_GET['del']))
{
	$from="sonirenil12@gmail.com";
	$to=$_GET['email'];
	$subject="Verify Admin";
	
	$message="You are not approved as an admin";
	
	$id=intval($_GET['del']);
	$adn="delete from admin where id=?";
		$stmt= $mysqli->prepare($adn);
		$stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->close();	   
		
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
          
            echo "<script>alert('Accepted');</script>" ;
            echo "<script>window.location.href='dashboard.php'</script>";

        } catch (Exception $e) { // handle error.
            echo '<script>alert("Message could not be sent. Mailer Error: ', $mail->ErrorInfo, '")</script>';
        }
	
        echo "<script>alert('Rejected');</script>" ;
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
	<meta name="theme-color" content="#3e454c">
	<title>Manage Admin</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<?php include('includes/header.php');?>

	<div class="ts-main-content">
			<?php include('includes/sidebar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title" style="margin-top:4%">Manage Admin</h2>
						<div class="panel panel-default">
							<div class="panel-heading">All bus Details</div>
							<div class="panel-body">
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>No.</th>
											<th>User-name</th>
											<th>Gender</th>
											<th>Phone-number</th>
											<th>Email-id</th>
											<th>Reg Date </th>
											<th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>No.</th>
											<th>User-name</th>
											<th>Gender</th>
											<th>Phone-number</th>
											<th>Email-id</th>
											<th>Reg Date </th>
											<th>Action</th>										</tr>
									</tfoot>
									<tbody>
<?php	
$aid=$_SESSION['id'];
$ret="select * from admin";
$stmt= $mysqli->prepare($ret) ;
//$stmt->bind_param('i',$aid);
$stmt->execute() ;//ok
$res=$stmt->get_result();
$cnt=1;
while($row=$res->fetch_object())
	  {
		  
	  	?>
		
		<?php
		$status=$row->status;
		if($status == 0)
		{
		?>
		
<tr><td><?php echo $cnt;?></td>
<td><?php echo $row->username;?></td>
<td><?php echo $row->gender;?></td>
<td><?php echo $row->phone;?></td>
<td><?php echo $row->email;?></td>
<td><?php echo $row->reg_date;?></td>

<td>
<form method="POST">
<a href="verify-admin.php?update=<?php echo $row->id;?>&amp;email=<?php echo $row->email; ?>" onclick="return confirm('Do you want to update it');"><i class="fa fa-check"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="verify-admin.php?del=<?php echo $row->id;?>&amp;email=<?php echo $row->email; ?>" onclick="return confirm('Do you want to reject');"><i class="fa fa-close"></i></a>
</td>
										</tr>
										<?php }?>								
									<?php
$cnt=$cnt+1;
									 } ?>
	  
										
									</tbody>
								</table>

								
							</div>
						</div>

					
					</div>
				</div>

			

			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>

</body>

</html>
