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
      // echo "Record updated successfully";
    } else {
      echo "Error updating record: " . mysqli_error($conn);
    }    
    
    // DECLARE LOG VARIABLES
    $sql = "SELECT * FROM eq_man WHERE id= '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $eq_name = $row["name"];
    $qty = $row["qty"];
    $category = $row["category"];
    $student = $row["borrower"];    
    $date = $row["date"];
    $time_start = $row["time_start"];
    $time_end = $row["time_end"];
    $faculty = $_SESSION['username'];

      // UPDATE query for remaining available equipments
    if ($status=='Approved'){

      $sql = "SELECT * FROM equipments WHERE equip_name='$eq_name'";
      $result2 = $conn->query($sql);
      $row2 = $result2->fetch_assoc();
      $available = $row2['available'];

      $remaining = $available - $qty;
      $sql_avail = "UPDATE equipments SET available=$remaining WHERE equip_name='$eq_name'";
      $conn->query($sql_avail);
    }

    // INSERT INTO LOGS
    $sql = "INSERT INTO logs (name, type, category, action, faculty, student, date, time_start, time_end) 
    VALUES ('$eq_name ($qty)', 'equipment', '$category', '$status', '$faculty', '$student', '$date', '$time_start', '$time_end')";
    $conn->query($sql);

    // ALERT ACTION
    // echo "<script>alert('Room $status.');</script>";

    header('Location: faculty-equip.php');

    // SUBTRACT QTY