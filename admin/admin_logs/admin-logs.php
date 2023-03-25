<?php 
    include '../../connections.php';
	include '../sessions.php';

    $sql = "SELECT * FROM logs";
	// result
	$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <TITLE>Admin Logs - CPE Lab Room and Equipment Management System</TITLE>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
        
        <!-- Bootstrap 5 Data Table by MJ MARAZ-->
        <!-- https://github.com/MJmaraz/datatable-bootstrap5 -->
        <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../assets/css/datatables.min.css">
        <link rel="stylesheet" href="../../assets/css/style.css">

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
                        <span>Logs</span>
						<a class="instruction fa fa-question-circle-o" style="color: white;" data-bs-toggle="popover" data-bs-trigger="hover"
							title="Logs" 
							data-bs-content="Contains list of actions, approved and declined reservation, inside the application 
							and their corresponding details.">
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
                    <!-- Data table filters -->
                    <div class="data_table ">
                        <!-- Table content -->
                        <table id="example" class="table table-striped table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <TH SCOPE="COL">ID</TH>
									<TH SCOPE="COL">Name</TH>
									<TH SCOPE="COL">Type</TH>
									<TH SCOPE="COL">Category</TH>
									<TH SCOPE="COL">Action</TH>
									<TH SCOPE="COL">Action By</TH>
									<TH SCOPE="COL">Student</TH>
									<TH SCOPE="COL">Date</TH>
									<TH SCOPE="COL">Time</TH>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Get data in a row from SQL query -->
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?= $row['id']; ?></td>
										<td><?= $row['name']; ?></td>
										<td><?= $row['type']; ?></td>
										<td><?= $row['category']; ?></td>
										<td><?= $row['action']; ?></td>
										<td><?= $row['faculty']; ?></td>
										<td><?= $row['student']; ?></td>
										<td><?= $row['date']; ?></td>
										<td><?= $row['time_start'] . "-" . $row['time_end']; ?></td>
                                        <!-- Archive function - move data from logs to archive after 5 months -->
                                        <?php
                                        // Set record overdue to creation date + 5 months
                                        $startDate = strtotime($row['date']. '+5 months');
                                        // get the current date
                                        $archiveDate = strtotime(date('y-m-d'));
                                        // Check if record is overdue
                                        if($startDate < $archiveDate) {
                                            // Insert overdue record to 'archive' table
                                            mysqli_query($conn, "INSERT INTO `archive`(`archive_id`,`id`, `name`, `type`, `category`, `action`, `faculty`, 
                                            `student`, `time_start`, `time_end`, `date`) VALUES ('','$row[id]',
                                            '$row[name]','$row[type]','$row[category]','$row[action]','$row[faculty]','$row[student]',
                                            '$row[time_start]','$row[time_end]','$row[date]')");
                                            // Delete record from logs table, it will generate new record to archive if not deleted
                                            mysqli_query($conn, "DELETE FROM `logs` WHERE '$row[id]'='$row[id]'");
                                        };?>
                                    </tr>
                                <?php } 
                                mysqli_close($conn); ?>
                            </tbody>
                        </table>
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

    </body>

</html>
