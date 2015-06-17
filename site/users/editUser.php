<?php

	session_start();
	session_regenerate_id();
	if(!isset($_SESSION['username']))      // if there is no valid session
	{
	    header("Location: index.php"); // SAIR
	}

	if ($_SESSION["user_type"]<>1){
		echo '<script> alert("You do not have permission to see this page"); window.location.href="../general"; </script>';
	}

	$username = $_SESSION['username'];
	$servername = $_SESSION['servername'];
	$user_db = $_SESSION['user_db'];
	$password_db = $_SESSION['password_db'];
	$dbname = $_SESSION['dbname'];

	$v = $_GET["v"];


	// Create connection
$conn = new mysqli($servername, $user_db, $password_db, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

	$sql = "SELECT user_id, user_first_name, user_last_name, user_type_id, user_tel, user_mail FROM User WHERE user_id = '{$v}'";
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

	<link href="../styles/setup.css" rel="stylesheet">
	<link href="../styles/basicStyle.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300,100' rel='stylesheet' type='text/css'>


	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script> 
	<script type="text/javascript" src="../scripts/script.js"></script> 	



</head>
<body>				
	<nav>
		<ul>
			<li> <a href="../profile.php"> PROFILE </a> </li>
			<li> <a href="#"> TASKS </a> </li>
			<li> <a href="#"> REPORTS </a> </li>
			<li> <a href="#" class="active"> SETUP </a> </li>
			<li> <a href="https://docs.google.com/spreadsheets/d/1bRcrZh3NT7Ya11cl_LQHDlfSD36UYbRfUcSNfBM4du8/edit#gid=0"> PORTAL </a> </li>
			<li class="right img"> <a href="../sessionStop.php"> <img src="../img/logoutIcon.png" alt="Logout"> </a> </li>
			<li class="right"> Hi, <?php echo $_SESSION["user_first_name"] . " " . $_SESSION["user_last_name"] ?> </li>
		</ul>
	</nav>

	<content>

		<article class="navLeft">


			<table>
				<tr onClick="location.href='../general'">
					<td><img src="../img/generalIcon.png" class="icon" name="General"></td>
					<td valign="middle">General</td>
				</tr>
				<tr onClick="location.href='../privacy'">
					<td><img src="../img/privacyIcon.png" class="icon" name="Privacy"></td>
					<td valign="middle">Privacy</td>
				</tr>
				<tr onClick="location.href='../users'">
					<td><img src="../img/usersActiveIcon.png" class="icon" name="Users"></td>
					<td valign="middle">Users</td>
				</tr>
				<tr onClick="location.href='../teams'">
					<td><img src="../img/teamsIcon.png" class="icon" name="Teams"></td>
					<td valign="middle">Teams</td>
				</tr>
			</table>

		</article>



		<article class="rightArt" id="General">

			<form action="changeUser.php" method="post" id="changeUserForm">
			<input type="hidden" name="user_id" value="<?php echo $v; ?>">

			<table>
				<tr>
						<td class="title"> First Name </td>
						<td class="wrapper"> 
	  						<input type="text" value="<?php echo $first_name ?>" name="first_name_new">
	  					</td>
  				</tr>

  				<tr>
						<td class="title"> Last Name </td>
						<td class="wrapper"> 
	  						<input type="text" value="<?php echo $last_name ?>" name="last_name_new">
	  					</td>
  				</tr>

  				<tr>
						<td class="title"> Email Address </td>
						<td class="wrapper"> 
	  						<input type="text" value="<?php echo $user_mail ?>" name="email_new">
	  					</td>
  				</tr>

  				<tr>
						<td class="title"> Phone Number </td>
						<td class="wrapper"> 
	  						<input type="text" value="<?php echo $user_tel ?>" name="tel_new">
	  					</td>
  				</tr>

  				<tr>
						<td class="title"> User Type </td>
						<td class="wrapper"> 
	  						<div class="styled-select">
	  						<select name="user_type_new">
	  						
							<?php 

							$sql3 = "SELECT user_type_id, user_type_description FROM user_type";
							$result3 = mysqli_query($conn, $sql3);
							if ($result3 || mysqli_num_rows($result3) ) {
								while ($row3 = mysqli_fetch_assoc($result3)){
									$user_type_id_s = $row3["user_type_id"];
									$user_type_description_s = $row3["user_type_description"];

									echo "<option value='";
									echo $user_type_id_s;
									echo "' ";

									if ($user_type_id == $user_type_id_s) {
										echo "selected";
									}

									echo "> ";
									echo $user_type_description_s;
									echo "</option>";
								}
							}


							?>
							
							</select>
							</div>
	  					</td>
  				</tr>


  			</table>

  			<table id="tabela_submit" class="high_table">

				<tr onclick="document.getElementById('changeUserForm').submit()">
					<td colspan=4 class="edit"> SUBMIT </td>
				</tr>

  			</form>
				<form action="deleteUser.php" method="post" id="deleteUser">
				<input type="hidden" name="user_id" value="<?php echo $v ?>">
				<tr onclick="pergunta()">
					<td colspan=4 class="delete"> DELETE USER </td>
				</tr>
				</form>

			</table>

  		</article>

 	</content>
 	<script>
		function pergunta() {
			if (confirm('Are you sure you want to delete this user?')){
				document.getElementById('deleteUser').submit();
			} else {
				return false;
			}
		}			
	</script>
 </body>
 </html>