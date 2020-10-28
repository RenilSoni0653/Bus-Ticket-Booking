<?php
session_start();
include('config.php');
date_default_timezone_set('Asia/Kolkata');

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

	</script>

	<style>	
	.nav { margin-bottom: 0; }
	.dropdown { position: static; }
	.dropdown-menu { width: 100%; text-align: center; }
	.dropdown-menu>li { display: inline-block; }
	
	.nav > li.dropdown.open {
    position: static;
	}
	
	.nav > li.dropdown.open .dropdown-menu {
		display:table; width: 100%; text-align: center; left:0; right:0;
	}
	
	.dropdown-menu>li {
		display: table-cell;
	}
	</style>
</head>

<body>
	<?php include('header.php');?>

	<div class="ts-main-content">
		<?php include('sidebar.php');?>	
		
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title" style="margin-top:4%"><a href="javascript:history.go(-1)" class="next round" title="Return to the previous page">&#8249;&#8249;</a>&nbsp;&nbsp;Bus schedule</h2>
					
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
$id=$_SESSION['id'];
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
$bno=$row['bno'];
$r=mysqli_query($mysqli,"select * from routes where bno='$bno'");
$routes=mysqli_fetch_array($r);

$route_dest=$routes['destination'];
$route_bno=$routes['bno'];
$rid=$routes['rid'];
$rid1=$row['rid'];

$Query = "select * from book where rid='$rid1' and book_date='$date'";

//$query1="select b.bno,b.source,b.destination,b.arrival,b.departure,b.book_date,r.destination from book b,routes r where b.bno='$bno' and (b.rid='$rid' and r.rid='$rid' and b.book_date='$date')";

$q=mysqli_query($mysqli,$Query);
$i=mysqli_num_rows($q);

$ar=$row['arrival'];
$dr=$row['departure'];
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

<form method="POST" action="user-book.php">
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

<form method="POST" action="next-user-schedule.php">
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
}							 } 
?>

									</tbody>								
			
								</table>
								
<?php
$cnt1 = 1;
$qu=mysqli_query($mysqli,"select * from compare where source='$source' and destination='$dest'");

//echo "<ul id=\"multicol-menu\" class=\"nav navbar-nav pull-right\">";
//echo "<li class=\"dropdown\">";
echo "<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><input type=\"submit\" name=\"compare\" value=\"Compare\" class=\"btn btn-primary btn-block\" value=\"Next\" ></a>";
echo "<ul class='dropdown-menu'>";

echo "<table width='100%'>";
echo "<tr>";
echo "<th>&nbsp;&nbsp;No.</th>";
echo "<th>Bus-type</th>";
echo "<th>Bus-no</th>";
echo "<th>Source</th>";
echo "<th>Destination</th>";
echo "<th>Total Seats</th>";
echo "<th>Source Arrival Time </th>";
echo "<th>Destination Arrival Time </th>";
echo "<th>Total Journey Time </th>";
echo "<th>Price</th>";
echo "<th>Status</th>";
echo "<th>Book</th>";
echo "</tr>";

//echo "<td><b><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Bus-type  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Bus-name  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Source  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Destination  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Available-Seats   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Source-arrival-time &nbsp;&nbsp;&nbsp;&nbsp;  Destination-arrival-time  &nbsp;&nbsp;&nbsp;&nbsp;  Total-Journey-time &nbsp;&nbsp;&nbsp;&nbsp;  Price  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Status  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Book</li></b><br><td>";
while($row12=mysqli_fetch_array($qu))
{
?>

<form method="POST" action="user-book.php">

<?php

$bno=$row12['bno'];

$r=mysqli_query($mysqli,"select * from compare where bno='$bno'");
$routes=mysqli_fetch_array($r);
$route_dest=$routes['destination'];
$route_bno=$routes['bno'];
$rid=$routes['rid'];

$query1="select b.bno,b.source,b.destination,b.arrival,b.departure,b.book_date,r.destination from book b,compare r where b.bno='$bno' and (b.source='$source' and r.rid='$rid' and b.rid='$rid' and r.rid='$rid' and b.book_date='$date')";

$q=mysqli_query($mysqli,$query1);
$i=mysqli_num_rows($q);

$ar=$row12['arrival'];
$dr=$row12['departure'];
$arrival=explode(':',$ar);
$departure=explode(':',$dr);

if($row12['status'] == 1)
{
	$st="Active";
}
else
{
	$st="Inactive";
}

echo "<div>";
echo "<li>";

echo "<div class='row'>";
echo "<div class'list-unstyled col-md-20 offset-md-2'>";
		
echo "<ol>";

?>
        
		<tr>
		<td>&nbsp;&nbsp;<?php echo $cnt1;?></td>
		<td><?php echo $row12['bname'];?></td>
		<td><?php echo $row12['bno'];?></td>
		<td><?php echo $row12['source'];?>
		<td><?php echo $row12['destination'];?></td>
		<td><?php echo $row12['total_seat']-$i."/".$row12['total_seat'];?></td>
		<td><?php echo $row12['arrival'];?></td>
		<td><?php echo $row12['departure'];?></td>
		<td><?php echo abs($arrival[0] - $departure[0]) .':'. abs($arrival[1] - $departure[1]);?></td>
		<td><?php echo $row12['price'];?></td>
		<td><?php echo $st;?></td>
		
		<?php 
		$curr_date=date('yy-m-d');
		$curr_time=date('H:i ',strtotime('now'));
		$c_hour=explode(':',$curr_time);
		$status=$row12['status'];
		
		$ar=$row12['arrival'];
		$dr=$row12['departure'];
		$arrival=explode(':',$ar);
		$departure=explode(':',$dr);
		
		if($ar >= $curr_time and $status == 1)
		{
			echo "<td><input type=\"submit\" name=\"book\" class=\"btn btn-primary \" value=\"Book\" ><br><br></td>";
			
		}
		else
		{
			$curr_Date=explode('-',$curr_date);
			$Date = explode('-',$date);
			
			if($Date[2] <= $curr_Date[2])
			{
				echo "<td><input type=\"submit\" name=\"book\" class=\"btn btn-primary \" value=\"Book\" disabled><br><br></td>";
			}
			else
			{
				echo "<td><input type=\"submit\" name=\"book\" class=\"btn btn-primary \" value=\"Book\" ><br><br></td>";
			}
		}

		?>

        </ol>
		</div>
        </div>
        </li>
        </div>

<input type="hidden" name="total_seat" value="<?php echo $row12['total_seat']; ?>">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<input type="hidden" name="rid" value="<?php echo $row12['rid']; ?>">
<input type="hidden" name="bno" value="<?php echo $row12['bno']; ?>">
<input type="hidden" name="bname" value="<?php echo $row12['bname']; ?>">
<input type="hidden" name="source" value="<?php echo $row12['source']; ?>">
<input type="hidden" name="destination" value="<?php echo $row12['destination']; ?>">
<input type="hidden" name="arrival" value="<?php echo $row12['arrival']; ?>">
<input type="hidden" name="departure" value="<?php echo $row12['departure']; ?>">
<input type="hidden" name="price" value="<?php echo $row12['price']; ?>">
<input type="hidden" name="doj" value="<?php echo $date;?>">
</tr>
</form>

<?php 
$cnt1 = $cnt1 + 1;
} 
?>

							</div>
						</div>
					
					</div>
				</div>			

			</div>
		</div>
	</div>
</table>

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
