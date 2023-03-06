<?php
    include '../connections.php';
    include 'sessions.php';
?>

<!-- Room Reservation -->
<div class="student_rooms">
    <!-- Page header -->
    <div class="row">
        <div class="col-8">
            <span class="title">
                Room Reservations
            </span>
        </div>
        <div class="col-1"></div>
        <div class="col-3 px-0">
            <a type="button" href="reserve.php">Reserve Room</a>
        </div>
    </div>
    <hr>
    <!-- calendar and timeslot-->
    <div class="date_time">
        <div class="row">
            <div class="col-6 px-0">
                <div class="calendar_title">Calendar</div>
                <!-- calendar goes here-->
            </div>
            <div class="col-1 px-0"></div>
            <!-- for time slots -->
            <div class="col-5 px-0" style="">
                <div class="time_title">Time Slots</div>
                <div class="row mx-auto" id="time_slots">
                    <div class="col-6 px-0">
                        <button>07:00 AM - 08:00 AM</button>
                        <button>08:00 AM - 09:00 AM</button>
                        <button>09:00 AM - 10:00 AM</button>
                        <button>10:00 AM - 11:00 AM</button>
                        <button>11:00 AM - 12:00 PM</button>
                        <button>12:00 PM - 01:00 PM</button>
                        <button>01:00 PM - 02:00 PM</button>
                    </div>
                    <div class="col-6 px-0">
                        <button>02:00 PM - 03:00 PM</button>
                        <button>03:00 PM - 04:00 PM</button>
                        <button>04:00 PM - 05:00 PM</button>
                        <button>05:00 PM - 06:00 PM</button>
                        <button>06:00 PM - 07:00 PM</button>
                        <button>07:00 PM - 08:00 PM</button>
                        <button>08:00 PM - 09:00 PM</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <!-- Individual Room Reservation
    <div class="accordion" id="rooms">
        <div class="accordion-item">
            <h2 class="accordion-header" id="roomDescription">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <strong>301</strong>&nbsp Lecture Room
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <h4>Reserved Rooms</h4>
                    <ul class="nav justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link" href="#">7:00 AM - 8:00 AM</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">7:00 AM - 8:00 AM</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">7:00 AM - 8:00 AM</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div> -->
    
    <!-- Room Reservation Table -->
    <DIV>
		<TABLE>
			<TR>
				<TH SCOPE="COL">ID</TH>
				<TH SCOPE="COL">Room Number</TH>
				<TH SCOPE="COL">Type</TH>
				<TH SCOPE="COL">Seat Count</TH>
				<TH SCOPE="COL">Status</TH>
				<TH SCOPE="COL">Action</TH>
			</TR>
				
			<?php
				$sql = "SELECT * FROM rooms";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
						echo "<TR>
						<TD>" . $row["id"]. "</TD>
						<TD>" . $row["room_no"]. "</TD>
						<TD>" . $row["room_type"]. "</TD>
						<TD>" . $row["seat_count"]. "</TD>
						<TD>" . $row["room_status"]. "</TD>
						<TD><A HREF='reserve.php?id=".$row["id"]."'>Reserve</A></TD>
						</TR>";
					}
				} else {
					echo "<TR><TD>0 results</TD></TR>";
				}
			?>
		</TABLE>
	</DIV>
</div>