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

	$sql = "SELECT user_id, user_first_name, user_last_name, user_type_id, user_tel, user_mail FROM User WHERE user_login = '{$username}'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result)) {
	    $row = mysqli_fetch_assoc($result);
	    $user_id = $row["user_id"];
	    $first_name = $row["user_first_name"];
	    $last_name = $row["user_last_name"];
	    $user_type_id = $row["user_type_id"];
	    $user_tel = $row["user_tel"];
	    $user_mail = $row["user_mail"];
	}

	$sql2 = "SELECT user_type_description FROM User_type WHERE user_type_id = '{$user_type_id}'";
	$result2 = mysqli_query($conn, $sql2);
	if (mysqli_num_rows($result2)) {
		$row = mysqli_fetch_assoc($result2);
		$user_type_description = $row["user_type_description"];
	}



?>

<html>
<head>
	<title>Setup - Highest Good Network </title>
	<link href="styles/setup.css" rel="stylesheet">
	<link href="styles/basicStyle.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300,100' rel='stylesheet' type='text/css'>
	<script src="scripts/setup.js"></script>

	</script>
</head>
<body>

	<nav>
		<ul>
			<li> <a href="profile.php"> PROFILE </a> </li>
			<li> <a href="#"> TASKS </a> </li>
			<li> <a href="#"> REPORTS </a> </li>
			<li> <a href="#" class="active"> SETUP </a> </li>
			<li> <a href="#"> PORTAL </a> </li>
			<li class="right img"> <a href="sessionStop.php"> <img src="img/logoutIcon.png" alt="Logout"> </a> </li>
			<li class="right"> Hi, <?php echo $_SESSION["user_name"] ?> </li>
		</ul>
	</nav>

	<content>

		<article class="navLeft">

			<table>
				<tr>
				<!-- <tr onClick="changeStyle('rightGeneral')"> -->
					<td><img src="img/generalIcon.png" class="icon"></td>
					<td valign="middle">General</td>
				</tr>
				<tr>
					<td><img src="img/privacyIcon.png" class="icon"></td>
					<td valign="middle">Privacy</td>
				</tr>
				<tr>
					<td><img src="img/teamsIcon.png" class="icon"></td>
					<td valign="middle">Teams</td>
				</tr>
				<tr>
					<td><img src="img/usersIcon.png" class="icon"></td>
					<td valign="middle">Users</td>
				</tr>
			</table>

		</article>


		<article class="rightArt" id="rightGeneral">

			<article id="edit" style="display: none">

				Edit alguma coisa aqui :)
			</article>

			<table class="general">
				<tr>
					<td class="title" valign="center"> First Name </td>
					<td class="middle" align="center" valign="center"> <?php echo $first_name ?> </td>
					<td align="right" class="edit" valign="center" onclick="changeToEdit('edit')" id="EditFName"> Edit </td>
				</tr>

				<tr>
					<td class="title" valign="center"> Last Name </td>
					<td class="middle" align="center" valign="center"> <?php echo $last_name ?> </td>
					<td align="right" class="edit" valign="center"> Edit </td>
				</tr>

				<tr>
					<td class="title" valign="center"> Telephone </td>
					<td class="middle" align="center" valign="center"> <?php echo $user_tel ?> </td>
					<td align="right" class="edit" valign="center"> Edit </td>
				</tr>

				<tr>
					<td class="title" valign="center"> Email </td>
					<td class="middle" align="center" valign="center"> <?php echo $user_mail ?> </td>
					<td align="right" class="edit" valign="center"> Edit </td>
				</tr>

				<tr display="none" id="admin">
					<td class="title" valign="center">  User Type </td>
					<td class="middle" align="center" valign="center"> <?php echo $user_type_description ?> </td>
					<td align="right" class="edit" valign="center"> Edit </td>
				</tr>
			</table>


		</article>







</html>