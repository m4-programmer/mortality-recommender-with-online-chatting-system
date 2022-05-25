

	<div class="brand clearfix" style="margin-bottom: 5px ">
		<div class="logo pull-left">
			 <a href="./"><img src="img/icon.png" alt="Logo" height="30px"> 
          SoMedia
        </a>
		  </div>
		<span class="menu-btn"><i class="fa fa-bars"></i></span>
	<?php 

		$userid = $_SESSION['id'];
		if (isset($userid) ){ 
			$uname = $user->fetchProfileDetails($userid);
			?>
			
		<ul class="ts-profile-nav">
			<li class="ts-account">
			
				<a href="#"><img src="img/ts-avatar.jpg" class="ts-avatar hidden-side" alt=""> <?php echo $uname[0]['uname'] ?><i class="fa fa-angle-down hidden-side"></i></a>
				<ul>
					<li><a href="my-profile.php">My Account</a></li>
					<li><a href="logout.php">Logout</a></li>
					<?php }
			else{
				echo '<li><a href="logout.php"> user'.$userid.' is </li>';
			}

			 ?>
				</ul>
			</li>
		</ul>

			
			
	</div>

