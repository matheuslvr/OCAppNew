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


// Create connection
$conn = new mysqli($servername, $user_db, $password_db, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO User (user_first_name, user_last_name, user_login, user_mail, user_tel) VALUES ('{$user_first_name}', '{$user_last_name}', '{$user_login}', '{$user_email}', '{$user_tel}') ";
$result = mysqli_query($conn, $sql);

if ($result){

header("Location: ../users");

}

?>