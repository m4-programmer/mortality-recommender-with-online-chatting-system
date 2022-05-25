<nav class="ts-sidebar">
			<ul class="ts-sidebar-menu">
				<?php 

		$userid = $_SESSION['id'];
		if (strlen($userid) > 0 ): 
			$uname = $user->fetchProfileDetails($userid);
			$username = $uname[0]['uname'];
			?>
			
	
	
			<?php endif ?>
			
				<li class="ts-label">Main <strong><div class="pull-right text-primary"><?php echo $username; ?></div></strong></li>
		
					<li><a href="dashboard.php"><i class="fa fa-desktop"></i>Dashboard </a></li>

<li><a href="findfriends.php"><i class="fa fa-file-o"></i>Friends</a></li>
<li><a href="chats.php"><i class="fa fa-file-o"></i>Chats</a></li>
<li><a href="blocked.php"><i class="fa fa-file-o"></i>Blocked Friends</a></li>
<li><a href="change-password.php"><i class="fa fa-files-o"></i>Change Password</a></li>
<li><a href="access-log.php"><i class="fa fa-file-o"></i>Access log</a></li>
<li><a href="my-profile.php"><i class="fa fa-file-o"></i>My Account</a></li>
<li><a href="logout.php"><i class="fa fa-user"></i> Logout</a></li>



				 
				
			</ul>
		</nav>