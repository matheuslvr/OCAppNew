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

$user_id = "";
$user_first_name = "";
$user_type_id = "";
$user_tel = "";
$user_mail = "";

$sql = "SELECT user_id, user_first_name, user_last_name, user_type_id, user_tel, user_mail FROM User WHERE user_login = '{$username}'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result)) {
    $row = mysqli_fetch_assoc($result);
    $user_id = $row["user_id"];
    $user_first_name = $row["user_first_name"];
    $user_last_name = $row["user_last_name"];
    $_SESSION["user_first_name"] = $user_first_name;
    $_SESSION["user_last_name"] = $user_last_name;
    $user_type_id = $row["user_type_id"];
    $user_tel = $row["user_tel"];
    $user_mail = $row["user_mail"];
}

$sql2 = "SELECT user_type_description FROM User_type WHERE user_type_id = '{$user_type_id}'";
$result2 = mysqli_query($conn, $sql2);
if (mysqli_num_rows($result2)) {
	$row = mysqli_fetch_assoc($result2);
	$user_type_id = $row["user_type_description"];
}

$number_teams = 0;
$sql4 = "SELECT team_description FROM Team WHERE team_id IN (SELECT team_id FROM User_team WHERE user_id = '{$user_id}')";
$result4 = mysqli_query($conn, $sql4);
while ($row = mysqli_fetch_assoc($result4)) {
	$number_teams++;
}

$hours_tasks = 0;
$number_tasks = 0;
$sql5 = "SELECT user_task_id, task_id FROM User_task WHERE user_id='{$user_id}'";
$result5 = mysqli_query($conn, $sql5);
if ($result5) {
	while ($row = mysqli_fetch_assoc($result5)) {
		$number_tasks += 1;
		$task_id = $row["task_id"];
		$sql6 = "SELECT task_time FROM Task WHERE task_id = '{$task_id}'";
		$result6 = mysqli_query($conn, $sql6);
		if (mysqli_num_rows($result6) > 0) {
			while ($row2 = mysqli_fetch_assoc($result6)) {
				$hours_tasks += $row2["task_time"];
			}
		}
		
	}
}

?>


<html>
<head>
	<title> Highest Good Network </title>
	<link href="styles/profile.css" rel="stylesheet">
	<link href="styles/basicStyle.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300,100' rel='stylesheet' type='text/css'>
</head>
<body>

	<nav>
		<ul>
			<li> <a href="#" class="active"> PROFILE </a> </li>
			<li> <a href="#"> TASKS </a> </li>
			<li> <a href="#"> REPORTS </a> </li>
			<li> <a href="general"> SETUP </a> </li>
			<li> <a href="https://docs.google.com/spreadsheets/d/1bRcrZh3NT7Ya11cl_LQHDlfSD36UYbRfUcSNfBM4du8/edit#gid=0"> PORTAL </a> </li>
			<li class="right img"> <a href="sessionStop.php"> <img src="img/logoutIcon.png" alt="Logout"> </a> </li>
			<li class="right"> Hi, <?php echo $user_first_name . " " . $user_last_name ?> </li>
		</ul>
	</nav>

	<content>

		<article class="artLeft">

			<img src="img/pictureIcon.png">

		</article>

		<article class="artRight">

			<h1> <?php echo $user_first_name . " " . $user_last_name ?> </h1> <!-- PHP AQUI FOFÍSSIMA -->


			<table>
				<tr>
					<td><img src="img/loginIcon.png" title="Login" class="icon"></td>
					<td valign="middle"><?php echo $username ?></td>
				</tr>
				<tr>
					<td><img src="img/userTypeIcon.png" title="Role" class="icon"></td>
					<td valign="middle"><?php echo $user_type_id ?></td>
				</tr>
				<tr>
					<td><img src="img/phoneIcon.png" title="Phone" class="icon"></td>
					<td valign="middle"><?php echo $user_tel ?></td>
				</tr>
				<tr>
					<td><img src="img/emailIcon.png" title="Email" class="icon"></td>
					<td valign="middle"><?php echo $user_mail ?></td>
				</tr>
			</table>

		</article>

	</content>


	<footer>

		<!-- PHP AQUI TAMBEM -->

		<div class="footLeft">

			<h1 class="test"> <?php echo $hours_tasks ?> </h1>
			<h2 class="test"> Hours </h2>
			<h3 class="test"> /week </h3>

		</div>

		<div class="footMid">

			<h1 class="test"> <?php echo $number_teams; ?> </h1>
			<h2 class="test"> Teams </h2>

		</div>

		<div class="footRight">

			<h1 class="test"> <?php echo $number_tasks ?></h1>
			


			<h2 class="test"> Tasks </h2>

		</div>

	</footer>

</body>
</html>