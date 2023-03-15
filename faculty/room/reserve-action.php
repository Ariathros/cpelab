<?php
    include '../../connections.php';	
    include '../sessions.php';

    $id = $_GET['id'];
    $status = $_GET['action'];

    // UPDATE STATUS
    $sql = "UPDATE room_man
    SET 
        status='$status'
    WHERE id=$id";
    
    if ($conn->query($sql)) {
      echo "Record updated successfully";
    } else {
      echo "Error updating record: " . mysqli_error($conn);
      die();
    }

    // DECLARE LOG VARIABLES
    $sql = "SELECT * FROM room_man WHERE id= '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $room_no = $row["room_no"];
    $room_type = $row["room_type"];
    $student = $row["borrower"];
    $date = $row["date"];
    $time_start = $row["time_start"];
    $time_end = $row["time_end"];

    // Select Student Name
    $sql = "SELECT * FROM useraccounts WHERE username= '$student'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();    
    $student_name = $row["firstname"]." ".$row["lastname"];
    $faculty = $_SESSION['name'];
    echo $student_name;

    // INSERT INTO LOGS
    $sql = "INSERT INTO logs (name, type, category, action, faculty, student, date, time_start, time_end) 
    VALUES ('$room_no', 'room', '$room_type', '$status', '$faculty', '$student_name', '$date', '$time_start', '$time_end')";
    $conn->query($sql);
    
    // ALERT ACTION
    // echo "<script>alert('Room $status.');</script>";

    header('Location: faculty-rooms.php');