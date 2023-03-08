<?php
    include "../../connections.php";
    include '../sessions.php';

    if(isset($_POST['submit'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $id_num = $_POST['id_num'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $usertype = $_POST['usertype'];

        $sql = "INSERT INTO `useraccounts`(`id`, `firstname`, `lastname`, `id_num`, `username`, `email`, `password`, `usertype`, `reg_date`) 
        VALUES (NULL,'$firstname','$lastname','$id_num','$username','$email','$password','$usertype', NULL)";

        $result = mysqli_query($conn, $sql);

        if($result) {
            header("Location: admin-accounts.php?msg=New Record Created Succesfully");
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
                <h3>Add New User</h3>
                <p class="text-muted">Complete the form below to add new user</p>
            </div>

            <div class="container d-flex justify-content-center">
                <form action="" method="post" style="width:50vw; min-width:300px;">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="form-label">First Name:</label>
                            <input type="text" class="form-control" name="firstname" placeholder="Juan">
                        </div>
                        <div class="col">
                            <label for="form-label">Last Name:</label>
                            <input type="text" class="form-control" name="lastname" placeholder="Dela Cruz">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">User Name:</label>
                        <input type="text" class="form-control" name="username" placeholder="">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">ID No.:</label>
                        <input type="text" class="form-control" name="id_num" placeholder="ex.2019-123456-AB-0">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" placeholder="name@example.com">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password:</label>
                        <input type="password" class="form-control" name="password" placeholder="provide a strong password">
                    </div>

                    <div class="form-group mb-3">
                        <label>User Type:</label> &nbsp; <!-- select indication -->
                        <input type="radio" class="form-check-input" name="usertype" id="student" value="student">
                        <label for="student" class="form-input-label">Student</label> &nbsp;
                        <input type="radio" class="form-check-input" name="usertype" id="faculty" value="faculty">
                        <label for="faculty" class="form-input-label">Faculty</label> &nbsp;
                        <input type="radio" class="form-check-input" name="usertype" id="admin" value="admin">
                        <label for="admin" class="form-input-label">Admin</label> &nbsp;
                    </div>

                    <div class="mb-5">
                        <button type="submit" class="btn btn-success" name="submit">Save</button>
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