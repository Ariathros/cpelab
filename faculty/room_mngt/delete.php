<?php
	include '../../connections.php';
	include '../sessions.php';

    if(isset($_POST['deletedata']))
    {
        $id = $_POST['delete_id'];

        $query = "DELETE FROM rooms WHERE id='$id'";
        $query_run = mysqli_query($conn, $query);

        if($query_run)
        {
            header("Location: room-mngt.php?msg=Record deleted succesfully");
        }
        else
        {
            echo '<script> alert("Data Not Deleted"); </script>';
        }
    }
?>