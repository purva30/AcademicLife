<!DOCTYPE html>
<html>
	<head>
		<meta name="generator" content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Enroll Page</title>
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
						<h2>Enrollment result:</h2>
						<?php
							include_once('include_fns.php');
							if (!check_auth_user())
							{
								login_form();
							}
							else
							{ 
								//connection to database is checked and UserID is retrived.
								$db = db_connect();
								$current_user = $_SESSION['auth_user'];	
								$queryid = "SELECT USER_ID FROM USER
								WHERE USER_NAME= '$current_user'";
							
								$resultuserid = $db->query($queryid);
								$rowid = mysqli_fetch_row($resultuserid);
								$user_id = $rowid[0];

								$coursetb="course";
								$enrolltb = "studentxref";
							
								foreach($_POST['courses'] as &$avblcourse)
								{
									//courseId is retrived based on the course selected by student.
									$query = "select COURSE_ID from $coursetb
									where COURSE_NAME = '$avblcourse'";
								
									$result = $db->query($query);
									if ($result -> num_rows > 0)
									{
										while($row = $result -> fetch_assoc()){
											$courseid = $row['COURSE_ID'];
										}		
									}else
									{
										echo "0 results";
									}

									//when student wants to enroll in any course, following sql code is performed.
									$query1 = "insert into $enrolltb values
									(NULL,'".$user_id."','".$courseid."')";

									$result1 = $db->query($query1);
									echo "<p>You have been enrolled for the course "."<b>".$avblcourse."</b><br/></p>";
								}
							}
						?>
						
						<table>
							<a href="student.php">
							<input type="submit" value="Back"></a>
						</table>
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
