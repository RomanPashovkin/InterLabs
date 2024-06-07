<?php
include_once("Connection.php");
include_once("User.php");

session_start();

$systemUser = new SystemUser($_POST['username'], $_POST['password']);

if ($connection->checkSystemUser($systemUser->username, $systemUser->password))
{
	$_SESSION['username'] = $systemUser->username;
	header('location: index.php');
}
else {
	header('location: login.php');
}
?>