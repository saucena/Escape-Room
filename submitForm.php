<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "escape_room");

$first_name = mysqli_real_escape_string($con, $_POST["first_name"]);
$last_name = mysqli_real_escape_string($con, $_POST["last_name"]);
$phone_number = mysqli_real_escape_string($con, $_POST["phone_number"]);
$email = mysqli_real_escape_string($con, $_POST["email"]);
$comment = mysqli_real_escape_string($con, $_POST["comment"]);
$room_id = mysqli_real_escape_string($con, $_POST["room"]);
$date = mysqli_real_escape_string($con, $_POST["date"]);
$time = mysqli_real_escape_string($con, $_POST["time"]);
$players = mysqli_real_escape_string($con, $_POST["players"]);

$sql = "SELECT id 
		FROM reservation 
		WHERE room_id = '$room_id' 
		AND reservation_date = '$date' 
		AND reservation_time = '$time'";

mysqli_set_charset($con, 'utf8mb4');
$result = mysqli_query($con, $sql);

if(!empty($_POST["token"])){
	if(mysqli_num_rows($result)== 0 && hash_equals($_SESSION["token"], $_POST["token"])){
		$price_total = $price = $extra_cost = 0;
		$players = intval($players);

		$sql = "SELECT price, extra_cost 
				FROM room 
				WHERE id = $room_id";
				
		$result = mysqli_query($con, $sql);

		while($row = mysqli_fetch_assoc($result)){
			$price = intval($row["price"]);
			$extra_cost = intval($row["extra_cost"]);
		}

		if($players>6){
			$price_total = $price + $extra_cost * (intval($players) - 6);
		}
		else{
			$price_total = $price;
		}

		$sql = "INSERT INTO reservation(first_name, last_name, phone_num, email_addr, comment, room_id, reservation_date, reservation_time, player_count, price) 
				VALUES ('$first_name', '$last_name', '$phone_number', '$email', '$comment', '$room_id', '$date', '$time', '$players', '$price_total')";
		mysqli_query($con, $sql);
		echo "1"; //viskas gerai
	}
	else{
		echo "2"; //tokenas nelygus arba yra tokiu pat laiku
	}
}
else{
	echo "3"; //tokeno nera
}
?>