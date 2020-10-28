<?php
session_start();
include('config.php');
include('checklogin.php');
check_login();

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
	<title>Complaint</title>
	<link rel="stylesheet" href="admin/css/font-awesome.min.css">
	<link rel="stylesheet" href="admin/css/bootstrap.min.css">
	<link rel="stylesheet" href="admin/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="admin/css/bootstrap-social.css">
	<link rel="stylesheet" href="admin/css/bootstrap-select.css">
	<link rel="stylesheet" href="admin/css/fileinput.min.css">
	<link rel="stylesheet" href="admin/css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="admin/css/style.css">
</head>

<body>
	<?php include('header.php');?>

	<div class="ts-main-content">
			<?php include('sidebar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title" style="margin-top:4%">Complaint</h2>
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
											<th>Destination</th>
											<th>Seat-Number</th>
											<th>Book Date </th>
											<th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>No.</th>
											<th>Bus-name</th>
											<th>Bus-no</th>
											<th>Source</th>
											<th>Destination</th>
											<th>Seat-Number</th>
											<th>Book Date </th>
											<th>Action</th>										</tr>
									</tfoot>
									<tbody>
<?php	
$aid=$_SESSION['id'];
$ret="select * from book where id='$aid'";
$stmt= $mysqli->prepare($ret) ;
//$stmt->bind_param('i',$aid);
$stmt->execute() ;//ok
$res=$stmt->get_result();
$cnt=1;
while($row=$res->fetch_object())
	  {
	  	?>
		
<?php
	$r=mysqli_query($mysqli,"select * from routes");
	$routes=mysqli_fetch_array($r);
	$route_source=$routes['source'];
	$route_dest=$routes['destination'];
	$route_bno=$routes['bno'];
	$rid=$routes['rid'];
	
	$query1="select r.rid,b.id from buses r,book b where r.rid='$rid' and b.id='$aid'";
	$qu=mysqli_query($mysqli,$query1);
	$row1=mysqli_fetch_array($qu);
	
?>

<tr><td><?php echo $cnt;?></td>
<td><?php echo $row->bname;?></td>
<td><?php echo $row->bno;?></td>
<td><?php echo $row->source;?></td>
<td><?php echo $row->destination;?></td>
<td><?php echo $row->seat_no;?></td>
<td><?php echo $row->posting_date;?></td>
<form method="POST">
<td><a href="user-complain.php?rid=<?php echo $row1['rid']; ?>"><i class="fa fa-edit"></i></a></td>
</form>
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