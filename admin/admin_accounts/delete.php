<?php
	include '../../connections.php';
	include '../sessions.php';

    $id = $_GET['id'];
    $sql = "DELETE FROM useraccounts WHERE id=$id"; // table name should not be enclosed with quote
    $result = mysqli_query($conn, $sql);
    
    if($result) {
        header("Location: admin-accounts.php?msg=Record deleted succesfully");
    }
    else {
        echo "Failed: " . mysqli_error($conn); 
    }
?>