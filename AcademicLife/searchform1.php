<!DOCTYPE html>
<html>
	<head>
		<meta name="generator" content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Search course result</title>
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
							<a href="homePage.html" title="Online Learning Management System">Online Learning Management System</a>
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
						<a href="HomePage.html">Home</a>
					</li>
					<li>
						<a href="options.php">Login/Register</a>
					</li>
					<li>
						<a href="AboutUs.html">About Us</a>
					</li>
					<li>
						<a href="Search.php">Search Courses</a>
					</li>
				</ul>
			</div>
			<!-- end nav -->
			
			<div id="content">
				<div class="inner container_12 clearfix">
					<div id="main" class="grid_8">
						<h2>Search result:</h2>
						<?php
							include_once('db_connect.php');
							//After connecting to the database, result is displayed based on courses available. Also provides all details about courses.
							$search = $_POST['keyword'];
		
							$db = db_connect();

							$currenttb="course";
		
							$query="SELECT COURSE_NAME, COURSE_DESCRIPTION
							FROM $currenttb
							WHERE COURSE_NAME LIKE"."'%$search%'";
				
		
							$result1 = $db->query($query);
							if ($result1 -> num_rows > 0)
							{
								while($row = $result1 -> fetch_assoc()){
								echo"<table>";
								echo"<tr><td><b>Course Name: </b></td><td>".$row["COURSE_NAME"]. "</td></tr>";
								echo"<tr><td><b>Course Description: </b></td><td>".$row["COURSE_DESCRIPTION"]. "</td></tr>";
								echo"</table><br/>";
								echo "<p>To enroll in this course, you will need to create an account as a Student/Teacher.</p>";
							}
							}else
							{
								echo "<p>This course is not offered at this time. Please try after some days or contact us thorugh phone or email. Thank you for visiting.</p>";
							}		
						?>
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