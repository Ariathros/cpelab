<?php
	include '../connections.php';
	include 'sessions.php';
?>

<HTML>
	<HEAD>
		<TITLE>Edit User - CPE Lab Room and Equipment Management System</TITLE>
	</HEAD>
	
	<BODY>
		<DIV>
			<?php
				include 'sidebar.php';
			?>
		</DIV>
		
		<DIV>
			<H1>Edit User</H1>
		</DIV>
		
		<DIV>
			<?php
				$id = intval($_GET['id']);
				
				$sql = "SELECT * FROM useraccounts WHERE id=$id";
				$result = $conn->query($sql);
				$row = $result->fetch_assoc();
				$firstname = $row['firstname'];
				$lastname = $row['lastname'];
				$id_num = $row['id_num'];
				$username = $row['username'];
				$email = $row['email'];
				$password = $row['password'];
				$usertype = $row['usertype'];
				
				// paki REQUIRED LAHAT PAGTAPOS
			?>
		
			<FORM METHOD="POST">
				ID: <?php echo $id; ?><BR>
				First Name:<INPUT NAME="firstname" TYPE="TEXT" VALUE="<?php echo $firstname; ?>" REQUIRED><BR>
				Last Name:<INPUT NAME="lastname" TYPE="TEXT" VALUE="<?php echo $lastname; ?>" REQUIRED><BR>
				ID No.:<INPUT NAME="id_num" TYPE="TEXT" VALUE="<?php echo $id_num; ?>" REQUIRED><BR>
				Username:<INPUT NAME="username" TYPE="TEXT" VALUE="<?php echo $username; ?>" REQUIRED><BR>
				Email:<INPUT NAME="email" TYPE="TEXT" VALUE="<?php echo $email; ?>" REQUIRED><BR>
				Password:<INPUT NAME="password" TYPE="TEXT" VALUE="<?php echo $password; ?>" REQUIRED><BR>
				User Type:    <input list="browsers" name="usertype" VALUE="<?php echo $usertype; ?>">
					<datalist id="browsers">
						<option value="user">
						<option value="faculty">
						<option value="admin">
					</datalist><BR>
				<INPUT NAME="bUpdate" TYPE="SUBMIT" VALUE="Update">
			</FORM>
		</DIV>
		
		<?php
			
			if (isset($_POST['bUpdate'])){

				$firstname = $_POST['firstname'];
				$lastname = $_POST['lastname'];
				$id_num = $_POST['id_num'];
				$username = $_POST['username'];
				$email = $_POST['email'];
				$password = $_POST['password'];
				$usertype = $_POST['usertype'];

				$sql = "UPDATE useraccounts
				SET 
					firstname='$firstname',
					lastname='$lastname',
					id_num='$id_num',
					username='$username',
					email='$email',
					password='$password',
					usertype='$usertype'
				WHERE id=$id";
				
				if ($conn->query($sql)) {
				  echo "Record updated successfully";
				} else {
				  echo "Error updating record: " . mysqli_error($conn);
				}
			}
		?>
	</BODY>
</HTML>