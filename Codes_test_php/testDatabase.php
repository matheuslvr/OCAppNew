<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ocAppDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";


$sql = "SELECT user_id, user_login, user_name FROM User";
$sql2 = "SELECT user_type_description FROM User_type WHERE user_type_id = $user_type ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "id: " . $row["user_id"]. " - Name: " . $row["user_name"]. " - Login - " . $row["user_login"]. "<br>";
        $user_type = $row["user_type_id"];
        $result2 = mysqli_query($conn, $sql2);
        if (mysqli_num_rows($result2) > 0) {
        	echo "tipo - " . $row["user_type_description"] . "<br>";
    	}
    }
} else {
    echo "0 results";
}

mysqli_close($conn);

?>