<head>
<link rel="stylesheet" type="text/css" href="css/home.css">
</head>

<header class="my-display-container my-wide bgimg my-grayscale-min" id="home">
<br><br><h1 class="my-center" style="color:white">Hostel Management</h1>
  <div class="my-display-middle my-text-black my-center header " id="header">
  
	<!--<br><br><br><br><br><ul style="color:white">
		<li>BioBook</li>
	</ul>-->
  </div>
</header>


<nav class="my-sidebar my-bar-block my-card my-top my-medium my-animate-left" style="background-color:black;color:white;display:none;z-index:2;width:18%;min-width:110px" id="mySidebar">
	<div id="header">
		<div class="head-view">
		<div class="globalsearch">
			<ul>
				<br><li><a href="dashboard.php" title="Biobook"><b>Hostel</b></a></li>
				<li></li>
				<li><a href="javascript:void(0)" onclick="my_close()" class="my-bar-item my-button">☰</a></li>
				
				
				<?PHP if(isset($_SESSION['id']))
				{ ?>
					<li><a href="dashboard.php"><i class="fa fa-desktop"></i>   Dashboard</a></li><br>
					<li><a href="my-profile.php"><i class="fa fa-user"></i>   My Profile</a></li><br>
					<li><a href="change-password.php"><i class="fa fa-files-o"></i>   Change Password</a></li><br>
					<li><a href="book-hostel.php"><i class="fa fa-file-o"></i>   Book Hostel</a></li><br>
					<li><a href="room-details.php"><i class="fa fa-file-o"></i>   Room Details</a></li><br>
					<li><a href="access-log.php"><i class="fa fa-file-o"></i>   Access log</a></li><br>
					<li><a href="user-complain.php"><i class="fa fa-file-o"></i>   Complaint</a></li><br>
					<li><a href="user-feedback.php"><i class="fa fa-file-o"></i>   Feedback</a></li><br>
<?php } else { ?>
				
				<li><a href="registration.php"><i class="fa fa-files-o"></i> User Registration</a></li><br>
				<li><a href="admin"><i class="fa fa-user"></i> Admin Login</a></li><br>
				<li><a href="index.php"><i class="fa fa-users"></i> User Login</a></li><br>
				<li><a href="security-index.php"><i class="fa fa-user"></i> Security Login</a></li><br>
				<?php } ?>

			</ul>
				
			</ul>
		</div>
	</div>
</nav>


	<div class="my-top" id="navi">
  <div class="my-black my-large" style="max-width:1400px;margin:auto">
    <div class="my-button my-padding-10 my-left" onclick="my_open()">☰</div>
    <div class="my-right my-padding-10 my-button"><a href="logout.php"><img src="img/signout.png" height="25px" width="25px"></img></a></div>
    <div class="my-center my-padding-16"></div>
  </div>
</div>

<script>
// Script to open and close sidebar
function my_open() {
    document.getElementById("mySidebar").style.display = "block";
}
 
function my_close() {
    document.getElementById("mySidebar").style.display = "none";
}
</script>

