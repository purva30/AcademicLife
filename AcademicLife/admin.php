<!DOCTYPE html>
<html>
	<head>
		<meta name="generator" content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Admin Page</title>
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
					<li>
						<a href="logout.php">Logout</a>
					</li>
				</ul>
			</div>
			<!-- end nav -->
      
			<div id="content">
				<div class="inner container_12 clearfix">
					<div id="main" class="grid_8">
						<?php
							include_once('include_fns.php');
							//Return error message if the required fields are left empty else it will add course in the database.
							if($_POST['add'])
							{
								$errorMessage = "";
							  
								if(empty($_POST['courseName']))
								{
									$errorMessage .= "<li>Please type a course name to add</li>";
								}
								if(empty($_POST['courseDepartment']))
								{
									$errorMessage .= "<li>Please enter the course department</li>";
								}
								if(empty($_POST['courseDescription']))
								{
									$errorMessage .= "<li>Please enter the course description</li>";
								}
								if(empty($_POST['courseStartDate']))
								{
									$errorMessage .= "<li>Please enter the course start date</li>";
								}
								if(empty($_POST['courseEndDate']))
								{
									$errorMessage .= "<li>Please enter the course end date</li>";
								}

								if(empty($errorMessage)) {
									$varCourseName = $_POST['courseName'];
									$varCourseDepartment = $_POST['courseDepartment'];
									$varCourseDescription = $_POST['courseDescription'];
									$varCourseStartDate = $_POST['courseStartDate'];
									$varCourseEndDate = $_POST['courseEndDate'];

									$username = "root";
									$password = "";
									$dbname = "fa15grp1";

									// Create connection
									$conn = new mysqli('localhost', $username, $password, $dbname);
									// Check connection
									if ($conn->connect_error) {
										die("Connection failed: " . $conn->connect_error);
									} 
									$sql = "INSERT INTO course VALUES (DEFAULT, '$varCourseName', '$varCourseDepartment', '$varCourseDescription', '$varCourseStartDate', '$varCourseEndDate')";

									if ($conn->query($sql) === TRUE) {
										echo "Success";
									} else {
										echo "Error: " . $sql . "<br>" . $conn->error;
									}
								}
							}
							//Error message if any course is not selected for removing and hit Delete class button.
							else if($_POST['remove']) {
								$errorMessage = "";
							  
								if($_POST['removeClass'] === "empty")
								{
									$errorMessage .= "<li>Please select a class name to drop</li>";
								}
								else {
									$varClass = $_POST['removeClass'];
									$username = "root";
									$password = "";
									$dbname = "fa15grp1";

									// Create connection
									$conn = new mysqli('localhost', $username, $password, $dbname);
									// Check connection
									if ($conn->connect_error) {
										die("Connection failed: " . $conn->connect_error);
									} 
									$sql = "DELETE FROM course WHERE course_name = '$varClass'";

									if ($conn->query($sql) === TRUE) {
										echo "Success";
									} else {
										echo "Error: " . $sql . "<br>" . $conn->error;
									}
								}
							}
							if (!check_auth_user())
							{
								login_form_admin();
							}
							else if (!check_auth_admin()) {
								echo "This user cannot access the admin page";
								login_form_admin();
							}
							else
							{ 
								//form created for entering course details.
								echo "<p><form action='admin.php' method='post'>";
								echo "<h2> Add a course </h2>";
								echo "Course Name: <input id='courseName' name='courseName' type='text' placeholder='course name' /><br>";
								echo "Course Department: <input id='courseDepartment' name='courseDepartment' type='text' placeholder='course department' /><br> ";       
								echo "Course Description: <input id='courseDescription' name='courseDescription' type='text' placeholder='course description' /><br>";
								echo "Course Start Date: <input id='courseStartDate' name='courseStartDate' type='date' /><br>";
								echo "Course End Date: <input id='courseEndDate' name='courseEndDate' type='date' /><br></p>";
								echo "<p><input type='Submit' name='add' value='Add Class' /></p>";
								
								//Courses can be removed from the database by admin. Dropdown option is provided to select course.
								echo "<p><h2> Remove a course </h2>";
								echo "<select name='removeClass'><br>";
								echo "<option value='empty' selected='selected'> -- Choose one -- </option>";

								$username = "root";
								$password = "";
								$dbname = "fa15grp1";
								mysql_connect('localhost', $username, $password) or die (mysql_error ());
								mysql_select_db($dbname) or die(mysql_error());

								$query = "SELECT * FROM course";
								$result = mysql_query($query);
								while($row = mysql_fetch_assoc($result)) {
									$varCourseName = $row['COURSE_NAME'];
									echo "<option value= '$varCourseName'> $varCourseName </option>";
								}
								echo "</select></p><br>";
								echo "<p><input type='Submit' name='remove' value='Delete Class' /></p>";

								echo "</form>";
							}
						?>
					</div>
					<!-- end main -->
				</div>
			</div>
			<!-- end content -->
			<div id="footer">
				<div class="inner container_12 clearfix">
					<p>
						<strong>Team members: Purva Rajwade (Coding) and Poonam Thapa (Documentation), Fall 2015.</strong>
					</p>
				</div>
			</div>
			<!-- end footer -->
		</div>
		<!-- end wrapper -->
	</body>
</html>

