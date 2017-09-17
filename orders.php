<?php
include 'loginValidation.php';
$_SESSION["url"] = "orders.php";
include 'headerHead.php';
include 'headerBody.php';

$con = mysqli_connect("localhost", "root", "", "escape_room");
?>


<div class="row">
	<div class="col-lg-12">
		<div class="page-header">
			<h1>Rezervacijos</h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 table-responsive">
		<table id="orders" class="table table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Vardas</th>
					<th>Pavardė</th>
					<th>Tel. numeris</th>
					<th>El.paštas</th>
					<th>Kambarys</th>
					<th>Data</th>
					<th>Laikas</th>
					<th>Dalyvių skaičius</th>
					<th>Kaina</th>
					<th>Pastabos</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$sql = "SELECT reservation.*, room.name
						FROM reservation
						LEFT JOIN room
						ON reservation.room_id = room.id
						ORDER BY id";
						
				mysqli_set_charset($con, 'utf8mb4');
				$result = mysqli_query($con, $sql);
				
				$x = 1;
				while($row = mysqli_fetch_assoc($result)){
					?><tr data-reservation=<?php echo $row["id"];?>>
						<td><?php echo htmlspecialchars($x); ?></td>
						<td><?php echo htmlspecialchars($row["first_name"]); ?></td>
						<td><?php echo htmlspecialchars($row["last_name"]); ?></td>
						<td><?php echo htmlspecialchars($row["phone_num"]); ?></td>
						<td><?php echo htmlspecialchars($row["email_addr"]); ?></td>
						<td><?php echo htmlspecialchars($row["name"]); ?></td>
						<td><?php echo htmlspecialchars($row["reservation_date"]); ?></td>
						<td><?php echo date("G:i", strtotime(htmlspecialchars($row["reservation_time"]))); ?></td>
						<td><?php echo htmlspecialchars($row["player_count"]); ?></td>
						<td><?php echo htmlspecialchars($row["price"])."&euro;"; ?></td>
						<td><?php echo htmlspecialchars($row["comment"]); ?></td>
						<?php $x++;
				}
				?>
			</tbody>
		</table>
	</div>
</div>

<script>
$(document).ready(function(){
	$("#orders").DataTable({
		"language": {
			"lengthMenu": "Rodyti _MENU_ užsakymų(-us) per puslapį",
			"zeroRecords": "Nieko nerasta - atsiprašome",
            "info": "Rodomas _PAGE_ puslapis iš _PAGES_",
            "infoEmpty": "Nėra jokių užsakymų",
            "infoFiltered": "(išrinkta iš _MAX_ užsakymų)",
			"search": "Paieška:",
			"paginate": {
				"first":      "Pirmas",
				"last":       "Paskutinis",
				"next":       "Kitas",
				"previous":   "Ankstesnis"
			}
		}
	});
});
</script>



<?php
include 'headerFooter.php';
?>