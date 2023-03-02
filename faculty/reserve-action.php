<?php
    include '../connections.php';	
    include 'sessions.php';

    $id = $_GET['id'];
    if ($_GET['action']=='approve'){
        $status="approved";
    }
    elseif($_GET['action']=='decline'){
        $status="declined";
    }
    else{
        die();
    }
    echo $status;

    $sql = "UPDATE room_man
    SET 
        status='$status'
    WHERE id=$id";
    
    if ($conn->query($sql)) {
      echo "Record updated successfully";
    } else {
      echo "Error updating record: " . mysqli_error($conn);
    }