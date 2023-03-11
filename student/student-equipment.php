<!-- <?php
    include '../connections.php';
    include 'sessions.php';
?> -->

<!-- Equipment Reservation -->
<div class="student_equipment">
	<nav class="navbar">
        <span class="navbar-text">
            Equipment Reservation
        </span>
        <!--<form class="form-inline my-2 my-lg-0">
			<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    	</form>-->
    </nav>
    <hr>
    <!-- <div class="d-flex flex column">
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
    </div> -->
	<div class="table-holder" style="margin-top:20px;">
			<div class="table-rsrv">
				<table class="table">
					<thead >
						<TR>
							<TH SCOPE="COL">Equipment Code</TH>
							<TH SCOPE="COL">Equipment Name</TH>
							<TH SCOPE="COL">Category</TH>
							<TH SCOPE="COL">Description</TH>
							<TH SCOPE="COL">Available</TH>
							<TH SCOPE="COL">Actions</TH>
						</TR>
											
						<!-- php -->
						<?php
							$sql = "SELECT * FROM equipments";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
									echo "<TR>
										<TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["equip_code"]. "</TD>
										<TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["equip_name"]. "</TD>
										<TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["category"]. "</TD>
										<TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["description"]. "</TD>
										<TD style='border-bottom: solid 1px black; text-align: center;'>" . $row["available"]. "</TD>
										<TD style='border-bottom: solid 1px black; text-align: center;'>
											<A class='btn btn-primary' type='button' style='background-color:green; border:0px;' HREF='borrow.php?id=".$row["id"]."'>Borrow</A>
										</TD>
									</TR>";
								}
							} else {
								echo "<TR>
								<TD style='border-bottom: solid 1px black; text-align: center;'>No Equipments Available Yet.</TD>
								</TR>";
							}
						?>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
</div>