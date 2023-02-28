<?php
	include '../connections.php';	
	include 'sessions.php';
?>

<HTML>
	<HEAD>
		<TITLE>Rooms - CPE Lab Room and Equipment Management System</TITLE>
	</HEAD>
	
	<BODY>
		<DIV>
			<?php include 'sidebar.php'; ?>
		</DIV>

		<DIV>
			<H1>Rooms</H1>
		</DIV>

		<DIV>
			<TABLE>
				<TR>
					<TH SCOPE="COL">ID</TH>
					<TH SCOPE="COL">Room Number</TH>
					<TH SCOPE="COL">Type</TH>
					<TH SCOPE="COL">Seat Count</TH>
					<TH SCOPE="COL">Status</TH>
					<TH SCOPE="COL">Action</TH>
				</TR>
				
				<?php
					$sql = "SELECT * FROM rooms";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							echo "<TR>
							<TD>" . $row["id"]. "</TD>
							<TD>" . $row["room_no"]. "</TD>
							<TD>" . $row["room_type"]. "</TD>
							<TD>" . $row["seat_count"]. "</TD>
							<TD>" . $row["room_status"]. "</TD>
							<TD><A HREF='reserve.php?id=".$row["id"]."'>Reserve</A></TD>
							</TR>";
						}
					} else {
						echo "<TR><TD>0 results</TD></TR>";
					}
				?>
			</TABLE>
		</DIV>
	</BODY>
</HTML>