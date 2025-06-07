<?php
	session_start();
	ob_start();
	require 'bin/config/dbconnect.php';
	require 'bin/user_mgmt.php';
	require 'bin/utils.php';	
	require 'bin/config/class.mail.php';
	require 'bin/config/registration.mail.php';	
	if(!isLoggedin())
	{
		header("Location:login.php");
		die("Please cooperate :( ");
	}
	if(isset($_POST['add_user']))
	{
		$name = mysqli_real_escape_string($dbcon,(htmlentities($_POST['name'])));
        $email = mysqli_real_escape_string($dbcon,(htmlentities($_POST['email'])));
      	$msg = add_user($name,$email);
      	if($msg == true)
      	{
      		unset($_POST);
?>
	<script type="text/javascript">
		alert("User Added Successfully");
		window.location.href('adduser.php');
	</script>
<?php
      	}
      	else if($msg == false) 
      	{
 ?>
	<script type="text/javascript">
		alert("Failed to add user!!");
	</script>
<?php     		
      	}
      	else
      	{
?>
	<script type="text/javascript">
		alert("<?php echo $msg; ?>");
	</script>
<?php
      	}
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

	<!-- CARD FOR CONTAINIG FORM -->
	<br/><br/>
	<center style="margin:10px auto;text-align: center;">
		<div class="row">
			<div class="col s12 m8">
				<div class="card-content">
					<span class="card-title">Add User</span>
					<br/>
					<div class="row">
						<form class="col s12" action="adduser.php" method="POST">
							<div class="row">
								<div class="input-field col s12">
									<input  name="name" id="name" type="text" class="validate" required>
									<label class="active" for="name">Name</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input  name="email" id="email" type="email" class="validate" required>
									<label class="active" for="email">Email</label>
								</div>
							</div>
							<center>
								<div class='row'>
									<button type='submit' name='add_user' class='col s12 btn btn-large waves-effect indigo'>Add User</button>
								</div>
				            </center>
						</form>
						
					</div>
				</div>
			</div>
		</div>
	</center>
	<script type="text/javascript">
		$(document).ready(function() {
			Materialize.updateTextFields();
		});
	</script>
</body>
</html>
<?php
	ob_end_flush();
?>