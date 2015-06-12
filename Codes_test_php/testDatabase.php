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
echo "Connected successfully <br>";


$sql = "SELECT user_id, user_login, user_name, user_type_id FROM User";
$result1 = mysqli_query($conn, $sql);

if (mysqli_num_rows($result1) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result1)) {
        echo "id: " . $row["user_id"]. " - Name: " . $row["user_name"]. " - Login - " . $row["user_login"];
        $user_type = $row["user_type_id"];
        $sql2 = "SELECT user_type_id, user_type_description FROM User_type WHERE user_type_id = '{$user_type}'";
        $result2 = mysqli_query($conn, $sql2);
        if (!$result2 || mysqli_num_rows($result2) > 0) {
            while(!$result2 || $row2 = mysqli_fetch_assoc($result2)) {
                echo " tipo - " . $row2["user_type_description"] . "<br>";
            }
    	}
    }
} else {
    echo "0 results";
} 

mysqli_close($conn);

?>