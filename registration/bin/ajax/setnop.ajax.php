<?php
	session_start();
	ob_start();
	require '../config/dbconnect.php';
	require '../user_mgmt.php';
	if(!isLoggedin())
	{
		die();
	}
	if(isset($_POST['e_id']) && !empty($_POST['e_id']))
	{
		$e_id = $_POST['e_id'];
		$query = "SELECT `min_members`, `max_members` FROM `events` WHERE `id` = '$e_id'";
		if($res = mysqli_query($dbcon,$query))
		{
			if(mysqli_num_rows($res)  == 1)
			{
				$row = mysqli_fetch_assoc($res);
				$min = $row['min_members'];
				$max = $row['max_members'];
?>
		<div class="input-field col s12">
			<input  name="no_p" id="no_p" onchange="set_fields()" type="number" min="<?php echo $min ?>" max="<?php echo $max; ?>" class="validate" required>
			<label class="active" for="no_p">Number of participants</label>
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