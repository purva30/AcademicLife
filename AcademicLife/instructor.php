<!DOCTYPE html>
<html>
	<head>
		<meta name="generator" content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Instructor Page</title>
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
							//check login for instructor and if its correct then proceed.
							if (!check_auth_user())
							{
								login_form();
							}
							else if (!check_auth_instructor()) {
								echo "This user cannot access the instructor page";
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

								//display the courses which are taught by specific instructor else return message.
								$query= "SELECT DISTINCT COURSE_NAME
								FROM COURSE
								WHERE COURSE_ID IN(SELECT COURSE_ID FROM INSTRUCTORXREF WHERE USER_ID = $user_id)";
							
								$result = $db->query($query);
							
								echo "<h2>Courses taught by you are:</h2>";
								if ($result -> num_rows > 0)
								{
									while($row = $result -> fetch_assoc())
									{
										echo "<p>".$row["COURSE_NAME"]. "</p>";			
									}
								}else
								{
									echo "<p>None of the courses are taught by you.</p>";	
								}
				
								/*provides option to select courses in which instructor is interested in teaching. 
								If all courses are taught by someone, displays message. */
								echo "<h2>Courses which you can teach:</h2>";
							
								$query1 ="SELECT DISTINCT COURSE_NAME
								FROM COURSE
								WHERE COURSE_ID NOT IN(SELECT DISTINCT COURSE_ID FROM INSTRUCTORXREF)
								AND COURSE_STARTDATE >= CURDATE()";
								
								$result1 = $db->query($query1);

								if ($result1 -> num_rows > 0)
								{
									echo '<form action="teach.php" method="POST">';
									while($row1 = $result1 -> fetch_assoc())
									{
										$coursetoteach = $row1["COURSE_NAME"];
										echo "<input type='checkbox' name='coursestoteach[]' value='$coursetoteach'>  $coursetoteach<br>";	
									}
									echo "<br/>"."<input type='submit' value='Teach'><br/><br/>";	
									echo '</form>';
								}else
								{
									echo "<p>No courses available to teach</p>";
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


