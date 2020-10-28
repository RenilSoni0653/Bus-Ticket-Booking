<?php
session_start();
include('config.php');
include('checklogin.php');
check_login();
?>
<!doctype html>
<html lang="en" class="no-js">

<?php

if(isset($_GET['fav']))
{
	$bid=intval($_GET['fav']);
	$qa="select * from book where bid='$bid'";
	
	$query=mysqli_query($mysqli,$qa);
	while($row=mysqli_fetch_array($query))
	{
		if($row['status'] == 0)
		{
			$q="update book set status=1 where bid='$bid'";
			$qu=mysqli_query($mysqli,$q);
		}
		else
		{
			$q="update book set status=0 where bid='$bid'";
			$qu=mysqli_query($mysqli,$q);
		}
	}
}
?>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	<title>Booking Details</title>
	<link rel="stylesheet" href="admin/css/font-awesome.min.css">
	<link rel="stylesheet" href="admin/css/bootstrap.min.css">
	<link rel="stylesheet" href="admin/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="admin/css/bootstrap-social.css">
	<link rel="stylesheet" href="admin/css/bootstrap-select.css">
	<link rel="stylesheet" href="admin/css/fileinput.min.css">
	<link rel="stylesheet" href="admin/css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="admin/css/style.css">
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
	<?php include('header.php');?>
<br>
	<div class="ts-main-content">
			<?php include('sidebar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title" style="margin-top:2%">Booking Details</h2>
						<div class="panel panel-default">
							<div class="panel-heading">Booking Details</div>
							<div class="panel-body">
								<table id="zctb" class="table table-bordered " cellspacing="0" width="100%">
									
									
									<tbody>
									
<?php	
$aid=$_SESSION['id'];
$ret=mysqli_query($mysqli,"select * from book where id='$aid'");
/*$stmt= $mysqli->prepare($ret) ;
$stmt->bind_param('i',$aid);
$stmt->execute() ;
$res=$stmt->get_result();*/
$cnt=1;
while($row=mysqli_fetch_array($ret))
	  {
		  $bid=$row['bid'];
		  
	  	?>
<form method="POST">
<tr>
<td colspan="4"><h4>Booking Realted Info</h4></td>

<?php

if($row['status'] == 0)
{
	echo "<input type='hidden' name='bid' value='$bid'>";
	//echo "<td><input type='submit' name='fav' class=\"btn btn-primary btn-block\" value='Favourite' ></td>";
	echo "<td><a href='view_booking?fav=$bid'><i class='fa fa-heart-o' style='font-size:30px;'></i></a></td>";
}
else
{
	echo "<input type='hidden' name='bid' value='$bid'>";
	//echo "<td><input type='submit' name='fav' class=\"btn btn-primary btn-block\" value='Favourited' ></td>";
	echo "<td><a href='view_booking.php?fav=$bid'><i class='fa fa-heart' style='font-size:30px;'></i></a></td>";
}
?>

<td><a href="javascript:void(0);"  onClick="popUpWindow('http://localhost/PHP PROJECT SEM-6(NEW)/full-profile.php?bid=<?php echo $bid;?>&amp;id=<?php echo $aid;?>');" title="View Full Details">Print Data</a></td>
</tr>


</form>
<tr>
<td><b>Username :</b></td>
<td><?php echo $row['username'];?></td>

<td><b>Gender :</b></td>
<td colspan="3"><?php echo $row['gender'];?></td>
</tr>

<tr>
<td><b>Phone-Number:</b></td>
<td>
<?php echo $row['phone'];?></td>
<td><b>Seat-Number :</b></td>
<td><?php echo $row['seat_no'];?></td>
<td><b>Booking-Date :</b></td>
<td><?php echo $row['book_date'];?> </td>
</tr>

<tr>
<td colspan="3"><b>Message : 
<?php echo $row['message'];?>
</b></td>
<td colspan="3"><b>Email-id : 
<?php echo $row['email'];?>
</b></td>
</tr>
		
<tr>
<td colspan="6"><h4>Bus realted Info</h4></td>
</tr>

<tr>
<td><b>Bus No. :</b></td>
<td><?php echo $row['bno'];?></td>
<td><b>Bus Name :</b></td>
<td colspan="3"><?php echo $row['bname'];?></td>

</tr>


<tr>
<td><b>Source:</b></td>
<td><?php echo $row['source'];?></td>
<td><b>Destination:</b></td>
<td colspan="3"><?php echo $row['destination'];?></td>
</tr>

<tr>
<td><b>Arrival Time :</b></td>
<td><?php echo $row['arrival'];?></td>
<td><b>Departure Time :</b></td>
<td colspan="3"><?php echo $row['departure'];?></td>

</tr>
<tr>
<td colspan="6"></td>
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
