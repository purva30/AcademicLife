<?php
 
  /**
   * connects to database server and selects database
   * @return handle
   */
  function db_connect()
  {
    $uname = "root";
	$passwordDB = "";
	$currentdb="fa15grp1";

	@ $db = new mysqli('localhost', $uname, $passwordDB, $currentdb);
	if (mysqli_connect_errno())
	{
		echo 'Error: Could not connect to database. Please try again later.';
		exit;
	}
    return $db;        
  }
?>