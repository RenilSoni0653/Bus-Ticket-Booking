<?php
session_start();
//include("includes/config.php");
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME', 'bus');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
<script language="javascript" type="text/javascript">
function f2()
{
window.close();
}
function f3()
{
window.print(); 
}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Bus Information</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="hostel.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0">
<?php 
	$bid=$_GET['id'];
	
		 $ret= mysqli_query($con,"SELECT * FROM buses where id='$bid'");
			while($row=mysqli_fetch_array($ret))
			{
			?>
			<tr>
			  <td colspan="2" align="center" class="font1">&nbsp;</td>
  </tr>
			<tr>
			  <td colspan="2" align="center" class="font1">&nbsp;</td>
  </tr>
			
			<tr>
			  <td colspan="2"  class="font"><?php echo ucfirst($row['bname']);?>'S <span class="font1"> information &raquo;</span> </td>
  </tr>
			
			<tr>
			  <td colspan="2"  class="heading" style="color: red;">Bus Related Info &raquo; </td>
  </tr>
			<tr>
			  <td colspan="2"  class="font1"><table width="100%" border="0">
                <tr>
                  <td width="32%" valign="top" class="heading">Bus no : </td>
                  
                      <td class="comb-value1"><span class="comb-value"><?php echo $row['bno'];?></span></td>
                    </tr>
					
					<tr>
                    <td width="12%" valign="top" class="heading">Bus Name : </td>
                      <td class="comb-value1"><?php echo $fpm=$row['bname'];?></td>
                    </tr>
					
                  <tr>
                  <td width="22%" valign="top" class="heading">Source : </td>
                  
                      <td class="comb-value1"><span class="comb-value"><?php echo $row['source'];?></span></td>
                    </tr>
                  
                    <tr>
                  <td width="22%" valign="top" class="heading">Destination : </td>
                  
                      <td class="comb-value1"><span class="comb-value"><?php echo $row['destination'];?></span></td>
                    </tr>
					
                     <tr>
                    <td width="12%" valign="top" class="heading">Source Arrival <br>Time : </td>
                      <td class="comb-value1"><span class="comb-value"><?php echo $row['arrival'];?></span></td>
                    </tr>
					
					<tr>
                  <td width="22%" valign="top" class="heading">Destination Arrival Time : </td>
                  
                      <td class="comb-value1"><span class="comb-value"><?php echo $row['departure'];?></span></td>
                    </tr>
					
					<?php
					include('includes/config.php');
$bno=$row['bno'];
$source=$row['source'];
$dest=$row['destination'];
$r=mysqli_query($mysqli,"select * from routes where bno='$bno'");
$routes=mysqli_fetch_array($r);
$route_bno=$routes['bno'];
$rid=$routes['rid'];
$rid1=$row['rid'];
$date=date('y-m-d');

$query1 = "select * from book where rid='$rid1' and book_date='$date'";
//$query1="select b.bno,b.source,b.destination,b.arrival,b.departure,b.book_date,r.destination from book b,routes r where b.bno='$bno' and (b.source='$source' and r.rid='$rid' and b.rid='$rid' and b.book_date='$date')";
$q=mysqli_query($mysqli,$query1);
$i=mysqli_num_rows($q);

if($row['status'] == 1)
{
	$st = "Active";
}
else
{
	$st = "Inactive";
}


$query = mysqli_query($mysqli,"select * from book where rid='$rid'");
$no_of_book=mysqli_num_rows($query);

?>
					<td width="22%" valign="top" class="heading">Price : </td>
                  
                      <td class="comb-value1"><span class="comb-value"><?php echo $row['price'];?></span></td>
                    </tr>
					
					<td width="22%" valign="top" class="heading">Total No of booking : </td>
                  
                      <td class="comb-value1"><span class="comb-value"><?php echo $no_of_book;?></span></td>
                    </tr>
					
					<tr>
                  <td width="22%" valign="top" class="heading">Total Available Seats : </td>
                  
                      <td class="comb-value1"><span class="comb-value"><?php echo $row['total_seat']-$i." / ".$row['total_seat'];?></span></td>
                    </tr>
                    
					<tr>
                  
				  <td width="22%" valign="top" class="heading">Status : </td>
                  
                      <td class="comb-value1"><span class="comb-value"><?php echo $st;?></span></td>
                    </tr>
					
					<td width="22%" valign="top" class="heading">Registred Date : </td>
                  
                      <td class="comb-value1"><span class="comb-value"><?php echo $row['created_at'];?></span></td>
                    </tr>

	<?php } ?>


                   
                  </table></td>
                </tr>
               
					
                  </table></td>
                </tr>
              </table></td>
  </tr>
		
           
 
	 
    </table></td>
  </tr>

  
  <tr>
    <td colspan="2" align="right" ><form id="form1" name="form1" method="post" action="">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="14%">&nbsp;</td>
          <td width="35%" class="comb-value"><label>
            <input name="Submit" type="submit" class="txtbox4" value="Prints this Document " onClick="return f3();" />
          </label></td>
          <td width="3%">&nbsp;</td>
          <td width="26%"><label>
            <input name="Submit2" type="submit" class="txtbox4" value="Close this document " onClick="return f2();"  />
          </label></td>
          <td width="8%">&nbsp;</td>
          <td width="14%">&nbsp;</td>
        </tr>
      </table>
        </form>    </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
</body>
</html>
