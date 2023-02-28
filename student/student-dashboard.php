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
					<TH SCOPE="COL">Time</TH>
					<TH SCOPE="COL">Status</TH>
				</TR>
			</TABLE>
		</DIV>

		<DIV>
			<H2>Equipment Reservations</H2>
			<TABLE>
				<TR>
					<TH SCOPE="COL">Item Code</TH>
					<TH SCOPE="COL">Category</TH>
					<TH SCOPsE="COL">Time</TH>
					<TH SCOPE="COL">Status</TH>
				</TR>
			</TABLE>
		</DIV>
	</BODY>
</HTML>