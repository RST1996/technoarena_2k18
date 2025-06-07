<?php
	session_start();
	ob_start();
	require 'bin/config/dbconnect.php';
	require 'bin/user_mgmt.php';
	if(!isLoggedin())
	{
		header("Loction: login.php");
		die("Please cooperate :( ");
	}
	session_destroy();
	header("Location: login.php");
	die("Please cooperate :( ");
	ob_end_flush();
?>