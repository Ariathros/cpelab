<?php
	include 'connections.php';
	include 'sessions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register Form</title>
</head>
<body>
	<!-- Set color for error messages -->
	<style>.error{ color:#FF0000 }</style>
</body>
</html>

<?php
	// Define variable names
	$firstNameErr = $lastNameErr = $userNameErr = $emailErr = $idNoErr = $passwordErr = "";
	$firstName = $lastName = $userName = $idNo = $email = $password = $confirmPassword = "";
	$hasErr = false;
	// Validate User Inputs
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		// disallow special characters
		if(empty($_POST["firstName"])) {
			$firstNameErr = "Please enter first name";
		} else {
			$firstName = test_input($_POST["firstName"]);
			if(!preg_match("/^[a-zA-Z- ']*$/", $firstName)) {
				$firstNameErr = "Special characters are not allowed";
			}
		}
		// disallow special characters
		if(empty($_POST["lastName"])) {
			$lastNameErr = "Please enter last name";
		} else {
			$lastName = test_input($_POST["lastName"]);
			if(!preg_match("/^[a-zA-Z- ']*$/", $lastName)) {
				$lastNameErr = "Special characters are not allowed";
			}
		}
		// disallow special characters
		if(empty($_POST["userName"])) {
			$userNameErr = "Please enter user name";
		} else {
			$userName = test_input($_POST["userName"]);
			if(!preg_match("/^[a-zA-Z- ']*$/", $userName)) {
				$userNameErr = "Special characters are not allowed";
			}
		}
		// disallow special characters
		if(empty($_POST["idNo"])) {
			$idNoErr = "Please enter your ID No.";
		} else {
			$idNo = test_input($_POST["idNo"]);
			if(!preg_match("/^[a-zA-Z0-9- ']*$/", $idNo)) {
				$idNoErr = "Special characters are not allowed";
			}
		}
		// validate email format
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
		// if no error occured it will proceed to INSERT query
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
	}
?>
<!-- Register Form -->
<h2>Register</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
	First Name: <input type="text" name="firstName" placeholder="Juan" value="">
	<span class="error">* <?php echo $firstNameErr;?></span>
	<br><br>
	Last Name: <input type="text" name="lastName" placeholder="Dela Cruz">
	<span class="error">* <?php echo $lastNameErr;?></span>
	<br><br>
	User Name: <input type="text" name="userName" placeholder="JDL">
	<span class="error">* <?php echo $userNameErr;?></span>
	<br><br>
	ID No.: <input type="text" name="idNo" placeholder="2020-000000-AB-0">
	<span class="error">* <?php echo $idNoErr;?></span>
	<br><br>
	E-mail: <input type="text" name="email" placeholder="example@email.com">
	<?php if(isset($emailErr)); ?>
		<span class="error">* <?php echo $emailErr;?></span>
	<br><br>
	Password: <input type="text" name="password" placeholder="at least 8 char">
	<span class="error">* <?php echo $passwordErr;?></span>
	<br><br>
	Confirm Password: <input type="text" name="confirmPassword">
	<br><br>
	<input type="submit" name="submit" value="Submit">  
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
			// get id no and email match
			$sql_email = "SELECT * FROM useraccounts WHERE email='$email'";
			$sql_id = "SELECT * FROM useraccounts WHERE id_num='$idNo'";
			$result_email = mysqli_query($conn, $sql_email) or die(mysqli_error($conn));
			$result_id = mysqli_query($conn, $sql_id) or die(mysqli_error($conn));
			// if returned more than 1 row show error
			if(mysqli_num_rows($result_email) > 0) {
				echo "Email already exists";
			} else if(mysqli_num_rows($result_id) > 0) {
				echo "ID No. already exists";
			} else {
				// INSERT query
				$sql = "INSERT INTO useraccounts (firstname, lastname, id_num, username, email, password, usertype) 
				VALUES ('$firstName', '$lastName', '$idNo', '$userName', '$email', '$password', 'student')";
				$conn->query($sql);
				$_SESSION['username']=$userName;
				$_SESSION['usertype']='student';
				header('Location: student/student-dashboard.php');
			}
		}
	}
?>