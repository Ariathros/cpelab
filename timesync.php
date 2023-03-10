<?php
	// include 'connections.php';
    
    date_default_timezone_set('Asia/Manila');
    // TIMESYNC PHP
    // 
    // - Will remove datas if end time is greater than current time

    $d1 =  date("Y-m-d", time());
    $t1 =  date("H:i:s", time());

    // Equipment Quantity Add

    $sql = "SELECT name, qty FROM eq_man WHERE date < '$d1' OR (date = '$d1' AND time_end <= '$t1')";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
            $eq_name = $row["name"];
            $qty = $row["qty"];
            $sql = "UPDATE equipments SET available=available+$qty WHERE equip_name='$eq_name'";
            $conn->query($sql);
        }
    }

    // Remove Equip Reservations pass End time

    $sql = "DELETE FROM eq_man
    WHERE date < '$d1' OR (date = '$d1' AND time_end <= '$t1')";
    $conn->query($sql);

    // Remove Room Reservations pass End time

    $sql = "DELETE FROM room_man
    WHERE date < '$d1' OR (date = '$d1' AND time_end <= '$t1')";
    $conn->query($sql);

?>