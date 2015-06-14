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
$user_name = "";
$user_type_id = "";
$user_tel = "";
$user_mail = "";
$day_hour = "";
date_default_timezone_set('America/Los_Angeles');

if(date("h") >= 0 && date("h") < 12){
	$day_hour = "Good morning";
}
else if(date("h") >= 12 && date("h") < 18){
	$day_hour = "Good afternoon";
}
else if(date("h") >= 18 && date("h") < 24){
	$day_hour = "Good evening";
}
else{
	$day_hour = "Hi";
}

$sql = "SELECT user_id, user_first_name, user_last_name, user_type_id, user_tel, user_mail FROM User WHERE user_login = '{$username}'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result)) {
    $row = mysqli_fetch_assoc($result);
    $user_id = $row["user_id"];
    $user_name = $row["user_first_name"] . " ";
    $user_name .= $row["user_last_name"];
    $_SESSION["user_name"] = $user_name;
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

$sql3 = "SELECT team_id FROM User_team WHERE user_id='{$user_id}'";
$result3 = mysqli_query($conn, $sql3);
if (mysqli_num_rows($result3)) {
	$row = mysqli_fetch_assoc($result3);
	$user_team = $row["team_id"];
}

$sql4 = "SELECT team_description FROM Team WHERE team_id='{$user_team}'";
$result4 = mysqli_query($conn, $sql4);
if (mysqli_num_rows($result4)) {
	$row = mysqli_fetch_assoc($result4);
	$user_team = $row["team_description"];
}

$hours_tasks = 0;
$number_tasks = 0;
$sql5 = "SELECT user_task_id, task_id FROM User_task WHERE user_id='{$user_id}'";
$result5 = mysqli_query($conn, $sql5);
if (mysqli_num_rows($result5) > 0) {
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
			<li> <a href="profile.php" class="active"> PROFILE </a> </li>
			<li> <a href="tasks.php"> TASKS </a> </li>
			<li> <a href="#"> REPORTS </a> </li>
			<li> <a href="setup.php"> SETUP </a> </li>
			<li> <a href="#"> PORTAL </a> </li>
			<li class="right img"> <a href="sessionStop.php"> <img src="img/logoutIcon.png" alt="Logout"> </a> </li>
			<li class="right"> <?php echo $day_hour ?>, <?php echo $user_name ?> </li>
		</ul>
	</nav>

	<content>

		<article class="artLeft">

			<img src="img/pictureIcon.png">

		</article>

		<article class="artRight">

			<h1> <?php echo $user_name ?> </h1> <!-- PHP AQUI FOFÍSSIMA -->


			<table>
				<tr>
					<td><img src="img/loginIcon.png" class="icon"></td>
					<td valign="middle"><?php echo $username ?></td>
				</tr>
				<tr>
					<td><img src="img/userTypeIcon.png" class="icon"></td>
					<td valign="middle"><?php echo $user_type_id ?></td>
				</tr>
				<tr>
					<td><img src="img/phoneIcon.png" class="icon"></td>
					<td valign="middle"><?php echo $user_tel ?></td>
				</tr>
				<tr>
					<td><img src="img/emailIcon.png" class="icon"></td>
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

			<h1 class="test"> <?php echo $user_team ?> </h1>
			<h2 class="test"> Team </h2>

		</div>

		<div class="footRight">

			<h1 class="test"> <?php echo $number_tasks ?> </h1>
			<h2 class="test"> Tasks </h2>

		</div>

	</footer>

</body>
</html>