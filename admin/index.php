<?php
session_start();
include('includes/config.php');
if(isset($_POST['login']))
{
	$username=$_POST['username'];
	$password=$_POST['password'];
	
	$result="select id,email,username,password,status from admin where (email='$username' || username='$username') and password='$password'";						
							
							$fireQuery=mysqli_query($mysqli,$result);
							
							
							if(mysqli_num_rows($fireQuery)>0)
							{
								$row=mysqli_fetch_assoc($fireQuery);
								$status=$row['status'];
								if($status == 1)
								{
									$_SESSION['id']=$row['id'];
									header("location:dashboard.php");
								}
								else
								{
									echo "<script>alert('Wait for verifying your Username/Email');</script>";
								}
							}
							else
							{
								echo "<script>alert('Invalid Username/Email or password');</script>";
							}
	/*$query=mysqli_query($mysqli,"SELECT username,password FROM admin WHERE username=$username and password=$password ");
	
	
	//$_SESSION['id']=$id;

	$ldate=date('d/m/Y h:i:s', time());
	if($query)
	{
		
	}
	else
	{
		
	}*/
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

	<title>Admin login</title>

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
	
	<div class="login-page bk-img" style="background-image: url(img/patel.jpg);">
		<div class="form-content">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3" style="margin-top:5%">
						<h1 class="text-center text-bold text-dark mt-2x">Bus booking system</h1>
						<div class="well row pt-2x pb-3x bk-dark">
							<div class="col-md-8 col-md-offset-2">
							
								<form action="" class="mt" method="post">
									<label for="" class="text-uppercase text-sm" style="color:white">Your Username or email</label>
									<input type="text" placeholder="Username" name="username" class="form-control mb">
									<label for="" class="text-uppercase text-sm" style="color:white">Password</label>
									<input type="password" placeholder="Password" name="password" pattern="(?=.*\d)(?=.*[a-z]){8,}" class="form-control mb">
									

									<input type="submit" name="login" class="text-lg btn btn-primary btn-block" value="login" >
									<br>
									<div class="text-center text-light">
									<a href="registration.php" class="text-dark">Sign up</a>&nbsp;<br><br>
									<a href="forgot-password.php" class="text-dark">Forgot password?</a>
								
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
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