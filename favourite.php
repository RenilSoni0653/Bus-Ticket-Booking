<?php
session_start();
include('config.php');
date_default_timezone_set('Asia/Kolkata');

include('checklogin.php');
check_login();

if(isset($_GET['del']))
{
	$id=intval($_GET['del']);
	$adn="update book set status=0 where bid=?";
		$stmt= $mysqli->prepare($adn);
		$stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->close();	   
        echo "<script>alert('Data Unfavourited');</script>" ;
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
	<title>Favourites</title>
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
						<h2 class="page-title" style="margin-top:4%">Favourites</h2>
						<div class="panel panel-default">
							<div class="panel-heading">All bus Details</div>
							<div class="panel-body">
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>No.</th>
											<th>Bus-no</th>
											<th>Bus-name</th>
											<th>Passanger-name</th>
											<th>Email-id</th>
											<th>Phone-number</th>
											<th>Source</th>
											<th>Destination</th>
											<th>Source Arrival Time</th>
											<th>Destination Arrival Time</th>
											<th>Price</th>
											<th>Book</th>	
											<th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>No.</th>
											<th>Bus-no</th>
											<th>Bus-name</th>
											<th>Passanger-name</th>
											<th>Email-id</th>
											<th>Phone-number</th>
											<th>Source</th>
											<th>Destination</th>
											<th>Source Arrival Time</th>
											<th>Destination Arrival Time</th>
											<th>Price</th>
											<th>Book</th>	
											<th>Action</th>
											</tr>
									</tfoot>
									<tbody>

<?php	
$id=$_SESSION['id'];
$ret="select * from book where id=$id and status=1";
$stmt= $mysqli->prepare($ret) ;
//$stmt->bind_param('i',$aid);
$stmt->execute() ;//ok
$res=$stmt->get_result();
$cnt=1;
$curr_date=date('yy-m-d');
while($row=$res->fetch_object())
	  {
?>
<?php
		$rid=$row->rid;
		$qu=mysqli_query($mysqli,"select * from buses where rid='$rid'");
		$s = mysqli_fetch_array($qu);
		$ar=$row->arrival;
		$dr=$row->departure;
		$arrival=explode(':',$ar);
		$departure=explode(':',$dr);		
		$date=$row->book_date;
?>
	
<tr><td><?php echo $cnt;?></td>
<td><?php echo $row->bno;?></td>
<td><?php echo $row->bname;?></td>
<td><?php echo $row->username;?></td>
<td><?php echo $row->email;?></td>
<td><?php echo $row->phone;?></td>
<td><?php echo $row->source;?></td>
<td><?php echo $row->destination;?></td>
<td><?php echo $row->arrival;?></td>
<td><?php echo $row->departure;?></td>
<td><?php echo $row->price;?></td>


<form method="POST" action="user-book.php">
<?php 
	$curr_date=date('yy-m-d');
	$curr_time=date('H:i ',strtotime('now'));
	$c_hour=explode(':',$curr_time);
	$status=$row->status;
	
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

<input type="hidden" name="total_seat" value="<?php echo $s['total_seat']; ?>">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<input type="hidden" name="rid" value="<?php echo $row->rid; ?>">
<input type="hidden" name="bno" value="<?php echo $row->bno; ?>">
<input type="hidden" name="bname" value="<?php echo $row->bname; ?>">
<input type="hidden" name="source" value="<?php echo $row->source; ?>">
<input type="hidden" name="destination" value="<?php echo $row->destination; ?>">
<input type="hidden" name="arrival" value="<?php echo $row->arrival; ?>">
<input type="hidden" name="departure" value="<?php echo $row->departure; ?>">
<input type="hidden" name="price" value="<?php echo $row->price; ?>">
<input type="hidden" name="doj" value="<?php echo $curr_date;?>">


<td><a href="favourite.php?del=<?php echo $row->bid;?>" onclick="return confirm('Do you want to Unfavourite');"><i class='fa fa-heart col-md-offset-2' style='font-size:30px;'></i></a></td>

</tr>
</form>
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
