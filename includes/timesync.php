<?php
    // TIMESYNC PHP
    // 
    // - Will remove datas if end time is greater than current time
    
    date_default_timezone_set('Asia/Manila');

    $d1 =  date("Y-m-d", time());
    $t1 =  date("H:i:s", time());

    // Equipment Quantity Add

    $sql = "SELECT name, qty FROM eq_man WHERE status='Approved' AND (date < '$d1' OR (date = '$d1' AND time_end <= '$t1'))";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
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

    // Room Status Update
    $sql = "SELECT * FROM room_man WHERE status='Approved'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            
            $room_no = $row['room_no'];
            $date = $row['date'];
            $time_start = $row['time_start'];
            $time_end = $row['time_end'];

            $sql2 = "SELECT * FROM rooms WHERE room_no='$room_no' ORDER BY time_start DESC";
            $result2 = $conn->query($sql2);
    
            if($date<=$d1 && ($time_start <= $t1 && $t1 < $time_end)){
                $room_status='Reserved';
            }else{
                $room_status='Available';
            }
            $sql3 = "UPDATE rooms SET room_status='$room_status' WHERE room_no='$room_no'";
            $conn->query($sql3);
        }
    } else {
        $sql3 = "UPDATE rooms SET room_status='Available'";
        $conn->query($sql3);
    }

    // Remove Room Reservations pass End time

    $sql = "DELETE FROM room_man
    WHERE date < '$d1' OR (date = '$d1' AND time_end <= '$t1')";
    $conn->query($sql);

?>