<!-- header or navbar section -->
  <div id="welcomeheader" class="navbar-default">
	 <div class="container">
		  <div class="logo pull-left">
			 <a href="./"><img src="img/icon.png" alt="Logo" height="30px"> 
          SoMedia
        </a>
		  </div>
		  <ul class="nav navbar-nav navbar-right pull-right">
		  	<?php 
		  	if (!isset($_SESSION['id'])):
		  	 ?>
				  <li class="absul-right" style="margin-right: 8px">
					 <a class="mdbtn" href="register.php">Register</a>
				  </li>
				<?php endif; ?>
				  <li class="absul-right " >
					 <a class="mdbtn" href="./">Login</a>
				  </li>
		  </ul>
	 </div>
  </div>