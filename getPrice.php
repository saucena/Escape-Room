<?php
$con = mysqli_connect("localhost", "root", "", "escape_room");

$room_id = mysqli_real_escape_string($con, $_GET["id"]);

$sql = "SELECT price, extra_cost 
		FROM room 
		WHERE id = '$room_id'";
$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_assoc($result)){
	$price = $row["price"];
	$extra_cost = $row["extra_cost"];
}

$answer = array("price"=>$price, "extra_cost"=>$extra_cost);
echo json_encode($answer);
?>