<?php
	include '../connections.php';	
	include 'sessions.php';
?>

<HTML>
	<HEAD>
		<TITLE>Add Room - CPE Lab Room and Equipment Management System</TITLE>
	</HEAD>
	
	<BODY>
		<DIV>
			<?php include 'sidebar.php'; ?>
		</DIV>
		
		<DIV>
			<H1>Add Room</H1>
		</DIV>
		
		<DIV>
			<FORM METHOD="POST">
				Room No: <INPUT NAME="room_no" TYPE='TEXT'><BR>
				Type: <INPUT NAME="room_type" TYPE='TEXT'><BR>
				Seat Count: <INPUT NAME="seat_count" TYPE='NUMBER'><BR>
				Status: <INPUT NAME="room_status" TYPE='TEXT'><BR>
				<INPUT NAME="bAdd" TYPE='SUBMIT'>
			</FORM>
		</DIV>
		
		<?php
			
			if (isset($_POST['bAdd'])){
				
			$room_no = htmlentities($_POST['room_no']);
			$room_type = htmlentities($_POST['room_type']);
			$seat_count = htmlentities(intval($_POST['seat_count']));
			$room_status = htmlentities($_POST['room_status']);

				// Insert to SQL
				$sql = "INSERT INTO rooms (room_no, room_type, seat_count, room_status)
					VALUES ('$room_no', '$room_type', $seat_count, '$room_status')";
				if ($conn->query($sql) === TRUE) {
					echo "New record created successfully";
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
			}
		?>
	</BODY>
</HTML>