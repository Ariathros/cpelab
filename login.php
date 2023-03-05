<?php
	// LOGIN PAGE
	include 'connections.php';
	include 'sessions.php';
?>

<HTML>
	<HEAD>
		<TITLE>Login - CPE Lab Room and Equipment Management System</TITLE>
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
						<INPUT NAME="username" TYPE="TEXT" PLACEHOLDER="Username/Email/ID No." class="form-control" REQUIRED>
					</div>
					<div class="input-group mb-3">
						<INPUT NAME="password" TYPE="PASSWORD" PLACEHOLDER="Password" class="form-control" REQUIRED>
					</div>
					<button NAME="bLogin" TYPE="SUBMIT" class="btn btn-primary" VALUE="Login">Login</button>
				</FORM>

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
								header('Location: student/student-index.php');
							}
							
						} else { 
							echo "Username doesn't exist!";
						}
					}
				?>
				
				<div>
					<a id="forgotPass" href="#">I forgot my password</a>
				</div>

				<DIV>
					<A HREF="register.php">Register</A>
				</DIV>
			</div>
		</div>

		
	</BODY>
</HTML>