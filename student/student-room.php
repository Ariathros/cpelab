<?php
    include '../connections.php';
    include 'sessions.php';
?>

<!-- Room Reservation -->
<div class="student_rooms">
    <!-- Page header -->
    <nav class="navbar">
        <span class="navbar-text">
            Room Reservation
        </span>
    </nav>
    <hr>
    <!-- calendar and timeslot-->
    <!-- <div class="date_time">
        <div class="row">
            <div class="col-6 px-0">
                <div class="calendar_title">Calendar</div>
                calendar goes here
            </div>
            <div class="col-1 px-0"></div>
            for time slots
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
    Individual Room Reservation
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
    
    <!-- Table for Rooms -->
    <div class="reservations">
		<div class="table-holder">
			<div class="table-rsrv">
				<table class="table">
					<thead >
                        <TR>
                            <TH SCOPE="COL">ID</TH>
                            <TH SCOPE="COL">Room Number</TH>
                            <TH SCOPE="COL">Type</TH>
                            <TH SCOPE="COL">Seat Count</TH>
                            <TH SCOPE="COL">Status</TH>
                            <TH SCOPE="COL">Action</TH>
                        </TR>

						<!-- php -->
						<?php
                            $sql = "SELECT * FROM rooms";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<TR>
                                    <TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["id"]. "</TD>
                                    <TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["room_no"]. "</TD>
                                    <TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["room_type"]. "</TD>
                                    <TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["seat_count"]. "</TD>
                                    <TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["room_status"]. "</TD>
                                    <TD style='border-bottom: solid 1px black; text-align: center;'>
                                        <A class='btn btn-primary' type='button' style='background-color:green; border:0px;' HREF='reserve.php?id=".$row["id"]."'>Reserve</A>
                                    </TD>
                                    </TR>";
                                }
                            } else {
                                echo "<TR><TD style='border-bottom: solid 1px black; text-align: center;'>0 results</TD></TR>";
                            }
                        ?>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>