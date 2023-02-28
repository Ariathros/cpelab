<?php
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
				<INPUT NAME="username" TYPE="TEXT" PLACEHOLDER="Username/Email/ID No."><BR>
				<INPUT NAME="password" TYPE="PASSWORD" PLACEHOLDER="Password"><BR>
				<INPUT NAME="bLogin" TYPE="SUBMIT" VALUE="Login">
			</FORM>
		</DIV>
		
		<?php
			$username = htmlentities($_POST['username']);
			$password = htmlentities($_POST['password']);
			
			if (isset($_POST['bLogin'])){
				// Select from SQL
				$sql = "SELECT password, usertype FROM useraccounts 
				WHERE (username='$username' OR email='$username' OR id_num='$username')";
				$result = cpeQuery($sql, $conn);

				if ($result->num_rows > 0) { //ACCOUNT EXIST
					$row = $result->fetch_assoc();
						if($row["password"]===$password){
							echo "Logged in!";
							$_SESSION['username']=$username;
							if($row["usertype"]==="admin"){
								header('Location: admin/admin-logs.php');
								$_SESSION['usertype']='admin';
							}
							elseif($row["usertype"]==="faculty"){
								header('Location: faculty/faculty-rooms.php');
								$_SESSION['usertype']='faculty';
							}
							else{
								header('Location: student/student-dashboard.php');
								$_SESSION['usertype']='student';
							}
						}
						else{ //ACCOUNT NOT EXIST
							echo "Wrong Password!";
						}
						
				} else { 
					echo "Account didn't exist!";
				}
			}
		?>
		
	</BODY>
</HTML>