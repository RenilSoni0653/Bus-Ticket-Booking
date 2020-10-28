<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

if(isset($_GET['rid']))
{
	$rid=$_GET['rid'];
	$qu="delete from routes where rid='$rid'";
	
	$query=mysqli_query($mysqli,$qu);
	if($query)
	{
		echo "<script>alert('Data Deleted');</script>" ;
	}
	else
	{
		echo "<script>alert('Data Not Deleted');</script>" ;
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
	<title>Manage Bus Routes</title>
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
						<h2 class="page-title" style="margin-top:4%">Manage Bus Routes</h2>
						<div class="panel panel-default">
							<div class="panel-heading">All bus Details</div>
							<!--<a href="add-buses.php" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i> Add Bus</a>-->
							<div class="panel-body">
							
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
								
									<thead>
										<tr>
											<th>No.</th>
											<th>Bus-name</th>
											<th>Bus-no</th>
											<th>Source</th>
											<th>Route name</th>
											<th>Destination arrival time</th>
											<th>Price</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>No.</th>
											<th>Bus-name</th>
											<th>Bus-no</th>
											<th>Source</th>
											<th>Route name</th>
											<th>Destination arrival time</th>
											<th>Price</th>
											<th>Status</th>
											<th>Action</th>										</tr>
									</tfoot>
									<tbody>
									
											
<?php	
//$aid=$_SESSION['id'];
$ret="select * from routes";
$stmt= $mysqli->prepare($ret) ;
//$stmt->bind_param('i',$aid);
$stmt->execute() ;//ok
$res=$stmt->get_result();
$cnt=1;
while($row=$res->fetch_object())
	  {
	  	?>
		
		<?php
/*$ar=$row['arrival'];
$dr=$row['departure'];
$arrival=explode(':',$ar);
$departure=explode(':',$dr);*/

if($row->status == 1)
{
	$st = "Active";
}
else
{
	$st = "Inactive";
}
?>

<tr>
<td><?php echo $cnt;?></td>
<td><?php echo $row->bname;?></td>
<td><?php echo $row->bno;?></td>
<td><?php echo $row->source;?></td>
<td><?php echo $row->destination;?></td>
<td><?php echo $row->d_arrival_time;?></td>
<td><?php echo $row->price;?></td>
<td><?php echo $st;?></td>
<td><a href="manage-route-list.php?rid=<?php echo $row->rid;?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
<a href="manage-route.php?rid=<?php echo $row->rid; ?>" onclick="return confirm('Do you want to delete');"><i class="fa fa-close"></i></a></td>
</tr>

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
