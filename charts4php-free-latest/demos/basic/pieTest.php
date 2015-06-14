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


// Execute query and get the variables from the database
$counter = 0;
$sql5 = "SELECT task_name, task_time FROM Task";
$result5 = mysqli_query($conn, $sql5);
if (mysqli_num_rows($result5) > 0) {
	while ($row = mysqli_fetch_assoc($result5)) { // run while the lines are not empty
		
		$name_task[$counter] = $row["task_name"];
		$time_task[$counter] = $row["task_time"];
		$counter++;
	}
}

$arrlength = count($name_task);

$p = new chartphp();

// creating the arrays
for($x = 0; $x < $arrlength; $x++){

$arrays[$x] = array($name_task[$x], (int)$time_task[$x]);

}

$p->data = array($arrays); // Set the arrays as the data to print the graph

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


