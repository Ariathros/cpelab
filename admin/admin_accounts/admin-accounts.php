<?php 
    include '../../connections.php';
	include '../sessions.php';

    $sql = "SELECT * FROM useraccounts";
	// result
	$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <TITLE>Admin Account Management - CPE Lab Room and Equipment Management System</TITLE>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
        
        <!-- Bootstrap 5 Data Table by MJ MARAZ-->
        <!-- https://github.com/MJmaraz/datatable-bootstrap5 -->
        <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../assets/css/datatables.min.css">

        <!-- Project plugins -->
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
        <link rel="icon" href="../../assets/images/pup logo.png" type="image/x-icon">
    </head>

    <body>
        <!-- Page Content -->
        <div class="row">

            <!-- Sidebar -->
            <div class="col-3 px-2">
                <?php
                    include "../sidebar.php";
                ?>
            </div>
            <!-- Main Content -->
            <div class="col-9 px-0">
                <!-- Header/ Banner -->
                <DIV style="padding-top:24px; padding-left:24px; padding-right:24px;">
                    <H1 class="navbar navbar-light justify-content-center fs-3" style="background-color: #4D0000; color: white;">
                        <span>Account Management</span>
                        <a class="instruction fa fa-question-circle-o" style="color: white;" data-bs-toggle="popover" data-bs-trigger="hover"
                            title="Account Management" 
                            data-bs-content="Contains all existing account in the system. You can also add, edit, and delete a particular account.">
                        </a>
                    </H1>
                </DIV>

                <div class="container">
                    <!-- Alert message for CRUD operation -->
                    <?php
                        if(isset($_GET['msg'])) {
                            $msg = $_GET['msg'];
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            '.$msg.'
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                        }
                    ?>
                    <!-- Alert message for invalid file uplaod -->
                    <?php
                        if(isset($_GET['err'])) {
                            $err = $_GET['err'];
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            '.$err.'
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                        }
                    ?>
                    <!-- Add button -->
                    <a href="create.php" class="btn btn-success mb-3 button2 :hover">Add New</a>&emsp;
                    <!-- Import button modal -->
                    <button type="button" class="btn btn-info mb-3 button2 :hover" data-bs-toggle="modal" data-bs-target="#importModal">
                        <i class="fa-solid fa-file-import"></i> Import Table
                    </button>

                    <!-- Data table utilities -->
                    <div class="data_table ">
                        <!-- Table content -->
                        <table id="example" class="table table-striped table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Id No.</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">User Type</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Get data in a row from SQL query -->
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?php echo $row['id']?></td>
                                        <td><?php echo $row['firstname']?></td>
                                        <td><?php echo $row['lastname']?></td>
                                        <td><?php echo $row['username']?></td>
                                        <td><?php echo $row['id_num']?></td>
                                        <td><?php echo $row['email']?></td>
                                        <td><?php echo $row['usertype']?></td>
                                        <td><a  href="edit.php?id=<?php echo $row['id']?>" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                        <button type="button" class="btn btn-danger deletebtn" data-bs-toggle="modal" data-bs-target="#deletemodal"><i class="fa-solid fa-trash fs-5"></i> Delete</button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        
                        <!-- Import Modal -->
                        <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Import User Accounts Table </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <b>Guidelines for your table</b>
                                        <p>1. Your table should have a column header in the following order <br>
                                        &emsp;&emsp;<strong>First Name | Last Name | Id No. | Username | Email | Password | Usertype </strong> <br>
                                        2. <b>First Name, Last Name, Username:</b> must not contain special characters <br>
                                        3. <b>Id No.:</b> ex. 2023-000000-AB-0 <br>
                                        4. <b>Email:</b> ex. example@email.com<br>
                                        5. <b>Usertype:</b> Admin | Faculty | Student <br>
                                        </p>
                                        <form action="import-table.php" method="POST" enctype="multipart/form-data">
                                            <input type="file" name="import_file" class="form-control" />
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" name="save_excel_data" class="btn btn-info">Import</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Delete Warning Modal -->
                        <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"> Delete User Data </h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="delete.php" method="POST">

                                        <div class="modal-body">

                                            <input type="hidden" name="delete_id" id="delete_id">

                                            <p> Are you sure you want to delete user? </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cancel </button>
                                            <button type="submit" name="deletedata" class="btn btn-danger"> Delete </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Java Script Files -->
        <script src="../../assets/js/bootstrap.bundle.min.js"></script>
        <script src="../../assets/js/jquery-3.6.0.min.js"></script>
        <script src="../../assets/js/datatables.min.js"></script>
        <script src="../../assets/js/pdfmake.min.js"></script>
        <script src="../../assets/js/vfs_fonts.js"></script>
        <script src="../../assets/js/custom.js"></script>

        <!-- Hover effect -->
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script>
            $(document).ready(function(){
                $('[data-bs-toggle="popover"]').popover()
            })
        </script>

        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
        </script>

        <!-- Modal Delete function -->
        <script>
            $(document).ready(function () {

                $('.deletebtn').on('click', function () {

                    $('#deletemodal').modal('show');

                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function () {
                        return $(this).text();
                    }).get();

                    console.log(data);

                    $('#delete_id').val(data[0]);

                });
            });
        </script>

    </body>

</html>
