<?php 

require '../include_classes.php';

if (isset($_POST['report'])) {
	$reporter = $_POST['reporter'];
	$reported = $_POST['reported'];
	$case = "User is Dead";

	$user->report($reporter,$reported,$case);
	// success message for reported case
	$alert = "User has been reported successfully as being Dead";
	$_SESSION['report'] = $alert;
	return header("location: ../chats.php");

}
if (isset($_POST['block'])) {
	$blockedUser = $_POST['reported'];
	$user->Blocker($blockedUser);
	$get  = $user->getname($blockedUser);
	$name = $get[0]['username'];
	$_SESSION['block_status'] = "$name is blocked successfully";
	 return header("location: ../chats.php");
}

 ?>