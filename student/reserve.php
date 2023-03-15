
<div>
	<div class="reservation_form container allContent-section" style="background-color: #F5F5F5">
		<div class="reservation_title">
			<u >Reservation Form</u>
			<hr>
		</div>
		<!-- <?php
			$id = intval($_GET['id']);
			
			$sql = "SELECT * FROM rooms WHERE id=$id";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			$room_no = $row['room_no'];
			$room_type = $row['room_type'];
			$seat_count = $row['seat_count'];
			$room_status = $row['room_status'];
			
			$timeErr = '';
			$hasErr = false;

			// condition to check if start time is greater than end time
			if($_SERVER['REQUEST_METHOD'] == 'POST') {
				

				$sql = "SELECT * FROM room_man WHERE room_no='$room_no' AND status='Approved'";
				$result = $conn->query($sql);
				$reserved=0;

				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {								
						$date1 = $_POST["date"];
						$start1 = $_POST["time_start"];
						$end1 = $_POST["time_end"];
						$date2 = $row["date"];
						$start2 = $row["time_start"];
						$end2 = $row["time_end"];
						
						// if start time or end time is between current reservations
						// or current reservations is between input start and end time
						// show error
						// 1 is input, 2 is existing
						if(	$date1==$date2 &&
							(($start1<$start2 && $start2<$end1) ||
								($start1<$end2 && $end2<$end1) ||
								($start2<$start1 && $end1<$end2))){
							$reserved=1;
							break;
						}	
					}	
				}

				if($start1 > $end1) {
					$timeErr = "Start time must not greater than end time.";
				}elseif($reserved==1){
					$timeErr = "Reservation already existing.";
				}
				else {
					$hasErr = true;
				}
			}
		?> -->
		<FORM METHOD="POST">
			<div class="input-group mb-3">
				<div class="input-title">Room No.:</div>
				<div class="input"><?php echo $room_no;?></div>
			</div>
			<div class="input-group mb-3">
				<div class="input-title">Room Type:</div>
				<div  class="input"><?php echo $room_type;?></div>
			</div>
			<div class="input-group mb-3">
				<div class="input-title">Seat Count:</div>
				<div  class="input"><?php echo $seat_count;?></div>
			</div>
			<div class="input-group mb-3">
				<div class="input-title">Status:</div>
				<div  class="input"><?php echo $room_status;?></div>
			</div>
			<div class="input-group mb-3">
				<div class="input-title">Date:</div>
				<div  class="input"><INPUT NAME="date" TYPE='DATE' REQUIRED></div>
			</div>
			<div class="input-group mb-3">
				<div class="input-title">Time:</div>
				<div class="input"><INPUT NAME="time_start" TYPE='TIME' min="07:00" max="21:00" REQUIRED > - 
				<INPUT NAME="time_end" TYPE='TIME' min="07:00" max="21:00" REQUIRED>
				<span class="error" style="color: red"><?php echo $timeErr;?></span></div>
			<div class="input-group mb-3">
				<div class="input-title">Reason:</div>
				<div  class="input"><INPUT NAME="reason" TYPE='TEXT'></div>
			</div>
			<INPUT class="btn" NAME="bReserve" TYPE='SUBMIT'>
		</FORM>
	</div>
	<!-- <?php
		if($hasErr) {
			if (isset($_POST['bReserve'])){

				$time_start = htmlentities($_POST['time_start']);
				$time_end = htmlentities($_POST['time_end']);
				$reason = htmlentities($_POST['reason']);
				$date = htmlentities($_POST['date']);

				// Insert to SQL
				$sql = "INSERT INTO room_man (room_no, room_type, borrower, reason, date, time_start, time_end, status)
					VALUES ('$room_no', '$room_type', '".$_SESSION['username']."', '$reason', '$date', '$time_start', '$time_end', 'Pending')";
				$conn->query($sql);
				header('Location: student-index.php');
			}
		}
	?> -->
</div>