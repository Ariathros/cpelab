<?php
	include '../../connections.php';
	include '../sessions.php';
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

		<title>Faculty Room Management - CPE Lab Room and Equipment Management System</title>
	</head>
	<body>
		<?php
			include "../sidebar.php";
		?>

		<nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #4D0000; color: white;">
            Room Management
        </nav>

		<div class="container">
			<?php
				if(isset($_GET['msg'])) {
					$msg = $_GET['msg'];
					echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
					'.$msg.'
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				  </div>';
				}
			?>

			<a href="create.php" class="btn btn-dark mb-3">Add New</a>

			<table class="table table-hover text-center">
				<thead class="table-dark">
					<tr>
					<TH SCOPE="COL">ID</TH>
					<TH SCOPE="COL">Room Number</TH>
					<TH SCOPE="COL">Type</TH>
					<TH SCOPE="COL">Seat Count</TH>
					<TH SCOPE="COL">Status</TH>
					<TH SCOPE="COL">Action</TH>
					</tr>
				</thead>
				<tbody>
					<?php

						$sql = "SELECT * FROM rooms";
						$result = mysqli_query($conn, $sql);
						// This will get all data from our database
						while ($row = mysqli_fetch_assoc($result)) {
							?>
							<tr>
								<td><?php echo $row['id']?></td>
								<td><?php echo $row['room_no']?></td>
								<td><?php echo $row['room_type']?></td>
								<td><?php echo $row['seat_count']?></td>
								<td><?php echo $row['room_status']?></td>
								<td><a href="edit.php?id=<?php echo $row['id']?>" class="link-dark"><i class="fa-solid fa-pen-to-square me-3"></i></a> <!--From fontawesome plugin-->
									<a href="delete.php?id=<?php echo $row['id']?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a></td>
							</tr>
							<?php
						}
					?>
				</tbody>
			</table>
		</div>
		<!-- Bootstrap -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
		integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
		</script>
	</body>
</html>