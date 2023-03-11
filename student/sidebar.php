<!-- <?php
	echo "<A HREF='student-dashboard.php'>Dashboard</A>
	<A HREF='student-rooms.php'>Rooms</A>
	<A HREF='student-equip.php'>Equipment</A>
	<A HREF='../logout.php'>Log Out</A>";
?> -->

<!-- Sidebar -->
<div class="sidebar"  style="color:white;">
    <div class="side-header">
        <img src="../assets/images/pup logo.png" width="120px" height="120px">
    </div>
    <div class="side-header">
        <br><b>Welcome <?php echo $_SESSION['name']; ?>!</b>
    </div>
    <div class="menu">
        <div>
            <a class="btn" onclick="dashboard()">
                <div class="menu_icon"><i class='fas fa-layer-group'></i></div>
                <div class="menu_text">Dashboard</div>
            </a>
        </div>
        <div>
            <a class="btn" onclick="student_room()">
                <div class="menu_icon"><i class='fas fa-door-open'></i></div>
                <div class="menu_text">Rooms</div>
            </a>
        </div>
        <div>
            <a class="btn" onclick="student_equipment()">
                <div class="menu_icon"><i class='fas fa-tools'></i></div>
                <div class="menu_text">Equipment</div>
            </a>
        </div>
    </div>
    <div class="logout">
        <a href="../logout.php" class="btn">
            <div class="menu_icon"><i class='fas fa-sign-out-alt'></i></div>
            <div class="menu_text">Logout</div>
        </a>
    </div>
</div>