<?php
require_once("includes/config.php");

if(!empty($_POST["bname"])) 
{
	$bname = $_POST["bname"];
	if (filter_var($bname, FILTER_SANITIZE_STRING)===false) 
	{
		echo "error : You did not enter a valid bus-name.";
	}
	else 
	{
		$result ="SELECT count(*) FROM buses WHERE bname=?";
		$stmt = $mysqli->prepare($result);
		$stmt->bind_param('s',$bname);
		$stmt->execute();
		$stmt->bind_result($count);
		$stmt->fetch();
		$stmt->close();
		
		if($count > 0)
		{
			echo "<span style='color:red'> Bus-name already exist .</span>";
		}
		else
		{
			echo "<span style='color:green'> Bus-name available for registration .</span>";
		}
	}
}

if(!empty($_POST["rid"])) 
{
	$rid = $_POST["rid"];
	if (filter_var($rid, FILTER_SANITIZE_STRING)===false) 
	{
		echo "error : You did not enter a valid bus-name.";
	}
	else 
	{
		$result ="SELECT count(*) FROM buses WHERE rid=?";
		$stmt = $mysqli->prepare($result);
		$stmt->bind_param('s',$rid);
		$stmt->execute();
		$stmt->bind_result($count);
		$stmt->fetch();
		$stmt->close();
		
		if($count > 0)
		{
			echo "<span style='color:red'> Bus-route already exist .</span>";
		}
		else
		{
			echo "<span style='color:green'> Bus-route available for registration .</span>";
		}
	}
}

if(!empty($_POST["bno"])) 
{
	$bno = $_POST["bno"];
	if (filter_var($bno, FILTER_SANITIZE_STRING)===false) 
	{
		echo "error : You did not enter a valid bus-name.";
	}
	else 
	{
		$result ="SELECT count(*) FROM buses WHERE bno=?";
		$stmt = $mysqli->prepare($result);
		$stmt->bind_param('s',$bno);
		$stmt->execute();
		$stmt->bind_result($count);
		$stmt->fetch();
		$stmt->close();
		
		if($count > 0)
		{
			echo "<span style='color:red'> Bus-number already exist .</span>";
		}
		else
		{
			echo "<span style='color:green'> Bus-number available for registration .</span>";
		}
	}
}

?>