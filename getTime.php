<?php
$con = mysqli_connect("localhost", "root", "", "escape_room");

$date = mysqli_real_escape_string($con, $_GET["date"]);
$room = mysqli_real_escape_string($con, $_GET["room"]);

$busy_time = array();

$sql = "SELECT reservation_time AS time 
		FROM reservation 
		WHERE reservation_date = '$date'
		AND room_id = '$room'
		ORDER BY reservation_time";

$result = mysqli_query($con, $sql);
if(mysqli_num_rows($result)>0){
	while($row = mysqli_fetch_assoc($result)){
		array_push($busy_time, date("G:i", strtotime($row["time"])));
	}
}

echo json_encode($busy_time);
?>