<?php
date_default_timezone_set('Europe/Berlin');
//hole alle Touren aus der DB der Firma
$sql = "SELECT * FROM user_data WHERE userCompanyID=1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$employee_userID = $row["userID"];
        $employee_username = $row["username"];
		$employee_avatar_url = $row["profile_pic_url"];
		$employee_rank = $row["rank"];
		$employee_time_online_raw = $row["last_seen"];
		if(strtotime($employee_time_online_raw) > strtotime("-2 minutes")) {
			$employee_online_status = "online";
			}else{
				/*
				$employee_time_online = new DateTime($employee_time_online_raw);
				$since = $employee_time_online->diff(new DateTime());
				if($since->y == 0){
					if($since->m == 0){
						if($since->d == 0){
							if($since->h == 0){
								$since_conv = $since->i." Minuten";
								}else{
									$since_conv = $since->h." Stunden ".$since->i." Minuten";
									}
							}else{
								$since_conv = $since->d." Tage ".$since->h." Stunden ".$since->i." Minuten";
								}
						}else{
							$since_conv = $since->m." Monaten ".$since->d." Tage ".$since->h." Stunden ".$since->i." Minuten";
							}
					}else{
						$since_conv = $since->y." Jahren ".$since->m." Monaten ".$since->d." Tage ".$since->h." Stunden ".$since->i." Minuten";
						}*/
						$employee_time_online_raw = date('d.m.Y H:i', strtotime($employee_time_online_raw));
				$employee_online_status = "zuletzt online ".$employee_time_online_raw;
				}
		$sql2 = "SELECT * FROM tour_table WHERE username='$employee_username' AND companyID=1 AND status='accepted'";
		$result2 = $conn->query($sql2);
		$employee_tours = $result2->num_rows;
		$sql2 = "SELECT * FROM career_table WHERE username='$employee_username' AND atCompanyID=1 AND end_date=0000-00-00";
		$result2 = $conn->query($sql2);
		if ($result2->num_rows > 0) {
			while($row2 = $result2->fetch_assoc()) {
				$employee_joined_date = $row2["start_date"];
			}
		}else{
			$employee_joined_date = "nicht abrufbar";
			}
		echo "<tr data-id='$found_tour_username,$found_tour' id='$found_tour_username,$found_tour' >";
		?>
		<td><img class="profilePicture" src="<?php echo $employee_avatar_url;?>"><?php echo $employee_username; ?></td>
		<td><?php echo $employee_rank; ?></td>
		<td><?php echo $employee_joined_date; ?></td>
		<td><?php echo $employee_tours; ?></td>
		<td><?php echo $employee_online_status; ?></td>
		</tr>
		<?php
    }
} else {
	echo "In deiner Firma befinden sich keine Mitarbeiter.";
}
?> 
