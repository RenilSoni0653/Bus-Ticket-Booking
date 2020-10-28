<?php
session_start();
include('config.php');
date_default_timezone_set('Asia/Kolkata');
include('checklogin.php');
check_login();

$aid=$_SESSION['id'];
if(isset($_POST['update']))
{
	$pid=$_POST['id'];
	$rid=$_GET['rid'];
	$value=$_POST['value'];
	$status=0;
	
	$query="insert into feedback(pid,rid,value,status) values('$pid','$rid','$value','$status')";
	$qu=mysqli_query($mysqli,$query);
	
	if($qu)
	{
		echo"<script>alert('Feedback submitted successfully');</script>";
	}
	else
	{
		echo"<script>alert('Feedback not submitted successfully');</script>";
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
	<title>Complaint</title>
	<link rel="stylesheet" href="admin/css/font-awesome.min.css">
	<link rel="stylesheet" href="admin/css/bootstrap.min.css">
	<link rel="stylesheet" href="admin/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="admin/css/bootstrap-social.css">
	<link rel="stylesheet" href="admin/css/bootstrap-select.css">
	<link rel="stylesheet" href="admin/css/fileinput.min.css">
	<link rel="stylesheet" href="admin/css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="admin/css/style.css">
<script type="text/javascript" src="js/bus(js)/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="js/bus(js)/validation.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript">
function valid()
{
if(document.registration.password.value!= document.registration.cpassword.value)
{
alert("Password and Re-Type Password Field do not match  !!");
document.registration.cpassword.focus();
return false;
}
return true;
}
</script>
</head>

<body>
	<?php include('header.php');?>
	<div class="ts-main-content">
		<?php include('sidebar.php');?>
		<br>
		<div class="content-wrapper">
			<div class="container-fluid">
	<?php	
$aid=$_SESSION['id'];
	$ret="select * from user_reg where id=?";
		$stmt= $mysqli->prepare($ret) ;
	 $stmt->bind_param('i',$aid);
	 $stmt->execute() ;//ok
	 $res=$stmt->get_result();
	 //$cnt=1;
	   while($row=$res->fetch_object())
	  {
	  	?>	
				<div class="row">
					<div class="col-md-11">
						<h2 class="page-title"><?php echo $row->fname;?>'s&nbsp;Feedback </h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-primary">
									<div class="panel-heading">
</div>
									

<div class="panel-body">
<form method="post" action="" class="form-horizontal" onSubmit="return valid();">
<input type="hidden" name="id" value="<?php echo $row->id; ?>">

<div class="form-group">
	<label class="col-sm-2 control-label">Ratings: </label>
<div class="col-sm-8">

	<select name="value" class="form-control" required="required">
	<option value="">----- Choose Ratings from below options -----</option>
	<option value="Extremely Bad">1 - Extremely Bad</option>
	<option value="Less than Expected">2 - Less than Expected</option>
	<option value="Good">3 - Good</option>
	<option value="Satisfying">4 - Satisfying</option>
	<option value="Extremely good">5 - Extremely good</option>
	</select>
	
</div>
</div>

<?php } ?>

<div class="col-sm-6 col-sm-offset-4">

<input type="submit" name="update" Value="Submit" class="btn btn-primary">
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
		</div>
	</div>
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
<script type="text/javascript">
	$(document).ready(function(){
        $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                $('#paddress').val( $('#address').val() );
                $('#pcity').val( $('#city').val() );
                $('#pstate').val( $('#state').val() );
                $('#ppincode').val( $('#pincode').val() );
            } 
            
        });
    });
</script>
	<script>
function checkAvailability() {

$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>

</html>