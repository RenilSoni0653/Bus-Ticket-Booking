<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

if(isset($_POST['submit']))
{
	$rid=$_POST['rid'];
	$bno=$_POST['bno'];
	$bname=$_POST['bname'];
	$source=$_POST['source'];
	$dest=$_POST['rname'];
	$price=$_POST['price'];
	$dept=$_POST['dhh'].":".$_POST['dmm'];
	$status = $_POST['status'];

	$qu="insert into routes(rid,bno,bname,source,destination,price,d_arrival_time,status) values('$rid','$bno','$bname','$source','$dest','$price','$dept','$status')";
	$query=mysqli_query($mysqli,$qu);

	if($query)
	{
		echo"<script>alert('Bus has been added successfully');</script>";
		header("location:dashboard.php");
	}
	else
	{
		echo"<script>alert('Bus has Not been added successfully');</script>";
	}
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
	<title>Edit Route</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="js/validation.min.js"></script>

<!--<script type="text/javascript">

$(document).ready(function(){

    var counter = 2;

    $("#addButton").click(function () {

    if(counter>3){
            alert("Only 3 textboxes allow");
            return false;
    }   

    var newTextBoxDiv = $(document.createElement('div'))
         .attr("id", 'TextBoxDiv', + counter);

    newTextBoxDiv.after().html('<label class="col-sm-2 control-label">Route-'+ counter + '  Name : </label>' +
          '<input type="text" class="form-control" name="textbox'  + counter + 
          '" id="textbox' + counter + '" value="" >' + '<label class="col-sm-2 control-label">Destination-'+ counter + '  Name : </label>' + 
		  '<input type="text" class="form-control" name="textbox'  + counter + 
          '" id="textbox' + counter + '" value="" >');

    newTextBoxDiv.appendTo("#TextBoxesGroup");


    counter++;
     });

     $("#removeButton").click(function () {
    if(counter==1){
          alert("No more textbox to remove");
          return false;
       }   

    counter--;

        $("#TextBoxDiv" + counter).remove();

     });

     $("#getButtonValue").click(function () {

    var msg = '';
    for(i=1; i<counter; i++){
      msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
    }
          alert(msg);
     });
  });
</script>-->

</head>
<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
		<?php include('includes/sidebar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title">Add Bus details </h2>
	
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Add Bus details</div>
									<div class="panel-body">
										<form method="post" class="form-horizontal">
							<?php
							$id=$_GET['id'];
							
							$qu=mysqli_query($mysqli,"select * from buses where id='$id'");
							while($row=mysqli_fetch_array($qu))
							{
							?>
							
						<div class="hr-dashed"></div>
						<div class="form-group">
						<label class="col-sm-2 control-label">Bus-name :  </label>
					<div class="col-sm-8">
					<input type="text"  name="bname" value="<?php echo $row['bname']; ?>" class="form-control" readonly> </div>
					</div>
					
				 <div class="form-group">
				<label class="col-sm-2 control-label">Bus-No : </label>
		<div class="col-sm-8">
	<input type="text" class="form-control" name="bno" value="<?php echo $row['bno']; ?>" id="cns" readonly>
						 </div>
						</div>
						
						 <div class="form-group">
				<label class="col-sm-2 control-label">Source : </label>
		<div class="col-sm-8">
	<input type="text" class="form-control" name="source" value="<?php echo $row['source']; ?>" id="cns" readonly>
						 </div>
						</div>
								
				<div class="form-group">
				<label class="col-sm-2 control-label">Route id : </label>
		<div class="col-sm-8">
	<input type="text" class="form-control" name="rid" required>
						 </div>
						</div>
						
					<div class="form-group">
				<label class="col-sm-2 control-label">Route Name : </label>
		<div class="col-sm-8">
	<input type="text" class="form-control" name="rname" required>
						 </div>
						</div>
						
						<div class="form-group">
				<label class="col-sm-2 control-label">Destination Arrival time : </label>
				
		<div class="col-sm-8">
		<select name="dhh">
		<?php
		
		
		for($i=1;$i<=23;$i++)
		{
			echo "<option>$i</option>";
		}
		?>
		</select>
		:
		<select name="dmm">
		<?php
		for($i=1;$i<=59;$i++)
		{
			echo "<option>$i</option>";
		}
		
	?>
	</select>
						 </div>
						</div>
					
					<div class="form-group">
				<label class="col-sm-2 control-label">Price : </label>
		<div class="col-sm-8">
	<input type="text" class="form-control" name="price" required>
						 </div>
						</div>
						
					<div class="form-group">
				<label class="col-sm-2 control-label">Status : </label>
		<div class="col-sm-8">
	<input type="number" min="0" max="1" class="form-control" name="status" id="sts" required="required">
						 </div>
						</div>
							<?php } ?>

						
												<div class="col-sm-8 col-sm-offset-2">
													<input class="btn btn-primary" type="submit" name="submit" value="Add route">
												</div>
											</div>

										</form>

									</div>
								</div>
									
							
							</div>
						
									
							

							</div>
						</div>

					</div>
				</div> 	
				

			</div>
		</div>
	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>

</script>
</body>

</html>