<?php
	include 'connections.php';
	include 'sessions.php';
?>

<HTML>
	<HEAD>
		<TITLE>CPE Lab Room and Equipment Management System</TITLE>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
		<script type="text/javascript" src="../assets/js/ajaxWork.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-4.0.0.min.js" ></script>
		
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="./assets/css/style.css"></link>
		<link rel="icon" href="./assets/images/pup logo.png" type="image/x-icon">
		<link rel="stylesheet" href="./assets/css/background.css"></link>
		
	</HEAD>
	
	<BODY>
		<div class="index">
			<nav class="navbar justify-content-between">
				<a class="navbar-brand">
					Rooms and Equipment Reservation System
				</a>
			</nav>	
			<div class="container ">
				<div class="d-flex">
					<div class="user_card">
						<div class="d-flex justify-content-center">
							<div class="brand_logo_container">
								<img src="./assets/images/pup logo.png" alt="Logo">
							</div>
						</div>
					<div class="d-flex justify-content-center form_container">
						<form method="POST">
							<div class="input-group mb-3">
								<div class="input-group-append">
									<span class="input-group-text"><i class="fas fa-user"></i></span>
								</div>
								<input type="text" name="username" class="form-control input_user" placeholder="Username">
							</div>
							<div class="input-group mb-2">
								<div class="input-group-append">
									<span class="input-group-text"><i class="fas fa-key"></i></span>
								</div>
								<input type="password" name="password" class="form-control input_pass" placeholder="Password">
							</div>

							<div class="d-flex justify-content-center mt-3 login_container">
								<input type='submit' type="button" name="bLogin" class="btn login_btn" value="Login">
							</div>
						</form>

					</div>
					<div>
						<?php
					// IF BUTTON IS CLICKED
							if (isset($_POST['bLogin'])){

								$username = htmlentities($_POST['username']);
								$password = htmlentities($_POST['password']);

								// Select from SQL
								$sql = "SELECT * FROM useraccounts WHERE username='$username'";
								$result = $conn->query($sql);

								// IF MAY RESULTS
								if ($result->num_rows > 0) {
									$row = $result->fetch_assoc();
									
									// verify hash password
									$checkHashPass = password_verify($password, $row['password']);
									if($row["password"]!=$checkHashPass){
											echo "Wrong Password!";
											return;
									}
										
									// USERTYPE CHECKER
									$_SESSION['username']=$username;
									$_SESSION['name']=$row['firstname']." ".$row['lastname'];

									if($row["usertype"]==="admin"){
										$_SESSION['usertype']='admin';
										header('Location: admin\admin_logs\admin-logs.php');
									}
									elseif($row["usertype"]==="faculty"){
										$_SESSION['usertype']='faculty';
										header('Location: faculty/dashboard/faculty-dashboard.php');
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
					</div>
					<div class="mt-4">
						<div class="links d-flex justify-content-center ">
							Don't have an account? <a href="register.php" class="ml-2">Sign Up</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</BODY>
</HTML>