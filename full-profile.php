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
<title>User  Information</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="hostel.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0">
<?php 
	$bid=$_GET['bid'];
	$id=$_GET['id'];
	
		 $ret= mysqli_query($con,"SELECT * FROM book where bid='$bid'");
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
			  <td colspan="2"  class="font"><?php echo ucfirst($row['username']);?>'S <span class="font1"> information &raquo;</span> </td>
  </tr>
			
			<tr>
			  <td colspan="2"  class="heading" style="color: red;">Booking Related Info &raquo; </td>
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
                    <td width="12%" valign="top" class="heading">Booking-Date : </td>
                      <td class="comb-value1"><span class="comb-value"><?php echo $row['book_date'];?></span></td>
                    </tr>
					
					<tr>
                  <td width="22%" valign="top" class="heading">Seat no : </td>
                  
                      <td class="comb-value1"><span class="comb-value"><?php echo $row['seat_no'];?></span></td>
                    </tr>
					
                    <tr>
                    <td width="12%" valign="top" class="heading">Arrival time : </td>
                      <td class="comb-value1"><?php echo $row['arrival'];?></td>
                    </tr>
					
                    <tr>
                    <td width="12%" valign="top" class="heading">Departure: </td>
                      <td class="comb-value1"><?php echo $row['departure'];?></td>
                    </tr>
                    
  <tr>
   <td colspan="2" align="left"  class="heading" style="color: red;">Personal Info &raquo; </td>
  </tr>
<tr>

<tr>
<td width="12%" valign="top" class="heading">Full Name: </td>
<td class="comb-value1"><?php echo $row['username'];?></td>
</tr>
	
<tr>
<td width="12%" valign="top" class="heading">Gender: </td>
<td class="comb-value1"><?php echo $row['gender'];?></td>
</tr>

<tr>
<td width="12%" valign="top" class="heading">Contact No: </td>
<td class="comb-value1"><?php echo $row['phone'];?></td>
</tr>

<tr>
<td width="12%" valign="top" class="heading">Email id: </td>
<td class="comb-value1"><?php echo $row['email'];?></td>
</tr>
<?php } ?>
<tr>


                   
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
