<?php
session_start();
include('config.php');
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
	<link rel="stylesheet" href="css/bus(css)/font-awesome.min.css">
	<link rel="stylesheet" href="css/bus(css)/bootstrap.min.css">
	<link rel="stylesheet" href="css/bus(css)/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bus(css)/bootstrap-social.css">
	<link rel="stylesheet" href="css/bus(css)/bootstrap-select.css">
	<link rel="stylesheet" href="css/bus(css)/fileinput.min.css">
	<link rel="stylesheet" href="css/bus(css)/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/bus(css)/style.css">
</head>

<body>
	<?php include('header.php');?>
<form method="POST" action="user-book.php">
	<div class="ts-main-content">
			
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title" style="margin-top:4%">Bus Schedule</h2>
						<div class="panel panel-default">
							<div class="panel-heading">All bus Details</div>
							<div class="panel-body">
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>No.</th>
											<th>Bus-type</th>
											<th>Bus-no</th>
											<th>Route-name</th>
											<th>Destination Arrival Time </th>
											<th>Total Journey Time </th>
											<th>Status</th>
											<th>Action</th>
											
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>No.</th>
											<th>Bus-type</th>
											<th>Bus-no</th>
											<th>Route-name</th>
											<th>Destination Arrival Time </th>
											<th>Total Journey Time </th>
											<th>Status</th>
											<th>Action</th>
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
$query1="select bno,source,destination,arrival,departure from book where bno='$bno' and (source='$source' and destination='$dest')";
$q=mysqli_query($mysqli,$query1);
$i=mysqli_num_rows($q);

$ar=$row['arrival'];
$dr=$row['departure'];
$arrival=explode(':',$ar);
$departure=explode(':',$dr);

/*$dayDifference=0;
$Arrival_Time=$row['arrival'];
$Departure_Time=$row['departure'];

$a=strtotime($Departure_Time);
$b=strtotime($Arrival_Time.' + '.($dayDifference*24).' Hours');
$interval = ($b - $a) / 60;
$traveltime=date("i:s",$interval);*/

if($row['status'] == 1)
{
	$st = "Active";
}
else
{
	$st = "Inactive";
}

?>

<tr><td><?php echo $cnt;;?></td>
<td><?php echo $row['bname'];?></td>
<td><a href="route-list.php"><?php echo $row['bno'];?></a></td>
<td><?php echo $row['source'];?></td>
<td><?php echo $row['destination'];?></td>
<td><?php echo $row['total_seat']-$i."/".$row['total_seat'];?></td>
<td><?php echo $arrival[0].':'.$arrival[1];?></td>
<td><?php echo $departure[0].':'.$departure[1];?></td>
<td><?php echo abs($arrival[0] - $departure[0]) .':'. abs($arrival[1] - $departure[1]);?></td>
<td><?php echo $st;?></td>
<?php
$status=$row['status'];
if($status == 1){
echo "<td><input type=\"submit\" name=\"book\" class=\"btn btn-primary btn-block\" value=\"Book\" ></td>";
}
else
{
	echo "<td><input type=\"submit\" name=\"book\" class=\"btn btn-primary btn-block\" value=\"Book\" disabled></td>";
}
?>

<input type="hidden" name="total_seat" value="<?php echo $row['total_seat']; ?>">
<input type="hidden" name="bno" value="<?php echo $row['bno']; ?>">
<input type="hidden" name="bname" value="<?php echo $row['bname']; ?>">
<input type="hidden" name="source" value="<?php echo $row['source']; ?>">
<input type="hidden" name="destination" value="<?php echo $row['destination']; ?>">
<input type="hidden" name="arrival" value="<?php echo $row['arrival']; ?>">
<input type="hidden" name="departure" value="<?php echo $row['departure']; ?>">
<input type="hidden" name="doj" value="<?php echo $date;?>">										
</form>
										</tr>

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
