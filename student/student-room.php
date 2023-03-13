<?php
    include '../connections.php';
    include 'sessions.php';
    include 'includes/room-functions.php';
?>

<!-- Room Reservation -->
<div class="student_rooms">
    <!-- Page header -->
    <nav class="navbar navbar-expand-lg">
        <span class="navbar-text">Room Reservation</span>
        <a class="instruction fa fa-question-circle-o" data-bs-toggle="popover"  
			title="Room Reservation" 
			data-bs-content="This page shows the current day's room reservations. 
            Click each room to see its availability and to create a reservation. 
            To create a reservation, click the Reserve button.
            Click the icon again to close this information.">
		</a>
    </nav>
    <hr>
    <!-- calendar and timeslot-->
    <!-- <div class="date_time">
            <div class="calendar_title">Calendar</label>
            </div>
            <div>
                <input type="date" id="calendar" name="calendar">
            </div>
        </div>
    <hr> -->
    Available Rooms for Reservation
    <div class="accordion accordion-flush" id="rooms">
        <?php

            $sql = "SELECT * FROM rooms ORDER BY room_no ASC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    
                    $room_no_display = $row['room_no'];
                    $room_name_display = $row["room_type"];
                    $room_status = $row["room_status"];
                    
                    echo "
                    <div class='accordion-item'>
                        <h2 class='accordion-header' id='room$room_no_display'>
                            <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#flush-room$room_no_display' aria-expanded='false' aria-controls='flush-collapseOne'>
                                <strong>$room_no_display</strong>&nbsp $room_name_display&nbsp $room_status
                            </button>
                        </h2>
                        <div id='flush-room$room_no_display' class='accordion-collapse collapse' aria-labelledby='room$room_no_display' data-bs-parent='#rooms'>
                            <div class='accordion-body'>
                                <h4>Current day reservations</h4>
                                    <ul class='nav justify-content-center'>";
                        getTimeReservations($conn, $room_no_display);
                        echo "</ul>";
                        unavailableDisable($room_status, $row["id"]);
                        echo "</div>
                        </div>
                    </div>";
                }
            }
        ?>
    </div>

</div>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script>
	$(document).ready(function(){
		$('[data-bs-toggle="popover"]').popover()
	})
</script>