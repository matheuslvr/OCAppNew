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


// Execute query and get the variables from the database
$counter = 0;


$sql5 = "SELECT user_id, user_first_name, user_week_hrs FROM user";
$result5 = mysqli_query($conn, $sql5);
if (mysqli_num_rows($result5) > 0) {
    while ($row = mysqli_fetch_assoc($result5)) { //run while the lines are not empty
        $task_time_temp = 0;
        $user_id_temp = $row["user_id"];
        $user_name_temp[$counter] = $row["user_first_name"];
        $user_week_hrs_temp[$counter] = $row["user_week_hrs"];

        $sql6 = "SELECT task_id FROM task WHERE user_id = '{$user_id_temp}'";
        $result6 = mysqli_query($conn, $sql6);
        if (mysqli_num_rows($result6) > 0) {
            while ($row = mysqli_fetch_assoc($result6)) {
                $task_id_temp = $row["task_id"];

                $sql7 = "SELECT sub_task_time FROM sub_task WHERE task_id = '{$task_id_temp}'";
                $result7 = mysqli_query($conn, $sql7);
                if (mysqli_num_rows($result7) > 0) {
                    while ($row = mysqli_fetch_assoc($result7)) {
                        $task_time_temp = $task_time_temp + $row["sub_task_time"];
                    }
                    $time_task[$counter] = $task_time_temp;
                    
                }
                else{
                    $time_task[$counter] = 0;
                }
                
            }

           // $time_task[$counter] = $task_time_temp;
        }
        $counter++;
    }
}



function getPercent($current, $max){
    $percent = round(($current/$max)*100);
    return $percent;
}

function getColor($current, $max){
    $color = color($current,$max);
    return $color;
}


// set the colors based on % of the bar
function color($current, $max) {
    $percent = getPercent($current,$max);

    $green = round(($percent*255)/100);
    $red = 255-$green;
    if (($percent > 0) && ($current <= $max)) {
	//$rgb = "rgb(255, 0, 00)";
   
    return "rgb(" . $red . ", " . $green . ", 00)";
    } else {
        if(($percent > 0) && ($current > $max)){
            return "rgb(105, 73, 166)";
        }
    }

} 


function printColor($num_h, $num_len){


    if($num_h <= $num_len){
        echo hpbar($num_h, $num_len);
    } else {
        $num_h = $num_len+0.000001;
        echo hpbar($num_h, $num_len);

    }


}



?>
 <!DOCTYPE html>
 <html>
 <head>
    <style>
        p{
           float: right;
        }
    </style>

 </head>
 <body>

    <table style="">
            <?php 
            for($i=0; $i<count($user_name_temp); $i++){
                $percent = getPercent($time_task[$i], $user_week_hrs_temp[$i]);
                $color = getColor($time_task[$i], $user_week_hrs_temp[$i]);
                if($time_task[$i] > $user_week_hrs_temp[$i]){
                    $percent = getPercent($user_week_hrs_temp[$i]+0.01, $user_week_hrs_temp[$i]);
                echo "<tr><td>" . $user_name_temp[$i] . "</td>";
                echo "<td>" . "<div style='border-radius: 10px; margin-right: 91%; border: 1px solid; background: #FFF; width: 100px; height: 5px;'><div style='width: " . $percent . "%; background-color: " . $color . "; border-radius: 10px; height: 5px;'></div></div>" . "</td>";
                echo "<td>" . $user_week_hrs_temp[$i] . " + " . "</td>";
                echo "<td>" . ((int)$time_task[$i] - (int)$user_week_hrs_temp[$i]) . "</td></tr>";// nao ta pegando o menos como operacao
                } else{

                echo "<tr><td>" . $user_name_temp[$i] . "</td>";
                echo "<td>" . "<div style='border-radius: 10px; margin-right: 91%; border: 1px solid; background: #FFF; width: 100px; height: 5px;'><div style='width: " . $percent . "%; background-color: " . $color . "; border-radius: 10px; height: 5px;'></div></div>" . "</td>";
                echo "<td>" . $time_task[$i] . "</td></tr>";
            }
            } 
            ?>
    </table>

</body>

 </html>
