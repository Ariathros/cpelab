<?php
    include '../connections.php';
    include 'sessions.php';
    include 'includes/room-functions.php';
?>

<!-- accordion style -->
<style>
    .accordion {
        background-color: #D0D2D4;
        color: #444;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
        transition: 0.4s;
    }

    .active, .accordion:hover {
        background-color: #ccc;
    }

    .accordion:after {
        content: '\002B';
        color: #777;
        font-weight: bold;
        float: right;
        margin-left: 5px;
    }

    .active:after {
        content: "\2212";
    }

    .panel {
        text-align:center;
        padding: 0 18px;
        background-color: white;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.2s ease-out;
    }
    .panel h4{
        padding:2%;
    }
    .panel .btn{
        margin:2%;
        background-color:green;
        border:0;
    }
</style>
<!-- Room Reservation -->
<div class="student_rooms mb-5">
    <!-- Page header -->
    <nav class="navbar navbar-expand-lg">
        <span class="navbar-text">Room Reservation</span>
        <a class="instruction fa fa-question-circle-o" data-bs-toggle="popover"  data-bs-trigger="hover"
			title="Room Reservation" 
			data-bs-content="This page shows the current day's room reservations. 
            Click each room to see its availability and to create a reservation. 
            To create a reservation, click the Reserve button.">
		</a>
    </nav>
    <hr>
    Available Rooms for Reservation
    <?php
        $sql = "SELECT * FROM rooms ORDER BY room_no";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                
                $room_no_display = $row['room_no'];
                $room_name_display = $row["room_type"];
                $room_status = $row["room_status"];
                
                echo "
                <button class='accordion'><strong>$room_no_display</strong>&nbsp $room_name_display</button>
                <div class='panel'>
                    <h4>Current day reservations</h4>
                    <ul class='nav justify-content-center'>";
                        getTimeReservations($conn, $room_no_display);
                        echo "</ul>";
                        unavailableDisable($conn, $room_status, $row['id']);
                        echo "
                </div>";
            }
            echo"
                
            ";
        }
    ?>
    
</div>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script>
	$(document).ready(function(){
		$('[data-bs-toggle="popover"]').popover()
	})
</script>
<script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
        panel.style.maxHeight = null;
        } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
        }
    });
    }
</script>