<?php
	// LOGIN PAGE
	include 'connections.php';
	include 'sessions.php';
?>

<HTML>
	<HEAD>
		<TITLE>Login - CPE Lab Room and Equipment Management System</TITLE>
	</HEAD>
	
	<BODY>
		<DIV>
			<FORM METHOD="POST">
				<INPUT NAME="username" TYPE="TEXT" PLACEHOLDER="Username/Email/ID No." REQUIRED><BR>
				<INPUT NAME="password" TYPE="PASSWORD" PLACEHOLDER="Password" REQUIRED><BR>
				<INPUT NAME="bLogin" TYPE="SUBMIT" VALUE="Login">
			</FORM>
		</DIV>
		
		<?php
			// IF BUTTON IS CLICKED
			if (isset($_POST['bLogin'])){

				$username = htmlentities($_POST['username']);
				$password = htmlentities($_POST['password']);

				// Select from SQL
				$sql = "SELECT password, usertype FROM useraccounts 
				WHERE username='$username'";
				$result = cpeQuery($sql, $conn);

				// IF MAY RESULTS
				if ($result->num_rows > 0) {
					$row = $result->fetch_assoc();

					if($row["password"]!=$password){
						// WRONG PASSWORD CONDITION
						echo "Wrong Password!";
						return;
					}
						
					// USERTYPE CHECKER
					$_SESSION['username']=$username;
					if($row["usertype"]==="admin"){
						$_SESSION['usertype']='admin';
						header('Location: admin/admin-logs.php');
					}
					elseif($row["usertype"]==="faculty"){
						$_SESSION['usertype']='faculty';
						header('Location: faculty/faculty-rooms.php');
					}
					else{
						
						$_SESSION['usertype']='student';
						header('Location: student/student-dashboard.php');
					}
					
				} else { 
					echo "Username doesn't exist!";
				}
			}
		?>

		<DIV>
			<A HREF="register.php">Register</A>
		</DIV>
		
	</BODY>
</HTML>