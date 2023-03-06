<HTML>
	<BODY>
            <?php
                // add waring prompt for deleting user
                if(isset($_GET['id'])) {
                    $id = $_GET['id'];
                
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $db_name = "cpelabman";
                    
                    $connection = new mysqli($servername, $username, $password, $db_name);

                    $sql = "DELETE FROM useraccounts WHERE id=$id"; // table name should not be enclosed in quotes
                    
                    // executed but not shown, should be set as flash messge instead
                    if ($connection->query($sql)) {
                        echo "Record updated successfully"; // header("location: admin/admin-accounts.php?msg=User has been deleted");
                    } else {
                        echo "Error updating record: " . mysqli_error($conn);
                    }
                }
            // bring back to Admin Accounts after delete
            //header("location: /cpelab/admin/admin-accounts.php");
            //exit;
            ?>
        </DIV>
    </BODY>
</HTML>
