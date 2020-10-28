<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();
//code for add courses
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
$status = $_POST['status'];

$query=mysqli_query($mysqli,"insert into compare(rid,bname,bno,total_seat,source,destination,arrival,departure,price,status) values('$rid','$bname','$bno','$seat','$source','$dest','$arrival','$dept','$price','$status')");

header("location:dashboard.php");
echo"<script>alert('Bus has been added successfully');</script>";
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
<script>
function getSeater(val) {
$.ajax({
type: "POST",
url: "get_seater.php",
data:'source='+val,
success: function(data){
//alert(data);
$('#source').val(data);
}
});

$.ajax({
type: "POST",
url: "get_seater.php",
data:'destination='+val,
success: function(data){
//alert(data);
$('#destination').val(data);
}
});
</script>
</head>
<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<br>
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
						<label class="col-sm-2 control-label">Route-id : <br> (Ex: CR001) </label>
					<div class="col-sm-8">
					<input type="text" name="rid"  id="rid" class="form-control" onBlur="checkAvailability1()" required="required"> 
					<span id="user-availability-status1" style="font-size:12px;"></span>
					</div>
					</div>
					
						<div class="form-group">
						<label class="col-sm-2 control-label">Bus-name :  </label>
					<div class="col-sm-8">
					<input type="text" id="bname" name="bname" class="form-control" onBlur="checkAvailability2()" required="required"> 
					<span id="user-availability-status2" style="font-size:12px;"></span>
					</div>
					</div>
				 <div class="form-group">
				<label class="col-sm-2 control-label">Bus-No : <br> (Ex: GJ-01-MV-8558)</label>
		<div class="col-sm-8">
	<input type="text" class="form-control" name="bno" id="bno" onBlur="checkAvailability3()" required="required">
	<span id="user-availability-status3" style="font-size:12px;"></span>
						 </div>
						</div>
						
						 <div class="form-group">
				<label class="col-sm-2 control-label">Source : </label>
				<div class="col-sm-8">
			<select name="source" id="source">
								<?php
								$qu="select DISTINCT source,destination from buses";
								$query=mysqli_query($mysqli,$qu);
								while($row=mysqli_fetch_array($query))
								{
								?>
							<option value="<?php echo $row['source']; ?>"><?php echo $row['source'];?> - <?php echo $row['destination'];?></option>
			<?php } ?>
			</select>
						 </div>
						</div>
						
						 <div class="form-group">
				<label class="col-sm-2 control-label">Destination : </label>
				<div class="col-sm-8">
			<select name="dest" id="destination">
			<?php
								$qu="select DISTINCT source,destination from buses";
								$query=mysqli_query($mysqli,$qu);
								while($row=mysqli_fetch_array($query))
								{
								?>
			<option value="<?php echo $row['destination']; ?>"><?php echo $row['destination'];?> - <?php echo $row['source'];?></option>
			<?php } ?>
			</select>
						 </div>
						</div>
						
						
					
												 <div class="form-group">
													<label class="col-sm-2 control-label">Price : </label>
											<div class="col-sm-8">
										<input type="text" class="form-control" name="price" id="cns" required="required">
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