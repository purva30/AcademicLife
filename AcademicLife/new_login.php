<?php
	include_once('include_fns.php');

	//displays error if incorrect login details are entered.
	if ( (!isset($_REQUEST['username'])) || (!isset($_REQUEST['password'])) )
	{
		echo 'You must enter your username and password to proceed';
		exit;
	}
 
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];
	if (login($username, $password))
	{
		$_SESSION['auth_user'] = $username;
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}
	else
	{
		echo 'The username or password you entered is incorrect';
		exit;
	}
?>

<html>
	<head>
		<meta name="generator" content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Invalid details</title>
		<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/grid.css" type="text/css" media="screen" />
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<div class="inner container_12 clearfix">
					<div id="logo" class="grid_5">
						<h1>
							<a href="HomePage.html" title="Online Learning Management System">Online Learning Management System</a>
						</h1>
						<p id="slogan">Your easy online portal</p>
					</div>
					<!-- end logo -->
				</div>
			</div>
			<!-- end header -->
			
			<div id="content">
				<div class="inner container_12 clearfix">
					<div id="main" class="grid_8">
						<h2>Pleas visit <a href="options.php">Login option Page</a></h2>
					</div>
					<!-- end main -->
				</div>
			</div>
			<!-- end content -->

			<div id="footer">
				<div class="inner container_12 clearfix">
					<strong>Team members: Purva Rajwade & Poonam Thapa, Fall 2015.</strong>
				</div>
			</div>
			<!-- end footer -->
		</div>
		<!-- end wrapper -->
	</body>
</html>