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

	<body>
		<div class="row">
			<div class="col-md-8">
				<img class="bg" src="./assets/images/pup.jpg">
			</div>
			<div class="col-md-4 flex-column" style="padding-bottom:50px;">
				<img class="pup_logo" src="./assets/images/pup logo.png" width="80px" height="80px">
				<h2>Hi, PUPian!</h2>
				<h5>Register your account</h5>

				<?php
					// Define variable names
					$firstNameErr = $lastNameErr = $userNameErr = $emailErr = $idNoErr ="";
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
							if(!preg_match("/^[a-zA-Z- ']*$/", $userName)) {
								$userNameErr = "Special characters are not allowed";
							}
						}
						
						if(empty($_POST["idNo"])) {
							$idNoErr = "Please your ID No.";
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

						if($firstNameErr == '' && $lastNameErr === '' && $userNameErr == '' && $emailErr == '' && $idNoErr == '') {
							$hasErr = true;
						}
					}
					// Validation
					function test_input($data) {
						$data = trim($data);
						$data = stripslashes($data);
						$data = htmlspecialchars($data);
						return $data;
					}
				?>

				<p><span class="error">* required field</span></p>

				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<div class="input-group mb-3">
						<INPUT NAME="firstName" TYPE="TEXT" PLACEHOLDER="First Name" class="form-control" REQUIRED>
						<span class="error">* <?php echo $firstNameErr;?></span>
					</div>
					<div class="input-group mb-3">
						<INPUT NAME="lastName" TYPE="TEXT" PLACEHOLDER="Last Name" class="form-control" REQUIRED>
						<span class="error">* <?php echo $lastNameErr;?></span>
					</div>
					<div class="input-group mb-3">
						<INPUT NAME="userName" TYPE="TEXT" PLACEHOLDER="User Name" class="form-control" REQUIRED>
						<span class="error">* <?php echo $userNameErr;?></span>
					</div><div class="input-group mb-3">
						<INPUT NAME="idNo" TYPE="TEXT" PLACEHOLDER="ID No." class="form-control" REQUIRED>
						<span class="error">* <?php echo $idNoErr;?></span>
					</div>
					<div class="input-group mb-3">
						<INPUT NAME="email" TYPE="TEXT" PLACEHOLDER="Email" class="form-control" REQUIRED>
						<?php if(isset($emailErr)); ?>
						<span class="error">* <?php echo $emailErr;?></span>
					</div>
					<div class="input-group mb-3">
						<INPUT NAME="password" TYPE="password" PLACEHOLDER="Password" class="form-control" REQUIRED>
					</div><div class="input-group mb-3">
						<INPUT NAME="confirmPassword" TYPE="password" PLACEHOLDER="Confirm Password" class="form-control" REQUIRED>
					</div>
					<button NAME="submit" TYPE="SUBMIT" class="btn btn-primary" VALUE="Submit">Submit</button>
				</form>

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

							$sql_email = "SELECT * FROM useraccounts WHERE email='$email'";
							$sql_id = "SELECT * FROM useraccounts WHERE id_num='$idNo'";
							$result_email = mysqli_query($conn, $sql_email) or die(mysqli_error($conn));
							$result_id = mysqli_query($conn, $sql_id) or die(mysqli_error($conn));

							if(mysqli_num_rows($result_email) > 0) {
								echo "Email already taken";
							} else if(mysqli_num_rows($result_id) > 0) {
								echo "Id No. already taken";
							} else {
								// Turn password to hash
								// $hashPass = password_hash($password, PASSWORD_DEFAULT);
								// Insert data to SQL
								$sql = "INSERT INTO useraccounts (firstname, lastname, id_num, username, email, password, usertype) 
								VALUES ('$firstName', '$lastName', '$idNo', '$userName', '$email', '$password', 'student')";
								$conn->query($sql);
								$_SESSION['username']=$userName;
								$_SESSION['usertype']='student';
								header('Location: student/student-index.php');
							}

							// MGA ILALAGAY (PWEDE DAGDAGAN)
							// - password doesn't match
							// - password less than 8 characters
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


