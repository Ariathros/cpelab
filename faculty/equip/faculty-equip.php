<?php
	include '../../connections.php';	
	include '../sessions.php';
?>

<HTML>
	<HEAD>
		<TITLE>Equipment Reservations - CPE Lab Room and Equipment Management System</TITLE>
	</HEAD>
	
	<BODY>
		<div class="row">
			<DIV class="col-3 px-2">
				<?php
					include '../sidebar.php';
				?>
			</DIV>
			<meta name="viewport" content="width=device-width, initial-scale=1">

			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
			<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
			<script type="text/javascript" src="../assets/js/ajaxWork.js"></script>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
			<script src="https://code.jquery.com/jquery-4.0.0.min.js" ></script>

			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
			<link rel="stylesheet" href="../assets/css/style.css"></link>
			
			<DIV>
				<H1 class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #4D0000; color: white;">
				Equipment Reservations
				</H1>
			</DIV>
			
			<DIV class="container" style="padding-left:24px; padding-right:24px; ">
				<TABLE class="table table-hover text-center">
					<thead class="table-dark">
						<TR>
							<TH SCOPE="COL">Item Code</TH>
							<TH SCOPE="COL">Category</TH>					
							<TH SCOPE="COL">Quantity</TH>
							<TH SCOPE="COL">Borrower</TH>
							<TH SCOPE="COL">Date</TH>
							<TH SCOPE="COL">Time</TH>
							<TH SCOPE="COL">Actions</TH>
						</TR>
					</thead>
						
					
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
		</div>
	</BODY>
</HTML>