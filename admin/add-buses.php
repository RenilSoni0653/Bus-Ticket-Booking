<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

if(isset($_POST['submit']))
{
	$rid=$_POST['rid'];
	$bname=$_POST['bname'];
	$bno=$_POST['bno'];
	$seat=$_POST['seat'];
	$source=$_POST['source'];
	$dest=$_POST['dest'];
	$arrival=$_POST['hh'].":".$_POST['mm'];
	$dept=$_POST['dhh'].":".$_POST['dmm'];
	$price=$_POST['price'];
	$st = $_POST['status'];

	$qu = mysqli_query($mysqli,"select * from buses where rid='$rid' or bno='$bno' or bname='$bname'");
	$row = mysqli_fetch_array($qu);
	
	if($rid == $row['rid'] or $bname == $row['bname'] or $bno == $row['bno'])
	{
		echo"<script>alert('Sorry, you cannot register with same Route-id or Bus-number or Bus-name');</script>";
	}
	else
	{
		$qu="insert into buses(rid,bname,bno,total_seat,source,destination,arrival,departure,price,status) values('$rid','$bname','$bno','$seat','$source','$dest','$arrival','$dept','$price','$st')";
		echo $qu;

		$query=mysqli_query($mysqli,$qu);

		if($query)
		{
			header("location:dashboard.php");
			echo"<script>alert('Bus has been added successfully');</script>";
		}
		else
		{
			echo"<script>alert('Bus has been added successfully');</script>";
		}
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
	<title>Add Bus</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="js/validation.min.js"></script>

</head>
<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content"><br><br>
		<?php include('includes/sidebar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title">Add Bus details </h2>
	
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Add Bus details</div>
									<div class="panel-body">
										<form method="post" class="form-horizontal">
										
					
						<div class="hr-dashed"></div>
						
						<div class="form-group">
				<label class="col-sm-2 control-label">Route - id : <br> (Ex: R001) </label>
		<div class="col-sm-8">
	<input type="text" class="form-control" name="rid" id="rid" onBlur="checkAvailability1()" required="required">
	<span id="user-availability-status1" style="font-size:12px;"></span>
						 </div>
						</div>
						
						<div class="form-group">
						<label class="col-sm-2 control-label">Bus-name :  </label>
					<div class="col-sm-8">
					<input type="text"  name="bname" id="bname" class="form-control" onBlur="checkAvailability2()" pattern='[A-Za-z]{3,10}' title='Enter letters only' required="required">
					<span id="user-availability-status2" style="font-size:12px;"></span>
					</div>
					</div>
					
				 <div class="form-group">
				<label class="col-sm-2 control-label">Bus-No : <br> (Ex: GJ-01-XX-0000)</label>
		<div class="col-sm-8">
	<input type="text" class="form-control" name="bno" id="bno" onBlur="checkAvailability3()" required="required">
	<span id="user-availability-status3" style="font-size:12px;"></span>
						 </div>
						</div>
						
						 <div class="form-group">
				<label class="col-sm-2 control-label">Source : </label>
		<div class="col-sm-8">
	<input type="text" class="form-control" name="source" id="cns" pattern='[A-Za-z]{3,10}' title='Enter letters only' required="required">
						 </div>
						</div>
						
						 <div class="form-group">
				<label class="col-sm-2 control-label">Destination : </label>
		<div class="col-sm-8">
	<input type="text" class="form-control" name="dest" pattern='[A-Za-z]{3,10}' title='Enter letters only' required="required">
						 </div>
						</div>
						
												 <div class="form-group">
													<label class="col-sm-2 control-label">Price : </label>
											<div class="col-sm-8">
										<input type="number" class="form-control" name="price" id="cns" required="required">
										 </div>
										</div>

<div class="form-group">
									<label class="col-sm-2 control-label">Total Seats</label>
									<div class="col-sm-8">
									<input type="number" max="30" class="form-control" name="seat" required="required">
												</div>
											</div>
											
						<div class="form-group">
				<label class="col-sm-2 control-label">Source Arrival time : <br> (24 Hours Format)</label>
		<div class="col-sm-8">
		<select name="hh">
		<?php
		
		
		for($i=1;$i<=23;$i++)
		{
			if($i < 10)
			{
				echo "<option>0$i</option>";
			}
			else
			{
				echo "<option>$i</option>";
			}
		}
		?>
		</select>
		:
		<select name="mm">
		<?php
		for($i=0;$i<=59;$i++)
		{
			if($i < 10)
			{
				echo "<option>0$i</option>";
			}
			else
			{
				echo "<option>$i</option>";
			}
		}
		
	?>
	</select>
						 </div>
						</div>
						
						<div class="form-group">
				<label class="col-sm-2 control-label">Destination Arrival time : <br> (24 Hours Format)</label>
				
		<div class="col-sm-8">
		<select name="dhh">
		<?php
		
		
		for($i=1;$i<=23;$i++)
		{
			if($i < 10)
			{
				echo "<option>0$i</option>";
			}
			else
			{
				echo "<option>$i</option>";
			}
		}
		?>
		</select>
		:
		<select name="dmm">
		<?php
		for($i=0;$i<=59;$i++)
		{
			if($i < 10)
			{
				echo "<option>0$i</option>";
			}
			else
			{
				echo "<option>$i</option>";
			}
		}
		
	?>
	</select>
						 </div>
						</div>
					
					<div class="form-group">
				<label class="col-sm-2 control-label">Status : <br> 1: Active <br>  0: Inactive</label>
		<div class="col-sm-8">
		<input type="number" min="0" max="1" class="form-control" name="status" id="sts" required="required">
		
						 </div>
						</div>
						
												<div class="col-sm-8 col-sm-offset-2">

													<input class="btn btn-primary" type="submit" name="submit" value="Add Bus">
												</div>
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
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>

</script>
</body>

	<script>
	
function checkAvailability1() 
{
	$("#loaderIcon").show();
	jQuery.ajax({
	url: "check_availability.php",
	data:'rid='+$("#rid").val(),
	type: "POST",
	success:function(data){
	$("#user-availability-status1").html(data);
	$("#loaderIcon").hide();
	},
	error:function ()
	{
	event.preventDefault();
	alert('error');
	}
	});
}

function checkAvailability2() 
{
	$("#loaderIcon").show();
	jQuery.ajax({
	url: "check_availability.php",
	data:'bname='+$("#bname").val(),
	type: "POST",
	success:function(data){
	$("#user-availability-status2").html(data);
	$("#loaderIcon").hide();
	},
	error:function ()
	{
	event.preventDefault();
	alert('error');
	}
	});
}

function checkAvailability3() 
{
	$("#loaderIcon").show();
	jQuery.ajax({
	url: "check_availability.php",
	data:'bno='+$("#bno").val(),
	type: "POST",
	success:function(data){
	$("#user-availability-status3").html(data);
	$("#loaderIcon").hide();
	},
	error:function ()
	{
	event.preventDefault();
	alert('error');
	}
	});
}
</script>

</html>