<?php

	/* SESSAO 
	session_start();
	session_regenerate_id();
	if(!isset($_SESSION['user']))      // if there is no valid session
	{
	    header("Location: loginform.html"); // SAIR
	}
	*/

	/* SO VAMOS USAR QUANDO TIVER PAGINA PARA TROCA DE SENHA :)
	$username = $_POST["username"];
	$password_old = $_POST["password_old"];
	$password_new = $_POST["password_new"]
	*/

	/* SO PARA TESTES */

	$username = "natalia";
	$name_new = "NAT LINDA";
	$password = "nataliafofa";

	/* FIM TESTES */

	$servername = "localhost";
	$user_db = "root";
	$password_db = "";
	$dbname = "ocAppDB";


// Create connection
$conn = new mysqli($servername, $user_db, $password_db, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT user_name, user_type_id, user_password FROM User WHERE user_login = '{$username}'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if ($row["user_password"] <> $password) {
    	echo "SENHA ERRADA!"; // TRATAR SENHA ERRADA CORRETAMENTE
    } else {
    	$sql2 = "UPDATE User SET user_name='{$name_new}' WHERE user_login = '{$username}'";
    	$result2 = mysqli_query($conn, $sql2);
    	if ($result2){
    		echo "NOME TROCADO!"; // TRATAR SENHA CERTA
    	}
    }
} else {
	echo "USERNAME NÃO EXISTE!"; // TRATAR USERNAME DESCONHECIDO
}

?>