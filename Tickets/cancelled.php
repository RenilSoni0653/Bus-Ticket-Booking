

<?php
include('db_login.php');
session_start();
$connection = mysqli_connect($db_host, $db_username, $db_password,'book');
if (!$connection)
{
	die ("Could not connect to the database: <br />". mysql_error());
}

?>

<!DOCTYPE HTML>
<HTML>

	<HEAD>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Ticket Cancelation</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css">
	</HEAD>

	<BODY>
		<br><br><br>
		<div class="container">
			<div class="row">
				<div class="span10">
					<?php
						if(isset($_POST['formSubmit'])) 
						{
							if(isset($_POST['formSeat']))
								$aSeat = $_POST['formSeat'];
							
							if(empty($aSeat)) 
						    {
								echo("<div class='alert alert-error'>You didn't select any ticket.</div>\n");
							} 
						    else 
						    {
						        $N = count($aSeat);
								for($i=0; $i < $N; $i++)
								{
									$query = "delete from seat where PNR = '" . $aSeat[$i] . "'";
									$result = mysqli_query($connection,$query);
								}
								echo "<div class='alert alert-success'>Your ticket(s) is(are) cancelled. You will be automatically redirected after 5 seconds.</div>";
								header("refresh: 5; index.php");
							}   
						}
					?>
				</div>
			</div>
		</div>
		<script src="http://code.jquery.com/jquery-latest.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/jquery-latest.min.js">\x3C/script>')</script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
	</BODY>
</HTML>
