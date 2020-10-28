<?php
require_once("config.php");
include('config.php');

if(!empty($_POST["emailid"])) 
{
	$email = $_POST["emailid"];
	
	if (filter_var($email, FILTER_VALIDATE_EMAIL)===false) 
	{
		echo "error : You did not enter a valid email.";
	}
	else
	{
		$result = "SELECT count(*) FROM user_reg WHERE email = ?";
		$stmt = $mysqli->prepare($result);
		$stmt->bind_param('s',$email);
		$stmt->execute();
		
		$stmt->bind_result($count);
		$stmt->fetch();
		$stmt->close();
		
		if($count > 0)
		{
			echo "<span style='color:red'> Email already exist, check other email-id.</span>";
			return false;
		}
		else
		{
			echo "<span style='color:green'> Email available for registration .</span>";
			return true;
		}
	}
}

if(!empty($_POST["oldpassword"])) 
{
	$pass = base64_encode($_POST["oldpassword"]);
	$result = "SELECT password FROM user_reg WHERE password = '$pass'";
	$query = mysqli_query($mysqli,$result);
	
	$row = mysqli_fetch_array($query);
	$opass = $row['password'];
	
	/*$stmt = $mysqli->prepare($result);
	$stmt -> bind_param('s',$pass);
	$stmt -> execute();
	
	$stmt -> bind_result($result);
	$stmt -> fetch();
	$opass = $result;*/
	
	
	if($opass == $pass)
		echo "<span style='color:green'> Password  matched.</span>";
	else 
		echo "<span style='color:red'> Password Not matched.</span>";
}
?>