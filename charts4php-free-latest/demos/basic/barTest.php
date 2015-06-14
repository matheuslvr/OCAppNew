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

$sql5 = "SELECT category_id, category_description FROM Category";
$result5 = mysqli_query($conn, $sql5);
if (mysqli_num_rows($result5) > 0) {
	while ($row = mysqli_fetch_assoc($result5)) { //run while the lines are not empty
		$task_time_temp = 0;
		$category_id_temp = $row["category_id"];
		$category_name_task[$counter] = $row["category_description"];
		$sql6 = "SELECT task_time FROM Task WHERE category_id = '{$category_id_temp}'";
		$result6 = mysqli_query($conn, $sql6);
		if (mysqli_num_rows($result6) > 0) {
			while ($row = mysqli_fetch_assoc($result6)) {
				$task_time_temp = $task_time_temp + $row["task_time"];
			}
			$time_task[$counter] = $task_time_temp;
		}
		else{
			$time_task[$counter] = 0;
		}
		$counter++;
	}
}

$p = new chartphp();

$arrlength = count($category_name_task);
// creating the arrays
for($x = 0; $x < $arrlength; $x++){

$arrays[$x] = array($category_name_task[$x], (int)$time_task[$x]);

}

$p->data = array($arrays); // Set the arrays as the data to print the graph

$p->chart_type = "bar";

// Common Options
$p->title = "Categories x Hours";
$p->xlabel = "";
$p->ylabel = "Hours";

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


