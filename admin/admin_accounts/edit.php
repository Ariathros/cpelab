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
        $usertype = $_POST['usertype'];
        // hash password
        //$hashPass = password_hash($password, PASSWORD_DEFAULT);
		// SQL query to update record
        $sql = "UPDATE `useraccounts` SET`firstname`='$firstname',`lastname`='$lastname',
		`id_num`='$id_num',`username`='$username',`email`='$email',
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
        <title>Create User - CPE Lab Room and Equipment Management System</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
		<script type="text/javascript" src="../assets/js/ajaxWork.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-4.0.0.min.js" ></script>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="../../assets/css/style.css"></link>
    </head>
    <body>
        <div class="row">
            <div class="col-3 px-2">
                <?php include "../sidebar.php"; ?>
            </div>
            <div class="col-9 px-0">
                <DIV style="padding-top:24px; padding-left:24px; padding-right:24px;">
                    <H1 class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #4D0000; color: white;">
                        Account Management
                    </H1>
                </DIV>

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

                            <div>
                                <a href="change-password.php?id=<?php echo $id ?>">Change Password</a>
                            </div>

                            <div class="mb-5">
                                <button type="submit" class="btn btn-success" name="submit">Update</button>
                                <a href="admin-accounts.php" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
        </script>
    </body>
</html>