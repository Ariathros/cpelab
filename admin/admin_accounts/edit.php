<?php
    include "../../connections.php";
    include '../sessions.php';
	$id = $_GET['id'];

    if(isset($_POST['submit'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $id_num = $_POST['id_num'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $usertype = $_POST['usertype'];

		// SQL query to update record
        $sql = "UPDATE `useraccounts` SET`firstname`='$firstname',`lastname`='$lastname',
		`id_num`='$id_num',`username`='$username',`email`='$email',`password`='$password',
		`usertype`='$usertype' WHERE id=$id";

        $result = mysqli_query($conn, $sql);

        if($result) {
            header("Location: admin-accounts.php?msg=User details updated succesfully");
        }
        else {
            echo "Failed: " . mysqli_error($conn); 
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

        <title>Create User - CPE Lab Room and Equipment Management System</title>
    </head>
    <body>
        <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #4D0000; color: white;">
            Account Management
        </nav>

        <div class="container">
            <div class="text-center mb-4">
                <h3>Update User Details</h3>
                <p class="text-muted">Click update to apply changes</p>
            </div>
			<!-- Get ID on each record where update button is pressed, limit to 1 to only get 1 record-->
			<?php
				// $id = $_GET['id'];
				$sql = "SELECT * FROM useraccounts WHERE id=$id LIMIT 1";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
			?>

            <div class="container d-flex justify-content-center">
                <form action="" method="post" style="width:50vw; min-width:300px;">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="form-label">First Name:</label>
                            <input type="text" class="form-control" name="firstname" 
							value="<?php echo $row['firstname']?>">
                        </div>
                        <div class="col">
                            <label for="form-label">Last Name:</label>
                            <input type="text" class="form-control" name="lastname" 
							value="<?php echo $row['lastname']?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">User Name:</label>
                        <input type="text" class="form-control" name="username" 
						value="<?php echo $row['username']?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">ID No.:</label>
                        <input type="text" class="form-control" name="id_num" 
						value="<?php echo $row['id_num']?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" 
						value="<?php echo $row['email']?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password:</label>
                        <input type="password" class="form-control" name="password" 
						value="<?php echo $row['password']?>">
                    </div>

                    <div class="form-group mb-3">
                        <label>User Type:</label> &nbsp; <!-- select indication -->
                        <input type="radio" class="form-check-input" name="usertype" id="student" value="student" 
						<?php echo ($row['usertype']=='student')?"checked":"";?>>
                        <label for="student" class="form-input-label">Student</label> &nbsp;
                        <input type="radio" class="form-check-input" name="usertype" id="faculty" value="faculty"
						<?php echo ($row['usertype']=='faculty')?"checked":"";?>>
                        <label for="faculty" class="form-input-label">Faculty</label> &nbsp;
                        <input type="radio" class="form-check-input" name="usertype" id="admin" value="admin"
						<?php echo ($row['usertype']=='admin')?"checked":"";?>>
                        <label for="admin" class="form-input-label">Admin</label> &nbsp;
                    </div>

                    <div class="mb-5">
                        <button type="submit" class="btn btn-success" name="submit">Update</button>
                        <a href="admin-accounts.php" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
        </script>
    </body>
</html>