<?php
	include '../connections.php';	
	include 'sessions.php';
?>

<HTML>
	<HEAD>
<<<<<<< Updated upstream
		<TITLE>Reserve - CPE Lab Room and Equipment Management System</TITLE>
=======
		<TITLE>Dashboard - CPE Lab Room and Equipment Management System</TITLE>

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
		<script type="text/javascript" src="../assets/js/ajaxWork.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-4.0.0.min.js" ></script>

		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="../assets/css/reserve.css"></link>
>>>>>>> Stashed changes
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
				header('Location: student-index.php');
			}
		?>
	</BODY>
</HTML>