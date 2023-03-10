<?php
	include '../connections.php';	
	include 'sessions.php';
?>

<div class="dashboard">
	<nav class="navbar">
        <span class="navbar-text">
            Dashboard
        </span>
    </nav>
	<hr>
	<div class="reservations">
		<div class="table-holder">
			<div class="table-title">My Reservations</div>
			<div class="table-rsrv">
				<table class="table">
					<thead >
						<TR>
							<TH SCOPE="COL">Room No.</TH>
							<TH SCOPE="COL">Type</TH>
							<TH SCOPE="COL">Reason</TH>
							<TH SCOPE="COL">Time</TH>
							<TH SCOPE="COL">Status</TH>
						</TR>

						<!-- php -->
						<?php
							$username = $_SESSION['username'];
							$sql = "SELECT * FROM room_man WHERE borrower='$username'";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
							// output data of each row
								while($row = $result->fetch_assoc()) {
									echo "<TR>
										<TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["room_no"]. "</TD>
										<TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["room_type"]. "</TD>
										<TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["reason"]. "</TD>
										<TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["time_start"]." - " . $row["time_end"]. "</TD>
										<TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["status"]. "</TD>
										</TR>";
								}
							} else {
								echo "<TR><TD>No reservations found.</TD></TR>";
							}
						?>
					</thead>
				</table>
			</div>
		</div>
							
		<div class="table-holder" style="margin-top:20px;">
			<div class="table-title">Equipment Reservations</div>
			<div class="table-rsrv">
				<table class="table">
					<thead >
						<TR>
							<TH SCOPE="COL">Item Name</TH>
							<TH SCOPE="COL">Reason</TH>
							<TH SCOPE="COL">Category</TH>
							<TH SCOPsE="COL">Time</TH>
							<TH SCOPE="COL">Status</TH>
						</TR>
											
						<!-- php -->
						<?php
							$username = $_SESSION['username'];
							$sql = "SELECT * FROM eq_man WHERE borrower='$username'";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
									echo "<TR>
										<TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["name"]. "</TD>
										<TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["reason"]. "</TD>
										<TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["category"]. "</TD>
										<TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["time_start"]." - " . $row["time_end"]. "</TD>
										<TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["status"]. "</TD>
									</TR>";
								}
							} else {
								echo "<TR><TD>No records of borrowed equipments.</TD></TR>";
							}
						?>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>