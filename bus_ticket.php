<html>
<body>
<form method="POST">

<?php
include("config.php");

if(isset($_POST['submit']))
{
	$rid=$_POST['rid'];
	$id=$_POST['id'];	
	$bno=$_POST['bno'];
	$bname=$_POST['bname'];
	$seat=$_POST['total_seat'];
	$source=$_POST['source'];
	$destination=$_POST['destination'];
	$arrival=$_POST['arrival'];
	$dept=$_POST['departure'];
	$phone=$_POST['phone'];
	$book_date=$_POST['doj'];
	$message=$_POST['message'];
	$email=$_POST['email'];
	$total_amt=$_POST['total_amt'];
	
	foreach($_POST['gender'] as $key => $genders)
	{
		$gen=$genders;
		$gender[]=$gen;
	}
	if($gender[0] == 1)
	{
		$gender[0]="Male";
	}
	if($gender[0] == 2)
	{
		$gender[1]="Female";
	}
	
	for($i=1,$j=0; $i<=$seat; $i++)
	{
		$chparam = "ch" . strval($i);
		$doj=$_POST['doj'];
		$PNR = $doj . "-" . strval($i);
		
		if( !empty($_POST[$chparam]))
		{	
			$qu="insert into book(id,rid,bno,bname,source,destination,arrival,departure,PNR,username,gender,age,phone,seat_no,book_date,price,message,email,status) values('$id','$rid','$bno','$bname','$source','$destination','$arrival','$dept','$PNR','".$_POST['username'][$j]."','$gender[$j]','".$_POST['age'][$j]."','$phone','".intval($i)."','$book_date','".$_POST['price'][$j]."','$message','$email',0)";
			
			$query = mysqli_query($mysqli,$qu);
			if($query)
			{				
				header("location:PayUMoney-PHP-Module-master/PayUMoney_form.php?amount=$total_amt");
			}
			else
			{
				echo "<script>alert('Please enter Details correctly')</script>";
			}
			
			$username=$_POST['username'][$j];
			$j++;
		}			
	}	
}
?>

</form>
</body>
</html>