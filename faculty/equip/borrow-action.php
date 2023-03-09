<?php
    include '../../connections.php';	
    include '../sessions.php';

    $id = $_GET['id'];
    $status = $_GET['action'];

    $sql = "UPDATE eq_man
    SET 
        status='$status'
    WHERE id=$id";
    
    if ($conn->query($sql)) {
      echo "Record updated successfully";
    } else {
      echo "Error updating record: " . mysqli_error($conn);
    }
    
    // DECLARE LOG VARIABLES
    $sql = "SELECT * FROM eq_man WHERE id= '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $room_no = $row["name"];
    $room_type = $row["category"];
    $student = $row["borrower"];
    $time_start = $row["time_start"];
    $time_end = $row["time_end"];
    $faculty = $_SESSION['username'];

    // INSERT INTO LOGS
    $sql = "INSERT INTO logs (name, type, category, action, faculty, student, time_start, time_end) 
    VALUES ('$room_no', 'equipment', '$room_type', '$status', '$faculty', '$student', '$time_start', '$time_end')";
    $conn->query($sql);

    // ALERT ACTION
    // echo "<script>alert('Room $status.');</script>";

    header('Location: faculty-equip.php');

    // SUBTRACT QTY