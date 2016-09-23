<!DOCTYPE html>
<html>
	<head>
		<meta name="generator" content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Student account Page</title>
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
							if (!check_auth_user())
							{
								login_form();
							}
							else if (!check_auth_student()) {
								echo "This user cannot access the student page";
								login_form();
							}
							else
							{ 
								$db = db_connect();
								$current_user = $_SESSION['auth_user'];	
								$queryid = "SELECT USER_ID FROM USER
								WHERE USER_NAME= '$current_user'";

								$resultuserid = $db->query($queryid);
								$rowid = mysqli_fetch_row($resultuserid);
								$user_id = $rowid[0];
				
								//courses available for for student to enroll are displayed after query is performed.
								echo "<h2>Courses available for enrollment:</h2>";
				
								$query= "SELECT DISTINCT COURSE_NAME
								FROM COURSE 
								WHERE COURSE_ID NOT IN(SELECT COURSE_ID FROM STUDENTXREF WHERE USER_ID = $user_id)
								AND COURSE_STARTDATE >= CURDATE()
								AND COURSE_ENDDATE >= CURDATE()";
				
								$result = $db->query($query);

								if ($result -> num_rows > 0)
								{	
									echo '<form action="enroll.php" method="POST">';
									while($row = $result -> fetch_assoc())
									{
										$course = $row["COURSE_NAME"];
										echo "<input type='checkbox' name='courses[]' value='$course'>  $course<br>";
									}
									echo "<br/>"."<input type='submit' value='Enroll'><br/><br/>";
									echo '</form>';
								}else
								{
									echo "<p>No courses available for enrollment at this time.</p>";	
								}

								//courses in which student is already enrolled are displayed after query is performed.
								echo "<h2>You are enrolled in the below courses:</h2>";

								$query1 ="SELECT DISTINCT COURSE_NAME, COURSE_DESCRIPTION, COURSE_STARTDATE, COURSE_ENDDATE
								FROM COURSE
								WHERE COURSE_ID IN(SELECT COURSE_ID FROM STUDENTXREF WHERE USER_ID = $user_id)";
			
								$result1 = $db->query($query1);
								if ($result1 -> num_rows > 0)
								{
									while($row1 = $result1 -> fetch_assoc()){
									echo"<table>";
									echo "<tr><td><b>Course Name: </b></td><td>".$row1["COURSE_NAME"]."</td></tr>";
									echo "<tr><td><b>Course Description: </b></td><td>".$row1["COURSE_DESCRIPTION"]."</td></tr>";
									echo "<tr><td><b>Start Date: </b></td><td>".$row1["COURSE_STARTDATE"]."</td></tr>";
									echo "<tr><td><b>Start Date: </b></td><td>".$row1["COURSE_ENDDATE"]."</td></tr>";
									echo "</table>";
								}		
								}else
								{
									echo "<p>You have not been enrolled in any course.</p>";
								}
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

        

        