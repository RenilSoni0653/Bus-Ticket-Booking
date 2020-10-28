<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
include('includes/config.php');
include('includes/checklogin.php');
check_login();

if(isset($_GET['del']))
{
	$id=intval($_GET['del']);
	$adn="delete from buses where id=?";
		$stmt= $mysqli->prepare($adn);
		$stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->close();	   
        echo "<script>alert('Data Deleted');</script>" ;
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
	<title>Manage Users</title>
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
						<h2 class="page-title" style="margin-top:4%">Manage Buses</h2>
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
											<th>Price</th>
											<th>Total Seats</th>
											<th>Status</th>
											<th>Reg Date </th>
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
											<th>Price</th>
											<th>Total Seats</th>
											<th>Status</th>
											<th>Reg Date</th>
											<th>Action</th>						
										</tr>
									</tfoot>
									<tbody>
<?php	
//$aid=$_SESSION['id'];
$ret="select * from buses";
$stmt= $mysqli->prepare($ret) ;
//$stmt->bind_param('i',$aid);
$stmt->execute() ;//ok
$res=$stmt->get_result();
$cnt=1;
while($row=$res->fetch_object())
{
?>
		
<?php
$bno=$row->bno;
$source=$row->source;
$dest=$row->destination;
$r=mysqli_query($mysqli,"select * from routes where bno='$bno'");
$routes=mysqli_fetch_array($r);
$route_bno=$routes['bno'];
$rid=$routes['rid'];
$rid1=$row->rid;
$date=date('y-m-d');

$query1 = "select * from book where rid='$rid1' and book_date='$date'";
//$query1="select b.bno,b.source,b.destination,b.arrival,b.departure,b.book_date,r.destination from book b,routes r where b.bno='$bno' and (b.source='$source' and r.rid='$rid' and b.rid='$rid' and b.book_date='$date')";
$q=mysqli_query($mysqli,$query1);
$i=mysqli_num_rows($q);

if($row->status == 1)
{
	$st = "Active";
}
else
{
	$st = "Inactive";
}
?>

<tr><td><?php echo $cnt;?></td>
<td><?php echo $row->bname;?></td>
<td><?php echo $row->bno;?></td>
<td><?php echo $row->source;?></td>
<td><?php echo $row->destination;?></td>
<td><?php echo $row->price;?></td>
<td><?php echo $row->total_seat-$i."/".$row->total_seat;?></td>
<td><?php echo $st;?></td>
<td><?php echo $row->created_at;?></td>

<td><a href="edit-buses.php?id=<?php echo $row->id;?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
<a href="manage-buses.php?del=<?php echo $row->id;?>" onclick="return confirm('Do you want to delete');"><i class="fa fa-close"></i></a></td>
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
