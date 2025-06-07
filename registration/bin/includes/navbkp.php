<nav>
		<div class="nav-wrapper">
			<a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
			<img class="brand-logo center" style="width:auto;height:100%" src="img/01.png">
		</div>
		<ul id="slide-out" class="side-nav">
			<li>
				<div class="user-view">
					<div class="background">
						<img src="img/usr_bg.jpg">
					</div>
					<a href="#!user"><img class="circle" src="img/u_dp.jpg"></a>
					<a href="#!name"><span class="white-text name"><?php echo $_SESSION['current_user_details']['name']; ?></span></a>
					<a href="#!email"><span class="white-text email"><?php echo $_SESSION['current_user_details']['email']; ?></span></a>
				</div>
			</li>
			<li><a href="."><i class="material-icons">cloud</i>Technoarena 2K18 ORS</a></li>
			<li><a href="#!">Change Password </a></li>
			<li><a href="logout.php">Log out </a></li>
			<li><div class="divider"></div></li>
<?php
	if($_SESSION['current_user_details']['admin_role']  == 1)
	{
?>
			<li><a class="waves-effect" href="adduser.php">Add User</a></li>
			<li><a class="waves-effect" href="#!">Registration Log</a></li>
<?php		
	}
?>
			
			<li><a class="waves-effect" href="register.php">Register</a></li>
			<li><a class="waves-effect" href="#!">Personal Log</a></li>
			<li><a class="waves-effect" href="events.php">Events</a></li>
		</ul>
		<!-- <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a> -->
	</nav>
	<script type="text/javascript">
		$(".button-collapse").sideNav();
	</script>