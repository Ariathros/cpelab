<!-- <?php
    include '../connections.php';
    include 'sessions.php';
?> -->

<!-- Equipment Reservation -->
<div class="student_equipment">
	<nav class="navbar navbar-expand-lg">
        <span class="navbar-text">
            Equipment Reservation
        </span>
		<a class="instruction fa fa-question-circle-o" data-bs-toggle="popover" data-bs-trigger="hover"
			title="Equipment Reservation" 
			data-bs-content="This page shows the current day's available equipment. Each piece of equipment has its number of items available, the name of the equipment, its category, and the button to borrow equipment.">
		</a>
    </nav>
    <hr>
    <div class="d-flex flex-wrap">
		<?php
			$sql = "SELECT * FROM equipments
			ORDER BY equip_name ASC";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					$equip_name = $row['equip_name'];
					$available = $row['available'];
					$description = $row['description'];
					$image_upload = $row['p_img'];

					echo "
					<div class='card' style='margin-right:20px;'>
						<h3 class='card-title' style='margin-top:5%; '>$equip_name</h3>
						<div class='card-body' style='margin-top:5%;margin-bottom:5%;'>
							<img src='../assets/images/$image_upload' class='card-img-top' alt='$image_upload' style='width:200px; height:200px; margin-bottom:5%'>
							<p class='card-text'>$description</p>
							<p class='card-text'>Remaining: $available</p>";
					if($available>0){
						echo "<A class='btn btn-primary' type='button' style='background-color:#800000; border:0px;' HREF='borrow.php?id=".$row["id"]."'>Borrow</A>";
					}
						echo" </div>
					</div>";
				}
			} else {
				echo "No Equipments Available Yet.";
			}
		?>
    </div>
</div>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script>
	$(document).ready(function(){
		$('[data-bs-toggle="popover"]').popover()
	})
</script>