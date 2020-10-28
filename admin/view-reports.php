<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
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
	<title>Bus Details</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
<script language="javascript" type="text/javascript">
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
 if(popUpWin)
{
if(!popUpWin.closed) popUpWin.close();
}
popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+510+',height='+430+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}

</script>

</head>

<body>
	<?php include('includes/header.php');?>
<br>
	<div class="ts-main-content">
			<?php include('includes/sidebar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title" style="margin-top:2%">Bus Details</h2>
						<div class="panel panel-default">
							<div class="panel-heading">Bus Details</div>
							<div class="panel-body">
								<table id="zctb" class="table table-bordered " cellspacing="0" width="100%">
									
									
									<tbody>
									
<?php	
$aid=$_SESSION['id'];
$id = $_GET['id'];
$ret="select * from buses where id=?";
$stmt= $mysqli->prepare($ret) ;
$stmt->bind_param('i',$id);
$stmt->execute() ;
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

<tr>
<td colspan="3"><h4>Bus Realted Info</h4></td>
<td><a href="javascript:void(0);"  onClick="popUpWindow('http://localhost/PHP PROJECT SEM-6(NEW)/admin/report_full_profile.php?id=<?php echo $id;?>');" title="View Full Details">Print Data</a></td>
</tr>

<tr>
<td><b>Bus No. :</b></td>
<td><?php echo $row->bno;?></td>
<td><b>Bus Name :</b></td>
<td colspan="3"><?php echo $row->bname;?></td>

</tr>


<tr>
<td><b>Source:</b></td>
<td><?php echo $row->source;?></td>
<td><b>Destination:</b></td>
<td colspan="3"><?php echo $row->destination;?></td>
</tr>

<tr>
<td><b>Arrival Time :</b></td>
<td><?php echo $row->arrival;?></td>
<td><b>Departure Time :</b></td>
<td colspan="3"><?php echo $row->departure;?></td>
</tr>

<tr>
<td><b>Price :</b></td>
<td><?php echo $row->price;?></td>
<td><b>Status :</b></td>
<td colspan="3"><?php echo $st;?></td>
</tr>

<?php
$rid=$row->rid;
$query = mysqli_query($mysqli,"select * from book where rid='$rid'");
$no_of_book=mysqli_num_rows($query);
?>

<tr>
<td><b>Total No of booking :</b></td>
<td colspan="2"><?php echo $no_of_book; ?></td>

<td><b>Total Seats available :<br> (Current Date)</b></td>
<td><?php echo $row->total_seat-$i." / ".$row->total_seat;?></td>
</tr>

<tr>
<td><b>Registered Date : </b></td>
<td colspan="6"><?php echo $row->created_at; ?></td>
</tr>

<?php
$cnt=$cnt+1;
}
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
