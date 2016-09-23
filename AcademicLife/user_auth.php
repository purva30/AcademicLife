<?php
	function login($username, $password)
	// check username and password with db
	// if yes, return true
	// else return false
	{
		// connect to db
		$uname = "root";
		$passwordDB = "";
		$currentdb="fa15grp1";

		@ $db = new mysqli('localhost', $uname, $passwordDB, $currentdb);
		if (mysqli_connect_errno())
		{
			echo 'Error: Could not connect to database. Please try again later.';
			exit;
		}

		$query = "select * from user
		where USER_NAME='$username' and
		USER_PASSWORD = '$password'";
 
		$result = $db->query($query);
		if (!$result)
		{
			return 0;
			echo "fail";
		}
		if ($result->num_rows>0)
		{
			return 1;
			echo "success";
		}
		else
		{
			return 0;
			echo "fail2";
		}
	}

	function check_auth_user()
	// see if somebody is logged in and notify them if not
	{
		global $_SESSION;
		if (isset($_SESSION['auth_user']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function check_auth_student() 
	// see if somebody is logged in and notify them if not
	{
		global $_SESSION;
		$varUsername = $_SESSION['auth_user'];
 	
		$db = db_connect();
		$query = "SELECT USER_ACCOUNTTYPE FROM USER
				WHERE USER_NAME= '$varUsername' AND USER_ACCOUNTTYPE= 'Student'";

		$result = $db->query($query);
		if (!$result)
		{
			return false;
		}
		if ($result->num_rows>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function check_auth_instructor() 
	// see if somebody is logged in and notify them if not
	{
		global $_SESSION;
		$varUsername = $_SESSION['auth_user'];
		
		$db = db_connect();
		$query = "SELECT USER_ACCOUNTTYPE FROM USER
			WHERE USER_NAME= '$varUsername' AND USER_ACCOUNTTYPE = 'Teacher'";

		$result = $db->query($query);
		
		if (!$result)
		{
			return false;
		}
		if ($result->num_rows>0)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}

	function check_auth_admin() 
	// see if somebody is logged in and notify them if not
	{
		global $_SESSION;
		$varUsername = $_SESSION['auth_user'];
		
		$db = db_connect();
		$query = "SELECT USER_ACCOUNTTYPE FROM USER
			WHERE USER_NAME= '$varUsername' AND USER_ACCOUNTTYPE = 'Admin'";

		$result = $db->query($query);	

		if (!$result)
		{
			return 0;
		}
		if ($result->num_rows>0)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}

	function login_form_admin()
	//this function is called for admin page.
	{
?>
<form action='new_login.php' method='POST'>
	<table border=0>
		<tr>
			<td>Username: </td>
			<td><input size='16' name='username'></td>
		</tr>
		<tr>
			<td>Password: </td>
			<td><input size='16' type='password' name='password'></td>
		</tr><br/>
	</table><br/>
	<input type='submit' value='Log in'>
</form>
<?php
	}

	function login_form()
	//this function is called for student and instructir page.
	{
?>
	<form action='new_login.php' method='POST'>
		<table border=0>
			<tr>
				<td>Username</td>
				<td><input size='16' name='username'></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input size='16' type='password' name='password'></td>
			</tr><br/>
		</table><br/>
		<input type='submit' value='Log in'>
	</form>
	<br/><strong>If not a member please <a href="signup.php"><u>Join us</u></strong></p>
<?php
}