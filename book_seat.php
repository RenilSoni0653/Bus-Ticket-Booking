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
		<title>Book the ticket</title>
		<link rel="stylesheet" type="text/css" href="Tickets/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="Tickets/css/bootstrap-responsive.css">
		
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

	</HEAD>

	<BODY>
<?php include("header.php");?>
		<div class="ts-main-content">
		<?php include('sidebar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
	        <div class="page-header">
			<h2 class="page-title" style="margin-top:4%"><a href="#" onClick="return f2();" title="Return to the previous page">&#8249;&#8249;</a>&nbsp;&nbsp;Book Ticket(s)</h2>
	            <!--<a href="#" class="next round" onClick="return f2();">&#8249;</a> <h1>Book the tickets</h1>-->
	        </div>		
				</div>
				</div>
			<?php

					// check for a successful form post
					if (isset($_GET['s'])) 
					{
						echo "<div class=\"alert alert-success\">".$_GET['s']." You will be automatically redirected after 5 seconds.</div>";
//						echo "You will be automatically redirected after 5 seconds.";
						header("refresh: 5; index.php");
					}

					// check for a form error
					elseif (isset($_GET['e'])) echo "<div class=\"alert alert-error\">".$_GET['e']."</div>";

			?> 
			<form method="POST" action="bus_ticket.php" class="form-horizontal">
			<?php
			$bname=$_POST['bname'];
			$bno=$_POST['bno'];
			$doj=$_POST['doj'];
			$price=$_POST['price'];
			$id=$_POST['id'];
			?>
			<div class="control-group col-md-offset-2">
			
	                <label class="control-label" for="input2">Bus Name : </label>
	                <div class="controls">
	                    <input type="text" name="bname" value="<?php echo $bname;?>" id="input2" class="span3" readonly>
	                </div>
	            </div>
				
				<div class="control-group col-md-offset-2">
	                <label class="control-label" for="input2">Bus Number : </label>
	                <div class="controls">
	                    <input type="text" name="bno" value="<?php echo $bno;?>" id="input2" class="span3" readonly>
	                </div>
	            </div>
				
	  
					<?php
						if(isset($_POST['doj']))
						{
							echo "<div class='control-group col-md-offset-2'>";
							echo "<label class='control-label' for='input1'>Date of Journey : </label>";
								echo "<div class='controls'>";
									echo "<input type='text' name='journey_date' id='input1' class='span3' value=". $_POST['doj'] ." readonly />";
								echo "</div>";
							echo "</div>";
						}
						$source=$_POST['source'];
						$destination=$_POST['destination'];
						$arrival=$_POST['arrival'];
						$dept=$_POST['departure'];
						$rid=$_POST['rid'];
						
					?>
					
	            
				<div class="control-group col-md-offset-2">
	                <label class="control-label" for="input2">Source : </label>
	                <div class="controls">
	                    <input type="text" name="source" value="<?php echo $source;?>" id="input2" class="span3" readonly>
	                </div>
	            </div>
				
				<div class="control-group col-md-offset-2">
	                <label class="control-label" for="input2">Destination : </label>
	                <div class="controls">
	                    <input type="text" name="destination" value="<?php echo $destination;?>" id="input2" class="span3" readonly>
	                </div>
	            </div>
				
				
				<!--<div class="control-group">
	                <label class="control-label" for="input1">Name</label>
	                <div class="controls">
	                    <input type="text" name="username" id="input1" placeholder="Type your name" class="span4" pattern="[A-z ]{3,}" title="Please enter a valid name." required>
	                </div>
	            </div>-->
				
				
				
	            <!--<div class="control-group">
	                <label class="control-label" for="input2">Address</label>
	                <div class="controls">
	                    <input type="text" name="address" id="input2" placeholder="Type your address" class="span3" required>
	                </div>
	            </div>-->

				<!--<div class="control-group">
	                <label class="control-label" for="input3" name="gender">Gender</label>
	                <div class="controls">
	                    <select name="gender">
						<option name="Male">Male</option>
						<option name="Female">Female</option>
						</select>
	                </div>
	            </div>-->
				
				<div class='control-group col-md-offset-2'>
					<label class='control-label' for='input1' name="p_details">Passanger Details : </label><br>
					<div class='controls'>
					<?php 
					$seat=$_POST['total_seat'];
						for($i=1,$j=1; $i<=$seat; $i++)
						{
							$chparam = "ch" . strval($i);
							if(isset($_POST[$chparam]))
							{	
								echo "Enter Details for Seat Number : ".$i;
								
								echo "<br>";
								echo "<br>";
	
								echo "Enter Full Name : <input type=\"text\" name=\"username[]\" id=\"input1\" placeholder=\"Type your name\" class=\"span4\" pattern=\"[A-z ]{3,}\" title=\"Please enter a valid name\" pattern='[A-Za-z]{3,30}' title='Enter letters only' required><br><br>";
								echo "Enter Age &nbsp;&nbsp;&nbsp; : <input type=\"number\" name=\"age[]\" min=\"1\" min=\"90\" id=\"input2\" placeholder=\"Type your Age\" class=\"span4\" title=\"Please enter a valid age\" required><br><br>";
								echo "Enter Gender : <select name='gender[]'>";
								echo "<option name='Male' value='Male'>Male</option>";
								echo "<option name='Female' value='Female'>Female</option>";
								echo "</select><br><br>";
								echo "Price : <input type=\"text\" name=\"price[]\" value='$price' id=\"input1\" class=\"span4\" readonly><br><br>";
								$total_amt=$price*$j;
								
								$j=$j+1;
							}
							
						}
					?>
	                </div>
	            </div>
				
	            <div class="control-group col-md-offset-2">
	                <label class="control-label" for="input4">&nbsp;Contact Number (only 10 digits) : </label>
	                <div class="controls">
	                    <input type="text" name="phone" pattern=".{10}" title="Please enter 10 digit no." class="span3" placeholder="Type your mobile number" maxlength="10" required/>
	                </div>
	            </div>

	            <div class="control-group col-md-offset-2">
	                <label class="control-label" for="input6">Email ID : </label>
	                <div class="controls">
	                    <input type="text" class="span3" placeholder="Type your email id" name="email" pattern="^[a-zA-Z0-9-\_.]+@[a-zA-Z0-9-\_.]+\.[a-zA-Z0-9.]{2,5}$" title="Please enter a valid email id." required/>
	                </div>
	            </div>

				<div class="control-group col-md-offset-2">
	                <label class="control-label" for="input2">Arrival Time : </label>
	                <div class="controls">
	                    <input type="text" name="arrival" value="<?php echo $arrival;?>" id="input2" class="span3" readonly>
	                </div>
	            </div>
				
				<div class="control-group col-md-offset-2">
	                <label class="control-label" for="input2">Departure Time : </label>
	                <div class="controls">
	                    <input type="text" name="departure" value="<?php echo $dept;?>" id="input2" class="span3" readonly>
	                </div>
	            </div>
				
				<div class="control-group col-md-offset-2">
	                <label class="control-label" for="input2">Total Amount : </label>
	                <div class="controls">
	                    <input type="text" name="total_amt" value="<?php echo $total_amt; ?>" id="input2" class="span3" readonly>
	                </div>
	            </div>
				
	            <div class="control-group col-md-offset-2">
	                <label class="control-label" for="input8">Message : </label>
	                <div class="controls">
	                    <textarea class="span3" rows="3" name="message" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{5,150}$" title="Please enter a valid message." ></textarea>
	                </div>
	            </div>
				<input type="hidden" name="seat_no" value="<?php echo $seat;?>">
				<input type="hidden" name="doj" value="<?php echo $doj;?>">
				<?php 
					$seat=$_POST['total_seat'];
					
						for($i=1; $i<=$seat; $i++)
						{
							$chparam = "ch" . strval($i);
							if(isset($_POST[$chparam]))
							{
								echo "<input type='hidden' class='span3' name=ch".$i." value='<?php echo ch".$i."; ?>'><br>";
							}
						}
					?>
	            <div class="form-actions">
					<input type="hidden" name="rid" value="<?php echo $rid; ?>">
					<input type="hidden" name="total_amt" value="<?php echo $total_amt; ?>">
				    <input type="hidden" name="total_seat" value="<?php echo $seat; ?>">
	                <input type="hidden" name="save" value="contact">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					
					
					<button type="submit" class="btn btn-info col-md-offset-5" name="submit">
						<i class="icon-ok icon-white"></i> Book
					</button>
					<?php
						//echo "<a href=\"PayUMoney-PHP-Module-master/PayUMoney_form.php?amount=$total_amt\" class='btn btn-info col-md-offset-5' name='submit'> <i class=\"icon-ok icon-white\"></i>Book</a>";
					?>
					<button type="reset" class="btn col-md-offset-1">
						<i class="icon-refresh icon-black"></i> Clear
					</button>
					
	            </div>

			</form>
			
		</div>

		<script src="http://code.jquery.com/jquery-latest.min.js"></script>
		<script>window.jQuery || document.write('<script src="Tickets/js/jquery-latest.min.js">\x3C/script>')</script>
		<script type="text/javascript" src="Tickets/js/bootstrap.js"></script>
	</BODY>
</HTML>