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

// Create connection
$conn = new mysqli($servername, $user_db, $password_db, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$firstname_new = $_POST["first_name_new"];
$lastname_new = $_POST["last_name_new"];
$email_new = $_POST["email_new"];
$tel_new = $_POST["tel_new"];

$sql = "UPDATE User SET user_first_name = '{$firstname_new}', user_last_name = '{$lastname_new}', user_mail = '{$email_new}', user_tel = '{$tel_new}' WHERE user_login = '{$username}' ";
$result = mysqli_query($conn, $sql);
if (mysqli_affected_rows($conn)>0) {
	$row = mysqli_fetch_assoc($result);
	$_SESSION["user_first_name"] = $firstname_new;
	$_SESSION['user_last_name'] = $lastname_new;
	header("Location:../general");
}



?>