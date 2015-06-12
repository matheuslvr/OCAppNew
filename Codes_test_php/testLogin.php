<?php

	/* SO VAMOS USAR QUANDO TIVER PAGINA PARA LOGIN :)
	$username = $_POST["username"];
	$password = $_POST["password"];
	*/

	/* SO PARA TESTES */

	$username = "natalia";
	$password = "natalia natalia";

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
    	echo "SENHA CERTA!"; // TRATAR SENHA CERTA
    	$user_type = $row["user_type_id"];
    	//include("testSessionStart.php");
    }
} else {
	echo "USERNAME NÃO EXISTE!"; // TRATAR USERNAME DESCONHECIDO
}

?>