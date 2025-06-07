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
            <!-- <div class="card-image">
              <img src="img/01.png">
             
            </div> -->
            <div class="card-content">
            	<span class="card-title" style="text-decoration: underline;text-align: center;">Personal Log</span>
              	<div class="row">
<?php
	$self = $_SESSION['current_user_details']['id'];
	$query = "SELECT `registration`.`id`,`registration`.`ta_id`,`registration`.`name`,`events`.`name` AS `e_name`, `registration`.`fees_paid` FROM `registration`,`events` WHERE `registration`.`registered_by` = '$self' AND `registration`.`event_id` = `events`.`id`";
	if($res = mysqli_query($dbcon,$query))
	{
		if(mysqli_num_rows($res) > 0)
		{
?>
					<table class="striped bordered centered responsive-table">
         				<thead>
         					<tr>
	         					<th>#</th>
	         					<th>TA ID</th>
	         					<th>Name</th>
	         					<th>Event</th>
	         					<th>Fees</th>
	         					<th>Confirmation</th>
	         				</tr>
         				</thead>
         				<tbody>
<?php
			$sr = 1;
			$total = 0;
			while ($row = mysqli_fetch_assoc($res))
			{
?>
						<tr>
							<td><?php echo $sr++; ?></td>
							<td><?php echo $row['ta_id']; ?></td>
							<td><?php echo $row['name']; ?></td>
							<td><?php echo $row['e_name']; ?></td>
							<td><?php echo $row['fees_paid']; ?></td>
							<td><a class="waves-effect waves-light btn" onclick="send(<?php echo $row['id']; ?>)"><i class="material-icons left">mail</i>Confirmation Mail</a></td>
						</tr>		
<?php
				$total += $row['fees_paid'];
			}
?>
						</tbody>
         			</table>
         			<div class="row">
         				Total Registration : <?php echo $sr-1 ;?><br/>
         				Total Collection :	<?php echo $total; ?>
         				
         			</div>
<?php
		}
		else
		{
			echo "No Registrations Yet";
		}
	}
?>
         			
              	</div>
            </div>
          </div>
        </div>
    </div>
    <script type="text/javascript">
    	function send(id)
    	{
    		var xhttp = new XMLHttpRequest();
			
	        xhttp.onreadystatechange = function() {
	        	if (this.readyState == 4 && this.status == 200) {
	        		var op = this.responseText; 
	        		if(op == "done")
	        		{
	        			Materialize.toast('Confirmation Mail Sent!', 2000);	
	        		}
	        		
	        	}
	        };
	        xhttp.open("POST", "bin/ajax/sendConfirmationMail.ajax.php", true);
	        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	        xhttp.send("id="+id);
    	}
    </script>
</body>
</html>
<?php
	ob_end_flush();
?>