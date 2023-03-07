<?php
	include '../../connections.php';
	include '../sessions.php';

	// Archive Query 
	// INSERT INTO 'archive' WHERE 'Date' + 1 Year > Current_timestamp;
	// DELETE FROM 'logs' WHERE id=$id;
?>

<HTML>
	<HEAD>
		<TITLE>Admin Logs - CPE Lab Room and Equipment Management System</TITLE>
	</HEAD>
	
	<BODY>
		<DIV>
			<?php
				include '../sidebar.php';
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
								echo "<TR>
								<TD>" . $row["id"]. "</TD>
								<TD>" . $row["name"]. "</TD>
								<TD>" . $row["type"]. "</TD>
								<TD>" . $row["category"]. "</TD>
								<TD>" . $row["action"]. "</TD>
								<TD>" . $row["faculty"]. "</TD>
								<TD>" . $row["student"]. "</TD>
								<TD>" . $row["date"]. "</TD>
								<TD>" . $row["time_start"]. "-" . $row["time_end"]. "</TD>
								</TR>";
								
								// Set record overdue to creation date + 3 months
								$startDate = strtotime($row['date']. '+3 months');
								// get the current date
								$archiveDate = strtotime(date('y-m-d'));
								// Check if record is overdue
								if($startDate < $archiveDate) {
									// insert overdue record to 'archive' table
									mysqli_query($conn, "INSERT INTO `archive`(`archive_id`,`id`, `name`, `type`, `category`, `action`, `faculty`, 
									`student`, `time_start`, `time_end`, `date`) VALUES ('','$row[id]',
									'$row[name]','$row[type]','$row[category]','$row[action]','$row[faculty]','$row[student]',
									'$row[time_start]','$row[time_end]','$row[date]')");
									
									// delete record from logs table, it will generate new reocrd to archive if not deleted
									mysqli_query($conn, "DELETE FROM `logs` WHERE '$row[id]'='$row[id]'");
									
								};
							}
						} else {
							echo "<TR><TD>0 results</TD></TR>";
						}

						// $date = "2022-02-01";

						//$archiveDate = date('Y-m-d', strtotime($date. ' + 5 years'));

						//echo "$archiveDate";

						//if($archiveDate > Current_timestamp())
					?>
				</TR>
					
			</TABLE>
		</DIV>
		
		
	</BODY>
</HTML>