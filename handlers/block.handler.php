<?php 
require '../include_classes.php';
if (isset($_POST['block'])) {
	$blockedUser = $_POST['reported'];

	$user->Blocker($blockedUser);
	$get  = $user->getname($blockedUser);
	$name = $get[0]['username'];
	$_SESSION['block_status'] = "$name is blocked successfully";
	 return header("location: ../dashboard.php");
}
if (isset($_POST['unblock'])) {
	$blockedUser = $_POST['id'];

	$user->UnBlocker($blockedUser);
	$get  = $user->getname($blockedUser);
	$name = $get[0]['username'];
	$_SESSION['block_status'] = "$name has been unblocked successfully";
	 return header("location: ../blocked.php");
}
 ?>