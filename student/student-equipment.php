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
		<a class="instruction fa fa-question-circle-o" data-bs-toggle="popover" 
			title="Equipment Reservation" 
			data-bs-content="This page shows the current day's available equipment. Each piece of equipment has its number of items available, the name of the equipment, its category, and the button to borrow equipment. Click the icon again to close this information.">
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
							<p class='card-text'>Remaining: $available</p>
							<A class='btn btn-primary' type='button' style='background-color:#800000; border:0px;' HREF='borrow.php?id=".$row["id"]."'>Borrow</A>
						</div>
					</div>";
				}
			} else {
				echo "No Equipments Available Yet.";
			}
		?>
    </div>

	<!-- <hr>

	<div class="table-holder" style="margin-top:20px;">
		<div class="table-rsrv">
			<table class="table">
				<thead >
					<TR>
						<TH SCOPE="COL">Equipment Code</TH>
						<TH SCOPE="COL">Equipment Name</TH>
						<TH SCOPE="COL">Category</TH>
						<TH SCOPE="COL">Description</TH>
						<TH SCOPE="COL">Available</TH>
						<TH SCOPE="COL">Actions</TH>
					</TR>
									
					<?php
						$sql = "SELECT * FROM equipments
						ORDER BY equip_name ASC";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								echo "<TR>
									<TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["equip_code"]. "</TD>
									<TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["equip_name"]. "</TD>
									<TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["category"]. "</TD>
									<TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["description"]. "</TD>
									<TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["available"]. "</TD>
									<TD style='border-bottom: solid 1px black; text-align: center;'>
										<A class='btn btn-primary' type='button' style='background-color:green; border:0px;' HREF='borrow.php?id=".$row["id"]."'>Borrow</A>
									</TD>
								</TR>";
							}
						} else {
							echo "<TR>
							<TD style='border-bottom: solid 1px black; text-align: center;'>No Equipments Available Yet.</TD>
							</TR>";
						}
					?>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div> -->
</div>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script>
	$(document).ready(function(){
		$('[data-bs-toggle="popover"]').popover()
	})
</script>