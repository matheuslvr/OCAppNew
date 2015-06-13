<?php

session_start();
    
    $_SESSION['username'] = $username;
    $_SESSION['user_type'] = $user_type;

	$_SESSION['servername'] = $servername;
	$_SESSION['user_db'] = $user_db;
	$_SESSION['password_db'] = $password_db;
	$_SESSION['dbname'] = $dbname; 

    header("Location:profile.php");

 ?>