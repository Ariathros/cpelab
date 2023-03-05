<?php
    include '../connections.php';
    include 'sessions.php';
?>

<!-- Equipment Reservation -->
<div class="student_equipment">
    <nav class="navbar">
        <div class="container-fluid">
            <span class="navbar-brand">Equipment Reservations</span>
            <form class="d-flex">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
            </form>
        </div>
    </nav>
    <hr>
    <div class="d-flex flex column">
        <div class="card">
            <h3 class="card-title">Card title</h3>
            <div class="card-body">
                <img src="..." class="card-img-top" alt="...">
                <p class="card-text">Remaining: #</p>
                <a href="#" class="btn">Borrow</a>
            </div>
        </div>
        <div class="card" style="width: 15rem;">
            <h3 class="card-title">Card title</h3>
            <div class="card-body">
                <img src="..." class="card-img-top" alt="...">
                <p class="card-text">Remaining: #</p>
                <a href="#" class="btn">Borrow</a>
            </div>
        </div>
    </div>
    <DIV>
		<TABLE>
			<TR>
				<TH SCOPE="COL">Equipment Code</TH>
				<TH SCOPE="COL">Equipment Name</TH>
				<TH SCOPE="COL">Category</TH>
				<TH SCOPE="COL">Total</TH>
				<TH SCOPE="COL">Available</TH>
				<TH SCOPE="COL">Actions</TH>
			</TR>
				
			<?php
				$sql = "SELECT * FROM equipments";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
						echo "<TR>
							<TD>" . $row["equip_code"]. "</TD>
							<TD>" . $row["equip_name"]. "</TD>
							<TD>" . $row["category"]. "</TD>
							<TD>" . $row["total"]. "</TD>
							<TD>" . $row["available"]. "</TD>
							<TD><A HREF='borrow.php?id=".$row["id"]."'>Borrow</A></TD>
						</TR>";
					}
				} else {
					echo "<TR>
					<TD>0 results</TD>
					</TR>";
				}
			?>
		</TABLE>
	</DIV>
</div>