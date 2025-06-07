<?php
	session_start();
	ob_start();
	require '../config/dbconnect.php';
	require '../user_mgmt.php';
	require 'bin/config/class.mail.php';
	require 'bin/config/ta_regsitration.mail.php';
	if(!isLoggedin())
	{
		die();
	}
	if(isset($_POST['id']) && !empty($_POST['id']))
	{
		$reg_id = $_POST['id'];
		
		if(ta_reg_mail($reg_id))
		{
			echo "done";
		}
		else
		{
			echo "fail";
		}

	}
	ob_end_flush();
?>