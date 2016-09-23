<?php
	include_once('include_fns.php');
	if($_POST['submit'])
	{
		// error message if fields are leeft empty.
		$errorMessage = "";
  
		if(empty($_POST['username']))
		{
			$errorMessage .= "<li>Username cannot be empty</li>";
		}
		if(empty($_POST['password']))
		{
			$errorMessage .= "<li>Password cannot be empty</li>";
		}
		$varUsername = $_POST['username'];
		$varPassword = $_POST['password'];

		if(empty($errorMessage)) 
		{
			$username = "root";
			$password = "";
			$dbname = "fa15grp1";

			// Create connection

			mysql_connect('localhost', $username, $password) or die (mysql_error ());

			// Select database
			mysql_select_db($dbname) or die(mysql_error());

			$query = "SELECT * FROM USER WHERE user_name = '$varUsername' and user_password = '$varPassword'";
			$result = mysql_query($query);

			$count = mysql_num_rows($result);
			if ($count == 1){
				$row = mysql_fetch_row($result);
				$_SESSION['auth_user'] = $varUsername;
				if ($row[5] === "Student") {
					header('Location: student.php');
				}
				else if ($row[5] === "Teacher") {
					header('Location: instructor.php');
				}
				else {
					header('Location: admin.php');
				}
			}else{
				echo "Invalid Login Credentials.";
			}
			$conn->close();
			exit;
		}
	}
?>

<html>
	<head>
		<meta name="generator" content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Login</title>
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
						<h2>Login</h2>
						<!-- Login form is created for all 3 type of users. If they dont have account, they can select join us page-->
						<form action="login.php" method="post">
							<?php
								if(!empty($errorMessage)) 
								{
									echo("<p>There was an error with your form:</p>\n");
									echo("<ul>" . $errorMessage . "</ul>\n");
								} 
							?>
							<table cellpadding="10">
							<tr > 
								<td style="width:1000px;"><label for="username" class="uname" data-icon="u" >Username : </label></td>
								<td><input id="username" name="username" required="required" type="text" placeholder="username"/></td>
							</tr>
							<tr style="width:100px;"> 
								<td><label for="password" class="youpasswd" data-icon="p"> password : </label></td>
								<td><input id="password" name="password" required="required" type="password" placeholder="passsword" /></td>
							</tr>
							<tr style="width:100px;">
								<td><input type="submit" name="submit" value="Login" /></td>
							</tr>
							<tr style="width:100px;">
								<p>Not a member yet?<a href="signup.php">Join us</a></p>
							</tr>
							</table>
						</form> 
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