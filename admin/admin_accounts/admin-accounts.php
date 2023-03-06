<?php
	include '../../connections.php';	
	include '../sessions.php';
?>

<HTML>
	<HEAD>
		<TITLE>Admin Accounts - CPE Lab Room and Equipment Management System</TITLE>
	</HEAD>
	
	<BODY>
		<DIV>
			<?php
				include '../sidebar.php';
			?>
		</DIV>
		
		<DIV>
			<H1>Accounts</H1>
		</DIV>

		<DIV>
			<A CLASS="btn btn-primary" HREF='create.php?ID="id"'>Add</A>
		</DIV>
		
		<DIV>
			<TABLE>
				<TR>
					<TH SCOPE="COL">ID</TH>
					<TH SCOPE="COL">First Name</TH>
					<TH SCOPE="COL">Last Name</TH>
					<TH SCOPE="COL">ID Number</TH>
					<TH SCOPE="COL">Username</TH>
					<TH SCOPE="COL">Email</TH>
					<TH SCOPE="COL">Password</TH>
					<TH SCOPE="COL">User Type</TH>
					<TH SCOPE="COL">Actions</TH>
				</TR>
				
				
					<?php
						$sql = "SELECT * FROM useraccounts";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							// output data of each row
							while($row = $result->fetch_assoc()) {
								echo "
								<TR>
									<TD>" . $row["id"]. "</TD>
									<TD>" . $row["firstname"]. "</TD>
									<TD>" . $row["lastname"]. "</TD>
									<TD>" . $row["id_num"]. "</TD>
									<TD>" . $row["username"]. "</TD>
									<TD>" . $row["email"]. "</TD>
									<TD>" . $row["password"]. "</TD>
									<TD>" . $row["usertype"]. "</TD>
									<TD>
										<A HREF='edit.php?id=".$row["id"]."' class='btnEdit'>Edit</button>
										<A HREF='delete.php?id=".$row["id"]."' class='btnDelete'>Delete</button>
									</TD>
								</TR>
								";
							}
						} else {
							echo "<TR><TD>0 results</TD></TR>";
						}
					?>
				</TR>
			</TABLE>
			
		</DIV>		
		
	</BODY>
</HTML>