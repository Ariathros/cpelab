<?php
	include '../connections.php';	
	include 'sessions.php';
?>

<HTML>
	<HEAD>
		<TITLE>Reserve - CPE Lab Room and Equipment Management System</TITLE>
	</HEAD>
	
	<BODY>		
		<DIV>
			<?php include 'sidebar.php'; ?>
		</DIV>

		<DIV>
			<H1>Reserve Room</H1>
		</DIV>

		<DIV>
			<?php
				$id = intval($_GET['id']);
				
				$sql = "SELECT * FROM rooms WHERE id=$id";
				$result = $conn->query($sql);
				$row = $result->fetch_assoc();
				$room_no = $row['room_no'];
				$room_type = $row['room_type'];
				$seat_count = $row['seat_count'];
				$room_status = intval($row['room_status']);
				
				
				// paki REQUIRED LAHAT PAGTAPOS
			?>

			<FORM METHOD="POST">
				Room No.: <?php echo $room_no;?><BR>
				Room Type: <?php echo $room_type;?><BR>
				Seat Count: <?php echo $seat_count;?><BR>
				Status: <?php echo $room_status;?><BR>
				Time: <INPUT NAME="time_start" TYPE='TIME' REQUIRED>-<INPUT NAME="time_end" TYPE='TIME' REQUIRED><BR>
				Reason: <INPUT NAME="reason" TYPE='TEXT'><BR>
				<INPUT NAME="bReserve" TYPE='SUBMIT'>
			</FORM>
		</DIV>
		
		<?php
			if (isset($_POST['bReserve'])){

				$time_start = htmlentities($_POST['time_start']);
				$time_end = htmlentities($_POST['time_end']);
				$reason = htmlentities($_POST['reason']);

				// Insert to SQL
				$sql = "INSERT INTO room_man (room_no, room_type, borrower, reason, time_start, time_end, status)
					VALUES ('$room_no', '$room_type', '".$_SESSION['username']."', '$reason', '$time_start', '$time_end', 'pending')";
				if ($conn->query($sql) === FALSE) {

					// CONDITIONS START HERE
					// if(condition here){
					// 	mga error output
					//  return;
					// }

					// if (condition here){
					// 	mga error output
					//  return;
					// }

					// MGA CONDITIONS (PWEDE DAGDAGAN)
					// - mas maaga time end sa time start
					// - room already used (need db query)


				}
				header('Location: student-dashboard.php');
			}
		?>
	</BODY>
</HTML>