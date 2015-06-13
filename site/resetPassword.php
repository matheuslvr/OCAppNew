<?php

	$password = "";
	function random_password( $length = 8 ) {
	    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
	    $password = substr( str_shuffle( $chars ), 0, $length );
	    return $password;
	}

	$email = $_POST["email"];

	$servername = "localhost";
	$user_db = "root";
	$password_db = "";
	$dbname = "ocAppDB";
	$password_new = random_password();
	$password_encrypted = md5($password_new);


// Create connection
$conn = new mysqli($servername, $user_db, $password_db, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

	$sql2 = "UPDATE User SET user_password='{$password_encrypted}' WHERE user_mail = '{$email}'";
	$result2 = mysqli_query($conn, $sql2);
	if ($result2){
		echo "SENHA TROCADA!"; // TRATAR SENHA CERTA
		$to = $email;
		$subject = "Troca de Senha - ACE Application";
		$message = "Trocamos sua senha. Ela agora é " . $password_new . " . Enjoy! /o/";
		include("sendEmail.php");
	} else {
		echo "EMAIL NÃO CADASTRADO NO SISTEMA!"; // TRATAR EMAIL DESCONHECIDO
	}

?>