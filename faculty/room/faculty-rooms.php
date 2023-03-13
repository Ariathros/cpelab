<?php
	include '../../connections.php';	
	include '../sessions.php';
?>

<HTML>
	<HEAD>
		<TITLE>Room Reservations - CPE Lab Room and Equipment Management System</TITLE>

		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
		<script type="text/javascript" src="../../assets/js/ajaxWork.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-4.0.0.min.js" ></script>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="../../assets/css/style.css"></link>
	</HEAD>
	
	<BODY>
		<DIV>
			<?php include '../sidebar.php'; ?>
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
					<TH SCOPE="COL">Date</TH>
					<TH SCOPE="COL">Time</TH>
					<TH SCOPE="COL">Actions</TH>
				</TR>
				
				<?php
					$sql = "SELECT * FROM room_man WHERE status= 'Pending'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							echo "<TR>
								<TD>" . $row["room_no"]. "</TD>
								<TD>" . $row["room_type"]. "</TD>
								<TD>" . $row["borrower"]. "</TD>
								<TD>" . $row["date"]. "</TD>
								<TD>" . $row["time_start"]."". $row["time_end"]."</TD>
								<TD>
									<A HREF='reserve-action.php?id=".$row["id"]."&action=Approved'>Approve</A>
									<A HREF='reserve-action.php?id=".$row["id"]."&action=Declined'>Decline</A>
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