<?php 
require '../../include_classes.php';
if (isset($_POST['Block'])) {
	$id = $_POST['id'];
	$admin->blockuser($id);
	$uname = $admin->getUsername($id);
	$_SESSION['successmsg'] = $uname. ' has been recommended for blocking';
	return header("location: ../users.php");
}
if (isset($_POST['unblock'])) {
	$id = $_POST['id'];
	$admin->unblockuser($id);
	$uname = $admin->getUsername($id);
	$_SESSION['successmsg'] = $uname. ' has been removed from blocking';
	return header("location: ../blocked.php");
}
 ?>