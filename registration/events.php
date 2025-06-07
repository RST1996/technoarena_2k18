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
	<br/><br/><br/>
	<h3 align="center"> EVNETS LIST </h3>
	<div class="row col m8 s12">
	<?php
	$query = "SELECT * FROM `events` WHERE 1";
	if($res = mysqli_query($dbcon,$query))
	{
?>
	<table class="striped bordered centered responsive-table" caption="EVENTS LIST">
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Event Type</th>
				<th>Min. Participants</th>
				<th>Max. Participants</th>
				<th>Fees</th>
			</tr>
		</thead>
<?php
		$sr = 1;
		while($row = mysqli_fetch_assoc($res))	
		{
			switch ($row['event_type']) {
				case 0:
					$event_type = 'Single';
					$apnd = ' per participant';
					break;
				case 1:
					$event_type = 'Group';
					$apnd = ' per group';
					break;
				
			}
?>
		<tr>
			<td><?php echo $sr++; ?></td>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $event_type ?></td>
			<td><?php echo $row['min_members']; ?></td>
			<td><?php echo $row['max_members']; ?></td>
			<td><?php echo $row['fees'].$apnd; ?></td>

		</tr>
<?php
		}
?>
	</table>

<?php
	}

	?>
	</div>
</body>
</html>
<?php
	ob_end_flush();
?>