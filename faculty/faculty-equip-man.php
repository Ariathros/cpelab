<?php
	include '../connections.php';	
	include 'sessions.php';
?>

<HTML>
	<HEAD>
		<TITLE>Equipment Management - CPE Lab Room and Equipment Management System</TITLE>
	</HEAD>
	
	<BODY>
		<DIV>
			<?php include 'sidebar.php'; ?>
		</DIV>
		
		<DIV>
			<H1>Equipment Reservations</H1>
		</DIV>
		
		<DIV>
			<A HREF="add-eq.php">Add Equipment</A>
		</DIV>
		
		<DIV>
			<TABLE>
				<TR>
					<TH SCOPE="COL">Equipment Code</TH>
					<TH SCOPE="COL">Equipment Name</TH>
					<TH SCOPE="COL">Category</TH>
					<TH SCOPE="COL">Total</TH>
					<TH SCOPE="COL">Available</TH>
					<TH SCOPE="COL">Actions</TH>
				</TR>
				
				<?php
					$sql = "SELECT * FROM equipments";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							echo "<TR>
								<TD>" . $row["equip_code"]. "</TD>
								<TD>" . $row["equip_name"]. "</TD>
								<TD>" . $row["category"]. "</TD>
								<TD>" . $row["total"]. "</TD>
								<TD>" . $row["available"]. "</TD>
								<TD>
									<A HREF='equip-edit.php?id=".$row["id"]."&action=edit'>Edit</A>
									<A HREF='equip-edit.php?id=".$row["id"]."&action=delete'>Delete</A>
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