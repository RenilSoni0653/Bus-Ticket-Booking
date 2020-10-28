<?php
include('includes/pdoconfig.php');
if(!empty($_POST["rid"])) 
{	
$id=$_POST['rid'];
$stmt = $DB_con->prepare("SELECT * FROM routes WHERE rid = :id");
//$stmt->execute(array(':id' => $id));
?>
 <?php
 while($row=$stmt->fetch(PDO::FETCH_ASSOC))
 {
  ?>
 <?php echo htmlentities($row['destination']); ?>
  <?php
 }
}

?>