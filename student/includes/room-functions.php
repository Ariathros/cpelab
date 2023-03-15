<?php

    function getTimeReservations($conn, $room_no){
        
        $d1 =  date("Y-m-d", time());
        $sql = "SELECT * FROM room_man
        WHERE room_no='$room_no' AND status='Approved' AND date='$d1'
        ORDER BY time_start ASC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                
                $t1 = strtotime($row['time_start']);
                $t2 = strtotime($row['time_end']);
                $time_start = date('h:i A',$t1);
                $time_end = date('h:i A',$t2);

                echo "
                    <li class='nav-item'>
                        <a class='nav-link' href='#'>$time_start - $time_end</a>
                    </li>
                ";
            }
        } else{
            echo "
                    <li class='nav-item'>
                        <a class='nav-link' href='#'>No reservations at this moment.</a>
                    </li>
                ";
        }
    }

    function unavailableDisable($conn, $room_status, $room_id){
        if ($room_status!='Unavailable'){
            echo "<A class='btn btn-primary' type='button' style='background-color:green; border:0px;' HREF='reserve.php?id=".$room_id."'>Reserve</A>";
        }
            
    }

