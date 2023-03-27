<?php
    include "../../connections.php";
    include '../sessions.php';

    $id = $_GET['id'];

    if(isset($_POST['submit'])) {
        $equip_code = $_POST['equip_code'];
        $equip_name = $_POST['equip_name'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $total = $_POST['total'];

        // $target = "../../assets/images/".basename($_FILES['p_img']['name']);
        // $image_upload = $_FILES['p_img']['name'];


		// SQL query to update record
        $sql = "UPDATE `equipments` SET `equip_code`='$equip_code',`equip_name`='$equip_name',
        `category`='$category', `description`='$description',`total`='$total',`available`='$total' WHERE id=$id";

        $result = mysqli_query($conn, $sql);

        if($result) {
            header("Location: equip-mngt.php?msg=Eqiupment details updated succesfully");
        }
        else {
            echo "Failed: " . mysqli_error($conn); 
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
		<script type="text/javascript" src="../../assets/js/ajaxWork.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-4.0.0.min.js" ></script>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="../../assets/css/style.css"></link>

        <title>Edit Equipment - CPE Lab Room and Equipment Management System</title>
    </head>
    <body>
        <div class="row">
            <DIV class="col-3 px-2">
				<?php
					include "../sidebar.php";
				?>
			</DIV>
            <div class="col-9 px-0">
                <DIV style="padding-top:24px; padding-left:24px; padding-right:24px;">
                    <H1 class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #4D0000; color: white;">
                        Equipment Management
                    </H1>
                </DIV>

                <div class="container" style="padding-left:24px; padding-right:24px;">
                    <div class="text-center mb-4">
                        <h3>Update Equipment Details</h3>
                        <p class="text-muted">Click update to apply changes</p>
                    </div>
                    <!-- Get ID on each record where update button is pressed, limit to 1 to only get 1 record-->
                    <?php
                        $sql = "SELECT * FROM equipments WHERE id=$id LIMIT 1";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                    ?>

                    <div class="container d-flex justify-content-center">
                        <form action="" method="post" style="width:50vw; min-width:300px;" enctype="multipart/form-data">
                            <!-- Equipment Code -->
                            <div class="row mb-3">
                                <label for="form-label">Equipment Code:</label>
                                <input type="text" class="form-control" name="equip_code" 
                                value="<?php echo $row['equip_code']?>">
                            </div>

                            <!-- Equipment Name -->
                            <div class="row mb-3">
                                <label for="form-label">Equipment Name:</label>
                                <input type="text" class="form-control" name="equip_name" 
                                value="<?php echo $row['equip_name']?>">
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

                            <!-- Description -->
                            <div class="mb-3">
                                <label class="form-label">Description:</label>
                                <textarea class="form-control" name="description" placeholder="Description" cols="40" rows="5"><?php echo $row['description']; ?></textarea>
                                
                            </div>
                            <!-- Image update -->
                            <!-- Tanggalin pag di na kaya XD -->
                            <!-- <div class="mb-3">
                            <label class="form-label">Choose Image:</label>
                                <input type="file"  name="p_img" accept="image/png, image/jpg, image/jpeg, image/PNG"?>">
                            
                            </div> -->
                            <!-- Total -->
                            <div class="mb-3">
                                <label class="form-label">Total:</label>
                                <input type="number" class="form-control" name="total" max="50" min="0" 
                                value="<?php echo $row['total']?>">
                            </div>

                            <div class="mb-5">
                                <button type="submit" class="btn btn-success" name="submit">Update</button>
                                <a href="equip-mngt.php" class="btn btn-danger">Cancel</a>
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