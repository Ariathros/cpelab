<?php
	include '../connections.php';	
	include 'sessions.php';
?>

<HTML>
	<HEAD>
		<TITLE>Room Reservations - CPE Lab Room and Equipment Management System</TITLE>
	</HEAD>
	
	<BODY>
		<DIV>
			<?php include 'sidebar.php'; ?>
		</DIV>
		
		<DIV>
			<H1>Room Reservations</H1>
		</DIV>
		
		<DIV>
			<TABLE>
				<TR>
					<TH SCOPE="COL">Room No.</TH>
					<TH SCOPE="COL">Type</TH>
					<TH SCOPE="COL">Borrower</TH>
					<TH SCOPE="COL">Time</TH>
					<TH SCOPE="COL">Actions</TH>
				</TR>
				
				<?php
					$sql = "SELECT * FROM room_man WHERE status= 'pending'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							echo "<TR>
								<TD>" . $row["room_no"]. "</TD>
								<TD>" . $row["room_type"]. "</TD>
								<TD>" . $row["borrower"]. "</TD>
								<TD>" . $row["time_start"]."". $row["time_end"]."</TD>
								<TD>
									<A HREF='reserve-action.php?id=".$row["id"]."&action=approve'>Approve</A>
									<A HREF='reserve-action.php?id=".$row["id"]."&action=decline'>Decline</A>
								</TD>
							</TR>";
						}
					} else {
						echo "<TR><TD>No reservations needed actions at this moment.</TD></TR>";
					}

					// insert to logs
				?>
			</TABLE>
		</DIV>
	</BODY>
</HTML>