<?php
	session_start();
	ob_start();
	require 'bin/config/dbconnect.php';
	require 'bin/user_mgmt.php';
	require 'bin/utils.php';
	if(!isLoggedin())
	{
		header("Location:login.php");
		die("Please cooperate :( ");
	}

?>
<!DOCTYPE html>
<html>
<head> 
	<title>TA18 | Registration</title>
	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="vendors/materialize/css/materialize.min.css"  media="screen,projection"/>

	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
	<!--Import jQuery before materialize.js-->
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="vendors/materialize/js/materialize.min.js"></script>
	<?php require 'bin/includes/navbar.inc'; ?>
	
	<div class="row">
        <div class="col s12 m7">
          <div class="card">
            <div class="card-image">
              <img src="img/2_cp.png">
              
            </div>
            <div class="card-content">
            	<span class="card-title">Welcome to TECHNOARENA ORS</span>
            </div>
            <div class="card-action">
              <a href="https://technoarena.gcoej.ac.in">Visit Website</a>
            </div>
          </div>
        </div>
      </div>
</body>
</html>
<?php
	ob_end_flush();
?>