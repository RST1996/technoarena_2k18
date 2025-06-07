<?php
	session_start();
	ob_start();
	require 'bin/config/dbconnect.php';
	require 'bin/user_mgmt.php';
	require 'bin/utils.php';
	if(isset($_POST['log_in']))
    {
        //print_r($_POST);
        $username = mysqli_real_escape_string($dbcon,(htmlentities($_POST['username'])));
        $password = mysqli_real_escape_string($dbcon,(htmlentities($_POST['password'])));
        $msg = login($username,$password);
        if($msg == true)
        {
            header('Location:index.php');
            die('Un-ethical activity detected..!!  Do not try to such things here.');
        }
        else
        {
            ?><script>alert( 'Invalid Credentials' );</script><?php
            unset($_POST);
        }
    }
	if(!isLoggedin())
	{
?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>TA | Registration</title>
		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="vendors/materialize/css/materialize.min.css"  media="screen,projection"/>

		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>
	<body>
		<nav>
			<div class="nav-wrapper">
			<img class="brand-logo center" style="width:auto;height:100%" src="img/01.png">
		</div>
		</nav>
		<div class="section"></div>
  <main>
    <center>
      <div class="section"></div>
      <h5 class="indigo-text">Please, login into your account</h5>
      <div class="section"></div>

      <div class="container">
        <div class="z-depth-1 grey lighten-4 row col m8" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

          <form class="col s12" method="post" action="login.php">
            <div class='row'>
              <div class='col s12'>
              </div>
            </div>

            <div class='row'>
              <div class="input-field col s12">
			      <input id="username" name="username" type="text" class="validate" required>
			      <label class="active" for="username">Username</label>
			    </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input id="password" name="password" type="password" class="validate" required>
			      <label class="active" for="password">Password</label>
              </div>
<!--               <label style='float: right;'>
								<a class='pink-text' href='#!'><b>Forgot Password?</b></a>
							</label> -->
            </div>

            <br />
            <center>
              <div class='row'>
                <button type='submit' name='log_in' class='col s12 btn btn-large waves-effect indigo'>Login</button>
              </div>
            </center>
          </form>
        </div>
      </div>
    </center>

    <div class="section"></div>
    <div class="section"></div>
  </main>

	</body>
	</html>
<?php
	}
	else
	{
		header("Location: index.php");
		die("Please cooperate :( ");
	}
	ob_end_flush();
?>