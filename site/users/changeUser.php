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


$v = $_POST["user_id"];
$firstname_new = $_POST["first_name_new"];
$lastname_new = $_POST["last_name_new"];
$email_new = $_POST["email_new"];
$tel_new = $_POST["tel_new"];
$user_type_new = $_POST["user_type_new"];


$sql = "UPDATE user SET user_first_name = '{$firstname_new}', user_last_name = '{$lastname_new}', user_mail = '{$email_new}', user_tel = '{$tel_new}', user_type_id = '{$user_type_new}' WHERE user_id = '{$v}' ";
$result = mysqli_query($conn, $sql);
if (mysqli_affected_rows($conn)>0) {
	header("Location:../users");
}

	header("Location:../users");


?>