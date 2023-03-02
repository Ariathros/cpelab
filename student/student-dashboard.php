<?php
	include '../connections.php';	
	include 'sessions.php';
?>

<HTML>
	<HEAD>
		<TITLE>Dashboard - CPE Lab Room and Equipment Management System</TITLE>
	</HEAD>
	
	<BODY>		
		<DIV>
			<?php include 'sidebar.php'; ?>
		</DIV>

		<DIV>
			<H1>Dashboard</H1>
		</DIV>

		<DIV>
			<H2>Room Reservations</H2>
			<TABLE>
				<TR>
					<TH SCOPE="COL">Room No.</TH>
					<TH SCOPE="COL">Type</TH>
					<TH SCOPE="COL">Reason</TH>
					<TH SCOPE="COL">Time</TH>
					<TH SCOPE="COL">Status</TH>
				</TR>

				<?php
					$username = $_SESSION['username'];
					$sql = "SELECT * FROM room_man WHERE borrower='$username'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							echo "<TR>
								<TD>" . $row["room_no"]. "</TD>
								<TD>" . $row["room_type"]. "</TD>
								<TD>" . $row["reason"]. "</TD>
								<TD>" . $row["time_start"]." - " . $row["time_end"]. "</TD>
								<TD>" . $row["status"]. "</TD>
							</TR>";
						}
					} else {
						echo "<TR><TD>No reservations found.</TD></TR>";
					}
				?>
			</TABLE>
		</DIV>

		<DIV>
			<H2>Equipment Reservations</H2>
			<TABLE>
				<TR>
					<TH SCOPE="COL">Item Code</TH>
					<TH SCOPE="COL">Reason</TH>
					<TH SCOPE="COL">Category</TH>
					<TH SCOPsE="COL">Time</TH>
					<TH SCOPE="COL">Status</TH>
				</TR>

				<?php
					$username = $_SESSION['username'];
					$sql = "SELECT * FROM eq_man WHERE borrower='$username'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							echo "<TR>
								<TD>" . $row["code"]. "</TD>
								<TD>" . $row["reason"]. "</TD>
								<TD>" . $row["category"]. "</TD>
								<TD>" . $row["time_start"]." - " . $row["time_end"]. "</TD>
								<TD>" . $row["status"]. "</TD>
							</TR>";
						}
					} else {
						echo "<TR><TD>No records of borrowed equipments.</TD></TR>";
					}
				?>

			</TABLE>
		</DIV>
	</BODY>
</HTML>