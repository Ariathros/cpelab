<?php
	include '../connections.php';	
	include 'sessions.php';
?>

<HTML>
	<HEAD>
		<TITLE>Equipment Reservations - CPE Lab Room and Equipment Management System</TITLE>
	</HEAD>
	
	<BODY>
		<DIV>
			<?php include 'sidebar.php'; ?>
		</DIV>
		
		<DIV>
			<H1>Equipment Reservations</H1>
		</DIV>
		
		<DIV>
			<TABLE>
				<TR>
					<TH SCOPE="COL">Item Code</TH>
					<TH SCOPE="COL">Category</TH>
					<TH SCOPE="COL">Borrower</TH>
					<TH SCOPE="COL">Time</TH>
					<TH SCOPE="COL">Actions</TH>
				</TR>
				
				<?php
					$sql = "SELECT * FROM eq_man";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							echo "<TR>
								<TD>" . $row["code"]. "</TD>
								<TD>" . $row["category"]. "</TD>
								<TD>" . $row["borrower"]. "</TD>
								<TD>" . $row["time_start"]."". $row["time_end"]."</TD>
								<TD>
									<A HREF='approve.php?id=".$row["id"]."'></A>
									<A HREF='decline.php?id=".$row["id"]."'></A>
								</TD>
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