<?php  
@session_start();



	require('class/db.php');
	require('class/user.php');
	require('class/admin.php');
	//require('class/helper.php');
	 $user =new User;
	 $admin = new Admin;
	 $user->check_login();
	 date_default_timezone_set('Africa/Lagos');
	  $id = $user->check_login();


?>