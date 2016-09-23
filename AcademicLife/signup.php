<?php
	include_once('include_fns.php');
	//error message if fields are left empty.
	if($_POST['formSubmit'])
	{
		$errorMessage = "";
		
	if(empty($_POST['email']))
	{
		$errorMessage .= "<li>Email cannot be empty</li>";
	}
	if(empty($_POST['password']))
	{
		$errorMessage .= "<li>Password cannot be empty</li>";
	}
	if(empty($_POST['username']))
	{
		$errorMessage .= "<li>Username cannot be empty</li>";
	}
	if(empty($_POST['birthday']))
	{
		$errorMessage .= "<li>Date of birth cannot be empty</li>";
	}

	$varEmail = $_POST['email'];
	$varPassword = $_POST['password'];
	$varUsername = $_POST['username'];
	$varBirthday = $_POST['birthday'];
	$varType = $_POST['type'];

	if(empty($errorMessage)) 
	{
		$uname = "root";
		$passwordDB = "";
		$currentdb="fa15grp1";

		// Create connection
		$conn = new mysqli('localhost', $uname, $passwordDB, $currentdb);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "INSERT INTO USER
		VALUES (DEFAULT, '$varEmail', '$varPassword', '$varUsername', '$varBirthday', '$varType')";

		if ($conn->query($sql) === TRUE) {
			$_SESSION['auth_user'] = $varUsername;
			$_SESSION['auth_type'] = $varType;
			if ($varType === "Student") {
				header('Location: student.php');
			}
			else if ($varType == "Teacher") {
				header('Location: instructor.php');
			}
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
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
		<title>Signup</title>
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
			
			<!-- Navigation bar created -->
			<div id="nav" class="container_12 clearfix">
				<ul>
					<li>
						<a href="homepage.html">Home</a>
					</li>  
				</ul>
			</div>
			<!-- end nav -->
      
			<!-- Sign up form is created for the users and need to select account type. -->
			<div id="content">
				<div class="inner container_12 clearfix">
					<div id="main" class="grid_8">
						<h2>Sign Up</h2>
						<form action="signup.php" method="post">
							<?php
								if(!empty($errorMessage)) 
								{
									echo("<p>There was an error with your form:</p>\n");
									echo("<ul>" . $errorMessage . "</ul>\n");
								} 
							?>

							<p> 
								<label for="email" class="uname" data-icon="u" > Your email </label>
								<input id="email" name="email" required="required" type="text" placeholder="email" />
							</p>
							<p> 
								<label for="username"> Username </label>
								<input id="username" name="username" required="required" type="text" placeholder="username" /> 
							</p>
							<p> 
								<label for="password" class="youpasswd" data-icon="p"> Your password </label>
								<input id="password" name="password" required="required" type="password" placeholder="passsword" /> 
							</p>
							<p>
								<label for="birthday"> Date of Birth </label>
								<input id="birthday" name="birthday" required="required" type="date" /> 
							</p>
							<p>
								Account type<br>
								<select name="type">
									<option value="Student" >Student</option>
									<option value="Teacher" >Teacher</option>
								</select>
							</p>
							<p>
								<input type="submit" name="formSubmit" value="Sign Up" />
							</p>
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