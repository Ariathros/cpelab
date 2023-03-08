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
	<style>.error{ color:#FF0000 }</style>
</body>
</html>
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
<!-- Register Form -->
<h2>Register</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
	First Name: <input type="text" name="firstName" placeholder="Juan">
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
	<span class="error">* <?php echo $emailErr;?></span>
	<br><br>
	Password: <input type="text" name="password">
	<br><br>
	Confirm Password: <input type="text" name="confirmPassword">
	<br><br>
	<input type="submit" name="submit" value="Submit">  
</form>
<?php
	
?>

<?php 
	if($hasErr) {
		// VARIABLE DECLARATIONS
		$firstName = htmlentities($_POST['firstName']);
		$lastName = htmlentities($_POST['lastName']);
		$idNo = htmlentities($_POST['idNo']);
		$userName = htmlentities($_POST['userName']);
		$email = htmlentities($_POST['email']);
		$password = htmlentities($_POST['password']);
		$confirmPassword = htmlentities($_POST['confirmPassword']);

		// MGA ILALAGAY (PWEDE DAGDAGAN)
		// - username exist
		// - email exist
		// - id no. exist
		// - password doesn't match
		// - password less than 8 characters

		// Insert to SQL
		$sql = "INSERT INTO useraccounts (firstname, lastname, id_num, username, email, password, usertype) 
		VALUES ('$firstName', '$lastName', '$idNo', '$userName', '$email', '$password', 'student')";
		$conn->query($sql);
		$_SESSION['username']=$userName;
		$_SESSION['usertype']='student';
		header('Location: student/student-dashboard.php');
	}
?>