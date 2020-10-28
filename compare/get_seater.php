<?php
include('includes/pdoconfig.php');
if(!empty($_POST["source"])) 
{	
$id=$_POST['source'];
$stmt = $DB_con->prepare("SELECT * FROM buses WHERE source = :source");
//$stmt->execute(array(':id' => $id));
?>
 <?php
 while($row=$stmt->fetch(PDO::FETCH_ASSOC))
 {
  ?>
 <?php echo htmlentities($row['rid']); ?>
  <?php
 }
}

?>
<?php
include('includes/pdoconfig.php');
if(!empty($_POST["destination"])) 
{	
$id=$_POST['destination'];
$stmt = $DB_con->prepare("SELECT * FROM buses WHERE destination = :destination");
//$stmt->execute(array(':id' => $id));
?>
 <?php
 while($row=$stmt->fetch(PDO::FETCH_ASSOC))
 {
  ?>
 <?php echo htmlentities($row['rid']); ?>
  <?php
 }
}

?>