<?php
	include 'connections.php';
	include 'sessions.php';
?>

<!DOCTYPE html>
<html lang="en">
	<HEAD>
		<TITLE>Registration - CPE Lab Room and Equipment Management System</TITLE>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="./assets/css/style.css"></link>
	</HEAD>

	<body id="register">
		<div class="row">
			<div class="col-md-5  register-left">
				<h3>Computer Engineering Rooms and Equipment Management System</h3>
				<img src="./assets/images/register.png">
				<p>Already have an account?</p>
				<a href="index.php">
					<input type="submit" name="back_login" value="Login"/>
				</a>
			</div>

			<div class="col-md-7 register-right">
				<h3 class="register-heading">Register your account</h3>
				
				<!-- php -->
				<?php
					// Define variable names
					$firstNameErr = $lastNameErr = $userNameErr = $emailErr = $idNoErr = $passwordErr="";
					$firstName = $lastName = $userName = $idNo = $email = $password = $confirmPassword = "";
					$hasErr = false;
					// Validate User Inputs
					if($_SERVER['REQUEST_METHOD'] == 'POST') {
						if(empty($_POST["firstName"])) {
							$firstNameErr = "Please enter first name";
						} else {
							$firstName = test_input($_POST["firstName"]);
							if(!preg_match("/^[a-zA-Z- ']*$/", $firstName)) {
								$firstNameErr = "Special characters are not allowed";
							}
						}

						if(empty($_POST["lastName"])) {
							$lastNameErr = "Please enter last name";
						} else {
							$lastName = test_input($_POST["lastName"]);
							if(!preg_match("/^[a-zA-Z- ']*$/", $lastName)) {
								$lastNameErr = "Special characters are not allowed";
							}
						}
					
						if(empty($_POST["userName"])) {
							$userNameErr = "Please enter user name";
						} else {
							$userName = test_input($_POST["userName"]);
							if(!preg_match("/^[a-zA-Z0-9- ']*$/", $userName)) {
								$userNameErr = "Special characters are not allowed";
							}
						}
						
						if(empty($_POST["idNo"])) {
							$idNoErr = "Please enter your ID No.";
						} else {
							$idNo = test_input($_POST["idNo"]);
							if(!preg_match("/^[a-zA-Z0-9- ']*$/", $idNo)) {
								$idNoErr = "Special characters are not allowed";
							}
						}

						if(empty($_POST["email"])) {
							$emailErr = "Please enter an email";
						} else {
							$email = test_input($_POST["email"]);
							if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
								$emailErr = "Incorrect email address";
							}
						}
						
						// check if password match and at least 8 char
						if(($_POST['password'] != $_POST['confirmPassword'])) {
							$passwordErr = "Password did not match! Try again";
						} else if(strlen($_POST['password']) < 8 ) {
							$passwordErr = "Password at least 8 characters! Try Again";
						}

						if($firstNameErr == '' && $lastNameErr === '' && $userNameErr == '' && $emailErr == '' && $idNoErr == '' && $passwordErr == '') {
							$hasErr = true;
						}
					}
					// Validation
					function test_input($data) {
						$data = trim($data);
						$data = stripslashes($data);
						$data = htmlspecialchars($data);
						return $data;
					}?>

				<!-- registration form -->
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<div class="input-group mb-3">
						<div class="input-group-append">
							<span class="input-group-text">First Name</span>
						</div>
						<input type="text" name="firstName" class="form-control input_user" placeholder="ex. Juan" REQUIRED>
					</div>
					<div class="error"><?php echo $firstNameErr;?></div>
					
					<div class="input-group mb-3">
						<div class="input-group-append">
							<span class="input-group-text">Last Name</span>
						</div>
						<input type="text" name="lastName" class="form-control input_user" placeholder="ex. Dela Cruz" REQUIRED>
					</div>
					<div class="error"><?php echo $lastNameErr;?></div>

					<div class="input-group mb-3">
						<div class="input-group-append">
							<span class="input-group-text">User Name</span>
						</div>
						<input type="text" name="userName" class="form-control input_user" placeholder="ex. jdc" REQUIRED>
					</div>
					<div class="error"><?php echo $userNameErr;?></div>

					<div class="input-group mb-3">
						<div class="input-group-append">
							<span class="input-group-text">ID No.</span>
						</div>
						<input type="text" name="idNo" class="form-control input_user" placeholder="ex. 2019-01234-MN-0" REQUIRED>
					</div>
					<div class="error"><?php echo $idNoErr;?></div>

					<div class="input-group mb-3">
						<div class="input-group-append">
							<span class="input-group-text">Email</span>
						</div>
						<input type="email" name="email" class="form-control input_user" placeholder="ex. jdc@example.com" REQUIRED>
					</div>
					<div class="error"><?php echo $emailErr;?></div>

					<div class="input-group mb-3">
						<div class="input-group-append">
							<span class="input-group-text">Password</span>
						</div>
						<input type="password" name="password" class="form-control input_user" placeholder="Password" REQUIRED>
					</div>
					<div class="error"><?php echo $passwordErr;?></div>
					
					<div class="input-group mb-3">
						<div class="input-group-append">
							<span class="input-group-text">Confirm Password</span>
						</div>
						<input type="password" name="confirmPassword" class="form-control input_user" placeholder="Confirm Password" REQUIRED>
					</div>
					<button type="submit" class="btnRegister"  value="Register">Register</button>
				</form>
				
				<!-- php -->
				<?php 
					if($hasErr) {
						// Variable declarations
						if(isset($_POST['submit'])) {
							$firstName = $_POST['firstName'];
							$lastName = $_POST['lastName'];
							$idNo = $_POST['idNo'];
							$userName = $_POST['userName'];
							$email = $_POST['email'];
							$password = $_POST['password'];
							$confirmPassword = $_POST['confirmPassword'];
							
							// Get email and id to check if it already exists
							$sql_email = "SELECT * FROM useraccounts WHERE email='$email'";
							$sql_id = "SELECT * FROM useraccounts WHERE id_num='$idNo'";
							$result_email = mysqli_query($conn, $sql_email) or die(mysqli_error($conn));
							$result_id = mysqli_query($conn, $sql_id) or die(mysqli_error($conn));
							// if return greater than 0 means there is similar value
							if(mysqli_num_rows($result_email) > 0) {
								echo "Email already taken";
							} else if(mysqli_num_rows($result_id) > 0) {
								echo "Id No. already taken";
							} else {
								// Turn password to hash
								$hashPass = password_hash($password, PASSWORD_DEFAULT);
								// Insert data to SQL
								$sql = "INSERT INTO useraccounts (firstname, lastname, id_num, username, email, password, usertype) 
								VALUES ('$firstName', '$lastName', '$idNo', '$userName', '$email', '$hashPass', 'student')";
								$conn->query($sql);
								$_SESSION['name']= $firstName ." ". $lastName;
								$_SESSION['username']=$userName;
								$_SESSION['usertype']='student';
								header('Location: student/student-index.php');
							}
						}
					}
				?>
			</div>
		</div>
	</body>
</html>

<html lang="en">
	<body>
		<style>.error{ color:#FF0000 }</style>
	</body>
</html>


