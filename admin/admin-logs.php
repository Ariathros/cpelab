<?php
	include '../connections.php';
	include 'sessions.php';
?>

<HTML>
	<HEAD>
		<TITLE>Admin Logs - CPE Lab Room and Equipment Management System</TITLE>
	</HEAD>
	
	<BODY>
		<DIV>
			<?php
				include 'sidebar.php';
			?>
		</DIV>
		
		<DIV>
			<H1>Logs</H1>
		</DIV>
		
		<DIV>
			<TABLE>
				<TR>
					<TH SCOPE="COL">ID</TH>
					<TH SCOPE="COL">Name</TH>
					<TH SCOPE="COL">Type</TH>
					<TH SCOPE="COL">Category</TH>
					<TH SCOPE="COL">Action</TH>
					<TH SCOPE="COL">Action By</TH>
					<TH SCOPE="COL">Student</TH>
					<TH SCOPE="COL">Date</TH>
					<TH SCOPE="COL">Time</TH>
				</TR>
				
				<TR>
					<?php
						$sql = "SELECT * FROM logs";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							// output data of each row
							while($row = $result->fetch_assoc()) {
								echo "
								<TD>" . $row["id"]. "</TD>
								<TD>" . $row["name"]. "</TD>
								<TD>" . $row["type"]. "</TD>
								<TD>" . $row["category"]. "</TD>
								<TD>" . $row["action"]. "</TD>
								<TD>" . $row["faculty"]. "</TD>
								<TD>" . $row["student"]. "</TD>
								<TD>" . $row["date"]. "</TD>
								<TD>" . $row["time_start"]. "-" . $row["time_end"]. "</TD>
								";
							}
						} else {
							echo "<TR><TD>0 results</TD></TR>";
						}
					?>
				</TR>
					
			</TABLE>
		</DIV>
		
		
	</BODY>
</HTML>