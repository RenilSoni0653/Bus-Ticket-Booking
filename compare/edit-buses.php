<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();
//code for add courses
if(isset($_POST['submit']))
{
$bname=$_POST['bname'];
$bno=$_POST['bno'];
$seat=$_POST['seat'];
$source=$_POST['source'];
$dest=$_POST['destination'];
$arrival=$_POST['hh'].":".$_POST['mm'];
$dept=$_POST['dhh'].":".$_POST['dmm'];
$price=$_POST['price'];
$status=$_POST['status'];
$id=$_GET['id'];

$query="update compare set bname=?,bno=?,total_seat=?,source=?,destination=?,arrival=?,departure=?,price=?,status=? where id=?";
$stmt = $mysqli->prepare($query);
$rc=$stmt->bind_param('ssissssiii',$bname,$bno,$seat,$source,$dest,$arrival,$dept,$price,$status,$id);
$stmt->execute();

echo"<script>alert('User has been Updated successfully');</script>";
header("location:manage-buses.php");
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
	<title>Edit Bus</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">>
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
	<div class="ts-main-content">
		<?php include('includes/sidebar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title">Edit Bus details </h2>
	
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Edit Bus details</div>
									<div class="panel-body">
										<form method="post" class="form-horizontal">
												<?php	
												$id=$_GET['id'];
	$ret="select * from compare where id=?";
		$stmt= $mysqli->prepare($ret) ;
	 $stmt->bind_param('i',$id);
	 $stmt->execute() ;//ok
	 $res=$stmt->get_result();
	 //$cnt=1;
	   while($row=$res->fetch_object())
	  {
	  	?>
						<div class="hr-dashed"></div>
						<div class="form-group">
						<label class="col-sm-2 control-label">Bus-name :  </label>
					<div class="col-sm-8">
					<input type="text"  name="bname" value="<?php echo $row->bname;?>"  class="form-control"> </div>
					</div>
				 <div class="form-group">
				<label class="col-sm-2 control-label">Bus-No : <br> (Ex: GJ-01-MV-8558)</label>
		<div class="col-sm-8">
	<input type="text" class="form-control" name="bno" id="cns" value="<?php echo $row->bno;?>" required="required">
						 </div>
						</div>
						
						<div class="form-group">
				<label class="col-sm-2 control-label">Source : </label>
		<div class="col-sm-8">
	<input type="text" class="form-control" name="source" value="<?php echo $row->source;?>" required="required">
						 </div>
						</div>
						
						<div class="form-group">
				<label class="col-sm-2 control-label">Destination : </label>
		<div class="col-sm-8">
	<input type="text" class="form-control" name="destination" value="<?php echo $row->destination;?>" required="required">
						 </div>
						</div>
						
						<?php
							$ar=$row->arrival;
							$dr=$row->departure;
							$hh=explode(':',$ar);
							$mm=explode(':',$dr);
						?>
						
						<div class="form-group">
				<label class="col-sm-2 control-label">Source Arrival time : <br> (24 Hours Format)</label>
		<div class="col-sm-8">
		<select name="hh">
		<?php
		
		echo "<option>$hh[0]</option>";
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
		echo "<option>$hh[1]</option>";
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
		
		echo "<option>$mm[0]</option>";
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
		echo "<option>$mm[1]</option>";
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
									<label class="col-sm-2 control-label">Price</label>
									<div class="col-sm-8">
									<input type="number" class="form-control" name="price" value="<?php echo $row->price;?>" >
									</div>
									</div>
						
									<div class="form-group">
									<label class="col-sm-2 control-label">Total Seats</label>
									<div class="col-sm-8">
									<input type="number" class="form-control" name="seat" max="30" value="<?php echo $row->total_seat;?>" >
									</div>
									</div>
<div class="form-group">
				<label class="col-sm-2 control-label">Status : <br> 1: Active <br>  0: Inactive</label>
		<div class="col-sm-8">
	<input type="number" min="0" max="1" class="form-control" name="status"  value="<?php echo $row->status?>" id="sts" required="required">
						 </div>
						</div>

<?php } ?>
												<div class="col-sm-8 col-sm-offset-2">
													
													<input class="btn btn-primary" type="submit" name="submit" value="Update Bus">
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

</html>