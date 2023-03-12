<!-- <?php
    include '../connections.php';
    include 'sessions.php';
    include 'includes/room-functions.php';
?> -->

<!-- Room Reservation -->
<div class="student_rooms">
    <!-- Page header -->
    <nav class="navbar navbar-expand-lg">
        <span class="navbar-text">Room Reservation</span>
        <a class="instruction fa fa-question-circle-o" data-bs-toggle="popover"  
			title="Room Reservation" 
			data-bs-content="This page shows the current day's room reservations. Click each room to see its availability and to create a reservation. Click the icon again to close this information.">
		</a>
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
    <hr> -->
    Current Day Room Reservation
    <div class="accordion" id="rooms">
        <?php

            $sql = "SELECT * FROM rooms";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    
                    $room_no_display = $row['room_no'];
                    $room_name_display = $row["room_type"];
                    $room_status = $row["room_status"];
                    
                    echo "<div class='accordion-item'>
                        <h2 class='accordion-header' id='roomDescription'>
                            <button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#collapseOne' aria-expanded='true' aria-controls='collapseOne'>
                                <strong>$room_no_display</strong>&nbsp $room_name_display&nbsp $room_status
                            </button>
                        </h2>
                        <div id='collapseOne' class='accordion-collapse collapse show' aria-labelledby='headingOne' data-bs-parent='#accordionExample'>
                            <div class='accordion-body'>
                                <h4>Reserved Rooms</h4>
                                    <ul class='nav justify-content-center'>";
                        getTimeReservations($conn, $room_no_display);
                        echo "</ul>
                        <A class='btn btn-primary' type='button' style='background-color:green; border:0px;' HREF='reserve.php?id=".$row["id"]."'>Reserve</A>
                            </div>
                        </div>
                    </div>";
                }
            }
        ?>
    </div>
    
    <!-- <hr> -->
    <!-- Table for Rooms -->
    <!-- <div class="reservations">
		<div class="table-holder">
			<div class="table-rsrv">
				<table class="table">
					<thead >
                        <TR>
                            <TH SCOPE="COL">Room Number</TH>
                            <TH SCOPE="COL">Type</TH>
                            <TH SCOPE="COL">Seat Count</TH>
                            <TH SCOPE="COL">Status</TH>
                            <TH SCOPE="COL">Action</TH>
                        </TR> -->

						<!-- php -->
						<!-- <?php
                            $sql = "SELECT * FROM rooms";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<TR>
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
	</div>  -->
</div>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script>
	$(document).ready(function(){
		$('[data-bs-toggle="popover"]').popover()
	})
</script>