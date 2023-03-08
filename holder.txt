<?php
	include 'connections.php';
	include 'sessions.php';
?>

<HTML>
	<HEAD>
		<TITLE>Register - CPE Lab Room and Equipment Management System</TITLE>
	</HEAD>
	
	<BODY>
		<FORM METHOD="POST">
			<INPUT NAME="f_name" TYPE="TEXT" PLACEHOLDER="First Name" REQUIRED><BR>
			<INPUT NAME="l_name" NAME="f_name" TYPE="TEXT" PLACEHOLDER="Last Name" REQUIRED><BR>
			<INPUT NAME="id_no" TYPE="TEXT" PLACEHOLDER="ID Number"><BR>
			<INPUT NAME="username" TYPE="TEXT" PLACEHOLDER="Username" REQUIRED><BR>
			<INPUT NAME="email" TYPE="EMAIL" PLACEHOLDER="Email" REQUIRED><BR>
			<INPUT NAME="password" TYPE="PASSWORD" PLACEHOLDER="Password" REQUIRED><BR>
			<INPUT NAME="c_password" TYPE="PASSWORD" PLACEHOLDER="Confirm Password" REQUIRED><BR>
			<INPUT NAME="bRegister" TYPE="SUBMIT" VALUE="Register"><BR>
		</FORM>
		
		<?php
			
			if (isset($_POST['bRegister'])){
				// VARIABLE DECLARATIONS
				$f_name = htmlentities($_POST['f_name']);
				$l_name = htmlentities($_POST['l_name']);
				$id_no = htmlentities($_POST['id_no']);
				$username = htmlentities($_POST['username']);
				$email = htmlentities($_POST['email']);
				$password = htmlentities($_POST['password']);
				$c_password = htmlentities($_POST['c_password']);

				// CONDITION START
				// if(condition here){
				// 	mga error output
				//  return;
				// }

				// if (condition here){
				// 	mga error output
				// }
				// MGA ILALAGAY (PWEDE DAGDAGAN)
				// - username exist
				// - email exist
				// - id no. exist
				// - password doesn't match
				// - password less than 8 characters


				// Insert to SQL
				$sql = "INSERT INTO useraccounts (firstname, lastname, id_num, username, email, password, usertype) 
				VALUES ('$f_name', '$l_name', '$id_no', '$username', '$email', '$password', 'user')";
				$conn->query($sql);
				$_SESSION['username']=$username;
				$_SESSION['usertype']='student';
				header('Location: student/student-dashboard.php');
			}
		?>
		
		<DIV>
			<A HREF="login.php">Already have an account?</A>
		</DIV>
	</BODY>
</HTML>