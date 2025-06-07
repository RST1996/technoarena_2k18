<?php
	session_start();
	ob_start();
	require '../config/dbconnect.php';
	require '../user_mgmt.php';
	if(!isLoggedin())
	{
		die();
	}
	if(isset($_POST['e_id']) && !empty($_POST['e_id']) && isset($_POST['no_p']) && !empty($_POST['no_p']))
	{
		$e_id = $_POST['e_id'];
		$no_p = $_POST['no_p'];
		$query = "SELECT `event_type`, `fees` FROM `events` WHERE `id` = '$e_id'";
		if($res = mysqli_query($dbcon,$query))
		{
			if(mysqli_num_rows($res)  == 1)
			{
				$row = mysqli_fetch_assoc($res);
				$type = $row['event_type'];
				$fees = $row['fees'];
				if($type == 0)
				{
					$total_fees = $fees*$no_p;
				}
				else
					$total_fees = $fees;
?>
		<div class="input-field col s12">
			<input  name="tot_fees" id="tot_fees" type="number" value="<?php echo $total_fees; ?>" class="validate" readonly>
			<label class="active" for="tot_fees">Total Fees</label>
		</div>
<?php
			}
			else
			{
				die();
			}
		}

	}
	ob_end_flush();
?>