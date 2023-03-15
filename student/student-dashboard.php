<!-- <?php
	include '../connections.php';	
	include 'sessions.php';
?> -->

<div class="dashboard">
	<DIV style="padding-top:24px;">
		<H1 class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #952D2D; color: white;">
			<span>Student Dashboard</span>
			<a class="instruction fa fa-question-circle-o" data-bs-toggle="popover" data-bs-trigger="hover"
				title="Dashboard" 
				data-bs-content="This page shows tables for all the reservations made for reserving rooms and borrowing equipment. The tables are the summary of all the requests made. If you wish to create a reservation, look at the left side and choose the category you want to create a reservation.">
			</a>
		</H1>
	</DIV>
	<hr>
	<div class="reservations">
		<div class="table-holder">
			<div class="table-title">
				Room Reservations
			</div>
			<div class="table-rsrv">
				<table class="table">
					<thead >
						<TR>
							<TH SCOPE="COL">Room No.</TH>
							<TH SCOPE="COL">Type</TH>
							<TH SCOPE="COL">Reason</TH>
							<TH SCOPE="COL">Date</TH>
							<TH SCOPE="COL">Time</TH>
							<TH SCOPE="COL">Status</TH>
						</TR>

						<?php
							// SHOW ROOM RESERVATIONS
							$username = $_SESSION['username'];
							$sql = "SELECT * FROM room_man WHERE borrower='$username' ORDER BY date ASC, time_start ASC";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									$t1 = strtotime($row['time_start']);
									$t2 = strtotime($row['time_end']);
									$time_start = date('h:i A',$t1);
									$time_end = date('h:i A',$t2);

									echo "<TR>
										<TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["room_no"]. "</TD>
										<TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["room_type"]. "</TD>
										<TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["reason"]. "</TD>								
										<TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["date"]. "</TD>
										<TD style='border-bottom: solid 1px black; text-align: center;'>$time_start - $time_end</TD>
										<TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["status"]. "</TD>
										</TR>";
								}
							} else {
								echo "<TR><TD>Your room reservation is empty</TD></TR>";
							}
						?>
					</thead>
				</table>
			</div>
		</div>
							
		<div class="table-holder" style="margin-top:20px;">
			<div class="table-title">
				Equipment Reservations
			</div>
			<div class="table-rsrv">
				<table class="table">
					<thead >
						<TR>
							<TH SCOPE="COL">Item Name</TH>
							<TH SCOPE="COL">Reason</TH>
							<TH SCOPE="COL">Category</TH>
							<TH SCOPE="COL">Quantity</TH>
							<TH SCOPE="COL">Date</TH>
							<TH SCOPsE="COL">Time</TH>
							<TH SCOPE="COL">Status</TH>
						</TR>
										
						<?php
							// SHOW EQUIPMENT RESERVATIONS
							$username = $_SESSION['username'];
							$sql = "SELECT * FROM eq_man WHERE borrower='$username' ORDER BY date ASC, time_start ASC";
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									$t1 = strtotime($row['time_start']);
									$t2 = strtotime($row['time_end']);
									$time_start = date('h:i A',$t1);
									$time_end = date('h:i A',$t2);
		
									echo "<TR>
										<TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["name"]. "</TD>
										<TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["reason"]. "</TD>
										<TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["category"]. "</TD>										
										<TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["qty"]. "</TD>									
										<TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["date"]. "</TD>
										<TD style='border-bottom: solid 1px black; text-align: center;'>$time_start - $time_end</TD>
										<TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["status"]. "</TD>
									</TR>";
								}
							} else {
								echo "<TR><TD>Your equipment reservation is empty</TD></TR>";
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
<!-- Hover effect -->
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script>
	$(document).ready(function(){
		$('[data-bs-toggle="popover"]').popover()
	})
</script>