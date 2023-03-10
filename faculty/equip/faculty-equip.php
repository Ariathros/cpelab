<?php
	include '../../connections.php';	
	include '../sessions.php';
?>

<HTML>
	<HEAD>
		<TITLE>Equipment Reservations - CPE Lab Room and Equipment Management System</TITLE>
	</HEAD>
	
	<BODY>
		<DIV>
			<?php include '../sidebar.php'; ?>
		</DIV>
		
		<DIV>
			<H1>Equipment Reservations</H1>
		</DIV>
		
		<DIV>
			<TABLE>
				<TR>
					<TH SCOPE="COL">Item Code</TH>
					<TH SCOPE="COL">Category</TH>					
					<TH SCOPE="COL">Quantity</TH>
					<TH SCOPE="COL">Borrower</TH>
					<TH SCOPE="COL">Date</TH>
					<TH SCOPE="COL">Time</TH>
					<TH SCOPE="COL">Actions</TH>
				</TR>
				
				<?php
					$sql = "SELECT * FROM eq_man WHERE status= 'Pending'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							echo "<TR>
								<TD>" . $row["name"]. "</TD>
								<TD>" . $row["category"]. "</TD>
								<TD>" . $row["qty"]. "</TD>
								<TD>" . $row["borrower"]. "</TD>
								<TD>" . $row["date"]. "</TD>
								<TD>" . $row["time_start"]."". $row["time_end"]."</TD>
								<TD>
									<A HREF='borrow-action.php?id=".$row["id"]."&action=Approved'>Approve</A>
									<A HREF='borrow-action.php?id=".$row["id"]."&action=Declined'>Decline</A>
								</TD>
							</TR>";
						}
					} else {
						echo "<TR><TD>No borrower needs equipment right now.</TD></TR>";
					}
				?>
			</TABLE>
		</DIV>
	</BODY>
</HTML>