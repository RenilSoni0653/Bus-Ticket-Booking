<?php if(isset($_SESSION['id']))
{ ?><div class="brand clearfix">
		<a href="dashboard.php"><h1 style="font-size:23px;margin-bottom:-44px;margin-left:20px">Bus booking system</h1></a>
		<span class="menu-btn"><i class="fa fa-bars"></i></span>
		<ul class="ts-profile-nav">
			<li class="ts-account">
				<a href="#"><img src="img/bus(img)/ts-avatar.jpg" class="ts-avatar hidden-side" alt=""> Account <i class="fa fa-angle-down hidden-side"></i></a>
				<ul>
					<li><a href="my-profile.php">My Account</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>

<?php
} else { ?>
<div class="brand clearfix">
		<h1 style="font-size:22px;color:white;margin-left:20px;margin-bottom:15px;"><a href="index.html" style="color:white">Bus booking System</a></h1>
		<span class="menu-btn"><i class="fa fa-bars"></i></span>
		
	</div>
	<?php } ?>