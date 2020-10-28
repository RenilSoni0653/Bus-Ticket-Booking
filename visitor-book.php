<?php
session_start();
include('config.php'); 
date_default_timezone_set('Asia/Kolkata');
include('checklogin.php');
check_login();
?>

<!DOCTYPE HTML>
<HTML>

	<HEAD>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="UTF-8">
		
		<title>Bus Ticket Booking</title>
		<link rel="stylesheet" type="text/css" href="Tickets/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="Tickets/css/bootstrap-responsive.css">
		
	<link rel="stylesheet" href="admin/css/font-awesome.min.css">
	<link rel="stylesheet" href="admin/css/bootstrap.min.css">
	<link rel="stylesheet" href="admin/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="admin/css/bootstrap-social.css">
	<link rel="stylesheet" href="admin/css/bootstrap-select.css">
	<link rel="stylesheet" href="admin/css/fileinput.min.css">
	<link rel="stylesheet" href="admin/css/style.css">
		
	<script language="javascript" type="text/javascript">
function f2()
{
window.history.back();
}
</script>
<style>
a {
  text-decoration: none;
  display: inline-block;
  padding: 8px 16px;
}

a:hover {
  background-color: #ddd;
  color: black;
}

.previous {
  background-color: #f1f1f1;
  color: black;
}

.next {
  background-color: #3E454C;
  color: white;
}

.round {
  border-radius: 50%;
}
</style>
	</HEAD>

	<BODY>
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
			<h2 class="page-title" style="margin-top:4%">Select Seat(s)</h2>	
			<div class="row well col-md-offset-0 col-md-12">
				<div class="span10">
					<form action="book_seat.php" method="POST" onsubmit="return validateCheckBox();">
					
						<ul class="thumbnails">
						<?php
							$date = strip_tags( utf8_decode( $_POST['doj'] ) );
							$id=$_POST['id'];
							$rid=$_POST['rid'];
							
							$price=$_POST['price'];
							$seat=$_POST['total_seat'];
							$source=$_POST['source'];
							$dest=$_POST['destination'];
							$arrival=$_POST['arrival'];
							$departure=$_POST['departure'];
							$bno=$_POST['bno'];
							$bname=$_POST['bname'];
							
							$query = "select * from book where book_date = '" . $date . "' and bno='$bno'";
							$result = mysqli_query($mysqli,$query);
							if ( mysqli_num_rows($result) == 0 )
							{	
								for($i=1; $i<=$seat; $i++)
								{
									echo "<li class='span1'>";
									echo "<a href='#' class='thumbnail' title='Available'>";
									echo "<img src='img/available.png' alt='Available Seat'/>";
									echo "<label class='checkbox'>";	
									echo "<input type='checkbox' name='ch".$i."'/>Seat".$i;
									echo "</label>";
									echo "</a>";
									echo "</li>";								
								}
							}
							else
							{
								
								//$seats = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
								for($i=0; $i<$seat; $i++)
								{
									$j=0;
									$seats[$i]=$j;
								}
								while($row = mysqli_fetch_array($result))
								{
									$pnr = explode("-", $row['PNR']);
									$pnr[3] = intval($pnr[3]) - 1;
									$seats[$pnr[3]] = 1;
								}
								for($i=1; $i<=$seat; $i++)
								{
									$j = $i - 1;
									if($seats[$j] == 1)
									{
										echo "<li class='span1'>";
											echo "<a href='#' class='thumbnail' title='Booked'>";
												echo "<img src='img/occupied.png' alt='Booked Seat'/>";
												echo "<label class='checkbox'>";
													echo "<input type='checkbox' name='ch".$i."' disabled/>Seat".$i;
												echo "</label>";
											echo "</a>";
										echo "</li>";
									}
									else
									{
										echo "<li class='span1'>";
											echo "<a href='#' class='thumbnail' title='Available'>";
												echo "<img src='img/available.png' alt='Available Seat'/>";
												echo "<label class='checkbox'>";
													echo "<input type='checkbox' name='ch".$i."'/>Seat".$i;
												echo "</label>";
											echo "</a>";
										echo "</li>";
									}
								}									
								
							}
						?>
						</ul>
						<input type="hidden" name="total_seat" value="<?php echo $seat;?>">
						<input type="hidden" name="rid" value="<?php echo $rid; ?>">
						<input type="hidden" name="id" value="<?php echo $id;?>">
						<input type="hidden" name="source" value="<?php echo $source;?>">
						<input type="hidden" name="bno" value="<?php echo $bno;?>">
						<input type="hidden" name="price" value="<?php echo $price;?>">
						<input type="hidden" name="bname" value="<?php echo $bname;?>">
						<input type="hidden" name="destination" value="<?php echo $dest;?>">
						<input type="hidden" name="arrival" value="<?php echo $arrival;?>">
						<input type="hidden" name="departure" value="<?php echo $departure;?>">
						<center><br>
							<label>Date of Journey</label>
							<?php
								echo "<input type='text' class='span2' name='doj' value='". $date ."' readonly/>";
							?>
							<br><br>
							<button type="submit" class="btn btn-info">
								<i class="icon-ok icon-white"></i> Submit
							</button>
							<button type="reset" class="btn">
								<i class="icon-refresh icon-black"></i> Clear
							</button>
							
						</center>
						
					</form>
					</div>
				</div>
			</div>
		</div>

		<script src="http://code.jquery.com/jquery-latest.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/jquery-latest.min.js">\x3C/script>')</script>
		<script type="text/javascript" src="Tickets/js/bootstrap.js"></script>
		<script type="text/javascript">
			function validateCheckBox()
			{
				var c = document.getElementsByTagName('input');
				for (var i = 0; i < c.length; i++)
				{
					if (c[i].type == 'checkbox')
					{
						if (c[i].checked) 
						{
							return true;
						}
					}
				}
				alert('Please select at least 1 ticket.');
				return false;
			}
		</script>
	</BODY>
</HTML>