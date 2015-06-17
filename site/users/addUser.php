<?php

	session_start();
	session_regenerate_id();
	if(!isset($_SESSION['username']))      // if there is no valid session
	{
	    header("Location: index.php"); // SAIR
	}

	$username = $_SESSION['username'];
	$servername = $_SESSION['servername'];
	$user_db = $_SESSION['user_db'];
	$password_db = $_SESSION['password_db'];
	$dbname = $_SESSION['dbname'];

// POSTS ;)

	$user_first_name = $_POST["user_first_name"];
	$user_last_name = $_POST["user_last_name"];
	$user_login = $_POST["user_login"];
	$user_email = $_POST["user_email"];
	$user_tel = $_POST["user_tel"];
	$user_type = $_POST["user_type"];


// Create connection
$conn = new mysqli($servername, $user_db, $password_db, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


/* EXCEPTIONS */


	function look($looktable, $value, $conn){

		$sqllook = "SELECT * FROM User WHERE '{$looktable}' = '{$value}' ";
		$resultlook = mysqli_query($conn, $sqllook);

		return $resultlook;
	}


	if ($user_first_name == "" || $user_last_name == "" || $user_login == "" || $user_email == "" || $user_tel == ""){
		die("<script> alert('One or more of the fields is empty.'); window.location.href='../users'; </script>");
	} else
	

	if (look("user_login", $user_login, $conn)){
		die("<script> alert('Login already exists on the system.'); window.location.href='../users'; </script>");
	}
	
	else

	if (look("user_mail", $user_email, $conn)){
		die("<script> alert('Email already exists on the system.'); window.location.href='../users'; </script>");
	}
	
	else

	if ($user_type == "") {
		$user_type = "Team Member";
		//echo "<script> alert('You left the User Type field empty, the app will set the user as a Team Member.');</script>";
	}




$sqltype = "SELECT user_type_id FROM user_type WHERE user_type_description = '{$user_type}' ";
$resulttype = mysqli_query($conn, $sqltype);
if ($resulttype){
	$row = mysqli_fetch_assoc($resulttype);
	$user_type_id = $row["user_type_id"];
}


$sql = "INSERT INTO User (user_first_name, user_last_name, user_login, user_mail, user_tel, user_type_id) VALUES ('{$user_first_name}', '{$user_last_name}', '{$user_login}', '{$user_email}', '{$user_tel}', '{$user_type_id}') ";
$result = mysqli_query($conn, $sql);

if ($result){

//echo "<script> window.location.href='../users'; </script>";

}

?> 