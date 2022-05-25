<nav class="ts-sidebar">
			<ul class="ts-sidebar-menu">
				<?php 

		$userid = $_SESSION['id'];
		if (strlen($userid) > 0 ): 
			$uname = $user->fetchProfileDetails($userid);
			?>
			
	
	
			<?php endif ?>
			
				<li class="ts-label">Main</li>
		
					<li><a href="index.php"><i class="fa fa-desktop"></i>Dashboard </a></li>

<li><a href="users.php"><i class="fa fa-file-o"></i>All Users</a></li>
<li><a href="blocked.php"><i class="fa fa-file-o"></i>Blocked Users</a></li>


<li><a href="reports.php"><i class="fa fa-files-o"></i>Reports</a></li>
<li><a href="access-log.php"><i class="fa fa-file-o"></i>Access log</a></li>
<li><a href="my-profile.php"><i class="fa fa-file-o"></i>My Account</a></li>
<li><a href="logout.php"><i class="fa fa-user"></i> Logout</a></li>



				 
				
			</ul>
		</nav>