<?php
session_start();
include('config.php');
include('checklogin.php');
date_default_timezone_set('Asia/Kolkata');
check_login();

if(isset($_GET['del']))
{
	$id=intval($_GET['del']);
	$adn="delete from book where bid=?";
		$stmt= $mysqli->prepare($adn);
		$stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->close();	   
        echo "<script>alert('Booking Deleted');</script>" ;
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
	<title>Cancel Booking</title>
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
						<h2 class="page-title" style="margin-top:4%">Cancel Booking</h2>
						<div class="panel panel-default">
							<div class="panel-heading">All bus Details</div>
							<!--<a href="add-buses.php" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i> Add Bus</a>-->
							<div class="panel-body">
							
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
								
									<thead>
										<tr>
											<th>No.</th>
											<th>Passenger-name</th>
											<th>Bus-name</th>
											<th>Bus-no</th>
											<th>Source</th>
											<th>Destination</th>
											<th>Arrival Time</th>
											<th>Seat-Number</th>
											<th>Book Date </th>
											<th>Reg Date </th>
											<th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>No.</th>
											<th>Passenger-name</th>
											<th>Bus-name</th>
											<th>Bus-no</th>
											<th>Source</th>
											<th>Destination</th>
											<th>Arrival Time</th>
											<th>Seat-Number</th>
											<th>Book Date </th>
											<th>Reg Date </th>
											<th>Action</th>										</tr>
									</tfoot>
									<tbody>
<?php	
$curr_date=date('yy-m-d');
$curr_Date=explode('-',$curr_date);

$aid=$_SESSION['id'];
$ret="select * from book where id='$aid'";
$stmt= $mysqli->prepare($ret) ;
//$stmt->bind_param('i',$aid);
$stmt->execute() ;//ok
$res=$stmt->get_result();
$cnt=1;
while($row=$res->fetch_object())
{
	$curr_date=date('yy-m-d');
	$date=$row->book_date;
	$curr_Date=explode('-',$curr_date);
	$Date = explode('-',$date);
	//echo $date.' ';
	//echo $curr_date;
	
	//if($Date[2] >= $curr_Date[2] and $Date[1] >= $curr_Date[1])
		
	if($curr_date <= $date)
	{
		$curr_time=date('yy-m-d H:i ',time());
		$booking_time=$row->posting_date;
		$b_hour=explode(':',$booking_time);
		$B_Hour = $b_hour[0];
		$b_Hour=explode(' ',$B_Hour);
?>

<tr><td><?php echo $cnt;?></td>
<td><?php echo $row->username;?></td>
<td><?php echo $row->bname;?></td>
<td><?php echo $row->bno;?></td>
<td><?php echo $row->source;?></td>
<td><?php echo $row->destination;?></td>
<td><?php echo $row->arrival;?></td>
<td><?php echo $row->seat_no;?></td>
<td><?php echo $row->book_date;?></td>
<td><?php echo $row->posting_date?></td>


<?php 
	$curr_time=date('H:i ',time());
	$c_hour=explode(':',$curr_time);
	$booking_time=$row->posting_date;
	$b_hour=explode(':',$booking_time);
	$B_Hour = $b_hour[0];
	$b_Hour=explode(' ',$B_Hour);
	$curr_date=date('yy-m-d');
	$hours=$b_Hour[1].':'.$b_hour[1];
	
	//echo $b_Hour[1];	//Hours
	//echo $b_hour[1];	//Minutes
	
	$Total_b_hours = $b_Hour[1];
	$Total_c_hours = $c_hour[0];
	
	$Total_b_min = $b_hour[1];
	$Total_c_min = $c_hour[1];
	
	//echo abs(abs($Total_b_hours.''. $Total_b_min) - abs($Total_b_hours.''.$Total_c_min));
	
	$booking_hours = abs($Total_b_hours - $Total_c_hours);
	$Total_Booking_Hour = $booking_hours;
	$h = "12:00";
	
	if($Total_Booking_Hour >= $h)
	{
		echo "<td><a href=\"cancel-booking.php?del=$row->bid;\" onclick=\"return confirm('Do you want to delete');\"><input type=\"submit\" class=\"btn btn-primary btn-block\" value=\"Cancel\" ></a></td>";
	}
	else
	{
		$date=$row->book_date;
		$curr_Date=explode('-',$curr_date);
		$Date = explode('-',$date);
		
		if($Date[2] <= $curr_Date[2] and $Date[1] <= $curr_Date[1])
		{	
			echo "<td><a href=\"cancel-booking.php?del=$row->bid;\" onclick=\"return confirm('Do you want to delete');\"><input type=\"submit\" class=\"btn btn-primary btn-block\" value=\"Cancel\" disabled></a></td>";
		}
		else
		{
			echo "<td><a href=\"cancel-booking.php?del=$row->bid;\" onclick=\"return confirm('Do you want to delete');\"><input type=\"submit\" class=\"btn btn-primary btn-block\" value=\"Cancel\"></a></td>";
		}
	}
	
?>
										</tr>
									<?php
$cnt=$cnt+1;
	}	 } 
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