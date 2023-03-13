<?php
    include "../../connections.php";
    include '../sessions.php';

    if(isset($_POST['submit'])) {
        $room_no = $_POST['room_no'];
        $room_type = $_POST['room_type'];
        $seat_count = $_POST['seat_count'];
        $room_status = $_POST['room_status'];
        // SQL query to add new record
        $sql = "INSERT INTO `rooms`(`id`, `room_no`, `room_type`, `seat_count`, `room_status`) 
		VALUES (NULL,'$room_no','$room_type','$seat_count','$room_status')";

        $result = mysqli_query($conn, $sql);

        if($result) {
            header("Location: room-mngt.php?msg=New Room Created Succesfully");
        }
        else {
            echo "Failed: " . mysqli_error($conn); 
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

        <title>Create Room - CPE Lab Room and Equipment Management System</title>
    </head>
    <body>
        <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #4D0000; color: white;">
            Room Management
        </nav>

        <div class="container">
            <div class="text-center mb-4">
                <h3>Add New Room</h3>
                <p class="text-muted">Complete the form below to add new room</p>
            </div>

            <div class="container d-flex justify-content-center">
                <form action="" method="post" style="width:50vw; min-width:300px;">
					<!-- Room No. -->
                    <div class="mb-3">
                        <label class="form-label">Room No.:</label>
                        <input type="text" class="form-control" name="room_no" placeholder="" REQUIRED>
                    </div>

					<!-- Room Type -->
                    <div class="mb-3">
						<label class="form-label">Room Type</label>
						<select name="room_type" class="form-control" REQUIRED>
							<option value="">--Select Option--</option>
							<option value="Lecture Room">Lecture Room</option>
							<option value="Computer Room">Computer Room</option>                            
							<option value="Miscelaneous Room">Miscelaneous Room</option>
						</select>
                    </div>

					<!-- Seat Count -->
                    <div class="mb-3">
                        <label class="form-label">Seat Count:</label>
                        <input type="number" max="50" min="1"class="form-control" name="seat_count" placeholder="max: 50, min: 1">
                    </div>

					<!-- Room Status -->
                    <div class="form-group mb-3">
                        <label>Room Status:</label> &nbsp; <!-- select indication -->
                        <input type="radio" class="form-check-input" name="room_status" id="Available" value="Available" REQUIRED>
                        <label for="available" class="form-input-label">Available</label> &nbsp;
                        <input type="radio" class="form-check-input" name="room_status" id="Unavailable" value="Unavailable" REQUIRED>
                        <label for="unavailable" class="form-input-label">Unavailable</label> &nbsp;
                        <input type="radio" class="form-check-input" name="room_status" id="Reserved" value="Reserved" REQUIRED>
                        <label for="reserved" class="form-input-label">Reserved</label> &nbsp;
                    </div>

                    <div class="mb-5">
                        <button type="submit" class="btn btn-success" name="submit">Save</button>
                        <a href="room-mngt.php" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
        </script>
    </body>
</html>