<?php
    include '../connections.php';	
    include 'sessions.php';

    $id = $_GET['id'];
    $action = $_GET['action']='edit';
    echo $action;

    // $sql = "UPDATE eq_man
    // SET 
    //     status='$status'
    // WHERE id=$id";
    
    // if ($conn->query($sql)) {
    //   echo "Record updated successfully";
    // } else {
    //   echo "Error updating record: " . mysqli_error($conn);
    // }