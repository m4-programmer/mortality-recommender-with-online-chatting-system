<?php
require 'include/repeated.php';

$user = new User;
// updates the user table with the time user logged out
$res = $user->Logout_Log($_SESSION['id']);
//destroys all session
session_destroy();
//redirects users to home page
header('Location: ../index.php');
?>