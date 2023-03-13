<?php
	include '../../connections.php';
	include '../sessions.php';

    if(isset($_POST['deletedata']))
    {
        $id = $_POST['delete_id'];

        $query = "DELETE FROM useraccounts WHERE id='$id'";
        $query_run = mysqli_query($conn, $query);

        if($query_run)
        {
            header("Location:admin-accounts.php?msg=Record deleted succesfully");
        }
        else
        {
            echo '<script> alert("Data Not Deleted"); </script>';
        }
    }

?>