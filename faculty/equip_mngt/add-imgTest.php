<?php
    include "../../connections.php";
    include '../sessions.php';

    if(isset($_POST['submit'])) {
        $equip_code = $_POST['equip_code'];
        $equip_name = $_POST['equip_name'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $total = $_POST['total'];

        // SQL query to add new record
        $sql = "INSERT INTO `equipments`(`id`, `equip_code`, `equip_name`, `category`, `description`, `total`, `available`) 
		VALUES (NULL,'$equip_code','$equip_name','$category', '$description', '$total', '$total')";

        $result = mysqli_query($conn, $sql);

        if($result) {
            header("Location: equip-mngt.php?msg=New Equipment Created Succesfully");
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

        <title>Create Equipment - CPE Lab Room and Equipment Management System</title>
    </head>
    <body>
        <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #4D0000; color: white;">
            Equipment Management
        </nav>

        <div class="container">
            <div class="text-center mb-4">
                <h3>Add New Equipmnet</h3>
                <p class="text-muted">Complete the form below to add new equipment</p>
            </div>

            <div class="container d-flex justify-content-center">
                <form action="" method="post" style="width:50vw; min-width:300px;">
					<!-- Equip Code -->
                    <div class="mb-3">
                        <label class="form-label">Code:</label>
                        <input type="text" class="form-control" name="equip_code" placeholder="pjt001">
                    </div>

					<!-- Equip Name -->
                    <div class="mb-3">
                        <label class="form-label">Name:</label>
                        <input type="text" class="form-control" name="equip_name" placeholder="Name of Equipment" REQUIRED>
                    </div>

					<!-- Category -->
                    <div class="mb-3">
						<label class="form-label">Category</label>
						<select name="category" class="form-control">
							<option value="">--Select Option--</option>
							<option value="Devices">Devices</option>
							<option value="Electronics">Electronics</option>
							<option value="Hardware">Hardware/Computer Parts</option>
							<option value="Others">Others</option>
						</select>
                    </div>

                    <!-- Add img -->
                    <div class="mb-3">
                        <label class="form-label">Upload Image:</label>
                        <input type="file" class="form-control" name="p_img" accept="image/png, image/jpg, image/jpeg" REQUIRED>
                    </div>


                    <!-- Description -->
                    <div class="mb-3">
                        <label class="form-label">Description:</label>
                        <textarea class="form-control" name="description" placeholder="Description" cols="40" rows="5"></textarea>
                        <!-- <input type="text" class="form-control" name="equip_name" placeholder="Name of Equipment" REQUIRED> -->
                    </div>

					<!-- Total -->
                    <div class="mb-3">
                        <label class="form-label">Total:</label>
                        <input type="number" max="50" min="0" class="form-control" name="total" placeholder="max: 50, min: 0" REQUIRED>
                    </div>   

                    <div class="mb-5">
                        <button type="submit" class="btn btn-success" name="submit">Save</button>
                        <a href="equip-mngt.php" class="btn btn-danger">Cancel</a>
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