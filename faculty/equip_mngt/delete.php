<?php
	include '../../connections.php';
	include '../sessions.php';

    $id = $_GET['id'];
    $sql = "DELETE FROM equipments WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    
    if($result) {
        header("Location: equip-mngt.php?msg=Record deleted succesfully");
    }
    else {
        echo "Failed: " . mysqli_error($conn); 
    }
?>