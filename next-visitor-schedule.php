<?php
session_start();
include('config.php');
date_default_timezone_set('Asia/Kolkata');
/*include('checklogin.php');
check_login();*/

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
	<title>Bus Schedule</title>
	<link rel="stylesheet" href="admin/css/font-awesome.min.css">
	<link rel="stylesheet" href="admin/css/bootstrap.min.css">
	<link rel="stylesheet" href="admin/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="admin/css/bootstrap-social.css">
	<link rel="stylesheet" href="admin/css/bootstrap-select.css">
	<link rel="stylesheet" href="admin/css/fileinput.min.css">
	<link rel="stylesheet" href="admin/css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="admin/css/style.css">
	<script language="javascript" type="text/javascript">
function f2()
{
window.history.back();
}
function f3()
{
window.print(); 
}
</script>
</head>

<body>
	<?php include('header.php');?>
<form method="POST" action="visitor-book.php">
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
						<h2 class="page-title" style="margin-top:4%">Bus Schedule</h2>
						<!--<input name="Submit2" type="submit" class="txtbox4 " value="Go Back" onClick="return f2();">-->
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
											<th>Available Seats</th>
											<th>Source Arrival Time </th>
											<th>Destination Arrival Time </th>
											<th>Total Journey Time </th>
											<th>Price</th>
											<th>Status</th>
											<th>Action</th>
											
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
											<th>Action</th>
																		</tr>
									</tfoot>
									<tbody>

<?php	


if(isset($_POST['book']))
{
	$source=$_POST['source'];
	$dest=$_POST['destination'];
	$date=$_POST['doj'];
	$rid1=$_POST['rid'];

$query="select * from buses where source='$source' and destination='$dest' and rid='$rid1'";
$qu=mysqli_query($mysqli,$query);
$cnt=1;

while($row=mysqli_fetch_array($qu))
	  {
	  	?>
		
<?php
$id=$row['id'];
$bno=$row['bno'];
$r=mysqli_query($mysqli,"select * from routes");
$routes=mysqli_fetch_array($r);
$route_dest=$routes['destination'];
$route_bno=$routes['bno'];
$rid=$_POST['rid'];

$query1="select b.bno,b.source,b.destination,b.arrival,b.departure,b.book_date,r.destination from book b,routes r where b.bno='$bno' and (b.source='$source' and r.rid='$rid' and b.rid='$rid' and b.book_date='$date')";

$q=mysqli_query($mysqli,$query1);
$i=mysqli_num_rows($q);

if($row['status'] == 1)
{
	$st = "Active";
}
else
{
	$st = "Inactive";
}
?>

<?php
		$sour=$_POST['source'];
		$bno=$_POST['bno'];
		$rid1=$_POST['rid'];
		
		$query="select * from routes where source='$sour' and bno='$bno' and rid='$rid1'";
		$qu=mysqli_query($mysqli,$query);		

		while($row1=mysqli_fetch_array($qu))
		{
			if(mysqli_num_rows($qu) > 0)
			{
?>
		
<?php
	$ar=$row['arrival'];
	$dr=$row1['d_arrival_time'];
	$arrival=explode(':',$ar);
	$departure=explode(':',$dr);
?>
		
<tr>
<td><?php echo $cnt;?></td>
<td><?php echo $row1['bname'];?></td>
<td><?php echo $row1['bno'];?></td>
<td><?php echo $row1['source'];?></td>
<td><?php echo $row1['destination'];?></td>
<td><?php echo $row['total_seat']-$i."/".$row['total_seat'];?></td>
<td><?php echo $arrival[0].':'.$arrival[1];?></td>
<td><?php echo $departure[0].':'.$departure[1];?></td>
<td><?php echo abs($arrival[0] - $departure[0]) .':'. abs($arrival[1] - $departure[1]);?></td>
<td><?php echo $row1['price'];?></td>
<td><?php echo $st;?></td>

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
		
		if($Date[2] <= $curr_Date[2])
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
<input type="hidden" name="source" value="<?php echo $row1['source']; ?>">
<input type="hidden" name="destination" value="<?php echo $row1['destination']; ?>">
<input type="hidden" name="arrival" value="<?php echo $row['arrival']; ?>">
<input type="hidden" name="departure" value="<?php echo $row1['d_arrival_time']; ?>">
<input type="hidden" name="price" value="<?php echo $row1['price']; ?>">
<input type="hidden" name="doj" value="<?php echo $date;?>">										
</tr>
</form>
										
		<?php }} ?>
									<?php
									
$cnt=$cnt+1;
}							 } 
?>
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
