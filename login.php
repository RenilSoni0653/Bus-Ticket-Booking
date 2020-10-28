<?php
session_start();
include('config.php');

if(isset($_POST['login']))
{
	$email = $_POST['email'];
	$Password = $_POST['password'];
	$password=base64_encode($Password);

	$result = "select `id`,`email`,`password` from `user_reg` where `email` like '$email' and `password` like '$password'";
	$fireQuery = mysqli_query($mysqli,$result);

	if(mysqli_num_rows($fireQuery) > 0)
	{
		$row = mysqli_fetch_assoc($fireQuery);
		$_SESSION['id'] = $row['id'];
		header("location:dashboard.php");
	}
	else
	{
		echo "<script>alert('Invalid Username/Email or password');</script>";
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
	<meta name="theme-color" content="#3e454c">
	<title>User Login</title>
	
	<link rel="stylesheet" href="admin/css/font-awesome.min.css">
	<link rel="stylesheet" href="admin/css/bootstrap.min.css">
	<link rel="stylesheet" href="admin/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="admin/css/bootstrap-social.css">
	<link rel="stylesheet" href="admin/css/bootstrap-select.css">
	<link rel="stylesheet" href="admin/css/fileinput.min.css">
	<link rel="stylesheet" href="admin/css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="admin/css/style.css">
	
	<script type="text/javascript" src="admin/js/jquery-1.11.3-jquery.min.js"></script>
	<script type="text/javascript" src="admin/js/validation.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
	
	<script type="text/javascript">
	function valid()
	{
		if(document.registration.password.value!= document.registration.cpassword.value)
		{
			alert("Password and Re-Type Password Field do not match  !!");
			document.registration.cpassword.focus();
			return false;
		}
		return true;
	}
	</script>
</head>

<body>
<?php include('header.php'); ?>
<div class="login-page bk-img" style="background-image: url(img/bus1.jpg);">
	<div class="ts-main-content">
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-9">
						<!--<h2 class="page-title col-md-offset-* text-bold mt-3x">User Login </h2>-->
						<h2 class="text-center text-bold text-dark mt-3x">User Login</h2> <hr>
						<div class="row">
							<div class="col-md-7 col-md-offset-3">
								<div class="well row pt-2x pb-3x bk-dark">
									<div class="col-md-10 col-md-offset-1">
										<form action="" class="mt" method="post">
											<label for="" class="text-uppercase text-sm" style="color:white">Email</label>
											<input type="text" placeholder="Email" name="email" class="form-control mb" required>
											
											<label for="" class="text-uppercase text-sm" style="color:white">Password</label>
											<input type="password" placeholder="Password" name="password" class="form-control mb" required> <br>
											
											<input type="submit" name="login" class="text-lg btn btn-primary btn-block" value="Login" > <br>
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
			</div> 	
		</div> 	
	</div> 	
</div> 	

<script src="admin/js/jquery.min.js"></script>
<script src="admin/js/bootstrap-select.min.js"></script>
<script src="admin/js/bootstrap.min.js"></script>
<script src="admin/js/jquery.dataTables.min.js"></script>
<script src="admin/js/dataTables.bootstrap.min.js"></script>
<script src="admin/js/Chart.min.js"></script>
<script src="admin/js/fileinput.js"></script>
<script src="admin/js/chartData.js"></script>
<script src="admin/js/main.js"></script>

</body>
</html>