<?php
	include '../../connections.php';
	include '../sessions.php';

    $id = $_GET['id'];
    $sql = "DELETE FROM rooms WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    
    if($result) {
        header("Location: room-mngt.php?msg=Record deleted succesfully");
    }
    else {
        echo "Failed: " . mysqli_error($conn); 
    }
?>