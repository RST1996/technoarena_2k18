<?php
	session_start();
	ob_start();
	require 'bin/config/dbconnect.php';
	require 'bin/user_mgmt.php';
	require 'bin/utils.php';
	require 'bin/config/class.mail.php';
	require 'bin/config/ta_regsitration.mail.php';
	if(!isLoggedin())
	{
		header("Location:login.php");
		die("Please cooperate :( ");
	}
	if(isset($_POST['register']))
	{
		//print_r($_POST);
		
		$name = mysqli_real_escape_string($dbcon,(htmlentities($_POST['name'])));
		
		$email = mysqli_real_escape_string($dbcon,(htmlentities($_POST['email'])));
		$clg_name = mysqli_real_escape_string($dbcon,(htmlentities($_POST['clg_name'])));
		$mob_no = mysqli_real_escape_string($dbcon,(htmlentities($_POST['mob_no'])));
		$event = mysqli_real_escape_string($dbcon,(htmlentities($_POST['event'])));
		$nop = mysqli_real_escape_string($dbcon,(htmlentities($_POST['no_p'])));
		$part_array = array();
		$part_array[] = $name;
		if($nop > 1)
		{
			foreach ($_POST['pname'] as $part) {
				# code...
				$part_array[] = mysqli_real_escape_string($dbcon,(htmlentities($part)));
			}	
		}
		

		$Total_fees = mysqli_real_escape_string($dbcon,(htmlentities($_POST['tot_fees'])));

		$registered_by = $_SESSION['current_user_details']['id'];
		$event_query = "SELECT * FROM `events` WHERE `id` = '$event'";
		if($res = mysqli_query($dbcon,$event_query))
		{
			if(mysqli_num_rows($res) == 1)
			{
				$ins_query = "INSERT INTO `registration` (`id`, `ta_id`, `name`, `email`, `clg_name`, `event_id`, `nop`, `mob_no`, `fees_paid`, `registered_by`) VALUES (NULL, 'TA18xxxx', '$name', '$email', '$clg_name', '$event', '$nop', '$mob_no', '$Total_fees', '$registered_by')";
				if($res = mysqli_query($dbcon,$ins_query))
				{
					$ins_id = mysqli_insert_id($dbcon);
					$ta_id = 'TA18'.sprintf('%05u', $ins_id);
					$up_query = "UPDATE `registration` SET `ta_id` = '$ta_id' WHERE `id`='$ins_id'";
					if($res = mysqli_query($dbcon,$up_query))
					{
						$query = "INSERT INTO `participants` (`reg_id`, `name`) VALUES ";
						$tuples_array = array();
						foreach ($part_array as $part) {
							$tuples_array[] = "('$ins_id','$part')";
						}

						$query = $query.implode(",", $tuples_array);
						if($res = mysqli_query($dbcon,$query))
						{
							ta_reg_mail($ins_id);	
							unset($_POST);
?>
	<script type="text/javascript">
		alert("Registered Successfully : TAID is <?php echo $ta_id; ?>")
	</script>
<?php
						}
						

					}
				}
				else
				{
?>
	<script type="text/javascript">3
		alert("Failed to process .. contact admin");
	</script>
<?php
				}
			}
			else
			{
?>
	<script type="text/javascript">
		alert("Invalid Request");
	</script>
<?php
			}
		}
		else
		{
			
?>
	<script type="text/javascript">
		alert("Unable to process");
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
	<div class="row">
        <div class="col s12 m7">
          <div class="card">
            <!-- <div class="card-image">
              <img src="img/01.png">
             
            </div> -->
            <div class="card-content">
            	 <span class="card-title" style="text-decoration: underline;text-align: center;">Registration</span>
              	<div class="row">
					<form class="col s12" id="reg_form" action="register.php" method="POST" onsubmit= "return check_and_confirm()">
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
						<div class="row">
							<div class="input-field col s12">
								<input  name="clg_name" id="clg_name" type="text" class="validate" required>
								<label class="active" for="clg_name">College Name</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input  name="mob_no" id="mob_no" type="text" class="validate" required>
								<label class="active" for="mob_no">Mobile No.</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<select  name="event" id="event" class="validate" onchange="setnop()" required>
									<option value="" style="text-align: center;">--SELECT AN EVENT--</option>
<?php
	$query = "SELECT `id`, `name`FROM `events` WHERE 1";
	if($res = mysqli_query($dbcon,$query))
	{
		while($row = mysqli_fetch_assoc($res))
		{
?>
									<option value="<?php echo $row['id'] ?>"><?php echo $row['name']; ?></option>
<?php
		}
	}
?>
								</select>
								<label class="active" for="event">Event</label>
							</div>
						</div>
						<div class="row" id="nop"></div>
						<div id="parti"></div>
						<div class="row" id="fees"></div>
						<center id="sub_btn">
							
			            </center>
					</form>
					
				</div>
            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript">
      	$(document).ready(function() {
			$('select').material_select();
		});
      </script>
      <script type="text/javascript">
      	function check_and_confirm()
      	{
      		if(confirm('Are you sure you want to register this participants.. This cannot be undone !!'))
      		{
      			return true;
      		}
      		else
      		{
      			return false;
      		}
      	}
      </script>
      <script type="text/javascript">
      	var nop  = document.getElementById('nop');
  		var parti  = document.getElementById('parti');
  		var fees  = document.getElementById('fees');
  		var sub_btn  = document.getElementById('sub_btn');
  		
      	function setnop()
      	{
      		var event = document.getElementById('event').value;
      		nop.innerHTML = "";
      		parti.innerHTML = "";
      		fees.innerHTML = "";
      		sub_btn.innerHTML = "";
      		var xhttp = new XMLHttpRequest();
			
	        xhttp.onreadystatechange = function() {
	        	if (this.readyState == 4 && this.status == 200) {
	        		nop.innerHTML = this.responseText; 
	        		Materialize.updateTextFields();
	        	}
	        };
	        xhttp.open("POST", "bin/ajax/setnop.ajax.php", true);
	        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	        xhttp.send("e_id="+event);
      	}

      	function set_fields()
      	{
      		parti.innerHTML = "";
      		fees.innerHTML = "";
      		sub_btn.innerHTML = "";
      		setparti();
      		setFees();
      		setBtn();
      		Materialize.updateTextFields();
      	}

      	function setBtn()
      	{
      		sub_btn.innerHTML = "<div class='row'><button type='submit' name='register' class='col s12 btn btn-large waves-effect indigo'>Register</button></div>";
      	}

      	function setFees()
      	{
      		var event = document.getElementById('event').value;
      		var num = document.getElementById('no_p').value;
      		var xhttp = new XMLHttpRequest();
			
	        xhttp.onreadystatechange = function() {
	        	if (this.readyState == 4 && this.status == 200) {
	        		fees.innerHTML = this.responseText; 
	        		Materialize.updateTextFields();
	        	}
	        };
	        xhttp.open("POST", "bin/ajax/setFees.ajax.php", true);
	        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	        xhttp.send("e_id="+event+"&no_p="+num);
      		
      	}

      	function setparti()
      	{
      		var num = document.getElementById('no_p').value;
      		//alert(num);
      		for (var i =  0; i < num - 1; i++) {
      			parti.innerHTML += "<div class=\"row\"><div class=\"input-field col s12\"><input  name=\"pname[]\" id=\"pname"+i+"\" type=\"text\" class=\"validate\" required><label class=\"active\" for=\"pname"+i+"\">Member</label></div></div>";

      		}
      	}

      </script>
</body>
</html>
<?php
	ob_end_flush();
?>