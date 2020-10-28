<?php
session_start();
include('config.php');
date_default_timezone_set('Asia/Kolkata');
/*include('checklogin.php');
check_login();*/

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
	<title>Bus Schedule</title>
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
	<?php
			if(isset($_SESSION['id']))
			{
				include('sidebar.php');
			}
		?>			
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title" style="margin-top:5%">Bus Schedule</h2>
						<div class="panel panel-default">
							<div class="panel-heading">All bus Details</div>
							<div class="panel-body">
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>No.</th>
											<th>Bus-type</th>
											<th>Bus-no</th>
											<th>Source</th>
											<th>Destination</th>
											<th>Total Seats</th>
											<th>Source Arrival Time </th>
											<th>Destination Arrival Time </th>
											<th>Total Journey Time </th>
											<th>Price</th>
											<th>Status</th>
											<th>Book</th>
											<th>Route</th>
											
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>No.</th>
											<th>Bus-type</th>
											<th>Bus-no</th>
											<th>Source</th>
											<th>Destination</th>
											<th>Total Seats</th>
											<th>Source Arrival Time </th>
											<th>Destination Arrival Time </th>
											<th>Total Journey Time </th>
											<th>Price</th>
											<th>Status</th>
											<th>Book</th>
											<th>Route</th>
											</tr>
									</tfoot>
									<tbody>
<?php	
if(isset($_POST['submit']))
{
	$source=$_POST['source'];
	$dest=$_POST['dest'];
	$date=$_POST['doj'];

$query="select * from buses where source='$source' and destination='$dest'";
$qu=mysqli_query($mysqli,$query);
$cnt=1;

while($row=mysqli_fetch_array($qu))
	  {
	  	?>
		
<?php

$id = $row['id'];


$bno=$row['bno'];
$r=mysqli_query($mysqli,"select * from routes where bno='$bno'");
$routes=mysqli_fetch_array($r);
$route_dest=$routes['destination'];
$route_bno=$routes['bno'];
$rid=$routes['rid'];
$rid1=$row['rid'];

$query1 = "select * from book where rid='$rid1' and book_date='$date'";
//$query1="select b.bno,b.source,b.destination,b.arrival,b.departure,b.book_date,r.destination from book b,routes r where b.bno='$bno' and (b.source='$source' and r.rid='$rid' and b.rid='$rid' and b.book_date='$date')";
$q=mysqli_query($mysqli,$query1);
$i=mysqli_num_rows($q);

$ar=$row['arrival'];
$dr=$row['departure'];;
$arrival=explode(':',$ar);
$departure=explode(':',$dr);

if($row['status'] == 1)
{
	$st = "Active";
}
else
{
	$st = "Inactive";
}
?>

<tr><td><?php echo $cnt;?></td>
<td><?php echo $row['bname'];?></td>
<td><?php echo $row['bno'];?></td>
<td><?php echo $row['source'];?></td>
<td><?php echo $row['destination'];?></td>
<td><?php echo $row['total_seat']-$i."/".$row['total_seat'];?></td>
<td><?php echo $arrival[0].':'.$arrival[1];?></td>
<td><?php echo $departure[0].':'.$departure[1];?></td>
<td><?php echo abs($arrival[0] - $departure[0]) .':'. abs($arrival[1] - $departure[1]);?></td>
<td><?php echo $row['price'];?></td>
<td><?php echo $st;?></td>

<form method="POST" action="visitor-book.php">
<?php 
	$curr_date=date('yy-m-d');
	$curr_time=date('H:i ',strtotime('now'));
	$c_hour=explode(':',$curr_time);
	
	$status=$row['status'];
	
	if($ar >= $curr_time and $status == 1)
	{
		echo "<td><input type=\"submit\" name=\"book\" class=\"btn btn-primary btn-block\" value=\"Book\" ></td>";
	}
	else
	{
		$curr_Date=explode('-',$curr_date);
		$Date = explode('-',$date);
		
		if($Date[2] <= $curr_Date[2] and $Date[1] <= $curr_Date[1])
		{
			
			echo "<td><input type=\"submit\" name=\"book\" class=\"btn btn-primary btn-block\" value=\"Book\" disabled></td>";
		}
		else
		{
			
			echo "<td><input type=\"submit\" name=\"book\" class=\"btn btn-primary btn-block\" value=\"Book\" ></td>";
		}
	}
?>

<input type="hidden" name="total_seat" value="<?php echo $row['total_seat']; ?>">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<input type="hidden" name="rid" value="<?php echo $row['rid']; ?>">
<input type="hidden" name="bno" value="<?php echo $row['bno']; ?>">
<input type="hidden" name="bname" value="<?php echo $row['bname']; ?>">
<input type="hidden" name="source" value="<?php echo $row['source']; ?>">
<input type="hidden" name="destination" value="<?php echo $row['destination']; ?>">
<input type="hidden" name="arrival" value="<?php echo $row['arrival']; ?>">
<input type="hidden" name="departure" value="<?php echo $row['departure']; ?>">
<input type="hidden" name="price" value="<?php echo $row['price']; ?>">
<input type="hidden" name="doj" value="<?php echo $date;?>">										
</form>

<form method="POST" action="next-visitor-schedule.php">
<td><input type="submit" name="book" class="btn btn-primary btn-block" value="Next" ></td>


<input type="hidden" name="total_seat" value="<?php echo $row['total_seat']; ?>">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<input type="hidden" name="rid" value="<?php echo $row['rid']; ?>">
<input type="hidden" name="bno" value="<?php echo $row['bno']; ?>">
<input type="hidden" name="bname" value="<?php echo $row['bname']; ?>">
<input type="hidden" name="source" value="<?php echo $row['source']; ?>">
<input type="hidden" name="destination" value="<?php echo $row['destination']; ?>">
<input type="hidden" name="arrival" value="<?php echo $row['arrival']; ?>">
<input type="hidden" name="departure" value="<?php echo $row['departure']; ?>">
<input type="hidden" name="price" value="<?php echo $row['price']; ?>">
<input type="hidden" name="doj" value="<?php echo $date;?>">
</tr>
</form>

									<?php
$cnt=$cnt+1;
}							 } ?>
								
										
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
	<script src="js/bus(js)/jquery.min.js"></script>
	<script src="js/bus(js)/bootstrap-select.min.js"></script>
	<script src="js/bus(js)/bootstrap.min.js"></script>
	<script src="js/bus(js)/jquery.dataTables.min.js"></script>
	<script src="js/bus(js)/dataTables.bootstrap.min.js"></script>
	<script src="js/bus(js)/Chart.min.js"></script>
	<script src="js/bus(js)/fileinput.js"></script>
	<script src="js/bus(js)/chartData.js"></script>
	<script src="js/bus(js)/main.js"></script>

</body>

</html>
