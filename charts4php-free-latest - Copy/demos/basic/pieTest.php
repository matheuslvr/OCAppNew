<?php
/**
 * Charts 4 PHP
 *
 * @author Shani <support@chartphp.com> - http://www.chartphp.com
 * @version 1.2.1
 * @license: see license.txt included in package
 */
 
include("../../lib/inc/chartphp_dist.php");

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



$counter1 = 0;
$counter = 0;
//$time_task = array(0);
//$name_task = array("");
$sql5 = "SELECT task_name FROM Task WHERE task_name IS NOT NULL";
$result5 = mysqli_query($conn, $sql5);
if (mysqli_num_rows($result5) > 0) {
	while ($row = mysqli_fetch_assoc($result5)) {
		
		$name_task[$counter] = $row["task_name"];
//		$time_task[$counter] = $row["task_time"];
//		echo $counter;
//		echo $time_task[$counter];
		$counter++;
		//echo $name_task[1];
//		echo $time_task[$counter];

//		echo $time_task[$counter];
//		echo $row["task_time"];
	}
}
$sql6 = "SELECT task_time FROM Task WHERE task_time IS NOT NULL";
$result6 = mysqli_query($conn, $sql6);
if (mysqli_num_rows($result6) > 0) {
	while ($row = mysqli_fetch_assoc($result6)) {
		
//		$name_task[$counter] = $row["task_name"];
		$time_task[$counter1] = $counter+1;
//		echo $counter;
		
		$counter1++;
		//echo $name_task[1];
//		echo $time_task[$counter];

//		echo $time_task[$counter];
//		echo $row["task_time"];
	}
}

echo $time_task[0];
		echo "<br>";
		echo $time_task[1];
/*
$cars = array("Volvo", "BMW", "Corsa", "uhaseua", "hahaha", "hhhhhh");
$arrlength = count($cars);
$num = array(17, 35, 17, 17, 17, 20);
$numlength = count($num);
*/
 
$num = array(8.5, 7.5);

$arrlength = count($name_task);
//echo $arrlength;
$p = new chartphp();

for($x = 0; $x < $arrlength; $x++){

$arrays[$x] = array($name_task[$x], $time_task[$x]);

}
//echo $time_task[0] . $time_task[1];

$p->data = array($arrays);


$p->chart_type = "pie";

// Common Options
$p->title = "Pie Chart";

$out = $p->render('c1');


?>
<!DOCTYPE html>
<html>
	<head>
		<script src="../../lib/js/jquery.min.js"></script>
		<script src="../../lib/js/chartphp.js"></script>
		<link rel="stylesheet" href="../../lib/js/chartphp.css">

	<style>
		/* white color data labels */
		.jqplot-data-label{color:white;}
	</style>
	</head>
	
	<body>
		<div style="width:40%; min-width:450px;">
		<?php echo $out; ?>

		</div>
	</body>
</html>


