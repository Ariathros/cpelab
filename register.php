<?php
	include 'connections.php';
	include 'sessions.php';
?>

<HTML>
	<HEAD>
		<TITLE>Register - CPE Lab Room and Equipment Management System</TITLE>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="./assets/css/style.css"></link>
	</HEAD>
	
	<BODY>
		<div class="row">
			<div class="col-md-8">
				<img class="bg" src="./assets/images/pup.jpg">
			</div>

			<div class="col-md-4 flex-column">
				<img class="pup_logo" src="./assets/images/pup logo.png" width="80px" height="80px">
				<h2>Hi, PUPian!</h2>
				<p>Sign in to start your session</p>

				<FORM METHOD="POST">
					<div class="input-group mb-3">
						<INPUT NAME="f_name" TYPE="TEXT" PLACEHOLDER="First Name" class="form-control" REQUIRED>
					</div>
					<div class="input-group mb-3">
						<INPUT NAME="l_name" NAME="f_name" TYPE="TEXT" PLACEHOLDER="Last Name" class="form-control" REQUIRED>
					</div>
					<div class="input-group mb-3">
						<INPUT NAME="id_no" TYPE="TEXT" PLACEHOLDER="ID Number" class="form-control">
					</div>
					<div class="input-group mb-3">
						<INPUT NAME="username" TYPE="TEXT" PLACEHOLDER="Username" class="form-control" REQUIRED>
					</div>
					<div class="input-group mb-3">
						<INPUT NAME="email" TYPE="EMAIL" PLACEHOLDER="Email" class="form-control" REQUIRED>
					</div>
					<div class="input-group mb-3">
						<INPUT NAME="password" TYPE="PASSWORD" PLACEHOLDER="Password" class="form-control" REQUIRED>
					</div>
					<div class="input-group mb-3">
						<INPUT NAME="c_password" TYPE="PASSWORD" PLACEHOLDER="Confirm Password" class="form-control" REQUIRED>
					</div>
					<button NAME="bRegister" TYPE="SUBMIT" class="btn btn-primary" VALUE="Register">Register</button>
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
						header('Location: student/student-index.php');
					}
				?>

				<DIV>
					<A HREF="login.php">Already have an account?</A>
				</DIV>
			</div>
		</div>			
	</BODY>
</HTML>