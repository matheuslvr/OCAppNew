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

	$team_name = $_POST["team_description"];
	$checked_users = $_POST["checked"];


// Create connection
$conn = new mysqli($servername, $user_db, $password_db, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO Team (team_description) VALUES ('{$team_name}') ";
$result = mysqli_query($conn, $sql);
$team_id = mysqli_insert_id($conn);


for ($i = 0; $i < count($checked_users); $i++) {
	$user_id = $checked_users[$i];
	$sql2 = "INSERT INTO User_team (user_id, team_id) VALUES ('{$user_id}', '{$team_id}') ";
	$result = mysqli_query($conn, $sql2);
}




header("Location: ../teams");



?>