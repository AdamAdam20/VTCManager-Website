<?php
$json_trucky = file_get_contents("https://api.truckyapp.com/v2/traffic/top/?server=sim1&game=ets2");
$obj_trucky = json_decode($json_trucky);
for($i=0; $i < 10; $i++) {
echo '<a class="list-group-item list-group-item-action waves-effect">'.$obj_trucky->response[$i]->name;
echo ' <span class="badge badge-primary badge-pill pull-right">'.$obj_trucky->response[$i]->players.'</span>';
echo '</a>';
}
?>
