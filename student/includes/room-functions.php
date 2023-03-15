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
            // echo "<A class='btn btn-primary' type='button' style='background-color:green; border:0px;' HREF='reserve.php?id=".$room_id."'>Reserve</A>";

            $sql = "SELECT * FROM rooms
            WHERE id='$room_id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $room_no = $row['room_no'];
            $room_type = $row['room_type'];
            $seat_count = $row['seat_count'];
            $status = $row['room_status'];
        ?>
        
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#room_<?php echo $room_no;?>">
        Reserve
        </button>

        <!-- Modal -->
        <div class="modal fade" id="room_<?php echo $room_no;?>" tabindex="-1" aria-labelledby="modal<?php echo $room_no;?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal<?php echo $room_no;?>"><?php echo "Room ".$room_no;?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
                <FORM METHOD="POST">
                    
                    <div class="input-group mb-3">
                        <div class="input-title">Room No.: <?php echo $room_no;?></div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-title">Room Type: <?php echo $room_type;?></div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-title">Seat Count: <?php echo $seat_count;?></div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-title">Status: <?php echo $status;?></div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-title">Date: </div>
                        <div  class="input"><INPUT NAME="date" TYPE='DATE' REQUIRED></div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-title">Time: </div>
                        <div class="input"><INPUT NAME="time_start" TYPE='TIME' min="07:00" max="21:00" REQUIRED > - 
                        <INPUT NAME="time_end" TYPE='TIME' min="07:00" max="21:00" REQUIRED></div>
                        <span class="error" style="color: red"></span></div>
                    <div class="input-group mb-3">
                        <div class="input-title">Reason: </div>
                        <div  class="input"><INPUT NAME="reason" TYPE='TEXT'></div>
                    </div>
                    
                </FORM>

            </div>
            <div class="modal-footer">                
                <button type="button" class="btn btn-primary">Reserve</button>
            </div>
            </div>
        </div>
        </div>
        <?php
        };
    }