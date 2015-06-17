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

include_once 'charts/lineChart.php';
include_once 'charts/barTest.php';


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
?>


<html>
<head>
	<title> Highest Good Network </title>
	<link href="styles/profile.css" rel="stylesheet">
	<link href="styles/basicStyle.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300,100' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="scripts/charts/canvasjs.min.js"></script>
	<script type="text/javascript" src="scripts/charts/membersxteam.js"></script>
	<script src="scripts/jquery.min.js"></script>
	<script src="scripts/chartphp.js"></script>
	<link rel="stylesheet" href="scripts/chartphp.css">
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

			<div id="chartContainer" style="height: 300px; width: 50%;">
	</div>
	<div id="connectionPhpJs0" style="display:none;">
		<?php echo json_encode($userNames);?>
	</div>
	<div id="connectionPhpJs1" style="display:none;">
		<?php echo json_encode($finalHours);?>
	</div>
	<div id="connectionPhpJs2" style="display:none;">
		<?php echo json_encode($finalDates);?>
	</div>
	<div id="connectionPhpJs3" style="display:none;">
		<?php echo json_encode($currentMonth);?>
	</div>
	<div id="connectionPhpJs4" style="display:none;">
		<?php echo json_encode($quantityDatesUser);?>
	</div>

		</article>

		<article class="artRight">

	
	<style>
		/* white color data labels */
		.jqplot-data-label{color:white;}
	</style>
	<div style="width:40%; min-width:50px; height:50%;">
		<?php echo $out ?>
	</div>

		</article>

	</content>

</body>
</html>