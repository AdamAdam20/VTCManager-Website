<?php
include '../get_user_data.php'; 
$day = date('w');
$week_start = date('Y-m-d', strtotime('-'.$day.' days + 1 day'));
$date = new DateTime();
$week = $date->format("W");
$sql = "SELECT username, departure, destination, cargo FROM tour_table WHERE companyID=$user_company_id ORDER BY tour_date DESC LIMIT 3";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		echo "<tr><td>".$row['departure']."</td><td>".$row['destination']."</td><td>".$row['cargo']."</td><td>".$row['username']."</td></tr>";
    }
    }else{
        }
        ?>
